<?php
include '../../koneksi.php';
session_start();

if (isset($_GET['id_hutang'])) {
    $id_hutang = intval($_GET['id_hutang']);

    $hapus_hutang = "delete from tbl_hutang where id_hutang = $id_hutang";
    if (mysqli_query($koneksi, $hapus_hutang)) {
        $_SESSION['status'] = 'Barang berhasil dihapus!';
        $_SESSION['status_type'] = 'success';
        //ubah ke view index hutang/tambah hutang
        header('Location: ../hutang.php');
        exit();
    } else {
        $_SESSION['status'] = 'Terjadi kesalahan saat menghapus barang!';
        $_SESSION['status_type'] = 'error';
        //ubah ke view index hutang/tambah hutang
        header('Location: ../hutang.php');
        exit();
    }
} else {
    echo "id barang tidak ditemukan!";
}