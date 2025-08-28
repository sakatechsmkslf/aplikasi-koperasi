<!DOCTYPE html>
<html lang="en">

<?php
include '../../koneksi.php';
include("../template/header.php");

session_start();
if (!isset($_SESSION['cari_data'])) {
  $_SESSION['cari_data'] = [];
}

if (!empty($_POST['input_scanner'])) {
  $input_scanner = mysqli_real_escape_string($koneksi, trim($_POST['input_scanner']));
  $cari = mysqli_query($koneksi, "select *, harga_jual AS harga FROM tbl_barang where input_scanner='$input_scanner' OR nama_barang LIKE '%$input_scanner%'");

  if (mysqli_num_rows($cari)) {
    while ($data = mysqli_fetch_assoc($cari)) {
      $isExist = false;
      foreach ($_SESSION['cari_data'] as $existingData) {
        if ($existingData['id_tbl_barang'] == $data['id_tbl_barang']) {
          $isExist = true;
          break;
        }
      }
      if (!$isExist) {
        $_SESSION['cari_data'][] = $data;
      }
    }
  }
}
if (isset($_POST['refresh'])) {
  $_SESSION['cari_data'] = [];
}
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include("../template/navbar.php"); ?>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="index3.html" class="brand-link">
        <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Kasir BC</span>
      </a>
      <?php include "../template/sidebare.php"; ?>
    </aside>

    <div class="content-wrapper">
      <section class="content">
        <div class="container-fluid">
          <h2 class="text-center display-4">Cari Barang</h2>
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <form method="POST" action="">
                <div class="input-group">
                  <input type="search" class="form-control form-control-lg" placeholder="Masukkan Kode Barcode"
                    id="input_scanner" name="input_scanner" autofocus>
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-lg btn-default">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" name="refresh" class="btn btn-danger">Refresh</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

      <section class="content" style="margin-top: 20px;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Hasil Pencarian</h3>
                </div>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Kode Barcode</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $total_harga = 0;
                      if (!empty($_SESSION['cari_data'])) {
                        foreach ($_SESSION['cari_data'] as $data) {
                          $total_harga += $data['harga_jual'];
                          echo "<tr>
                                 <td>{$data['id_tbl_barang']}</td>
                                <td>{$data['input_scanner']}</td>
                                <td>{$data['nama_barang']}</td>
                                <td>Rp " . number_format($data['harga_jual'], 0, ',', '.') . "</td>
                                <td>{$data['quantity']}</td>
                                <td><input type='number' class='form-control jumlah-barang' data-harga='{$data['harga_jual']}' value='1' min='1'></td>
                                <td class='total-harga-barang'>Rp " . number_format($data['harga_jual'], 0, ',', '.') . "</td>
                                </tr>";
                        }
                      } else {
                        echo "<tr><td colspan='7'>Data yang anda cari tidak ada</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                  <div class="mt-3">
                    <h5>Total <strong id="totalHargaKeseluruhan">Rp
                        <?= number_format($total_harga, 0, ',', '.'); ?></strong></h5>
                  </div>
                  <button class="btn btn-success mt-3" data-toggle="modal" data-target="#modalBayar">Bayar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- Modal Bayar -->
  <div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="modalBayarLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalBayarLabel">Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Total Harga: <strong id="modalTotalHarga">Rp <?= number_format($total_harga, 0, ',', '.'); ?></strong></p>

          <form id="formBayar" action="transaksi.php" method="POST">
            <div class="form-group">
              <label for="jumlahUang">Jumlah Uang</label>
              <input type="text" class="form-control" id="jumlahUang" name="jumlah_uang"
                placeholder="Masukkan jumlah uang">
            </div>
            <input type="hidden" id="dataTransaksi" name="data_transaksi">
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" onclick="hitungKembalian()">Bayar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>

    document.querySelector('#formBayar').addEventListener('submit', function (e) {
      const dataTransaksi = [];
      document.querySelectorAll('#example1 tbody tr').forEach(row => {
        const id = row.querySelector('td:nth-child(1)').innerText;
        const jumlah = row.querySelector('.jumlah-barang').value;
        const totalHarga = row.querySelector('.total-harga-barang').innerText.replace(/[^\d]/g, '');

        dataTransaksi.push({
          id,
          jumlah,
          totalHarga
        });
      });

      document.getElementById('dataTransaksi').value = JSON.stringify(dataTransaksi);
    });

    document.addEventListener('DOMContentLoaded', () => {
      const jumlahBarangInputs = document.querySelectorAll('.jumlah-barang');
      const totalHargaKeseluruhan = document.getElementById('totalHargaKeseluruhan');
      const modalTotalHarga = document.getElementById('modalTotalHarga');

      jumlahBarangInputs.forEach(input => {
        input.addEventListener('input', () => {
          const harga = parseInt(input.dataset.harga);
          const jumlah = parseInt(input.value);
          const totalHargaBarang = harga * jumlah;

          input.closest('tr').querySelector('.total-harga-barang').innerText = `Rp ${new Intl.NumberFormat('id-ID').format(totalHargaBarang)}`;

          let totalKeseluruhan = 0;
          jumlahBarangInputs.forEach(input => {
            const harga = parseInt(input.dataset.harga);
            const jumlah = parseInt(input.value);
            totalKeseluruhan += harga * jumlah;
          });

          totalHargaKeseluruhan.innerText = `Rp ${new Intl.NumberFormat('id-ID').format(totalKeseluruhan)}`;
          modalTotalHarga.innerText = `Rp ${new Intl.NumberFormat('id-ID').format(totalKeseluruhan)}`;
        });
      });
    });

    function hitungKembalian() {
      const totalHarga = parseInt(document.getElementById('modalTotalHarga').innerText.replace(/[^\d]/g, ''));
      const jumlahUang = parseInt(document.getElementById('jumlahUang').value.replace(/[^\d]/g, ''));
      const kembalian = jumlahUang - totalHarga;

      if (kembalian >= 0) {
        alert(`Uang Kembalian: Rp ${new Intl.NumberFormat('id-ID').format(kembalian)}`);
      } else {
        alert('Uang yang diberikan kurang!');
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      const inputScanner = document.getElementById('input_scanner');
      inputScanner.focus();

      document.querySelector('form').addEventListener('submit', () => {
        setTimeout(() => {
          inputScanner.focus();
          inputScanner.select();
        }, 100);
      });
    });

    var dengan_rupiah = document.getElementById('jumlahUang');
    dengan_rupiah.addEventListener('keyup', function (e) {
      dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

  </script>

  <?php include("../template/footer.php"); ?>
</body>

</html>