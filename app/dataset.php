<?php
	require_once("config/koneksi.php");
?>

<link type="text/css" rel="stylesheet" href="development-bundle/themes/ui-lightness/ui.all.css" />

    <script src="development-bundle/jquery-1.8.0.min.js"></script>
    <script src="development-bundle/ui/ui.core.js"></script>
    <script src="development-bundle/ui/ui.datepicker.js"></script>
    <script src="development-bundle/ui/i18n/ui.datepicker-id.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                $("#tgllahir").datepicker({
                    dateFormat : "mm/dd/yy",
                    changeMonth : true,
                    changeYear : true
                });
            });
        </script>

<!-- end jq -->
<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
</script>

<?php
switch(@$_GET['act']){
  // Tampil Data
  default:
  $qcari = mysqli_query($con,"SELECT COUNT(*) as jum FROM tb_atribut"); // Jumlah atrribut
        $rcari = mysqli_fetch_array($qcari);
        $jlhattrib = $rcari['jum'];
  	?>
 
	<div class="form-container">
    <h2>Data Set</h2>

    <!-- File Upload Form -->
    <form method="post" enctype="multipart/form-data" action="media.php?module=proses_excel">
        <p>Data Excel:</p>
        <input style="border:1px solid #000;" name="userfile" type="file" class="btn form-control">
        <input name="upload" type="submit" value="Import" class="button">
        <input type="button" value="Hapus Semua" class="button" onclick="window.location.href='media.php?module=dataset&act=hapusdata';">
    </form>

    <br>

    <!-- Add Data Set Button -->
    <center>
        <input type="button" name="button" value="Tambah Data Set" class="button" onclick="javascript:window.location='media.php?module=dataset&act=forminput'">
    </center>

    <div class="table-container" style="overflow: auto;">
        <!-- Data Table -->
        <table class="data">
            <tr>
                <th width="30">No.</th>
                <th width="140">Nama Barang</th>
                
                <?php
                // Fetch all attributes for header columns
                $tampil = mysqli_query($con, "SELECT * FROM tb_atribut ORDER BY id_atribut ASC");
                $attributes = []; // Array to store attribute names
                while ($r = mysqli_fetch_array($tampil)) {
                    $attributes[] = $r['nm_atribut'];
                    echo "<th>{$r['nm_atribut']}</th>";
                }
                $attribute_count = count($attributes); // Total number of attributes
                ?>
                
                <th width="30">Aksi</th>
            </tr>

            <?php
            // Pagination Logic
            $per_page = 10; // Items per page
            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($current_page - 1) * $per_page;

            // Count total items for pagination
            $total_items_query = mysqli_query($con, "SELECT COUNT(*) AS count FROM objek WHERE ket='data'");
            $total_items_row = mysqli_fetch_array($total_items_query);
            $total_items = $total_items_row['count'];
            $total_pages = ceil($total_items / $per_page);

            // Fetch data with limit and offset for pagination
            $query = mysqli_query($con, "SELECT * FROM objek WHERE ket='data' ORDER BY id_objek ASC LIMIT $offset, $per_page");
            $no = $offset + 1;

            // Display data rows
            while ($r = mysqli_fetch_array($query)) {
			    // Remove any leading comma before splitting the data
			    $data = explode(',', ltrim($r['data'], ','));

			    // Ensure data has the same number of items as attributes
			    while (count($data) < $attribute_count) {
			        $data[] = ''; // Fill missing data with empty strings if needed
			    }

			    echo "<tr>
			            <td align='center'>$no</td>
			            <td>$r[nama_objek]</td>";

			    // Display each attribute's data
			    for ($i = 0; $i < $attribute_count; $i++) {
			        echo "<td align='center'>" . (isset($data[$i]) ? $data[$i] : '') . "</td>";
			    }

			    echo "<td align='center'>
			            <a href=\"javascript:confirmdelete('media.php?module=dataset&act=hapus&id=$r[id_objek]')\" title='Hapus' class='with-tip'>
			                <img src='images/cancel.gif'>
			            </a>
			          </td>
			        </tr>";
			    $no++;
			}

            ?>
        </table>
    </div>

    <br>

    <!-- Display Total Data Count -->
    <p><b>Total Data: <?php echo $total_items; ?> record(s)</b></p>

    <!-- Pagination Controls -->
    <div class="pagination-container">
        <ul class="pagination">
            <?php
            $visible_links = 3; // Number of links to show around the current page

            if ($current_page > 1) {
                echo "<li><a href='?module=dataset&page=" . ($current_page - 1) . "'>&laquo;</a></li>";
            }

            // Start of the pagination
            if ($current_page > $visible_links + 1) {
                echo "<li><a href='?module=dataset&page=1'>1</a></li>";
                if ($current_page > $visible_links + 2) {
                    echo "<li><span>...</span></li>"; // Ellipsis for skipped pages
                }
            }

            // Display surrounding pages
            $start = max(1, $current_page - $visible_links);
            $end = min($total_pages, $current_page + $visible_links);

            for ($i = $start; $i <= $end; $i++) {
                if ($i == $current_page) {
                    echo "<li class='active'><a href='#'>$i</a></li>";
                } else {
                    echo "<li><a href='?module=dataset&page=$i'>$i</a></li>";
                }
            }

            // End of the pagination
            if ($current_page < $total_pages - $visible_links) {
                if ($current_page < $total_pages - $visible_links - 1) {
                    echo "<li><span>...</span></li>"; // Ellipsis for skipped pages
                }
                echo "<li><a href='?module=dataset&page=$total_pages'>$total_pages</a></li>";
            }

            if ($current_page < $total_pages) {
                echo "<li><a href='?module=dataset&page=" . ($current_page + 1) . "'>&raquo;</a></li>";
            }
            ?>
        </ul>
    </div>
</div>


<?php
// Insert and delete operations for Centroid
if (isset($_POST['submit1'])) {
    mysqli_query($con, "INSERT INTO centroid (data_centroid) VALUES ('$_POST[centroid]')");
    echo "<script>alert('Sukses Memasukkan Centroid Baru.'); window.location.href='media.php?module=dataset';</script>";
}
if (isset($_GET['id'])) {
    mysqli_query($con, "DELETE FROM centroid WHERE id_centroid=$_GET[id]");
    echo "<script>alert('Sukses Menghapus Data Centroid.'); window.location.href='media.php?module=dataset';</script>";
}
?>

	 <?php
	 if (isset($_POST['submit1'])){
		mysqli_query($con,"insert into centroid (data_centroid) VALUES ('$_POST[centroid]')");
		echo "<script>window.alert('Sukses Memasukkan Centroid Baru. . .');
        window.location=('media.php?module=dataset')</script>";
	}
	if (@$_GET['id'] != ''){
		mysqli_query($con,"DELETE FROM centroid where id_centroid=$_GET[id]");
		echo "<script>window.alert('Sukses Menghapus Data Centroid. . .');
        window.location=('media.php?module=dataset')</script>";
	}
  break;

   case "hapusdata":
  	mysqli_query($con,"TRUNCATE objek");
	echo "<script>window.alert('Sukses Menghapus Semua Dataset');
			window.location=('media.php?module=dataset')</script>";
  break;

  case "forminput":
  	?>
  	<div class="form-container">
    <h2>Input Dataset</h2>

    <form action="media.php?module=dataset&act=simpandata" method="post" id="datasetinistrasi" name="datasetinistrasi" enctype="multipart/form-data">
        <table class="data">
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><input type="text" name="nama_objek" class="panjang" placeholder="Input Nama Barang" /></td>
            </tr>
        </table>

        <table class="data">
            <tr>
                <td colspan="3"><h2>Nilai Atribut</h2></td>
            </tr>

            <?php
            $q_atribut = mysqli_query($con, "SELECT * FROM tb_atribut ORDER BY id_atribut ASC");
            $no = 1;
            while ($r_atribut = mysqli_fetch_array($q_atribut)) {
                echo "<tr>
                        <td align='center'>$no</td>
                        <td>{$r_atribut['nm_atribut']}</td>
                        <td><input type='hidden' name='id_atribut$no' value='{$r_atribut['id_atribut']}' />
                            <input type='text' name='data$no' class='panjang' placeholder='Input Hanya Angka..' /></td>
                    </tr>";
                $no++;
            }
            ?>
            <tr>
                <td colspan="3" align="center">
                    <input type="button" value="<< Kembali" class="button" onclick="history.go(-1)" />
                    <input type="submit" value="Simpan" class="button" />
                </td>
            </tr>
        </table>
    </form>
</div>

 &nbsp;
    <?php
  break;
  case "simpandata":
		$qcari = mysqli_query($con,"SELECT COUNT(*) as jum FROM tb_atribut"); // Jumlah atrribut
        $rcari = mysqli_fetch_array($qcari);
        $jlhattrib = $rcari['jum'];
		$data[] = "";
		$id_atribut[] = "";
		$tmp = "";
		//$tot = 0;
		for($i=1; $i<=$jlhattrib; $i++){
			$data[$i] = $_POST['data'.$i.''];
			/*
			$id_atribut[$i] = $_POST['id_atribut'.$i.''];
			$query=mysqli_query("insert into tb_tmpdataset(
							id_dataset,
							id_atribut,
							id_nilaiatribut
						)values(
							'$_POST[id_dataset]',
							'".$id_atribut[$i]."',
							'".$data[$i]."'
							)");
							*/
			$tmp = implode(',',$data);
		}
		//echo "xx = ".$tmp;
		$query=mysqli_query($con,"insert into objek(
							nama_objek,
							data
						)values(
							'$_POST[nama_objek]',
							'$tmp'
							)");

		if($query){
			?><script language="javascript">alert("Data sukses di proses...")</script><?php
			
			?><script language="javascript">document.location.href="media.php?module=dataset"</script><?php
		}else{
			echo mysqli_error();
		}
  break;

  case "hapus":
  	$query=mysqli_query($con,"DELETE FROM objek WHERE id_objek='$_GET[id]'");
		if($query){
			?><script language="javascript">alert("Data sudah dihapus !")</script><?php
			?><script language="javascript">document.location.href="media.php?module=dataset"</script><?php
		}else{
			echo mysqli_error();
		}
  break;

}
  	?>