<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $barcode = $_POST['barcode'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = "update tbl_barang SET input_scanner = '$barcode', nama_barang = '$nama', harga = '$harga', quantity = '$stok' WHERE id_tbl_barang = '$id'";
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
?>