<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_simpanan = $_POST['id_simpanan'];
    $nama = $_POST['nama'];
    $jenis_simpanan = $_POST['jenis_simpanan'];
    $nominal = $_POST['nominal'];
    $tanggal = $_POST['tanggal'];

    $query = "update tbl_simpanan SET jenis_simpanan = '$jenis_simpanan',nama = '$nama', jenis_simpanan = '$jenis_simpanan', nominal = '$nominal', tanggal = '$tanggal' WHERE id_simpanan = '$id_simpanan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        session_start();
        $_SESSION['status'] = "Data berhasil diupdate!";
        header("Location: simpanan.php");
    } else {
        session_start();
        $_SESSION['status'] = "Gagal update";
        header("Location: simpanan.php");
    }
}