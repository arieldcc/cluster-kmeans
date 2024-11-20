<?php
require_once("../config/koneksi.php");
include "../config/fungsi_indotgl.php";
include "../config/apracha.php";
//include "../adm.php";
?>
<html>
<head>
<title>Print Data Hasil Analisa - <?php judul();?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script type="text/javascript">
function cetak()
{
window.print();
window.close();
}
</script>
<style type="text/css">
<!--
body {

	background-repeat:no-repeat;
	background-position:top;
	font-family:"Courier New", Courier, monospace;
	font-weight:bold;
}
.style1 {font-weight: bold}
.style2 {color: #009933}
.style5 {color: #000000}
-->

table{
border-collapse:collapse;
}
table, td, th{
border:1px solid black;
}
.float_r {
position:absolute;
left:450px;
top:Auto;
 }
</style>
</head>
<body>
<body onLoad="window.print()">
   <center>Laporan Hasil Analisa <?php judul();?></center><br><br>
   <table width="750" align="center" cellpadding="3" cellspacing="3">
   <tr bgcolor="#CCCCCC" align="center">
            	<td width="50" class="data"> NO.</td>
	<td width="100" class="data">ID Rumah</td>
    <td class="data">Jenis Rumah</td>
       <td class="data">Alamat</td>
    <td width="100" class="data">Nilai</td>
             </tr>
     <?php
	 $tgl=date('d-m-Y');
	$lap = mysql_query("SELECT tb_rumah.*, tb_hasil.* FROM tb_rumah join tb_hasil on
					tb_rumah.id_rumah=tb_hasil.id_rumah ORDER BY tb_hasil.nilai_v desc");
	$no=1;
	while ($l=mysql_fetch_array($lap)){
		?>
		<tr>
        	<td align="center"><?php echo $no;?>.</td>
		    <td><?php echo $l['id_rumah'];?></td>
            <td><?php echo $l['jrumah'];?></td>
            <td><?php echo $l['alamat'];?></td>
            <td><?php echo number_format($l['nilai_v'],3);?></td>
		</tr>
	<?php
		$no++;
	}?>
	</table><br>
    <div class="float_r">
    Gorontalo, <?php echo tgl_indo(date('Y-m-d'));?><br>
    </div>
</div>
  </div>
</div>
</body>
</html>