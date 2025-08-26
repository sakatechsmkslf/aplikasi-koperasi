<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pendapatan = $_POST['id_pendapatan'];
    $tanggal = $_POST['tanggal'];
    $nama_pendapatan = $_POST['nama_pendapatan'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $query = "update tbl_pendapatan SET tanggal = '$tanggal', nama_pendapatan = '$nama_pendapatan', jumlah = '$jumlah', keterangan = '$keterangan' WHERE id_pendapatan = '$id_pendapatan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        session_start();
        $_SESSION['status'] = "Data berhasil diupdate!";
        header("Location: ../pendapatan.php");
    } else {
        session_start();
        $_SESSION['status'] = "Gagal update";
        header("Location: ../pendapatan.php");
    }
}