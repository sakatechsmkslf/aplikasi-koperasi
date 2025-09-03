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
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Table Simpanan</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Jenis Simpanan</th>
                                                <th>Nominal</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM tbl_simpanan";
                                            $result = mysqli_query($koneksi, $query);
                                            if (mysqli_num_rows($result) > 0):
                                                while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <tr>
                                                        <td><?= $row['id_simpanan']; ?></td>
                                                        <td><?= $row['nama']; ?></td>
                                                        <td><?= ucfirst($row['jenis_simpanan']); ?></td>
                                                        <td>Rp <?= number_format($row['nominal'], 0, ',', '.'); ?></td>
                                                        <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                                        <td>
                                                            <button class="btn btn-primary edit-btn"
                                                                data-id="<?= $row['id_simpanan']; ?>"
                                                                data-nama="<?= $row['nama']; ?>"
                                                                data-jenis="<?= $row['jenis_simpanan']; ?>"
                                                                data-nominal="<?= $row['nominal']; ?>"
                                                                data-tanggal="<?= $row['tanggal']; ?>" 
                                                                data-toggle="modal"
                                                                data-target="#editModal">
                                                                Edit
                                                            </button>
                                                            <a href="proses_hapus_simpanan.php?id=<?= $row['id_simpanan']; ?>"
                                                                class="btn btn-danger text-white">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile;
                                            else: ?>
                                                <tr>
                                                    <td colspan="6">Tidak ada data ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Simpanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="proses_edit_simpanan.php" method="POST" id="formEditSimpanan">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_simpanan" id="edit-id">

                                                        <div class="form-group mb-3">
                                                            <label for="edit-nama">Nama</label>
                                                            <input type="text" name="nama" id="edit-nama" class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-jenis">Jenis Simpanan</label>
                                                            <select name="jenis_simpanan" id="edit-jenis" class="form-control" required>
                                                                <option value="pokok">Pokok</option>
                                                                <option value="wajib">Wajib</option>
                                                                <option value="sukarela">Sukarela</option>
                                                                <option value="deposito">Deposito</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-nominal">Nominal</label>
                                                            <input type="text" name="nominal" id="edit-nominal" class="form-control" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="edit-tanggal">Tanggal</label>
                                                            <input type="date" name="tanggal" id="edit-tanggal" class="form-control" required>
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

    <!-- Alert untuk status -->
    <?php if (isset($_SESSION['status'])): ?>
        <script>
            alert("<?= $_SESSION['status']; ?>");
        </script>
        <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_type']);
        ?>
    <?php endif; ?>

    <!-- Include footer -->
    <?php include("../template/footer.php"); ?>

    <!-- JavaScript -->
    <script>
        // Fungsi untuk format rupiah
        function formatRupiah(angka) {
            let clean = angka.toString().replace(/\D/g, "");
            return clean ? "Rp " + new Intl.NumberFormat("id-ID").format(clean) : "";
        }

        $(document).ready(function () {
            // Handler untuk tombol edit
            $(".edit-btn").click(function () {
                var id = $(this).data("id");
                var nama = $(this).data("nama");
                var jenis = $(this).data("jenis");
                var nominal = $(this).data("nominal");
                var tanggal = $(this).data("tanggal");

                // Isi data ke form modal
                $("#edit-id").val(id);
                $("#edit-nama").val(nama);
                $("#edit-jenis").val(jenis);
                $("#edit-nominal").val(formatRupiah(nominal));
                $("#edit-tanggal").val(tanggal);
            });

            // Format rupiah saat mengetik
            $('#edit-nominal').on('keyup', function () {
                let angka = this.value.replace(/\D/g, "");
                this.value = angka ? "Rp " + new Intl.NumberFormat("id-ID").format(angka) : "";
            });

            // Hilangkan format sebelum submit
            $('#formEditSimpanan').on('submit', function () {
                $('#edit-nominal').val($('#edit-nominal').val().replace(/\D/g, ""));
            });
        });
    </script>
</body>
</html>