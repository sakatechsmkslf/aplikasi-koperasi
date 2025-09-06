<?php

include '../../koneksi.php';

$nama_aset = $_POST['nama_aset'];
$nilai_perolehan = $_POST['nilai_perolehan'];
$akumulasi_penyusutan = $_POST['akumulasi_penyusutan'];
$tahun_perolehan = $_POST['tahun_perolehan'];
$umur_ekonomis = $_POST['umur_ekonomis'];


$input = mysqli_query($koneksi, "insert into tbl_neraca(nama_aset,nilai_perolehan,akumulasi_penyusutan,tahun_perolehan,umur_ekonomis) values('$nama_aset','$nilai_perolehan','$akumulasi_penyusutan','$tahun_perolehan','$umur_ekonomis')");
if ($input) {
    header("location:index.php");
} else {
    echo "Data gagal disimpan";
}