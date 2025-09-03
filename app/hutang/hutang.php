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
                                                <th>Jenis Hutang</th>
                                                <th>Nominal</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM tbl_hutang";
                                            $result = mysqli_query($koneksi, $query);
                                            if (mysqli_num_rows($result) > 0):
                                                while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <tr>
                                                        <td><?= $row['id_hutang']; ?></td>
                                                        <td><?= $row['jenis']; ?></td>
                                                        <td>Rp <?= number_format($row['nominal'], 0, ',', '.'); ?></td>
                                                        <td><?= date('d-m-Y', strtotime($row['jatuh_tempo'])); ?></td>
                                                        <td>
                                                            <?php if ($row['status'] == 'lunas'): ?>
                                                                <span class="badge badge-success">Lunas</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-warning">Belum Lunas</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-primary edit-btn"
                                                                data-id="<?= $row['id_hutang']; ?>"
                                                                data-jenis="<?= $row['jenis']; ?>"
                                                                data-nominal="<?= $row['nominal']; ?>"
                                                                data-jatuh_tempo="<?= $row['jatuh_tempo']; ?>"
                                                                data-status="<?= $row['status']; ?>" data-toggle="modal"
                                                                data-target="#editHutangModal">
                                                                Edit
                                                            </button>
                                                            <a href="proses_hapus_hutang.php?id=<?= $row['id_hutang']; ?>"
                                                                class="btn btn-danger text-white">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile;
                                            else: ?>
                                                <tr>
                                                    <td colspan="6">Tidak ada data hutang ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editHutangModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Hutang</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <form action="proses_edit_hutang.php" method="POST" id="formEditHutang">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_hutang" id="edit-id-hutang">

                                                        <div class="form-group mb-3">
                                                            <label for="edit-jenis">Jenis Hutang</label>
                                                            <input type="text" name="jenis" id="edit-jenis"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-nominal">Nominal</label>
                                                            <input type="text" name="nominal" id="edit-nominal"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-jatuh_tempo">Jatuh Tempo</label>
                                                            <input type="date" name="jatuh_tempo" id="edit-jatuh_tempo"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-status">Status</label>
                                                            <select name="status" id="edit-status" class="form-control"
                                                                required>
                                                                <option value="belum lunas">Belum Lunas</option>
                                                                <option value="lunas">Lunas</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
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
                $("#edit-id-hutang").val($(this).data("id"));
                $("#edit-jenis").val($(this).data("jenis"));
                $("#edit-nominal").val(formatRupiah($(this).data("nominal")));
                $("#edit-jatuh_tempo").val($(this).data("jatuh_tempo"));
                $("#edit-status").val($(this).data("status"));
            });

            $('#edit-nominal').on('keyup', function () {
                let angka = this.value.replace(/\D/g, "");
                this.value = angka ? "Rp " + new Intl.NumberFormat("id-ID").format(angka) : "";
            });

            $('#formEditHutang').on('submit', function () {
                $('#edit-nominal').val($('#edit-nominal').val().replace(/\D/g, ""));
            });
        });
    </script>


    <?php include("../template/footer.php"); ?>
</body>

</html>