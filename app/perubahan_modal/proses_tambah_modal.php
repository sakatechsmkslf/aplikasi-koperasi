<?php

include '../../koneksi.php';

$tahun = $_POST['tahun'];
$bulan = $_POST['bulan'];
$nominal = $_POST['nominal'];


$input = mysqli_query($koneksi, "insert into tbl_modal_awal(tahun,bulan,nominal) values('$tahun','$bulan','$nominal')");
if ($input) {
    header("location:modal.php");
} else {
    echo "Data gagal disimpan";
}