<?php
include '../../koneksi.php';
session_start();
include("../template/header.php");
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("../template/navbar.php"); ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="../index3.html" class="brand-link">
                <img src="../dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3">
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
                                    <h3 class="card-title">Daftar Aset (Neraca)</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Aset</th>
                                                <th>Nilai Perolehan</th>
                                                <th>Akumulasi Penyusutan</th>
                                                <th>Tahun Perolehan</th>
                                                <th>Umur Ekonomis</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM tbl_neraca";
                                            $result = mysqli_query($koneksi, $query);
                                            if (mysqli_num_rows($result) > 0):
                                                while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <tr>
                                                        <td><?= $row['id_neraca']; ?></td>
                                                        <td><?= $row['nama_aset']; ?></td>
                                                        <td>Rp <?= number_format($row['nilai_perolehan'], 0, ',', '.'); ?></td>
                                                        <td>Rp <?= number_format($row['akumulasi_penyusutan'], 0, ',', '.'); ?></td>
                                                        <td><?= date('d-m-Y', strtotime($row['tahun_perolehan'])); ?></td>
                                                        <td><?= $row['umur_ekonomis']; ?> Tahun</td>
                                                        <td>
                                                            <button class="btn btn-primary edit-btn"
                                                                data-id="<?= $row['id_neraca']; ?>"
                                                                data-nama_aset="<?= $row['nama_aset']; ?>"
                                                                data-nilai="<?= $row['nilai_perolehan']; ?>"
                                                                data-penyusutan="<?= $row['akumulasi_penyusutan']; ?>"
                                                                data-tahun="<?= $row['tahun_perolehan']; ?>"
                                                                data-umur="<?= $row['umur_ekonomis']; ?>"
                                                                data-toggle="modal"
                                                                data-target="#editModal">
                                                                Edit
                                                            </button>
                                                            <a href="proses_hapus_neraca.php?id=<?= $row['id_neraca']; ?>"
                                                                class="btn btn-danger text-white">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile;
                                            else: ?>
                                                <tr>
                                                    <td colspan="7">Tidak ada data ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Aset</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <form action="proses_edit_neraca.php" method="POST" id="formEditNeraca">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_neraca" id="edit-id">

                                                        <div class="form-group mb-3">
                                                            <label for="edit-nama_aset">Nama Aset</label>
                                                            <input type="text" name="nama_aset" id="edit-nama_aset" class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-nilai">Nilai Perolehan</label>
                                                            <input type="text" name="nilai_perolehan" id="edit-nilai" class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-penyusutan">Akumulasi Penyusutan</label>
                                                            <input type="text" name="akumulasi_penyusutan" id="edit-penyusutan" class="form-control">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-tahun">Tahun Perolehan</label>
                                                            <input type="date" name="tahun_perolehan" id="edit-tahun" class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-umur">Umur Ekonomis (tahun)</label>
                                                            <input type="number" name="umur_ekonomis" id="edit-umur" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        function formatRupiah(angka) {
            let clean = angka.toString().replace(/\D/g, "");
            return clean ? "Rp " + new Intl.NumberFormat("id-ID").format(clean) : "";
        }

        $(document).ready(function () {
            $(".edit-btn").click(function () {
                $("#edit-id").val($(this).data("id"));
                $("#edit-nama_aset").val($(this).data("nama_aset"));
                $("#edit-nilai").val(formatRupiah($(this).data("nilai")));
                $("#edit-penyusutan").val(formatRupiah($(this).data("penyusutan")));
                $("#edit-tahun").val($(this).data("tahun"));
                $("#edit-umur").val($(this).data("umur"));
            });

            $('#edit-nilai, #edit-penyusutan').on('keyup', function () {
                let angka = this.value.replace(/\D/g, "");
                this.value = angka ? "Rp " + new Intl.NumberFormat("id-ID").format(angka) : "";
            });

            $('#formEditNeraca').on('submit', function () {
                $('#edit-nilai').val($('#edit-nilai').val().replace(/\D/g, ""));
                $('#edit-penyusutan').val($('#edit-penyusutan').val().replace(/\D/g, ""));
            });
        });
    </script>

    <?php include("../template/footer.php"); ?>
</body>
</html>
