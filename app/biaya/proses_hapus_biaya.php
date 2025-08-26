<?php
include '../../koneksi.php';
session_start();

if (isset($_GET['id_biaya'])) {
    $id_biaya = intval($_GET['id_biaya']);

    $hapus_biaya = "delete from tbl_biaya where id_biaya = $id_biaya";
    if (mysqli_query($koneksi, $hapus_biaya)) {
        $_SESSION['status'] = 'Barang berhasil dihapus!';
        $_SESSION['status_type'] = 'success';
        //ubah ke view index biaya/tambah biaya
        header('Location: ../biaya.php');
        exit();
    } else {
        $_SESSION['status'] = 'Terjadi kesalahan saat menghapus barang!';
        $_SESSION['status_type'] = 'error';
        //ubah ke view index biaya/tambah biaya
        header('Location: ../biaya.php');
        exit();
    }
} else {
    echo "id barang tidak ditemukan!";
}