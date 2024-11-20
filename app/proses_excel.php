<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";
// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);
$column = $data->colcount($sheet_index = 0);

//echo "Baris = ".$baris;
//echo "<br>Kolom = ".$column;

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++){
  // membaca data nim (kolom ke-1 sampai 7) 
  $nama_objek = $data->val($i, 2);
  $value = 
        "," . $data->val($i, 3) .
        "," . $data->val($i, 4) .
         "," . $data->val($i, 5);

  // setelah data dibaca, sisipkan ke dalam tabel mhs
  $query = "INSERT INTO objek (id_objek,nama_objek,data,ket) VALUES (null, '$nama_objek','$value','data')";
  $hasil = mysqli_query($con,$query);

  // jika proses insert data sukses, maka counter $sukses bertambah
  // jika gagal, maka counter $gagal yang bertambah
  if ($hasil) $sukses++;
  else $gagal++;
}

// tampilan status sukses dan gagal
?>
<h1>Proses import data selesai...!!!</h1>        
<?php

//echo "<center style='margin-top:10%; padding-bottom:14%;'><h3>Proses import data selesai...!!!</h3>";
echo "<p>Jumlah Data Penjualan yang sukses di import sebanyak : ".$sukses."<br>";
echo "Jumlah Data Penjualan yang gagal di import sebanyak : ".$gagal."</p>
<input type=button value='Lihat Semua Data' class='btn btn-primary' onclick=\"window.location.href='media.php?module=dataset';\"></center>";

?>