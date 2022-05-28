<?php
     require '../function.php';
     $data = chart("SELECT nama,jenis_barang,grade, MAX(master_barang.stok) as stok FROM master_barang WHERE master_barang.stok > 100 GROUP BY stok DESC LIMIT 4;");

     echo$data;
?>