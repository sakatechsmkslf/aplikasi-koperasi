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
                                    <h3 class="card-title">Tambah Aset (Neraca)</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="neraca/proses_tambah_neraca.php" id="formneraca">
                                        <div class="form-group">
                                            <label for="nama_aset">Nama Aset</label>
                                            <input type="text" name="nama_aset" class="form-control" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="nilai_perolehan">Nilai Perolehan</label>
                                            <input type="text" name="nilai_perolehan" class="form-control" id="nilai_perolehan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="akumulasi_penyusutan">Akumulasi Penyusutan</label>
                                            <input type="text" name="akumulasi_penyusutan" class="form-control" id="akumulasi_penyusutan">
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_perolehan">Tahun Perolehan</label>
                                            <input type="date" name="tahun_perolehan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="umur_ekonomis">Umur Ekonomis (tahun)</label>
                                            <input type="number" name="umur_ekonomis" class="form-control" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" form="formneraca">Simpan</button>
                                    <a href="index.php" class="btn btn-danger">Batal</a>
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

        const nilai = document.getElementById('nilai_perolehan');
        const penyusutan = document.getElementById('akumulasi_penyusutan');
        const form = document.getElementById('formneraca');

        nilai.addEventListener('keyup', function () { formatRupiah(this); });
        penyusutan.addEventListener('keyup', function () { formatRupiah(this); });

        form.addEventListener('submit', function () {
            nilai.value = nilai.value.replace(/\D/g, "");
            penyusutan.value = penyusutan.value.replace(/\D/g, "");
        });
    </script>

    <?php include("../template/footer.php"); ?>
</body>
</html>
