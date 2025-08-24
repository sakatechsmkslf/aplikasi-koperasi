<?php
include "koneksi.php";
session_start();

$email=$_POST['email'];
$password=md5($_POST['password']);


$sql= mysqli_query($koneksi, "select * from user where user_email='$email' and user_password='$password'");
if(mysqli_num_rows($sql)==1){
    $user = mysqli_fetch_assoc($sql);
    $_SESSION['user_email'] = $user['user_email']; 
   header("location:app");
}else{
    echo "login gagal";
}
?>