<?php

include "../../koneksi.php";

$input_scanner = addslashes(trim($_POST['input_scanner']));
$nama_barang = addslashes(trim($_POST['nama_barang']));
$id_category = addslashes(trim($_POST['id_category']));
$harga = addslashes(trim($_POST['harga']));
$harga_jual = addslashes(trim($_POST['harga_jual']));
$quantity = addslashes(trim($_POST['quantity']));
$tanggal_input = date('Y-m-d H:i:s');


$input = mysqli_query($koneksi, "insert into tbl_barang(input_scanner,nama_barang,id_category,harga,harga_jual,quantity,tanggal_input) values('$input_scanner','$nama_barang','$id_category','$harga','$harga_jual','$quantity','$tanggal_input')");
if ($input) {
   echo "Data berhasil disimpan";
} else {
   echo "Data gagal disimpan";
}
?>