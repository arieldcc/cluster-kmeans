<?php if (@$_SESSION['leveluser'] == 'admin'){ ?>
<h3>Menu Admin</h3>
<ul>
	<li><a style='margin-bottom:2px;' class='btn btn-success btn-block' href="media.php?module=hal_web">Halaman WEB</a></li>
	<li><a class='btn btn-danger btn-block' href="media.php?module=berita">Data Berita</a></li>
	<li><a class='btn btn-danger btn-block' href="media.php?module=user">Data User</a></li>
    <li><a class='btn btn-danger btn-block' href="logout.php">Logout</a></li>
</ul>
<?php } ?>
<h3>Informasi Terbaru</h3>
<?php
	  $sql=mysqli_query($con,"select * from tb_berita order by rand() LIMIT 3");
	  while($r=mysqli_fetch_array($sql)){
		  $tgl = tgl_indo($r['tanggal']);
		  $judul = nl2br($r['judul']);
		  $isijudul = substr($judul,0, 36);

		  $isi_berita = nl2br($r['isi_berita']);
		  $isi = substr($isi_berita,0, 160);
		  $isi = substr($isi_berita,0,strrpos($isi," "));
			echo "<table><tr>
						<span class='sidebar-title'><a href=news-$r[id_berita].adm>$isijudul...</a></span>
						 <div class='date'>Diposting pada : $r[hari], $tgl - $r[jam] WIB  </div>
						 <p>$isi [...]</p><hr>";
		 }
			echo "</table><br>";
?>

