<?php
include '../../koneksi.php';

$jumlah_barang = mysqli_fetch_assoc(mysqli_query($koneksi, "select count(*) AS jumlah from tbl_barang"))['jumlah'] ?? 0;

$total_harga_asli = mysqli_fetch_assoc(mysqli_query($koneksi, "select sum(harga) AS total from tbl_barang where date_format(tanggal_input, '%Y-%m') = date_format(now(), '%Y-%m')"))['total'] ?? 0;

$total_pendapatan = mysqli_fetch_assoc(mysqli_query($koneksi, "select sum(total_harga) AS total from tbl_transaksi where date_format(tanggal_transaksi, '%Y-%m') = date_format(now(), '%Y-%m')"))['total'] ?? 0;

$keuntungan = $total_pendapatan - $total_harga_asli
  ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- Total Barang -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $jumlah_barang; ?></h3>
              <p>Total Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>

        <!-- Total Harga Barang Masuk -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>Rp <?= number_format($total_harga_asli, 0, ',', '.'); ?></h3>
              <p>Total Harga Barang Masuk</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
          </div>
        </div>

        <!-- Pendapatan -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?></h3>
              <p>Total Pendapatan Sekarang</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>

        <!-- Unique Visitors -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>Rp <?= number_format($keuntungan, 0, ',', '.'); ?></h3>
              <p>keuntungan Bulan Sekarang</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>