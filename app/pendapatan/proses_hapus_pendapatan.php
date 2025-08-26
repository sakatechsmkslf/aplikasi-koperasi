<?php
include '../../koneksi.php';
session_start();

if (isset($_GET['id_pendapatan'])) {
    $id_pendapatan = intval($_GET['id_pendapatan']);

    $hapus_pendapatan = "delete from tbl_pendapatan where id_pendapatan = $id_pendapatan";
    if (mysqli_query($koneksi, $hapus_pendapatan)) {
        $_SESSION['status'] = 'Barang berhasil dihapus!';
        $_SESSION['status_type'] = 'success';
        //ubah ke view index pendapatan/tambah pendapatan
        header('Location: tabel-barang.php');
        exit();
    } else {
        $_SESSION['status'] = 'Terjadi kesalahan saat menghapus barang!';
        $_SESSION['status_type'] = 'error';
        //ubah ke view index pendapatan/tambah pendapatan
        header('Location: tabel-barang.php');
        exit();
    }
} else {
    echo "id barang tidak ditemukan!";
}