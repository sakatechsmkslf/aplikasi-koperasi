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
                  <h3 class="card-title">Table Barang</h3>
                </div>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Kode Barcode</th>
                        <th>Nama</th>
                        <th>Harga Satuan</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "select * from tbl_barang";
                      $result = mysqli_query($koneksi, $query);
                      if (mysqli_num_rows($result) > 0):
                        while ($row = mysqli_fetch_assoc($result)): ?>
                          <tr>
                            <td><?= $row['id_tbl_barang']; ?></td>
                            <td><?= $row['input_scanner']; ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td><?= $row['quantity']; ?></td>
                            <td>
                              <button class="btn btn-primary edit-btn"
                                data-id="<?= $row['id_tbl_barang']; ?>"
                                data-barcode="<?= $row['input_scanner']; ?>"
                                data-nama="<?= $row['nama_barang']; ?>"
                                data-harga="<?= $row['harga']; ?>"
                                data-stok="<?= $row['quantity']; ?>"
                                data-toggle="modal" data-target="#editModal">
                                Edit
                              </button> <button class="btn btn-danger"><a href="hapus-barang.php?id=<?= $row['id_tbl_barang']; ?>" class="text-white">Hapus</a></button>
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
                  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="edit_barang.php" method="POST">
                          <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="form-group">
                              <label>Kode Barcode</label>
                              <input type="text" name="barcode" id="edit-barcode" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label>Nama Barang</label>
                              <input type="text" name="nama" id="edit-nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label>Harga</label>
                              <input type="number" name="harga" id="edit-harga" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label>Stok</label>
                              <input type="number" name="stok" id="edit-stok" class="form-control" required>
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

  <script>
      $(document).ready(function () {
        $(".edit-btn").click(function () {
            var id = $(this).data("id");
            var barcode = $(this).data("barcode");
            var nama = $(this).data("nama");
            var harga = $(this).data("harga");
            var stok = $(this).data("stok");

            $("#edit-id").val(id);
            $("#edit-barcode").val(barcode);
            $("#edit-nama").val(nama);
            $("#edit-harga").val(harga);
            $("#edit-stok").val(stok);
        });
    });
  </script>
</body>

</html>