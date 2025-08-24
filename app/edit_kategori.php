<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];

    $query = "update category SET nama = '$nama' WHERE id_category = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        session_start();
        $_SESSION['status'] = "Data berhasil diupdate!";
        header("Location: kategori.php"); 
    } else {
        session_start();
        $_SESSION['status'] = "Gagal update";
        header("Location: kategori.php");
    }
}
?>

