<?php
     require '../function.php';

     $bulan = $_POST['bulan'];

     $dataTerendah = chart("SELECT barang_masuk.nama,barang_masuk.grade,barang_masuk.jenis_barang,MIN(barang_masuk.netto) as stok FROM barang_masuk WHERE month(barang_masuk.tanggal) = ".$bulan." GROUP BY barang_masuk.grade DESC LIMIT 4");

     echo $dataTerendah;
?>