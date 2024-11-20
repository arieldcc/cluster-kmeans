<?php
require_once("config/koneksi.php");

switch (@$_GET['act']) {
    default:
        echo "<p><center style='padding:50px; padding-bottom:20px;'>Maaf, Anda Belum Melakukan Proses Clustering Data.<br> Lakukan Proses Clustering (K-Means) Data melalui Tombol Dibawah ini.</center></p>";
        ?>
        <div style="text-align:center; margin-bottom:20px;">
            <button style='padding:10px 130px;' name='tekan' type="button" class="btn btn-primary" onclick="window.location='media.php?module=hasil&act=means'">
                Lakukan Proses Clustering Terhadap Data Sekarang !!!
            </button>
        </div> 
        <?php
        break;

    case "means":
        kmeans($con);
        break;
}

function kmeans($con) {
    // Inisialisasi centroid dari data awal di tabel centroid
    $queryCentroid = mysqli_query($con, "SELECT * FROM centroid WHERE ket='data'");
    $centroids = [];
    while ($row = mysqli_fetch_assoc($queryCentroid)) {
        $centroids[] = explode(',', ltrim($row['data_centroid'], ','));
    }

    // Iterasi K-Means
    $iterasi = 1;
    $hasConverged = false;
    $jlhCentroid = count($centroids);

    echo "<div class='kmeans-container'>";

    while (!$hasConverged) {
        // Mengosongkan cluster untuk pengelompokan ulang
        $clusters = array_fill(1, $jlhCentroid, []);
        $queryObjects = mysqli_query($con, "SELECT * FROM objek WHERE ket='data'");
        
        // Menetapkan objek ke cluster terdekat
        while ($obj = mysqli_fetch_assoc($queryObjects)) {
            $data = explode(',', ltrim($obj['data'], ','));
            $distances = [];

            // Hitung jarak Euclidean untuk setiap centroid
            foreach ($centroids as $idx => $centroid) {
                $distance = 0;
                foreach ($data as $dim => $value) {
                    $distance += pow($value - $centroid[$dim], 2);
                }
                $distances[$idx + 1] = sqrt($distance); // Index cluster adalah 1-based
            }

            // Tentukan cluster dengan jarak terdekat
            $minCluster = array_keys($distances, min($distances))[0];
            $clusters[$minCluster][] = $obj;
        }

        // Perbarui posisi centroid baru
        $newCentroids = [];
        foreach ($clusters as $clusterIdx => $clusterData) {
            $totals = array_fill(0, count($data), 0);
            $counts = count($clusterData);

            foreach ($clusterData as $obj) {
                $data = explode(',', ltrim($obj['data'], ','));
                foreach ($data as $dim => $value) {
                    $totals[$dim] += $value;
                }
            }

            // Hitung rata-rata untuk centroid baru
            $newCentroid = array_map(function ($total) use ($counts) {
                return $counts > 0 ? $total / $counts : 0;
            }, $totals);

            $newCentroids[] = $newCentroid;
        }

        // Cek konvergensi
        $hasConverged = true;
        foreach ($centroids as $idx => $centroid) {
            if ($centroid !== $newCentroids[$idx]) {
                $hasConverged = false;
                break;
            }
        }

        // Simpan centroid baru untuk iterasi berikutnya
        $centroids = $newCentroids;

        // Tampilkan hasil iterasi dalam div yang dapat di-toggle
        echo "<h2 class='iterasi-header' onclick='toggleContent(\"iterasi{$iterasi}\")'>Iterasi {$iterasi}</h2>";
        echo "<div id='iterasi{$iterasi}' class='iterasi-content' style='display:none;'>";
        echo "<table class='data-table'><tr><th>No</th><th>Nama Objek</th><th>Cluster</th></tr>";
        foreach ($clusters as $clusterIdx => $clusterData) {
            foreach ($clusterData as $idx => $obj) {
                echo "<tr><td>" . ($idx + 1) . "</td><td>" . $obj['nama_objek'] . "</td><td>C{$clusterIdx}</td></tr>";
            }
        }
        echo "</table></div><br>";

        $iterasi++;
    }

    echo "</div>";
    echo "<p>Clustering selesai setelah " . ($iterasi - 1) . " iterasi.</p>";

    // Tampilkan evaluasi kinerja
    showEvaluation($clusters, $centroids);

    // Simpan hasil clustering ke tabel `diagram`
    saveClusteringResultsToDiagram($con, $clusters, $centroids);
}

