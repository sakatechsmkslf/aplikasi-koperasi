<?php

include '../../koneksi.php';

$jenis_simpanan = $_POST['jenis_simpanan'];
$nominal = $_POST['nominal'];
$tanggal = $_POST['tanggal'];


$input = mysqli_query($koneksi, "insert into tbl_simpanan(jenis_simpanan,nominal,tanggal) values('$jenis_simpanan','$nominal','$tanggal')");
if ($input) {
    header("location:../neraca.php");
} else {
    echo "Data gagal disimpan";
}