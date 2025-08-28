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
                                                <th>tanggal</th>
                                                <th>Nama Biaya</th>
                                                <th>jumlah</th>
                                                <th>keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "select * from tbl_biaya";
                                            $result = mysqli_query($koneksi, $query);
                                            if (mysqli_num_rows($result) > 0):
                                                while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <tr>
                                                        <td><?= $row['id_biaya']; ?></td>
                                                        <td><?= $row['tanggal']; ?></td>
                                                        <td><?= $row['nama_biaya']; ?></td>
                                                        <td>Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                                                        <td><?= $row['keterangan']; ?></td>
                                                        <td>
                                                            <button class="btn btn-primary edit-btn"
                                                                data-id_biaya="<?= $row['id_biaya']; ?>"
                                                                data-tanggal="<?= $row['tanggal']; ?>"
                                                                data-nama_biaya="<?= $row['nama_biaya']; ?>"
                                                                data-jumlah="<?= $row['jumlah']; ?>"
                                                                data-keterangan="<?= $row['keterangan']; ?>" data-toggle="modal"
                                                                data-target="#editModal">
                                                                Edit
                                                            </button>
                                                            <button class="btn btn-danger"><a
                                                                    href="proses_hapus_biaya.php?id_biaya=<?= $row['id_biaya']; ?>"
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
                                                    <h5 class="modal-title" id="editModalLabel">Edit Biayaa</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="proses_edit_biaya.php" method="POST"
                                                    id="formEditBiaya">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_biaya" id="edit-id_biaya">

                                                        <div class="form-group mb-3">
                                                            <label for="edit-nama_biaya">Nama Biaya</label>
                                                            <input type="text" name="nama_biaya" id="edit-nama_biaya"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-tanggal">Tanggal</label>
                                                            <input type="date" name="tanggal" id="edit-tanggal"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-jumlah">Jumlah</label>
                                                            <input type="text" name="jumlah" id="edit-jumlah"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-keterangan">Keterangan</label>
                                                            <textarea name="keterangan" id="edit-keterangan"
                                                                class="form-control" rows="4" required></textarea>
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

    <script>
        $('#edit-jumlah').on('keyup', function () {
            let angka = this.value.replace(/\D/g, ""); 
            this.value = angka ? "Rp " + new Intl.NumberFormat("id-ID").format(angka) : "";
        });

        $('#formEditBiaya').on('submit', function () {
            let angka = $('#edit-jumlah').val().replace(/\D/g, "");
            $('#edit-jumlah').val(angka);
        });

    </script>

    <?php include("../footer.php");
    ?>
    <script>
        function formatRupiah(angka) {
            let clean = angka.toString().replace(/\D/g, "");
            return clean ? "Rp " + new Intl.NumberFormat("id-ID").format(clean) : "";
        }

        $(document).ready(function () {
            $(".edit-btn").click(function () {
                var id_biaya = $(this).data("id_biaya");
                var tanggal = $(this).data("tanggal");
                var nama_biaya = $(this).data("nama_biaya");
                var jumlah = $(this).data("jumlah");
                var keterangan = $(this).data("keterangan");

                $("#edit-id_biaya").val(id_biaya);
                $("#edit-tanggal").val(tanggal);
                $("#edit-nama_biaya").val(nama_biaya);
                $("#edit-jumlah").val(formatRupiah(jumlah));
                $("#edit-keterangan").val(keterangan);

            });
        });
    </script>
</body>

</html>