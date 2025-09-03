<?php

include '../../koneksi.php';

$jenis = $_POST['jenis'];
$nominal = $_POST['nominal'];
$jatuh_tempo = $_POST['jatuh_tempo'];
$status = $_POST['status'];


$input = mysqli_query($koneksi, "insert into tbl_hutang(jenis,nominal,jatuh_tempo,status) values('$jenis','$nominal','$jatuh_tempo','$status')");
if ($input) {
    header("location:../hutang.php");
} else {
    echo "Data gagal disimpan";
}