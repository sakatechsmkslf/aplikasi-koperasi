<?php
include '../../koneksi.php';
session_start();

if (isset($_GET['id_neraca'])) {
    $id_neraca = intval($_GET['id_neraca']);

    $hapus_neraca = "delete from tbl_neraca where id_neraca = $id_neraca";
    if (mysqli_query($koneksi, $hapus_neraca)) {
        $_SESSION['status'] = 'Barang berhasil dihapus!';
        $_SESSION['status_type'] = 'success';
        //ubah ke view index neraca/tambah neraca
        header('Location: ../neraca.php');
        exit();
    } else {
        $_SESSION['status'] = 'Terjadi kesalahan saat menghapus barang!';
        $_SESSION['status_type'] = 'error';
        //ubah ke view index neraca/tambah neraca
        header('Location: ../neraca.php');
        exit();
    }
} else {
    echo "id barang tidak ditemukan!";
}