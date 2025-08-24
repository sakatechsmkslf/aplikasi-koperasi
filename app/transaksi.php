<?php
session_start();

include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jumlahUang = intval(str_replace(['Rp.', '.', ','], '', $_POST['jumlah_uang']));
    $dataTransaksi = json_decode($_POST['data_transaksi'], true);
    $totalHarga = 0;

    foreach ($dataTransaksi as $item) {
        $totalHarga += intval($item['totalHarga']);
    }

    if ($jumlahUang >= $totalHarga) {
        $tanggal = date('Y-m-d H:i:s');
        $query = "insert into tbl_transaksi (tanggal_transaksi, total_harga, jumlah_uang, kembalian) 
                  VALUES ('$tanggal', $totalHarga, $jumlahUang, $jumlahUang - $totalHarga)";

        if (mysqli_query($koneksi, $query)) {
            $idTransaksi = mysqli_insert_id($koneksi);

            foreach ($dataTransaksi as $item) {
                $idBarang = intval($item['id']);
                $jumlah = intval($item['jumlah']);
                $subtotal = intval($item['totalHarga']);

                $barang = "select nama_barang from tbl_barang WHERE id_tbl_barang = $idBarang";
                $hasilBarang = mysqli_query($koneksi, $barang);
                $rowBarang = mysqli_fetch_assoc($hasilBarang);
                $namaBarang = $rowBarang['nama_barang'];

                mysqli_query($koneksi, "insert into detail_transaksi (id_transaksi, id_barang, nama_barang, jumlah, subtotal) 
                                        VALUES ($idTransaksi, $idBarang, '$namaBarang', $jumlah, $subtotal)");

                mysqli_query($koneksi, "update tbl_barang SET quantity = quantity - $jumlah WHERE id_tbl_barang = $idBarang");
            }

            unset($_SESSION['cari_data']);
            header('Location: cari_data.php');
            exit();
        } else {
            echo "Transaksi gagal: " . mysqli_error($koneksi);
        }
    }
}

?>
