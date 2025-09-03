<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_hutang = $_POST['id_hutang'];
    $jenis = $_POST['jenis'];
    $nominal = $_POST['nominal'];
    $jatuh_tempo = $_POST['jatuh_tempo'];
    $status = $_POST['status'];

    $query = "update tbl_hutang SET jenis = '$jenis', nominal = '$nominal', jatuh_tempo = '$jatuh_tempo', status = '$status'  WHERE id_hutang = '$id_hutang'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        session_start();
        $_SESSION['status'] = "Data berhasil diupdate!";
        header("Location: ../hutang.php");
    } else {
        session_start();
        $_SESSION['status'] = "Gagal update";
        header("Location: ../hutang.php");
    }
}