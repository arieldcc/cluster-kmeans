<?php
ob_start();
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<link rel="stylesheet" type="text/css" href="view/style.css" />
<link href='https://fonts.googleapis.com/css?family=Buda:light|Amaranth' rel='stylesheet' type='text/css' />
<title><?php echo function_exists('judul') ? judul() : 'Default Title'; ?></title>
<script>
    function confirmdelete(delUrl) {
        if (confirm("Anda yakin ingin menghapus?")) {
            document.location = delUrl;
        }
    }
</script>
</head>
<body onload="peta_awal();">

<div id="wrap">

    <div id="header">
        <h1><?php echo function_exists('judul') ? judul() : 'Clustering Data Penjualan'; ?></h1>
        <h2><?php echo isset($subTitle) ? $subTitle : ''; ?></h2>
    </div>

    <div id="menu">
        <ul>
            <li><a href="index.adm">Home</a></li>
            <?php if (empty($_SESSION['leveluser'])) { ?>
                <li><a href="media.php?module=hasil">Hasil Clustering</a></li>
                <li><a href="media.php?module=diagram">Diagram Clustering</a></li>
                <li><a href="profil.adm">Profil</a></li>
                <li><a href="login.adm">Login</a></li>
            <?php } elseif ($_SESSION['leveluser'] == 'admin') { ?>
                <li><a href="media.php?module=atribut">Data Atribut</a></li>
                <li><a href="media.php?module=dataset">Dataset</a></li>
                <li><a href="media.php?module=datac">Centroid</a></li>
                <li><a href="media.php?module=hasil&act=means">Hasil Clustering</a></li>
                <li><a href="media.php?module=diagram">Diagram Clustering</a></li>
            <?php } ?>
        </ul>
    </div>

    <div id="content">
        <?php if ($_GET['module'] == 'analisa' || $_GET['act'] == 'forminput1') {
            include "content.php";
        } else { ?>
            <div class="left">
                <?php include "content.php"; ?>
            </div>
            <div class="right">
                <?php include "sidebar.php"; ?>
            </div>
        <?php } ?>
    </div>

    <div id="footer">
        <div class="footerleft">Copyright (c) <?php echo tahun(); ?> - <?php echo objek(); ?></div>
        <div class="footerright">Design by <a href="#"><?php echo nama_mhs(); ?></a></div>
    </div>

</div>

</body>
</html>
