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
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Simpanan</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="proses_tambah_simpanan.php" id="formSimpanan">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control" required autofocus>
                                        </div>

                                        <div class="form-group">
                                            <label for="jenis_simpanan">Jenis Simpanan</label>
                                            <select name="jenis_simpanan" class="form-control" required>
                                                <option value="">-- Pilih Jenis --</option>
                                                <option value="pokok">Pokok</option>
                                                <option value="wajib">Wajib</option>
                                                <option value="sukarela">Sukarela</option>
                                                <option value="deposito">Deposito</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="nominal">Nominal</label>
                                            <input type="text" name="nominal" id="nominal" class="form-control"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" required>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" form="formSimpanan">Simpan</button>
                                            <a href="simpanan.php" class="btn btn-danger">Batal</a>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        // format angka ke rupiah
        function formatRupiah(input) {
            let angka = input.value.replace(/\D/g, "");
            input.value = angka ? "Rp " + new Intl.NumberFormat("id-ID").format(angka) : "";
        }

        const nominal = document.getElementById('nominal');
        const form = document.getElementById('formSimpanan');

        nominal.addEventListener('keyup', function () { formatRupiah(this); });

        form.addEventListener('submit', function () {
            nominal.value = nominal.value.replace(/\D/g, ""); // biar ke DB cuma angka
        });
    </script>

    <?php include("../template/footer.php"); ?>
</body>

</html>