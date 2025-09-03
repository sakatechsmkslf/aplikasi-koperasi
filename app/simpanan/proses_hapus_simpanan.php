<?php
include '../../koneksi.php';
session_start();

if (isset($_GET['id_simpanan'])) {
    $id_simpanan = intval($_GET['id_simpanan']);

    $hapus_simpanan = "delete from tbl_simpanan where id_simpanan = $id_simpanan";
    if (mysqli_query($koneksi, $hapus_simpanan)) {
        $_SESSION['status'] = 'Barang berhasil dihapus!';
        $_SESSION['status_type'] = 'success';
        //ubah ke view index simpanan/tambah simpanan
        header('Location: ../simpanan.php');
        exit();
    } else {
        $_SESSION['status'] = 'Terjadi kesalahan saat menghapus barang!';
        $_SESSION['status_type'] = 'error';
        //ubah ke view index simpanan/tambah simpanan
        header('Location: ../simpanan.php');
        exit();
    }
} else {
    echo "id barang tidak ditemukan!";
}