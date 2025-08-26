<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_biaya = $_POST['id_pendapatan'];
    $tanggal = $_POST['tanggal'];
    $nama_biaya = $_POST['nama_pendapatan'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $query = "update tbl_pendepatan SET tanggal = '$tanggal', nama_pendapatan = '$nama_pendapatan', jumlah = '$jumlah', keterangan = '$keterangan' WHERE id_biaya = '$id_pendapatan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        session_start();
        $_SESSION['status'] = "Data berhasil diupdate!";
        header("Location: tabel-barang.php");
    } else {
        session_start();
        $_SESSION['status'] = "Gagal update";
        header("Location: tabel-barang.php");
    }
}