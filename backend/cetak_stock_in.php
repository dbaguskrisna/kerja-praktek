<?php
require 'function.php';
$data = query("SELECT barang_masuk.id_barang_masuk ,pembayaran_supplier.nomor_nota, barang_masuk.tanggal, barang_masuk.truck, barang_masuk.coly, barang_masuk.gross, barang_masuk.netto, barang_masuk.nama, barang_masuk.jenis_barang, barang_masuk.grade, barang_masuk.asal, kontainer.nama_kontainer FROM barang_masuk INNER JOIN pembayaran_supplier ON barang_masuk.id_pembayaran_supplier = pembayaran_supplier.id_pembayaran INNER JOIN kontainer ON barang_masuk.id_kontainer = kontainer.id_kontainer;");
//Koneksi dan Menentukan Database Di Server
$conn = mysqli_connect("localhost", "root", "", "coba");
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}
?>

<script type="text/javascript">
     window.print()
</script>

<style type="text/css">
     #print {
          margin: auto;
          text-align: center;
          font-family: "Calibri", Courier, monospace;
          width: 1200px;
          font-size: 14px;
     }

     #print .title {
          margin: 20px;
          text-align: right;
          font-family: "Calibri", Courier, monospace;
          font-size: 12px;
     }

     #print span {
          text-align: center;
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
          font-size: 18px;
     }

     #print table {
          border-collapse: collapse;
          width: 100%;
          margin: 10px;
     }

     #print .table1 {
          border-collapse: collapse;
          width: 90%;
          text-align: center;
          margin: 10px;
     }

     #print table hr {
          border: 3px double #000;
     }

     #print .ttd {
          float: right;
          width: 250px;
          background-position: center;
          background-size: contain;
     }

     #print table th {
          color: #000;
          font-family: Verdana, Geneva, sans-serif;
          font-size: 12px;
     }

     #logo {
          width: 111px;
          height: 90px;
          padding-top: 10px;
          margin-left: 10px;
     }

     h2,
     h3 {
          margin: 0px 0px 0px 0px;
     }
</style>

<div id="print">
     <table class='table1'>
          <tr>
               <td><img src='logo.png' height="100" width="100"></td>
               <td>
                    <h1>Laporan Barang Masuk </h1>
                   
                    <h2>PT.Alvian Putra Jaya</h2>
                    <p style="font-size:14px;"><i> Jl. Perak Timur No. 266, Kelurahan Perak Timur,Kecamatan Pabean Cantikan, Kota Surabaya 60164, Jawa Timur</i></p>
               </td>
          </tr>
     </table>

     <table class='table'>
          <td>
               <hr />
          </td>

     </table>
     <td>
          <h3>LAPORAN DATA CONTOH</h3>
     </td>
     <tr>
          <td>
               <table border='1' class='table' width="90%">
                    <tr>
                         <th>Nomor Nota</th>
                         <th>Tanggal</th>
                         <th>Truck</th>
                         <th>Coly</th>
                         <th>Gross</th>
                         <th>Netto</th>
                         <th>Nama Barang</th>
                         <th>Jenis Barang</th>
                         <th>Grade Barang</th>
                         <th>Asal Barang</th>
                         <th>Kontainer</th>
                    </tr>

                    <?php foreach ($data as $row) : ?>
                         <tr role="row" class="even">
                              <td>
                                   <?= $row["nomor_nota"] ?>
                              </td>
                              <td>
                                   <?= $row["tanggal"] ?>
                              </td>
                              <td>
                                   <?= $row["truck"] ?>
                              </td>
                              <td>
                                   <?= $row["coly"] ?>
                              </td>
                              <td>
                                   <?= $row["gross"] ?>
                              </td>
                              <td>
                                   <?= $row["netto"] ?>
                              </td>
                              <td>
                                   <?= $row["nama"] ?>
                              </td>
                              <td>
                                   <?= $row["jenis_barang"] ?>
                              </td>
                              <td>
                                   <?= $row["grade"] ?>
                              </td>
                              <td>
                                   <?= $row["asal"] ?>
                              </td>
                              <td>
                                   <?= $row["nama_kontainer"] ?>
                              </td>
                         </tr>
                    <?php endforeach; ?>
               </table>
     </tr>
     </table>
</div>
<div id="print">
     <table width="450" align="right" class="ttd">
          <tr>
               <td width="100px" style="padding:20px 20px 20px 20px;" align="center">
                    <strong>CEO</strong>
                    <br><br><br><br>
                    <strong><u>TTD</u><br></strong><small></small>
               </td>
          </tr>
     </table>
</div>