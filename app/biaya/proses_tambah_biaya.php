<?php

include '../../koneksi.php';

$tanggal = $_POST['tanggal'];
$nama_biaya = $_POST['nama_biaya'];
$jumlah = $_POST['jumlah'];
$keterangan = $_POST['keterangan'];


$input = mysqli_query($koneksi, "insert into tbl_biaya(tanggal,nama_biaya,jumlah,keterangan) values('$tanggal','$nama_biaya','$jumlah','$keterangan')");
if ($input) {
    header("location:../../dasboard.php");
} else {
    echo "Data gagal disimpan";
}