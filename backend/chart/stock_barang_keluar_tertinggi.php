
<?php
     require '../function.php';

     $bulan = $_POST['bulan'];

     $dataTertinggi = chart("SELECT barang_keluar.id_barang,master_barang.nama,master_barang.grade,MAX(barang_keluar.net_weight) AS stok FROM barang_keluar INNER JOIN master_barang ON barang_keluar.id_barang = master_barang.id_barang WHERE month(barang_keluar.tanggal)=".$bulan." GROUP BY barang_keluar.id_barang");

     echo $dataTertinggi;
?>