
<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
if(!$_SESSION['user_email']){
  header("Location: ../");
}
include ("header.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <?php include ("navbar.php"); ?>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle" >
      <span class="brand-text font-weight-light">Kasir BC</span>
    </a>

    <!-- Sidebar -->
    <?php include "sidebare.php"; ?>

    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <?php include "dasboard.php"; ?>

  <!-- /.content-wrapper -->
  <?php include "footer.php"; ?>

</body>
</html>
