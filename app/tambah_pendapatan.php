<?php
include '../koneksi.php';
session_start();
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
                            <div class="card">
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">tambah Pendapatan</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="pendapatan/proses_tambah_pendapatan.php">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control"
                                                placeholder="Masukkan Nama Kategori" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Pendapatan</label>
                                            <input type="text" name="nama_pendapatan" class="form-control"
                                                placeholder="Masukkan Nama Kategori" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah</label>
                                            <input type="number" name="jumlah" class="form-control"
                                                placeholder="Masukkan Nama Kategori" autofocus>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea id="keterangan" name="keterangan" class="form-control" rows="4"
                                                autofocus></textarea>
                                        </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="btn_simpan">Simpan</button>
                                    <button type="submit" class="btn btn-danger" id="btn_batal">Batal</button>
                                </div>
                                </form>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
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

    <?php include("footer.php");
    ?>
</body>

</html>