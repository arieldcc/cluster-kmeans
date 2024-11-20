<?php

	function fakultas(){
		echo "Fakultas Ilmu Komputer";
	}

	function tahun(){
		$tgl = getdate();
		echo $tgl['year'];
	}

	function objek(){
		echo "Penjualan";
	}
	
	function judul(){
		echo "Clustering Data Penjualan Produk Dengan Menggunakan Metode K-Means";	
	}
	
	function nama_mhs(){
		echo "Nolinda Lakunsing";
	}

function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
?>