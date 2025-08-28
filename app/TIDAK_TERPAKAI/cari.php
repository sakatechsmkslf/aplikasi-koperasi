<?php
$koneksi=mysqli_connect("localhost","root","","kasir") or die();
$input_scanner=trim($_POST['input_scanner']);
$cari=mysqli_query($koneksi,"select * from tbl_barang where input_scanner='$input_scanner' ");
$jml=mysqli_num_rows($cari);
if($jml>0){
   $data=mysqli_fetch_array($cari);
   echo "<p><b>Hasil Pencarian Barang</b><br> Kode Barcode : $data[input_scanner]</p>";
   echo "<table class='table_content'>";
   echo "<tr><th>Kode Barcode</th><th>Nama Barang</th><th>Harga</th><th>quantity</th></tr>";
   echo "<tr><td>".$data['input_scanner']."</td><td>".$data['nama_barang']."</td><td>".$data['harga']."</td><td>".$data['quantity']."</td></tr>";
   echo "</table>";
}else{
   echo "<p class='error'>Data tidak ditemukan</p>";
}
?>