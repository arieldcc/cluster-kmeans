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
  // Tampil Data datauser
  default:
  	?>
    <h1>Data User</h1>
    <center><input type="button" name="button"  value="Tambah Data User" class="button" onclick="javascript:window.location='media.php?module=user&act=forminput'"></center>
<table class="data">
<tr class="data">
	<th width="40" class="data" align="center">No. </th>
	<th class="data" align="center">Nama User</th>
    <th class="data" align="center">Nama Lengkap</th>
    <th class="data" width="180" align="center">Alamat</th>
	<th width="80" class="data" align="center">Aksi</th>
</tr>
<?php
	if(!isset($_GET['hal'])){
		@$page = 1;
		@$hal = 1;
	} else {
		@$page = $_GET['hal'];
	}
	$jmlperhalaman = 10;  // jumlah record per halaman
	$offset = (($page * $jmlperhalaman) - $jmlperhalaman);
	
	$tampil=mysqli_query($con,"SELECT * FROM tb_login ORDER BY username asc LIMIT $offset, $jmlperhalaman");
    
		
	$no = 1;
    while ($r=mysqli_fetch_array($tampil)){
      
    $lebar=strlen($no);
    switch($lebar){
      case 1:
      {
        $g="0".$no;
        break;     
      }
      case 2:
      {
        $g=$no;
        break;     
      }      
    } 
    
   echo "<tr class='data'>
   <td class='data'><center>$g</center></td>
    <td class='data'>$r[username]</td>
	<td class='data'>$r[nama_lengkap]</td>
	<td class='data'>$r[alamat]</td>
    <td class='data'>
   
   <a href=media.php?module=user&act=tampil&id=$r[username] title='Tampil' class='with-tip'>
   <center><img src='images/view.png'></a>
   
   <a href=media.php?module=user&act=edit&id=$r[username] title='Edit' class='with-tip'>
   <img src='images/edit.gif'></a>
   
   <a href=javascript:confirmdelete('media.php?module=user&act=hapus&id=$r[username]') 
   title='Hapus' class='with-tip'>
   <img src='images/cancel.gif'></center></a> 
	   
   </td></tr>";		
      $no++;
    }
?>
</table>
<?php
// membuat nomor halaman
	$qtotal_record = mysqli_query($con,"SELECT COUNT(*) as Num FROM tb_login");
		$rtotal_record = mysqli_fetch_array($qtotal_record);
		$total_record = $rtotal_record['Num'];
	$total_halaman = ceil($total_record / $jmlperhalaman);

	echo "<center>Halaman :<br/>";
	$perhal=4;
	if(@$hal > 1){
		$prev = ($page - 1);
		echo "<a href=media.php?module=user&hal=$prev> << </a> ";
	}
	if($total_halaman<=10){
	$hal1=1;
	$hal2=$total_halaman;
	}else{
	$hal1=$hal-$perhal;
	$hal2=$hal+$perhal;
	}
	if(@$hal<=5){
	$hal1=1;
	}
	if(@$hal<$total_halaman){
	$hal2=@$hal+$perhal;
	}else{
	$hal2=@$hal;
	}
	for($i = $hal1; $i <= $hal2; $i++){
		if((@$hal) == $i){
			echo "[<b>$i</b>] ";
			} else {
		if($i<=$total_halaman){
				echo "<a href=media.php?module=user&hal=$i>$i</a> ";
		}
		}
	}
	if(@$hal < $total_halaman){
		$next = ($page + 1);
		echo "<a href=media.php?module=user&hal=$next>>></a>";
	}
	echo "</center><br/>";
?>
    <?php
  break;
   case "forminput":
  	?> 
    <h1>Input Data User</h1>
                <hr>
<form action="media.php?module=user&act=simpandata" method="post" id="datauser" name="datauser" enctype="multipart/form-data">
<table class="data">
<tr class="data">
	<td colspan="3" align="center" class="data"><hr /></td>
 </tr>
 <tr class="data">
	<td class="data" width="200">Nama User</td>
    <td class="data" width="5">:</td>
	<td class="data"><input type="text" name="username" class="panjang"/></td>
 </tr>
 <tr class="data">
	<td class="data">Password</td>
    <td class="data">:</td>
	<td class="data"><input type="password" name="password" class="panjang"/></td>
 </tr>
 <tr class="data">
	<td class="data">Nama Lengkap</td>
    <td class="data">:</td>
	<td class="data"><input type="text" name="nama_lengkap" class="panjang"/></td>
 </tr>
 <tr class="data">
	<td class="data">Alamat</td>
    <td class="data">:</td>
	<td class="data"><input type="text" name="alamat" class="panjang"/></td>
 </tr>
 <tr class="data">
	<td colspan="3" align="center" class="data"><hr /></td>
 </tr>
 <tr class="data">
	<td colspan="3" align="center" class="data">
    <input type="button" name="button"  value="<< Kembali" class="button" onclick="history.go(-1)"/>
    <input type="submit" name="button"  value="Simpan" class="button" /> </td>
 </tr>
 </table>
 </form>
	<?php
  break;
  
  case "tampil":
  	$q_edit = mysqli_query($con,"SELECT * FROM tb_login WHERE username='$_GET[id]'");
    $p    = mysqli_fetch_array($q_edit);
  ?>
    <h1>Detail Data User</h1>
