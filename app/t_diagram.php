<?php
// clustering_visualization.php
require_once("config/koneksi.php");

// Fetch clustering data from the `diagram` table
$query = mysqli_query($con, "SELECT x, y, cluster FROM diagram");
$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = [
        'x' => (float)$row['x'],
        'y' => (float)$row['y'],
        'cluster' => $row['cluster']
    ];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clustering Visualization</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 90%; max-width: 800px; margin: auto;">
        <h2 style="text-align: center;">K-Means Clustering Visualization</h2>
        <canvas id="clusteringChart"></canvas>
    </div>

    <script>
        // Data from PHP
        const dataFromPHP = <?php echo json_encode($data); ?>;

        const clusters = {};
        const centroids = [];

        // Organize data into clusters and centroids
        dataFromPHP.forEach(point => {
            const { x, y, cluster } = point;
            if (cluster.startsWith('C')) {
                // Centroids labeled as C1, C2, etc.
                centroids.push({ x, y, cluster });
            } else {
                if (!clusters[cluster]) clusters[cluster] = [];
                clusters[cluster].push({ x, y });
            }
        });

        // Prepare data for Chart.js
        const datasets = Object.keys(clusters).map(cluster => ({
            label: `Cluster ${cluster}`,
            data: clusters[cluster],
            backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`,
            borderColor: 'rgba(0, 0, 0, 0.1)',
            borderWidth: 1,
            pointRadius: 5
        }));

        // Add centroids as a separate dataset
        datasets.push({
            label: 'Centroids',
            data: centroids,
            backgroundColor: 'rgba(255, 0, 0, 0.8)', // Red color for centroids
            borderColor: 'rgba(0, 0, 0, 0.1)',
            borderWidth: 1,
            pointRadius: 8,
            pointStyle: 'rect'
        });

        // Create the Chart.js scatter plot
        const ctx = document.getElementById('clusteringChart').getContext('2d');
        new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.dataset.label}: (${tooltipItem.raw.x}, ${tooltipItem.raw.y})`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        title: {
                            display: true,
                            text: 'X Coordinate'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Y Coordinate'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
