<?php
include("../template/header.php");
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include "../template/navbar.php"; ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../index3.html" class="brand-link">
                <img src="../dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">Kasir BC</span>
            </a>
            <?php include "../template/sidebare.php"; ?>

            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tambah Barang</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">General Form</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Tambah Barang</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kode Barcode</label>
                                        <input type="text" class="form-control" id="input_scanner"
                                            placeholder="Masukkan Kode Barang" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama_barang"
                                            placeholder="Masukkan Nama Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Harga Asli</label>
                                        <input type="text" class="form-control" id="harga"
                                            placeholder="Masukkan Harga Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Harga Jual</label>
                                        <input type="text" class="form-control" id="harga_jual"
                                            placeholder="Masukkan Harga Jual Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Jumlah Barang</label>
                                        <input type="number" class="form-control" id="quantity"
                                            placeholder="Masukkan Jumlah Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_category">Kategori</label>
                                        <select class="form-control select2" id="id_category">
                                            <option value="">Pilih Kategori</option>
                                            <?php
                                            include "../../koneksi.php";
                                            $query = mysqli_query($koneksi, "select id_category, nama from category");
                                            while ($row = mysqli_fetch_assoc($query)) {
                                                echo "<option value='" . $row['id_category'] . "'>" . $row['nama'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="btn_simpan">Simpan</button>
                                    <button type="submit" class="btn btn-danger" id="btn_batal">Batal</button>
                                </div>

                            </div>
                            <!-- /.card -->
                        </div>

                    </div>

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <script>
            $(document).ready(function () {
                $('#input_scanner').val("").focus();

                $('#input_scanner').on('keypress', function (e) {
                    if (e.which === 13) {
                        let kode = $(this).val().trim();
                        if (kode === "") {
                            $('#message_info').text("Kode barcode tidak boleh kosong!");
                        } else {
                            $('#message_info').text("");
                            $('#nama_barang').focus();
                        }
                        e.preventDefault();
                    }
                });

                $('#btn_simpan').click(function () {
                    let input_scanner = $('#input_scanner').val().trim();
                    let nama_barang = $('#nama_barang').val().trim();
                    let harga = $('#harga').val().replace("Rp. ", "").replace(".", '').trim();;
                    let harga_jual = $('#harga_jual').val().replace("Rp. ", "").replace(".", '').trim();;
                    let quantity = $('#quantity').val().trim();
                    let id_category = $('#id_category').val();


                    if (!input_scanner || !nama_barang || !harga || !harga_jual || !quantity || !id_category) {
                        alert("Semua field harus diisi!");
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: 'tambah_barang.php',
                        data: {
                            input_scanner: input_scanner,
                            nama_barang: nama_barang,
                            harga: harga,
                            harga_jual: harga_jual,
                            quantity: quantity,
                            id_category: id_category
                        },
                        beforeSend: function () {
                            $('#message_info').text("Sedang memproses data, silahkan tunggu...");
                        },
                        success: function (response) {
                            $('#message_info').text("");
                            alert(response);
                            $('#input_scanner, #nama_barang, #harga,#harga_jual, #quantity, #id_category').val("");
                            $('#input_scanner').focus();
                        },
                        error: function () {
                            $('#message_info').text("Terjadi kesalahan saat menyimpan data.");
                        }
                    });
                });

                $('#btn_batal').click(function () {
                    $('#input_scanner, #nama_barang, #harga, #harga_jual, #quantity, #id_category').val("");
                    $('#message_info').text("");
                    $('#input_scanner').focus();
                });
            });

            var dengan_rupiah = document.getElementById('harga', 'harga_jual');
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

            var rupiah_jual = document.getElementById('harga_jual');
            rupiah_jual.addEventListener('keyup', function (e) {
                rupiah_jual.value = formatRupiah(this.value, 'Rp. ');
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
        </script>
        <script>
            $(document).ready(function () {
                $('.select2').select2({
                    placeholder: "Pilih Kategori",
                    allowClear: true,
                    width: 'resolve',
                    dropdownAutoWidth: true,
                    theme: "classic",
                });

                $(document).on('select2:open', () => {
                    document.querySelector('.select2-search__field').focus();
                });
            });
        </script>
        <?php include("../template/footer.php");
        ?>
</body>

</html>