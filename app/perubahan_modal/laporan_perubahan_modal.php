<?php
include '../../koneksi.php';
session_start();
include("../template/header.php");


$bulan = isset($_GET['bulan']) ? (int)$_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? (int)$_GET['tahun'] : date('Y');

$q_modal_awal = mysqli_query($koneksi, "
    SELECT nominal FROM tbl_modal_awal 
    WHERE bulan = $bulan AND tahun = $tahun
");
$modal_awal = mysqli_fetch_assoc($q_modal_awal)['nominal'] ?? 0;

$q_penjualan = mysqli_query($koneksi, "
    SELECT SUM(total_harga) AS penjualan_kotor
    FROM tbl_transaksi
    WHERE MONTH(tanggal_transaksi) = $bulan AND YEAR(tanggal_transaksi) = $tahun
");
$penjualan = mysqli_fetch_assoc($q_penjualan)['penjualan_kotor'] ?? 0;

$q_hpp = mysqli_query($koneksi, "
    SELECT SUM(d.jumlah * b.harga) AS hpp
    FROM detail_transaksi d
    JOIN tbl_barang b ON d.id_barang = b.id_tbl_barang
    JOIN tbl_transaksi t ON d.id_transaksi = t.id_transaksi
    WHERE MONTH(t.tanggal_transaksi) = $bulan AND YEAR(t.tanggal_transaksi) = $tahun
");
$hpp = mysqli_fetch_assoc($q_hpp)['hpp'] ?? 0;

$q_biaya = mysqli_query($koneksi, "
    SELECT SUM(jumlah) AS total_biaya
    FROM tbl_biaya
    WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun
");
$biaya_usaha = mysqli_fetch_assoc($q_biaya)['total_biaya'] ?? 0;

$q_pendapatan_lain = mysqli_query($koneksi, "
    SELECT SUM(jumlah) AS pendapatan_lain
    FROM tbl_pendapatan
    WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun
");
$pendapatan_lain = mysqli_fetch_assoc($q_pendapatan_lain)['pendapatan_lain'] ?? 0;

$laba_kotor  = $penjualan - $hpp;
$laba_usaha  = $laba_kotor - $biaya_usaha;
$laba_bersih = $laba_usaha + $pendapatan_lain;

$modal_akhir = $modal_awal + $laba_bersih;
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php include("../template/navbar.php"); ?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
      <img src="../dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Kasir BC</span>
    </a>
    <?php include "../template/sidebare.php"; ?>
  </aside>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h3 class="mt-3">Laporan Perubahan Modal <small>Per <?= date("F Y", strtotime("$tahun-$bulan-01")) ?></small></h3>

        <!-- Filter -->
        <form method="get" class="form-inline mb-3">
          <select name="bulan" class="form-control mr-2">
            <?php for ($i=1;$i<=12;$i++): ?>
              <option value="<?= $i ?>" <?= $i==$bulan?'selected':'' ?>>
                <?= date("F", mktime(0,0,0,$i,1)) ?>
              </option>
            <?php endfor; ?>
          </select>
          <input type="number" name="tahun" value="<?= $tahun ?>" class="form-control mr-2" style="width:120px;">
          <button type="submit" class="btn btn-primary">Tampilkan</button>
          <a href="cetak_perubahan_modal.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>" class="btn btn-danger ml-2" target="_blank">Cetak PDF</a>
        </form>

        <table class="table table-bordered mt-3">
          <tr><td>Modal Awal</td><td>Rp <?= number_format($modal_awal,0,',','.'); ?></td></tr>
          <tr><td>Laba Bersih</td><td>Rp <?= number_format($laba_bersih,0,',','.'); ?> (+)</td></tr>
          <tr><th>Modal Akhir</th><th>Rp <?= number_format($modal_akhir,0,',','.'); ?></th></tr>
        </table>
      </div>
    </section>
  </div>
</div>

 <?php include("../template/footer.php");?>
    </body>
</html>