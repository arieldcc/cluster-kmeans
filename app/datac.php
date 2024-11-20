<?php
require_once("config/koneksi.php");
?>

<!-- JavaScript for Row Manipulation -->
<script>
function addRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "text";
    cell1.appendChild(element1);
}

function confirmdelete(delUrl) {
    if (confirm("Anda yakin ingin menghapus?")) {
        document.location = delUrl;
    }
}
</script>

<!-- Display Data Section -->
<?php
switch(@$_GET['act']) {
    default:
        $qcari = mysqli_query($con, "SELECT COUNT(*) as jum FROM tb_atribut");
        $rcari = mysqli_fetch_array($qcari);
        $jlhattrib = $rcari['jum'];
?>

<div class="form-container">
    <center>
        <input type="button" value="Tambah Data Centeroid" class="button" onclick="window.location='media.php?module=datac&act=forminput'">
        <input type="button" value="Bersihkan Tabel Centeroid" class="button" onclick="window.location='media.php?module=datac&act=hapusAll'">
    </center>

    <div style="width:100%; overflow:auto;">
        <table class="data" width="100%">
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <?php
                // Display attribute headers
                $tampil = mysqli_query($con, "SELECT * FROM tb_atribut ORDER BY id_atribut ASC");
                while ($r = mysqli_fetch_array($tampil)) {
                    echo "<th>{$r['nm_atribut']}</th>";
                }
                ?>
                <th>Aksi</th>
            </tr>
            <?php
            // Fetch centroids data and display in table
            $query = mysqli_query($con, "SELECT * FROM centroid WHERE ket='data' ORDER BY id_centroid ASC");
            $no = 1;
            while ($r = mysqli_fetch_array($query)) {
                $data = explode(',', ltrim($r['data_centroid'], ',')); // Remove any leading comma
                echo "<tr>
                        <td align='center'>$no</td>
                        <td>{$r['nm_data']}</td>";
                
                // Display each attribute value in a cell
                for ($n = 1; $n <= $jlhattrib; $n++) {
                    echo "<td align='center'>" . (isset($data[$n - 1]) ? $data[$n - 1] : '') . "</td>";
                }

                echo "<td align='center'>
                        <a href=\"javascript:confirmdelete('media.php?module=datac&act=hapus&id={$r['id_centroid']}')\">
                            <img src='images/cancel.gif' title='Hapus'>
                        </a>
                      </td>
                     </tr>";
                $no++;
            }
            ?>
        </table>
    </div>
</div>

<?php
    echo "<p><b>Total Data: $jlhData record(s)</b></p>";
    break;

case "hapusAll":
    mysqli_query($con, "TRUNCATE centroid");
    echo "<script>alert('Sukses Menghapus Semua Data Centroid'); window.location='media.php?module=datac';</script>";
    break;

case "forminput":
?>

<!-- Input Form Section -->
<div class="form-container">
    <h2>Input Dataset</h2>
    <form action="media.php?module=datac&act=simpandata" method="post" enctype="multipart/form-data">
        <table class="data" width="100%">
            <tr>
                <td width="20%">Nama Barang</td>
                <td width="5%">:</td>
                <td><input type="text" name="nm_data" class="form-control" placeholder="Input Nama Barang"></td>
            </tr>
        </table>

        <table class="data" width="100%">
            <tr>
                <td colspan="4" align="center"><h2>Nilai Atribut</h2></td>
            </tr>

            <?php
            // Display attribute inputs
            $q_atribut = mysqli_query($con, "SELECT * FROM tb_atribut ORDER BY id_atribut ASC");
            $no = 1;
            while ($r_atribut = mysqli_fetch_array($q_atribut)) {
                echo "<tr>
                        <td width='5%' align='center'>$no</td>
                        <td width='20%'>{$r_atribut['nm_atribut']}</td>
                        <td width='5%'>:</td>
                        <td><input type='text' class='form-control' name='data$no' placeholder='Input Hanya Angka..'></td>
                      </tr>";
                $no++;
            }
            ?>
            <tr>
                <td colspan="4" align="center">
                    <input type="button" value="<< Kembali" class="button" onclick="history.go(-1)">
                    <input type="submit" value="Simpan" class="button">
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
    break;

case "simpandata":
    $qcari = mysqli_query($con, "SELECT COUNT(*) as jum FROM tb_atribut");
    $rcari = mysqli_fetch_array($qcari);
    $jlhattrib = $rcari['jum'];
    $data = [];

    // Collect attribute values
    for ($i = 1; $i <= $jlhattrib; $i++) {
        $data[$i - 1] = $_POST['data' . $i];
    }
    $tmp = implode(',', $data);

    // Insert centroid data
    $query = mysqli_query($con, "INSERT INTO centroid (nm_data, data_centroid, ket) VALUES ('{$_POST['nm_data']}', '$tmp', 'data')");
    if ($query) {
        echo "<script>alert('Data sukses di proses...'); window.location='media.php?module=datac';</script>";
    } else {
        echo mysqli_error($con);
    }
    break;

case "hapus":
    $query = mysqli_query($con, "DELETE FROM centroid WHERE id_centroid='{$_GET['id']}'");
    if ($query) {
        echo "<script>alert('Data sudah dihapus!'); window.location='media.php?module=datac';</script>";
    } else {
        echo mysqli_error($con);
    }
    break;
}
?>
