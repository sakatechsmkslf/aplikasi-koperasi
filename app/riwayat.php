<?php
include '../koneksi.php';
include("header.php");
?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("navbar.php"); ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">Kasir BC</span>
            </a>
            <?php include "sidebare.php"; ?>

        </aside>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card"></div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Riwayat Pembelian</h3>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="">
                                        <label for="tanggal">Tanggal:</label>
                                        <input type="date" name="tanggal" id="tanggal" value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : '' ?>">

                                        <label for="bulan">Bulan:</label>
                                        <input type="month" name="bulan" id="bulan" value="<?= isset($_GET['bulan']) ? $_GET['bulan'] : '' ?>">

                                        <button type="submit" class="btn btn-success">Filter</button>
                                    </form>

                                    <?php
                                    $where = [];
                                    if (!empty($_GET['tanggal'])) {
                                        $tanggal = $_GET['tanggal'];
                                        $where[] = "tbl_transaksi.tanggal_transaksi = '$tanggal'";
                                    }
                                    if (!empty($_GET['bulan'])) {
                                        $bulan = $_GET['bulan'];
                                        $where[] = "DATE_FORMAT(tbl_transaksi.tanggal_transaksi, '%Y-%m') = '$bulan'";
                                    }

                                    $where_clause = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

                                    $query = "
                                SELECT 
                                    tbl_transaksi.id_transaksi, 
                                    tbl_transaksi.tanggal_transaksi, 
                                    tbl_transaksi.total_harga, 
                                    tbl_transaksi.jumlah_uang, 
                                    tbl_transaksi.kembalian, 
                                    detail_transaksi.id_barang, 
                                    detail_transaksi.jumlah, 
                                    tbl_barang.nama_barang, 
                                    tbl_barang.harga_jual
                                FROM tbl_transaksi
                                LEFT JOIN detail_transaksi ON tbl_transaksi.id_transaksi = detail_transaksi.id_transaksi
                                LEFT JOIN tbl_barang ON detail_transaksi.id_barang = tbl_barang.id_tbl_barang
                                $where_clause
                                ORDER BY tbl_transaksi.id_transaksi DESC
                            ";

                                    $result = mysqli_query($koneksi, $query);
                                    ?>

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Total Harga</th>
                                                <th>Jumlah Uang Dibayarkan</th>
                                                <th>Kembalian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (mysqli_num_rows($result) > 0): ?>
                                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <tr>
                                                        <td><?= $row['id_transaksi']; ?></td>
                                                        <td><?= $row['tanggal_transaksi']; ?></td>
                                                        <td><?= $row['nama_barang'] ?: '-'; ?></td>
                                                        <td><?= $row['jumlah'] ?: '-'; ?></td>
                                                        <td>Rp <?= number_format($row['harga_jual']) ?: '-'; ?></td>
                                                        <td>Rp <?= number_format($row['jumlah'] * $row['harga_jual']); ?></td>
                                                        <td>Rp <?= number_format($row['jumlah_uang']) ?: '-'; ?></td>
                                                        <td>Rp <?= number_format($row['jumlah_uang'] - ($row['jumlah'] * $row['harga_jual'])) ?: '-'; ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8">Tidak ada data ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
    <?php include("footer.php");
    ?>
</body>

</html>