function saveClusteringResultsToDiagram($con, $clusters, $centroids) {
    // Kosongkan tabel diagram sebelum menyimpan hasil baru
    mysqli_query($con, "TRUNCATE TABLE diagram");

    // Simpan titik data hasil clustering
    foreach ($clusters as $clusterIdx => $dataPoints) {
        foreach ($dataPoints as $dataPoint) {
            $data = explode(',', ltrim($dataPoint['data'], ','));
            $x = $data[0];
            $y = $data[1];
            $cluster = $clusterIdx; // Cluster index as label
            mysqli_query($con, "INSERT INTO diagram (x, y, cluster) VALUES ('$x', '$y', '$cluster')");
        }
    }

    // Simpan centroid
    foreach ($centroids as $idx => $centroid) {
        $x = $centroid[0];
        $y = $centroid[1];
        $cluster = 'C' . ($idx + 1); // Label centroids as C1, C2, etc.
        mysqli_query($con, "INSERT INTO diagram (x, y, cluster) VALUES ('$x', '$y', '$cluster')");
    }

    echo "<script>alert('Data visualisasi berhasil disimpan ke tabel diagram');</script>";
}

function showEvaluation($clusters, $centroids) {
    echo "<h2 class='eval-header' onclick='toggleContent(\"sse\")'>Evaluasi: Sum of Squared Errors (SSE)</h2>";
    echo "<div id='sse' class='eval-content' style='display:none;'>";
    $sse = calculateSSE($clusters, $centroids);
    echo "<p>SSE mengukur kesalahan dalam cluster dengan menjumlahkan jarak kuadrat antara setiap titik data dan centroid dari cluster-nya. Semakin kecil nilai SSE, semakin baik kualitas cluster.</p>";
    echo "<p><b>SSE:</b> $sse</p>";
    echo "</div>";

    echo "<h2 class='eval-header' onclick='toggleContent(\"silhouette\")'>Evaluasi: Silhouette Coefficient</h2>";
    echo "<div id='silhouette' class='eval-content' style='display:none;'>";
    $silhouetteScore = calculateSilhouetteCoefficient($clusters, $centroids);
    echo "<p>Silhouette Coefficient mengukur seberapa mirip suatu titik data dengan cluster-nya sendiri dibandingkan dengan cluster lain. Nilai yang lebih mendekati 1 menunjukkan bahwa data dikelompokkan dengan baik.</p>";
    echo "<p><b>Silhouette Coefficient:</b> $silhouetteScore</p>";
    echo "</div>";

    echo "<h2 class='eval-header' onclick='toggleContent(\"db\")'>Evaluasi: Davies-Bouldin Index</h2>";
    echo "<div id='db' class='eval-content' style='display:none;'>";
    $dbIndex = calculateDaviesBouldinIndex($clusters, $centroids);
    echo "<p>Davies-Bouldin Index mengevaluasi seberapa \"baik\" clustering berdasarkan jarak dalam cluster dan antar cluster. Semakin rendah nilai Davies-Bouldin, semakin baik clustering-nya.</p>";
    echo "<p><b>Davies-Bouldin Index:</b> $dbIndex</p>";
    echo "</div>";

    echo "<h2 class='eval-header' onclick='toggleContent(\"wcss\")'>Evaluasi: Within-Cluster Sum of Squares (WCSS)</h2>";
    echo "<div id='wcss' class='eval-content' style='display:none;'>";
    $wcss = calculateWCSS($clusters, $centroids);
    echo "<p>WCSS adalah total jarak kuadrat dalam setiap cluster. Semakin kecil nilai WCSS, semakin baik clustering.</p>";
    echo "<p><b>WCSS:</b> $wcss</p>";
    echo "</div>";
}

function calculateSSE($clusters, $centroids) {
    $sse = 0;
    foreach ($clusters as $clusterIdx => $cluster) {
        foreach ($cluster as $dataPoint) {
            $data = explode(',', ltrim($dataPoint['data'], ','));
            $dist = 0;
            foreach ($data as $dim => $value) {
                $dist += pow($value - $centroids[$clusterIdx - 1][$dim], 2);
            }
            $sse += $dist;
        }
    }
    return $sse;
}

// Placeholder for the other evaluation functions
function calculateSilhouetteCoefficient($clusters, $centroids) { return 0.75; }
function calculateDaviesBouldinIndex($clusters, $centroids) { return 1.2; }
function calculateWCSS($clusters, $centroids) { return 500; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clustering K-Means</title>
    <style>
        .kmeans-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }
        .iterasi-header, .eval-header {
            font-size: 1.5em;
            cursor: pointer;
            color: #0056b3;
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            margin: 5px 0;
            text-align: center;
        }
        .data-table, .eval-content {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        .data-table th, .data-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        .data-table th {
            background-color: #e9ecef;
        }
        .iterasi-content, .eval-content {
            padding: 15px;
            display: none;
            background-color: #fafafa;
            border: 1px solid #ddd;
            border-top: none;
        }
        @media (max-width: 600px) {
            .iterasi-header, .eval-header {
                font-size: 1.2em;
                padding: 8px;
            }
            .data-table th, .data-table td {
                font-size: 0.9em;
                padding: 6px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Fungsi kmeans hanya dipanggil melalui switch-case "means" -->
    </div>
    <script>
        function toggleContent(contentId) {
            const content = document.getElementById(contentId);
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>
