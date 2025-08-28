<?php
include '../../koneksi.php';
session_start();
include("../template/header.php");
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("../template/navbar.php"); ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="../dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">Kasir BC</span>
            </a>
            <?php include "../template/sidebare.php"; ?>

        </aside>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Rekap Penjualan</h3>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="">
                                        <label for="tanggal">Tanggal:</label>
                                        <input type="date" name="tanggal" id="tanggal"
                                            value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : '' ?>">

                                        <label for="bulan">Bulan:</label>
                                        <input type="month" name="bulan" id="bulan"
                                            value="<?= isset($_GET['bulan']) ? $_GET['bulan'] : '' ?>">

                                        <label for="kategori">Kategori:</label>
                                        <select name="kategori" id="kategori">
                                            <option value="">Semua Kategori</option>
                                            <?php
                                            $kategori_query = mysqli_query($koneksi, "select * from category");
                                            while ($kategori = mysqli_fetch_assoc($kategori_query)) {
                                                $selected = isset($_GET['kategori']) && $_GET['kategori'] == $kategori['id_category'] ? 'selected' : '';
                                                echo "<option value='{$kategori['id_category']}' $selected>{$kategori['nama']}</option>";
                                            }
                                            ?>
                                        </select>

                                        <button type="submit" class="btn btn-success">Filter</button>
                                    </form>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Kode Barcode</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori </th>
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <th>Stok Tersisa</th>
                                                <th>Barang Terjual</th>
                                                <th>Jumlah Pendapatan</th>
                                                <th>Jumlah Keuntungan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "
                                            SELECT 
                                            b.id_tbl_barang, 
                                            b.input_scanner AS kode_barcode, 
                                            b.nama_barang, 
                                            c.nama, 
                                            b.harga AS harga_beli, 
                                            b.harga_jual, 
                                            b.quantity AS stok_tersisa, 
                                            COALESCE(SUM(d.jumlah), 0) AS barang_terjual, 
                                               COALESCE(SUM(d.jumlah * b.harga_jual), 0) AS jumlah_pendapatan, 
                                               COALESCE(SUM(d.jumlah * (b.harga_jual - b.harga)), 0) AS jumlah_keuntungan
                                            FROM tbl_barang b
                                            LEFT JOIN category c ON b.id_category = c.id_category
                                            LEFT JOIN detail_transaksi d ON b.id_tbl_barang = d.id_barang
                                            LEFT JOIN tbl_transaksi t ON d.id_transaksi = t.id_transaksi
                                             WHERE 1=1";

                                            if (!empty($_GET['tanggal'])) {
                                                $tanggal = $_GET['tanggal'];
                                                $query .= " and date(t.tanggal_transaksi) = '$tanggal'";
                                            }

                                            if (!empty($_GET['bulan'])) {
                                                $bulan = $_GET['bulan'];
                                                $query .= " and DATE_FORMAT(t.tanggal_transaksi, '%Y-%m') = '$bulan'";
                                            }

                                            if (!empty($_GET['kategori'])) {
                                                $kategori = $_GET['kategori'];
                                                $query .= " and b.id_category = '$kategori'";
                                            }

                                            $query .= " 
                                            GROUP BY b.id_tbl_barang, b.input_scanner, b.nama_barang, c.nama, b.harga, b.harga_jual, b.quantity
                                            ORDER BY b.id_tbl_barang ASC";

                                            $result = mysqli_query($koneksi, $query);
                                            ?>
                                            <?php if (mysqli_num_rows($result) > 0): ?>
                                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <tr>
                                                        <td><?= $row['id_tbl_barang']; ?></td>
                                                        <td><?= $row['kode_barcode']; ?></td>
                                                        <td><?= $row['nama_barang']; ?></td>
                                                        <td><?= $row['nama']; ?></td>
                                                        <td>Rp <?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                                                        <td>Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                                                        <td><?= $row['stok_tersisa']; ?></td>
                                                        <td><?= $row['barang_terjual']; ?></td>
                                                        <td>Rp <?= number_format($row['jumlah_pendapatan'], 0, ',', '.'); ?>
                                                        </td>
                                                        <td>Rp <?= number_format($row['jumlah_keuntungan'], 0, ',', '.'); ?>
                                                        </td>

                                                    </tr>
                                                <?php endwhile;
                                            else: ?>
                                                <tr>
                                                    <td colspan="6">Tidak ada data ditemukan</td>
                                                </tr>
                                            <?php endif; ?>

                                            </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
    <?php if (isset($_SESSION['status'])): ?>
        <script>
            alert("<?= $_SESSION['status']; ?>");
        </script>
        <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_type']);
        ?>
    <?php endif; ?>

    <?php include("../template/footer.php");
    ?>
</body>

</html>