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
                                    <form method="POST" action="hutang/proses_tambah_hutang.php" id="formHutang">
                                        <div class="form-group">
                                            <label for="jenis">Jenis Hutang</label>
                                            <input type="text" name="jenis" id="jenis" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="nominal">Nominal</label>
                                            <input type="text" name="nominal" id="nominal" class="form-control"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="jatuh_tempo">Jatuh Tempo</label>
                                            <input type="date" name="jatuh_tempo" id="jatuh_tempo" class="form-control"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="belum lunas" selected>Belum Lunas</option>
                                                <option value="lunas">Lunas</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" form="formHutang">Simpan</button>
                                    <!-- <a href="index.php" class="btn btn-danger">Batal</a> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        function formatRupiah(input) {
            let angka = input.value.replace(/\D/g, "");
            input.value = angka ? "Rp " + new Intl.NumberFormat("id-ID").format(angka) : "";
        }

        const nominal = document.getElementById('nominal');
        const form = document.getElementById('formHutang');

        nominal.addEventListener('keyup', function () {
            formatRupiah(this);
        });

        form.addEventListener('submit', function () {
            // biar ke database masuk angka polos
            nominal.value = nominal.value.replace(/\D/g, "");
        });
    </script>

    <?php include("../template/footer.php"); ?>
</body>

</html>