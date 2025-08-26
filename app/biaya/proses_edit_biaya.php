<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_biaya = $_POST['id_biaya'];
    $tanggal = $_POST['tanggal'];
    $nama_biaya = $_POST['nama_biaya'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $query = "update tbl_biaya SET tanggal = '$tanggal', nama_biaya = '$nama_biaya', jumlah = '$jumlah', keterangan = '$keterangan' WHERE id_biaya = '$id_biaya'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        session_start();
        $_SESSION['status'] = "Data berhasil diupdate!";
        header("Location: ../biaya.php");
    } else {
        session_start();
        $_SESSION['status'] = "Gagal update";
        header("Location: ../biaya.php");
    }
}