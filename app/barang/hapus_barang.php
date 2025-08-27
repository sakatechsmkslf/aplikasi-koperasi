<?php
include '../../koneksi.php';
session_start();

if (isset($_GET['id'])) {
    $id_barang = intval($_GET['id']);

    $hapusBarang = "delete from tbl_barang where id_tbl_barang = $id_barang";
    if (mysqli_query($koneksi, $hapusBarang)) {
        $_SESSION['status'] = 'Barang berhasil dihapus!';
        $_SESSION['status_type'] = 'success';
        header('Location: tabel-barang.php');
        exit();
    } else {
        $_SESSION['status'] = 'Terjadi kesalahan saat menghapus barang!';
        $_SESSION['status_type'] = 'error';
        header('Location: tabel-barang.php');
        exit();
    }
} else {
    echo "id barang tidak ditemukan!";
}
?>