<?php
require_once("../config/koneksi.php");
include "../config/fungsi_indotgl.php";
include "../config/apracha.php";
?>
<html>
<head>
<title>Print Data Kriteria - <?php objek();?></title>
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
   <center>Laporan Data Kriteria<br><?php judul();?><br></center><br>
   <table width="630" align="center" cellpadding="3" cellspacing="3">
   <tr bgcolor="#CCCCCC" align="center">
            	<td width="50">ID</td>
                <td>Nama Kriteria</td>
                <td>Atribut</td>
                <td>Bobot</td>
             </tr>
     <?php
	 $tgl=date('d-m-Y');
	$lap = mysql_query("SELECT * FROM tb_kriteria order by id_kriteria ASC");
	while ($l=mysql_fetch_array($lap)){
		?>
		<tr>
        	<td align="center"><?php echo $l['id_kriteria'];?></td>
		    <td><?php echo $l['nm_kriteria'];?></td>
            <td><?php echo $l['atribut'];?></td>
            <td><?php echo $l['bobot'];?></td>
		</tr>
	<?php }?>
	</table><br>
    <div class="float_r">
    Gorontalo, <?php echo tgl_indo(date('Y-m-d'));?><br>
    </div>
</div>
  </div>
</div>
</body>
</html>