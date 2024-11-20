<?php
//error_reporting(0);
include "config/koneksi.php";
$pass=$_POST['password'];
//$level=$_POST['level'];
$username = $_POST['id_user'];
$login=mysqli_query($con,"SELECT * FROM tb_login
			WHERE username='".$username."' AND password='$pass'");
$cocok=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);

if ($cocok > 0){
	session_start();
	//$_SESSION['id_user']     	= $r['id_user'];
	$_SESSION['namauser']     	= $r['username'];
	//$_SESSION['email']    		= $r['email'];
  	$_SESSION['namalengkap']  	= $r['nama_lengkap'];
  	$_SESSION['passuser']     	= $r['password'];
  	$_SESSION['leveluser']    	= $r['level'];
	echo "<script>alert('Selamat datang $r[nama_lengkap]!');</script>";
	?>
    <style>
		.message{
			text-decoration:underline;
			font-weight:bolder;
			font-size:14px;
		}
	</style>
 <center>
  	<p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><img src="images/tunggu.gif" border="0"></p>
  <p><span class="message"><font color="#990000">Mohon Tunggu ...</font></span></p>
</center>
<meta http-equiv="refresh" content="1; url=index.php">
    <?php
	//header('location:index.adm');
	}
else {
echo "<script>window.alert('Username atau Password anda salah.');
				window.location='index.adm'</script>";
	}

?>
