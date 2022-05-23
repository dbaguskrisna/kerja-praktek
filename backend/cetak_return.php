<?php
require 'function.php';
$data = query("SELECT barang_keluar.id_barang_keluar,barang_keluar.tanggal,barang_keluar.contract_no,barang_keluar.consigne,barang_keluar.notify_party,barang_keluar.port_of_loading,barang_keluar.country_of_origin,barang_keluar.destination,barang_keluar.description,barang_keluar.packing,barang_keluar.freight,barang_keluar.gross_weight,barang_keluar.no_of_bags,barang_keluar.net_weight,master_barang.nama,master_barang.jenis_barang,master_barang.grade,kapal.nama_kapal,pembayaran_customer.nomor_nota,kontainer.nama_kontainer FROM barang_keluar INNER JOIN master_barang ON barang_keluar.id_barang = master_barang.id_barang INNER JOIN kapal ON barang_keluar.id_kapal = kapal.id_kapal INNER JOIN pembayaran_customer ON barang_keluar.id_pembayaran_customer = pembayaran_customer.id_pembayaran INNER JOIN kontainer ON barang_keluar.id_kontainer = kontainer.id_kontainer WHERE barang_keluar.status = 1");
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
                    <h1>Laporan Return Barang </h1>

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
                         <th>Tanggal</th>
                         <th>Nomor kontrak</th>
                         <th>Consigne</th>
                         <th>Notify Party</th>
                         <th>Port Of Loading</th>
                         <th>Country Of Origin</th>
                         <th>Destination</th>
                         <th>Description</th>
                         <th>Packing</th>
                         <th>Freight</th>
                         <th>Nama</th>
                         <th>Jenis Barang</th>
                         <th>Grade</th>
                         <th>Nama Kapal</th>
                         <th>Nomor Nota</th>
                         <th>Kontainer</th>
                         <th>Gross Weight</th>
                         <th>No Of Bags</th>
                         <th>Net Weight</th>
                    </tr>

                    <?php foreach ($data as $row) : ?>
                         <tr role="row" class="even">
                              <td>
                                   <?= $row["tanggal"] ?>
                              </td>
                              <td>
                                   <?= $row["contract_no"] ?>
                              </td>
                              <td>
                                   <?= $row["consigne"] ?>
                              </td>
                              <td>
                                   <?= $row["notify_party"] ?>
                              </td>
                              <td>
                                   <?= $row["port_of_loading"] ?>
                              </td>
                              <td>
                                   <?= $row["country_of_origin"] ?>
                              </td>
                              <td>
                                   <?= $row["destination"] ?>
                              </td>
                              <td>
                                   <?= $row["description"] ?>
                              </td>
                              <td>
                                   <?= $row["packing"] ?>
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
                                   <?= $row["freight"] ?>
                              </td>
                              <td>
                                   <?= $row["nama_kapal"] ?>
                              </td>
                              <td>
                                   <?= $row["nomor_nota"] ?>
                              </td>
                              <td>
                                   <?= $row["nama_kontainer"] ?>
                              </td>
                              <td>
                                   <?= $row["no_of_bags"] ?>
                              </td>
                              <td>
                                   <?= $row["gross_weight"] ?>
                              </td>
                              <td>
                                   <?= $row["net_weight"] ?>
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