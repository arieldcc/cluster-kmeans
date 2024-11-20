<?php

function kode_auto($tabel, $inisial, $index, $panjang){
  $struktur	= mysql_query("SELECT * FROM $tabel");
  $field	= mysql_field_name($struktur,0);
  $query	= "SELECT max(".$field.") as max_id FROM ".$tabel." WHERE ".$field." LIKE '".$inisial."%'";
  $hasil	= mysql_query($query);
  $data		= mysql_fetch_array($hasil);
  $id_max	= $data['max_id'];
  $no_urut	= (int) substr($id_max, $index, $panjang);
  $no_urut	= $no_urut + 1;
  $id_baru	= $inisial . sprintf("%03s", $no_urut);
  return $id_baru;
}

?>