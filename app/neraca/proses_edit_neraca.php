<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_neraca = $_POST['id_neraca'];
    $nama_aset = $_POST['nama_aset'];
    $nilai_perolehan = $_POST['nilai_perolehan'];
    $akumulasi_penyusutan = $_POST['akumulasi_penyusutan'];
    $tahun_perolehan = $_POST['tahun_perolehan'];
    $umur_ekonomis = $_POST['umur_ekonomis'];

    $query = "update tbl_neraca SET nama_aset = '$nama_aset', nilai_perolehan = '$nilai_perolehan', akumulasi_penyusutan = '$akumulasi_penyusutan', tahun_perolehan = '$tahun_perolehan', umur_ekonomis = '$umur_ekonomis'  WHERE id_neraca = '$id_neraca'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        session_start();
        $_SESSION['status'] = "Data berhasil diupdate!";
        header("Location: ../neraca.php");
    } else {
        session_start();
        $_SESSION['status'] = "Gagal update";
        header("Location: ../neraca.php");
    }
}