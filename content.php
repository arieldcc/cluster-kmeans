<?php
if ($_GET['module']=='home'){
  $sql=mysqli_query($con,"SELECT * FROM tb_halaman WHERE halaman='home'");
  $r=mysqli_fetch_array($sql);
    echo "<h1>$r[judul]</h1>
          <p>$r[detail]</p>";

}

elseif ($_GET['module']=='form_login'){
	echo "
	<div class='login-container'>
    <h1>Silahkan Login !!</h1>
    <form method='POST' name='formku' onSubmit='return valid()' action='cek_login.php' id='registerHere'>
        <table class='data'>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type='text' name='id_user' class='panjang'></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type='password' name='password' class='panjang'></td>
            </tr>
            <tr>
                <td colspan='3' align='center'>
                    <button type='submit' class='button'>Login</button>
                </td>
            </tr>
        </table>
    </form>
</div>
";
}

elseif ($_GET['module']=='profil'){
  include "app/profil.php";
}

elseif ($_GET['module']=='atribut'){
  include "app/atribut.php";
}

elseif ($_GET['module']=='dataset'){
    include "app/dataset.php";
}

elseif ($_GET['module']=='user'){
  include "app/user.php";
}

elseif ($_GET['module']=='datac'){
  include "app/datac.php";
}

elseif ($_GET['module']=='proses_excel'){
  include "app/proses_excel.php";
}

elseif ($_GET['module']=='hasil'){
  include "app/hasil.php";
}

elseif ($_GET['module']=='adm'){
  include "app/administrasi.php";
}

elseif ($_GET['module']=='penyelengara'){
  include "app/penyelengara.php";
}

elseif ($_GET['module']=='diagram'){
  include "app/t_diagram.php";

}

elseif ($_GET['module']=='datapendaftaran'){
  echo "<div class='alert alert-info'>Data Hasil Pengambilan Keputusan Online.</div>";

  $prosedur=mysqli_query($con,"SELECT * FROM tb_hasil_analisa a left join tb_login b on a.username=b.username ORDER BY a.id_hasil DESC");
  $no=1;
  echo "<table style='border:1px solid #c1c1c1;' class='table table-bordered'>
		<tr>
			<th>No</th><th>Nama Lengkap</th><th>Keputusan Jurusan</th><th>Hasil (Nilai)</th>
		</tr>";
  $no=1;

  while($r=mysqli_fetch_array($prosedur)){
  $tanggal = tgl_indo($r['tgl_daftar']);
  if(($no % 2)==0){ $warna="#fff"; } else{ $warna="#f4f4f4"; }
	echo "<tr bgcolor='$warna'><td>$no</td>
				 <td>$r[nama_lengkap]</td>
				 <td>$r[jurusan]</td>
				 <td style='color:red'>$r[nilai]</td>
			 </tr>";
	$no++;
  }
  echo "</table>";
}

elseif ($_GET['module']=='hubungikami'){
  echo "<h1>Hubungi kami secara online (Private)</h1>
		<form action=hubungi-aksi.adm name='formku' onSubmit='return valid()' method=POST id='registerHere'>
			<table class='data'>
				<tr class='data'>
					<td class='data' width='150'>Nama Lengkap</td>
					<td class='data' width='5'>:</td>
					<td class='data'>
					<input id='nama_lengkap' name='nama_lengkap' type='text' class='panjang'/></td>
				</tr>
				<tr class='data'>
					<td class='data'>Alamat E-mail</td>
					<td class='data'>:</td>
					<td class='data'>
					<input name='email' type='text' class='panjang' id='email'/></td>
				</tr>
				<input name='subjek' type='hidden' value='From_Guest'/>
				<tr class='data'>
					<td class='data'>Message</td>
					<td class='data'>:</td>
					<td class='data'><textarea style='width:93%; height:120px;' name='pesan' class='required'></textarea></td>
				</tr>
				<tr class='data'>
					<td class='data' align='center' colspan='3'>
						<button type='submit' class='button'>Submit</button></td>
				</tr>
			</table>
			</fieldset>
		</form>";
}

