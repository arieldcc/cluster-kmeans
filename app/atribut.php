<?php
	require_once("config/koneksi.php");
?>
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
  // Tampil Data atribut
  default:
  	?>
						
						<div class="table-container">
    <center>
        <input type='button' name='button' value='Tambah Data Atribut' class='button' onclick="javascript:window.location='media.php?module=atribut&act=forminput'">
    </center>
    <hr>
    <table class="data">
        <tr>
            <th width="50">No.</th>
            <th>Nama Atribut</th>
            <th width="80">Aksi</th>
        </tr>
        <?php
        if(!isset($_GET['hal'])){
            $page = 1;
            $hal = 1;
        } else {
            $page = $_GET['hal'];
        }
        $jmlperhalaman = 12;  // jumlah record per halaman
        $offset = (($page * $jmlperhalaman) - $jmlperhalaman);

        $tampil = mysqli_query($con, "SELECT * FROM tb_atribut ORDER BY id_atribut ASC LIMIT $offset, $jmlperhalaman");

        $no = 1;
        while ($r = mysqli_fetch_array($tampil)) {
            $g = str_pad($no, 2, "0", STR_PAD_LEFT);

            echo "<tr>
                    <td><center>$g</center></td>
                    <td>$r[nm_atribut]</td>
                    <td>
                        <center>
                            <a href='media.php?module=atribut&act=tampil&id=$r[id_atribut]' title='Tampil' class='with-tip'><img src='images/view.png'></a>
                            <a href='media.php?module=atribut&act=edit&id=$r[id_atribut]' title='Edit' class='with-tip'><img src='images/edit.gif'></a>
                            <a href=\"javascript:confirmdelete('media.php?module=atribut&act=hapus&id=$r[id_atribut]')\" title='Hapus' class='with-tip'><img src='images/cancel.gif'></a>
                        </center>
                    </td>
                </tr>";
            $no++;
        }
        ?>
    </table>

    <?php
    // Pagination
    $qtotal_record = mysqli_query($con, "SELECT COUNT(*) as Num FROM tb_atribut");
    $rtotal_record = mysqli_fetch_array($qtotal_record);
    $total_record = $rtotal_record['Num'];
    $total_halaman = ceil($total_record / $jmlperhalaman);
    echo "<div class='pagination-container'><ul class='pagination'>";

    $perhal = 4;
    if($hal > 1){
        $prev = ($page - 1);
        echo "<li><a href='media.php?module=atribut&hal=$prev'>&laquo;</a></li>";
    }
    $hal1 = max(1, $hal - $perhal);
    $hal2 = min($total_halaman, $hal + $perhal);

    for($i = $hal1; $i <= $hal2; $i++){
        if($hal == $i){
            echo "<li class='active'><a href='#'>$i</a></li>";
        } else {
            echo "<li><a href='media.php?module=atribut&hal=$i'>$i</a></li>";
        }
    }
    if($hal < $total_halaman){
        $next = ($page + 1);
        echo "<li><a href='media.php?module=atribut&hal=$next'>&raquo;</a></li>";
    }
    echo "</ul></div>";
    ?>
</div>

		<?php
  break;
   case "forminput":
  	?>

	<div class="form-container">
    <h2>Input Data Atribut</h2>

    <form action="media.php?module=atribut&act=simpandata" method="post" id="atribut" name="atribut" enctype="multipart/form-data">
        <table class="data">
            <tr>
                <td colspan="3" align="center"><hr /></td>
            </tr>
            <tr>
                <td width="150"><p>Nama Atribut</p></td>
                <td width="5">:</td>
                <td><input type="text" name="nm_atribut" class="panjang" placeholder="Masukkan Nama Atribut" /></td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <input type="button" name="button" value="<< Kembali" class="button" onclick="history.go(-1)" />
                    <input type="submit" name="button" value="Simpan" class="button" />
                </td>
            </tr>
        </table>
    </form>
</div>

  &nbsp;

	<?php
  break;

  case "tampil":
  	$edit = mysqli_query($con,"SELECT * FROM tb_atribut WHERE id_atribut='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
  ?>
<div class="form-container">
    <h2>Detail Data Atribut</h2>

    <form action="" method="post" id="atribut" name="atribut" enctype="multipart/form-data">
        <table class="data">
            <tr>
                <td>ID Atribut</td>
                <td width="5">:</td>
                <td><?php echo $r['id_atribut']; ?></td>
            </tr>
            <tr>
                <td>Nama Atribut</td>
                <td>:</td>
                <td><?php echo $r['nm_atribut']; ?></td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <input type="button" name="button" value="<< Kembali" class="button" onclick="history.go(-1)" />
                </td>
            </tr>
        </table>
    </form>
</div>

  &nbsp;


 
 <?php
  break;

  case "edit":
  	$edit = mysqli_query($con,"SELECT * FROM tb_atribut WHERE id_atribut='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
  ?>

 
								<div class="form-container">
    <h2>Edit Data Atribut</h2>

    <form action="media.php?module=atribut&act=update" method="post" id="atribut" name="atribut" enctype="multipart/form-data">
        <table class="data">
            <tr>
                <td width="200">ID Atribut</td>
                <td width="5">:</td>
                <td><input type="text" name="id_atribut" class="pendek" value="<?php echo $r['id_atribut']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Nama Atribut</td>
                <td>:</td>
                <td><input type="text" name="nm_atribut" class="panjang" value="<?php echo $r['nm_atribut']; ?>" placeholder="Input Nama Atribut" /></td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <input type="button" name="button" value="<< Kembali" class="button" onclick="history.go(-1)" />
                    <input type="submit" name="button" value="Ubah" class="button" />
                </td>
            </tr>
        </table>
    </form>
</div>



  &nbsp;
 <?php
  break;

  case "simpandata":
  			$query=mysqli_query($con,"insert into tb_atribut(
								nm_atribut
							)values(
								'$_POST[nm_atribut]'
							)");


  	 if($query){
			?><script language="javascript">alert("Data sudah tersimpan")</script><?php
			?><script language="javascript">document.location.href="media.php?module=atribut"</script><?php
		}else{
			echo mysqli_error();
		}
  break;

  case "update":
  			$query=mysqli_query($con,"
							UPDATE tb_atribut SET
							nm_atribut = '$_POST[nm_atribut]'
							WHERE id_atribut = '$_POST[id_atribut]'");

		if($query){
			?><script language="javascript">alert("Data sudah diubah !")</script><?php
			?><script language="javascript">document.location.href="media.php?module=atribut"</script><?php
		}else{
			echo mysqli_error();
		}
  break;

  case "hapus":
  	$query=mysqli_query($con,"DELETE FROM tb_atribut WHERE id_atribut='$_GET[id]'");
		if($query){
			?><script language="javascript">alert("Data sudah dihapus !")</script><?php
			?><script language="javascript">document.location.href="media.php?module=atribut"</script><?php
		}else{
			echo mysqli_error();
		}
  break;
}
  	?>