<form action="" method="post" id="datauser" name="datauser" enctype="multipart/form-data">
<table class="data">
<tr class="data">
	<td colspan="3" align="center" class="data"><hr /></td>
 </tr>
<tr class="data">
	<td class="data" width="200">Nama User</td>
    <td class="data" width="5">:</td>
	<td class="data"><input type="text" name="username" class="panjang"
    value="<?php echo $p['username'];?>" readonly /></td>
 </tr>
 <tr class="data">
	<td class="data">Password</td>
    <td class="data">:</td>
	<td class="data"><input type="password" name="password" class="panjang" value="<?php echo $p['password'];?>" readonly /></td>
 </tr>
 <tr class="data">
	<td class="data">Nama Lengkap</td>
    <td class="data">:</td>
	<td class="data"><input type="text" name="nama_lengkap" class="panjang" value="<?php echo $p['nama_lengkap'];?>" readonly /></td>
 </tr>
 <tr class="data">
	<td class="data">Alamat</td>
    <td class="data">:</td>
	<td class="data"><input type="text" name="alamat" class="panjang" value="<?php echo $p['alamat'];?>" readonly /></td>
 </tr>
 <tr class="data">
	<td colspan="3" align="center" class="data"><hr /></td>
 </tr>
<table class="data">
 <tr class="data">
	<td colspan="3" align="center" class="data">
    <input type="button" name="button"  value="<< Kembali" class="button" onclick="history.go(-1)"/></td>
 </tr>
 </table>
 </form>
 <?php
  break;
  
  case "edit":
  	$p_edit = mysqli_query($con,"SELECT * FROM tb_login WHERE username='$_GET[id]'");
    $p    = mysqli_fetch_array($p_edit);
  ?>
    <h1>Edit Data User</h1>
<form action="media.php?module=user&act=update" method="post" id="datauser" name="datauser" enctype="multipart/form-data">
<table class="data">
<tr class="data">
	<td colspan="3" align="center" class="data"><hr /></td>
 </tr>
<tr class="data">
	<td class="data" width="200">Nama User</td>
    <td class="data" width="5">:</td>
	<td class="data"><input type="text" name="username" class="panjang"
    value="<?php echo $p['username'];?>" readonly /></td>
 </tr>
 <tr class="data">
	<td class="data">Password</td>
    <td class="data">:</td>
	<td class="data"><input type="password" name="password" class="panjang" value="<?php echo $p['password'];?>"/></td>
 </tr>
 <tr class="data">
	<td class="data">Nama Panjang</td>
    <td class="data">:</td>
	<td class="data"><input type="text" name="nama_lengkap" class="panjang" value="<?php echo $p['nama_lengkap'];?>"/></td>
 </tr>
 <tr class="data">
	<td class="data">Alamat</td>
    <td class="data">:</td>
	<td class="data"><input type="text" name="alamat" class="panjang" value="<?php echo $p['alamat'];?>"/></td>
 </tr>
 <tr class="data">
	<td colspan="3" align="center" class="data"><hr /></td>
 </tr>
<table class="data">
 <tr class="data">
	<td colspan="3" align="center" class="data"><hr /></td>
 </tr>
 <tr class="data">
	<td colspan="3" align="center" class="data">
    <input type="button" name="button"  value="<< Kembali" class="button" onclick="history.go(-1)"/>
    <input type="submit" name="button"  value="Ubah" class="button" /> </td>
 </tr>
 </table>
 </form>
 <?php
  break;
  
  case "simpandata":
  		$query=mysqli_query($con,"insert into tb_login(
								username,
								password,
								nama_lengkap,
								jenis_kelamin,
								alamat,
								level
							)values(
								'$_POST[username]',
								'$_POST[password]',
								'$_POST[nama_lengkap]',
								'L',
								'$_POST[alamat]',
								'admin'
							)");
	
		
  	 if($query){
			?><script language="javascript">alert("Data sudah tersimpan")</script><?php
			?><script language="javascript">document.location.href="media.php?module=user"</script><?php
		}else{
			echo mysqli_error();
		}
  break;
  
  case "update":
  	$query=mysqli_query($con,"
							UPDATE tb_login SET 
							nama_lengkap = '$_POST[nama_lengkap]',
							alamat = '$_POST[alamat]',
							password = '$_POST[password]'
							WHERE username = '$_POST[username]'");
			
		
		if($query){
			?><script language="javascript">alert("Data sudah diubah !")</script><?php
			?><script language="javascript">document.location.href="media.php?module=user"</script><?php
		}else{
			echo mysqli_error();
		}
  break;
  
  case "hapus":
  	$query=mysqli_query($con,"DELETE FROM tb_login WHERE username='$_GET[id]'");
		if($query){
			?><script language="javascript">alert("Data sudah dihapus !")</script><?php
			?><script language="javascript">document.location.href="media.php?module=user"</script><?php
		}else{
			echo mysqli_error();
		}
  break;
}
  	?>