elseif ($_GET['module']=='hubungiaksi'){
$nama_lengkap = trim(htmlentities($_POST['nama_lengkap']));
$email = trim(htmlentities($_POST['email']));
$subjek = trim(htmlentities($_POST['subjek']));
$pesan = trim(htmlentities($_POST['pesan']));
  mysqli_query($con,"INSERT INTO tb_hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal)
                        VALUES('$nama_lengkap',
                               '$email',
                               '$subjek',
                               '$pesan',
                               '$tgl_sekarang')");

  echo "<div style='margin-top:5%; text-align:center;' class='alert alert-success'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Sukses Mengirim Pesan ke Admin! <br>Terimakasih telah menghubungi kami. Kami akan segera meresponnya
		</div>";
}

elseif ($_GET['module']=='detailberita'){
	  $sql=mysqli_query($con,"select * from tb_berita where id_berita=$_GET[id]");
	  while($r=mysqli_fetch_array($sql)){
		  $tgl = tgl_indo($r['tanggal']);
		  $isi_berita = nl2br($r['isi_berita']);

			echo "<table><tr>
						<span class='sidebar-title'><a href=news-$r[id_berita].adm>$r[judul]</a></span>
						 <div class='date'>Diposting pada : $r[hari], $tgl - $r[jam] WIB  </div><hr>";
			echo "<p>$isi_berita</p>";
		 }
			echo "</table><br/>";
}

elseif ($_GET['module']=='hal_web'){
	echo "<h1>Halaman WEB.</h1>";

  $prosedur=mysqli_query($con,"SELECT * FROM tb_halaman ORDER BY id_halaman DESC");
  $no=1;
  echo "
  <table class='data'>
		<tr class='data'>
			<th class='data' align='center'>No</th>
			<th class='data' align='center'>Halaman</th>
			<th class='data' align='center'>Judul</th>
			<th width='80' class='data' align='center'>Action</th>
		</tr>";
  $no=1;

  while($r=mysqli_fetch_array($prosedur)){
  if(($no % 2)==0){ $warna="#fff"; } else{ $warna="#f4f4f4"; }
	echo "<tr bgcolor='$warna'>
				<td class='data'>$no</td>
				 <td class='data'>$r[halaman]</td>
				 <td class='data'>$r[judul]</td>
				 <td class='data' align='center'>
				 	<a class='btn btn-success' href='media.php?module=hal_web&aksi=detail&id=$r[id_halaman]'>&radic;</a>
					<a class='btn btn-danger' href='media.php?module=hal_web&aksi=hapus&id=$r[id_halaman]'>&times;</a>
				 </td>
			 </tr>";
	$no++;
  }
  echo "</table>";

  if (@$_GET['aksi']=='detail'){
		$edit = mysqli_query($con,"SELECT * FROM tb_halaman WHERE id_halaman='$_GET[id]'");
    	$r    = mysqli_fetch_array($edit);
  		?>
        <br />
        <hr />
        <br />
        <form class="form-horizontal" action='media.php?module=hal_web&aksi=update' method='POST'>
        <h1>Detail Data Halaman WEB</h1>
        <table class='data'>
        	<tr class='data'>
            	<td width="150" class='data'>ID Halaman</td>
                <td width="5" class='data'>:</td>
                <td class='data'><input type="text" class='span3' name='id_halaman' id="id_halaman"
                  value="<?php echo $r['id_halaman'];?>" readonly></td>
            </tr>
            <tr class='data'>
            	<td width="150" class='data'>Halaman</td>
                <td width="5" class='data'>:</td>
                <td class='data'><input type="text" class='span9' name='halaman' id="halaman" value="<?php echo $r['halaman'];?>"></td>
            </tr>
            <tr class='data'>
            	<td width="150" class='data'>Judul</td>
                <td width="5" class='data'>:</td>
                <td class='data'>
                <textarea name='judul' rows='7' cols="60" id='judul'><?php echo $r['judul'];?></textarea>
                </td>
            </tr>
            <tr class='data'>
            	<td width="150" class='data'>Detail Halaman</td>
                <td width="5" class='data'>:</td>
                <td class='data'><textarea name='detail' rows='10' cols="60" id='detail'><?php echo $r['detail'];?></textarea> </td>
            </tr>
            <tr class='data'>
            	<td colspan="3" align="center" class='data'>
                	<center>
                    <a class='btn btn-primary' href='media.php?module=hal_web'>&lArr; Kembali</a>
                    <button type='submit' name='u' class="button">Ubah &rArr;</button>
                    </td>
            </tr>
        </table>
        </form>
        <?php
  	}

	if (@$_GET['aksi']=='update'){
  		$query=mysqli_query($con,"
							UPDATE tb_halaman SET
							judul = '$_POST[judul]',
							detail = '$_POST[detail]'
							WHERE id_halaman = '$_POST[id_halaman]'");

  		echo "<script>window.alert('Sukses Ubah Halaman WEB Terpilih.');
				window.location='media.php?module=hal_web'</script>";
  }

  if (@$_GET['aksi']=='hapus'){
  		mysqli_query($con,"DELETE FROM tb_halaman where id_halaman='$_GET[id]'");

  		echo "<script>window.alert('Sukses Hapus Halaman WEB Terpilih.');
				window.location='media.php?module=hal_web'</script>";
  }

}
elseif ($_GET['module']=='berita'){
	echo "<h1>Data Berita</h1>";

  $prosedur=mysqli_query($con,"SELECT * FROM tb_berita ORDER BY id_berita DESC");
  $no=1;
  echo "
  <table class='data'>
		<tr class='data'>
			<th class='data' align='center'>No</th>
			<th class='data' align='center'>Tanggal</th>
			<th class='data' align='center'>judul</th>
			<th width='80' class='data' align='center'>Action</th>
		</tr>";
  $no=1;

  while($r=mysqli_fetch_array($prosedur)){
	  $tanggal = tgl_indo($r['tanggal']);
  if(($no % 2)==0){ $warna="#fff"; } else{ $warna="#f4f4f4"; }
	echo "<tr bgcolor='$warna'>
				<td class='data'>$no</td>
				 <td class='data'>$tanggal</td>
				 <td class='data'>$r[judul]</td>
				 <td class='data' align='center'>
				 	<a class='btn btn-success' href='media.php?module=berita&aksi=detail&id=$r[id_berita]'>&radic;</a>
					<a class='btn btn-danger' href='media.php?module=berita&aksi=hapus&id=$r[id_berita]'>&times;</a>
				 </td>
			 </tr>";
	$no++;
  }
  echo "</table>";

  if (@$_GET['aksi']=='detail'){
		$edit = mysqli_query($con,"SELECT * FROM tb_berita WHERE id_berita='$_GET[id]'");
    	$r    = mysqli_fetch_array($edit);
		$tanggal = tgl_indo($r['tanggal']);
  		?>
        <br />
        <hr />
        <br />
        <form class="form-horizontal" action='media.php?module=berita&aksi=update' method='POST'>
        <h1>Detail Data Berita</h1>
        <table style='border:1px solid #c1c1c1;' class='table table-bordered'>
        	<tr class='data'>
            	<td width="150" class='data'>ID Berita</td>
                <td width="5" class='data'>:</td>
                <td class='data'><input type="text" class='span3' name='id_berita' id="id_berita"
                  value="<?php echo $r['id_berita'];?>" readonly></td>
            </tr>
            <tr class='data'>
            	<td width="150" class='data'>Waktu Terbit Berita</td>
                <td width="5" class='data'>:</td>
                <td class='data'><input type="text" class='panjang' name='waktu' id="waktu"
                  value="<?php echo $r['hari']." | ".$tanggal." | ".$r['jam'];?>" readonly></td>
            </tr>
            <tr class='data'>
            	<td width="150" class='data'>Judul</td>
                <td width="5" class='data'>:</td>
                <td class='data'><input type="text" class='panjang' name='judul' id="judul" value="<?php echo $r['judul'];?>"></td>
            </tr>
            <tr class='data'>
            	<td width="150" class='data'>Isi Berita</td>
                <td width="5" class='data'>:</td>
                <td class='data'>
                <textarea name='isi_berita' rows='12' cols="60" id='isi_berita'><?php echo $r['isi_berita'];?></textarea>
                </td>
            </tr>
            <tr class='data'>
            	<td colspan="3" align="center" class='data'>
                	<center>
                    <a class='btn btn-primary' href='media.php?module=hal_web'>&lArr; Kembali</a>
                    <button type='submit' name='u' class="button">Ubah &rArr;</button>
                    </td>
            </tr>
        </table>
        </form>
        <?php
  	}

	if (@$_GET['aksi']=='update'){
  		$query=mysqli_query($con,"
							UPDATE tb_berita SET
							judul = '$_POST[judul]',
							isi_berita = '$_POST[isi_berita]'
							WHERE id_berita = '$_POST[id_berita]'");

  		echo "<script>window.alert('Sukses Ubah Berita Terpilih.');
				window.location='media.php?module=berita'</script>";
  }

  if (@$_GET['aksi']=='hapus'){
  		mysqli_query($con,"DELETE FROM tb_berita where id_berita='$_GET[id]'");

  		echo "<script>window.alert('Sukses Hapus Berita Terpilih.');
				window.location='media.php?module=berita'</script>";
  }
}
?>