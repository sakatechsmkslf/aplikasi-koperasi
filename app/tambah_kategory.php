<?php

include '../koneksi.php';

$nama = $_POST['nama'];


$input = mysqli_query($koneksi,"insert into category(nama) values('$nama')");
if($input){
    header("location:kategori.php");
}else{
   echo "Data gagal disimpan";
}


?>