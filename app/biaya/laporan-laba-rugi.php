<?php
include '../../koneksi.php';
session_start();
include("../template/header.php");

$bulan = $_GET['bulan'] ?? date('m');
$tahun = $_GET['tahun'] ?? date('Y');

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
    SELECT SUM(jumlah) AS pendapatan
    FROM tbl_pendapatan
    WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun
");
$pendapatan_lain = mysqli_fetch_assoc($q_pendapatan_lain)['pendapatan_lain'] ?? 0;

$laba_kotor  = $penjualan - $hpp;
$laba_usaha  = $laba_kotor - $biaya_usaha;
$laba_bersih = $laba_usaha + $pendapatan_lain;
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

        <h3 class="mt-3">Laporan Laba Rugi <small>Per <?= date("F Y", strtotime("$tahun-$bulan-01")) ?></small></h3>

        <form method="get" class="form-inline mb-3">
          <label class="mr-2">Bulan:</label>
          <select name="bulan" class="form-control mr-2">
            <?php for($i=1;$i<=12;$i++): ?>
              <option value="<?= $i ?>" <?= ($bulan == $i ? 'selected' : '') ?>>
                <?= date("F", mktime(0,0,0,$i,1)) ?>
              </option>
            <?php endfor; ?>
          </select>

          <label class="mr-2">Tahun:</label>
          <select name="tahun" class="form-control mr-2">
            <?php for($i=2020;$i<=date('Y');$i++): ?>
              <option value="<?= $i ?>" <?= ($tahun == $i ? 'selected' : '') ?>><?= $i ?></option>
            <?php endfor; ?>
          </select>

          <button type="submit" class="btn btn-primary">Filter</button>
          <a href="cetak-laba-rugi.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>" target="_blank" class="btn btn-success ml-2">Cetak PDF</a>
        </form>

        <table class="table table-bordered mt-3">
          <tr class="bg-light"><th colspan="2">Pendapatan</th></tr>
          <tr><td>Penjualan</td><td>Rp <?= number_format($penjualan,0,',','.'); ?></td></tr>
          <tr><td><b>Penjualan Bersih</b></td><td><b>Rp <?= number_format($penjualan,0,',','.'); ?></b></td></tr>

          <tr class="bg-light"><th colspan="2">Harga Pokok Penjualan (HPP)</th></tr>
          <tr><td>HPP</td><td>Rp <?= number_format($hpp,0,',','.'); ?></td></tr>
          <tr><td><b>Laba Kotor</b></td><td><b>Rp <?= number_format($laba_kotor,0,',','.'); ?></b></td></tr>

          <tr class="bg-light"><th colspan="2">Biaya Usaha</th></tr>
          <tr><td>Total Biaya Usaha</td><td>Rp <?= number_format($biaya_usaha,0,',','.'); ?></td></tr>
          <tr><td><b>Laba Usaha</b></td><td><b>Rp <?= number_format($laba_usaha,0,',','.'); ?></b></td></tr>

          <tr class="bg-light"><th colspan="2">Pendapatan & Beban Lain-lain</th></tr>
          <tr><td>Pendapatan Lain-lain</td><td>Rp <?= number_format($pendapatan_lain,0,',','.'); ?></td></tr>
          <tr><td><b>Laba Bersih</b></td><td><b>Rp <?= number_format($laba_bersih,0,',','.'); ?></b></td></tr>
        </table>

      </div>
    </section>
  </div>
</div>
 <?php include("../template/footer.php");?>
    </body>
</html>
