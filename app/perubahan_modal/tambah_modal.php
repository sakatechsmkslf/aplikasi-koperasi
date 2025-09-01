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
                                    <h3 class="card-title">tambah Modal</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="proses_tambah_modal.php" id="formku">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tahun</label>
                                            <input type="number" name="tahun" class="form-control"
                                                placeholder="Masukkan Nama Tahun" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Bulan</label>
                                            <input type="number" name="bulan" class="form-control"
                                                placeholder="Masukkan Nama Tanggal" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nominal</label>
                                            <input type="text" name="nominal" class="form-control"
                                                placeholder="Masukkan Nominal" id="nominal">
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

    <script>
        const input = document.getElementById('nominal');
        const form = document.getElementById('formku');

        input.addEventListener('keyup', function (e) {
            let angka = this.value.replace(/\D/g, "");
            this.value = angka ? "Rp " + new Intl.NumberFormat("id-ID").format(angka) : "";
        });

        form.addEventListener('submit', function () {
            let angka = input.value.replace(/\D/g, "");
            input.value = angka;
        });
    </script>

    <?php include("../template/footer.php");
    ?>
</body>

</html>