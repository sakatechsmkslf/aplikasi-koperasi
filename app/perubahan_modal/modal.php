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

                                </form>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Tahun</th>
                                                <th>Bulan</th>
                                                <th>Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "select * from tbl_modal_awal";
                                            $result = mysqli_query($koneksi, $query);
                                            if (mysqli_num_rows($result) > 0):
                                                while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <tr>
                                                        <td><?= $row['id_modal']; ?></td>
                                                        <td><?= $row['tahun']; ?></td>
                                                        <td><?= $row['bulan']; ?></td>
                                                        <td><?= $row['nominal']; ?></td>
                                                        <td>
                                                            <button class="btn btn-primary edit-btn"
                                                                data-id_modal="<?= $row['id_modal']; ?>"
                                                                data-tanggal="<?= $row['tahun']; ?>"
                                                                data-nama_pendapatan="<?= $row['bulan']; ?>"
                                                                data-nominal="<?= $row['nominal']; ?>"
                                                                data-target="#editModal">
                                                                Edit
                                                            </button>
                                                            <button class="btn btn-danger"> <a
                                                                    href="hapus_modal.php?id_modal=<?= $row['id_modal']; ?>"
                                                                    class="text-white">Hapus</a></button>
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
                                    <div class="modal fade" id="editModal" tabindex="-1"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Modal</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="edit_modal.php" method="POST"
                                                    id="formEditBiaya">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_modal"
                                                            id="edit-id_modal">

                                                        <div class="form-group mb-3">
                                                            <label for="edit-tahun">Tahun</label>
                                                            <input type="text" name="tahun"
                                                                id="edit-tahun" class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-bulan">Bulan</label>
                                                            <input type="date" name="bulan" id="edit-bulan"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-nominal">Nominal</label>
                                                            <input type="text" name="nominal" id="edit-nominal"
                                                                class="form-control" min="1" required>
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
                                </div>
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

    <?php include("../template/footer.php"); ?>

    <script>
        $('#edit-nominal').on('keyup', function () {
            let angka = this.value.replace(/\D/g, "");
            this.value = angka ? "Rp " + new Intl.NumberFormat("id-ID").format(angka) : "";
        });

        $('#formEditBiaya').on('submit', function () {
            let angka = $('#edit-nominal').val().replace(/\D/g, "");
            $('#edit-nominal').val(angka);
        });


        function formatRupiah(angka) {
            let clean = angka.toString().replace(/\D/g, "");
            return clean ? "Rp " + new Intl.NumberFormat("id-ID").format(clean) : "";
        }

        $(document).ready(function () {
            $(".edit-btn").click(function () {
                var id_modal = $(this).data("id_modal");
                var tahun = $(this).data("tahun");
                var bulan = $(this).data("bulan");
                var nominal = $(this).data("nominal");

                $("#edit-id_modal").val(id_modal);
                $("#edit-tahun").val(tahun);
                $("#edit-bulan").val(bulan);
                $("#edit-nominal").val(formatRupiah(nominal));

            });
        });
    </script>


</body>

</html>