<?php
session_start();
require 'function.php';

$data = query("SELECT barang_keluar.id_barang_keluar,barang_keluar.tanggal,barang_keluar.contract_no,barang_keluar.consigne,barang_keluar.notify_party,barang_keluar.port_of_loading,barang_keluar.country_of_origin,barang_keluar.destination,barang_keluar.description,barang_keluar.packing,barang_keluar.freight,barang_keluar.gross_weight,barang_keluar.no_of_bags,barang_keluar.net_weight,master_barang.nama,master_barang.jenis_barang,master_barang.grade,kapal.nama_kapal,pembayaran_customer.nomor_nota,kontainer.nama_kontainer FROM barang_keluar INNER JOIN master_barang ON barang_keluar.id_barang = master_barang.id_barang INNER JOIN kapal ON barang_keluar.id_kapal = kapal.id_kapal INNER JOIN pembayaran_customer ON barang_keluar.id_pembayaran_customer = pembayaran_customer.id_pembayaran INNER JOIN kontainer ON barang_keluar.id_kontainer = kontainer.id_kontainer");

if (!isset($_SESSION["admin"])) {
  header("Location: ../login/index.php");
  exit;
}

if (isset($_POST["submit"])) {
  insertStockout($_POST);
} else if (isset($_POST["submitUpdate"])) {
  updateStockout($_POST);
} else if (isset($_POST["submitDelete"])) {
  deleteStockout($_POST);
}

?>

<!-- modal tambah data -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">tambah data stock out</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Tanggal : </label>
                <input type="date" class="form-control" name="tanggal" id="tanggal">
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Nomor Kontrak : </label>
                <input type="text" class="form-control" name="contract_no" id="contract_no">
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Consigne : </label>
                <input type="text" class="form-control" name="consigne" id="consigne">
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Notify Party : </label>
                <input type="text" class="form-control" name="notify_party" id="notify_party">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Port Of Loading : </label>
                <input type="text" class="form-control" name="port_of_loading" id="port_of_loading">
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Country Of Origin : </label>
                <input type="text" class="form-control" name="country_of_origin" id="country_of_origin">
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Destination : </label>
                <input type="text" class="form-control" name="destination" id="destination">
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Freight : </label>
                <input type="text" class="form-control" name="freight" id="freight">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Description : </label>
                <input type="text" class="form-control" name="description" id="description">
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Packing : </label>
                <input type="text" class="form-control" name="packing" id="packing">
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Nama Barang :</label>
                <?php
                $datas = query("SELECT * FROM master_barang");
                ?>
                <select name="nama_barang" class="form-control" id="nama_barang">
                  <?php foreach ($datas as $rows) : ?>
                    <option value="<?= $rows['id_barang'] ?>"><?= $rows['nama'] ?> Grade <?= $rows['grade'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Gross Of Weight : </label>
                <input type="text" class="form-control" name="grossWeight" id="grossWeight">
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">No Of Bags : </label>
                <input type="text" class="form-control" name="noOfBags" id="noOfBags">
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Net Weight : </label>
                <input type="text" class="form-control" name="netWeight" id="netWeight">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Nota Pembayaran Customer</label>
                <?php
                $datas = query("SELECT * FROM pembayaran_customer");
                ?>
                <select name="nota_pembayaran" class="form-control" id="nota_pembayaran">
                  <?php foreach ($datas as $rows) : ?>
                    <option value="<?= $rows['id_pembayaran'] ?>"><?= $rows['nomor_nota'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">kapal</label>
                <?php
                $datas = query("SELECT * FROM kapal");
                ?>
                <select name="kapal" class="form-control" id="kapal">
                  <?php foreach ($datas as $rows) : ?>
                    <option value="<?= $rows['id_kapal'] ?>"><?= $rows['nama_kapal'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Kontainer</label>
                <?php
                $datas = query("SELECT * FROM kontainer");
                ?>
                <select name="kontainer" class="form-control" id="kontainer">
                  <?php foreach ($datas as $rows) : ?>
                    <option value="<?= $rows['id_kontainer'] ?>"><?= $rows['nama_kontainer'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" id="submit" name="submit" class="btn btn-primary">Tambahkan Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->

      <!-- SEARCH FORM -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
       
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link" role="button" href="logout.php">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PT.Alfian Putra Jaya</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              <?php 
                echo $_SESSION['user'];
              ?>
            </a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="admin.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="employee_data.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  User Data
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="stock_in_admin.php" class="nav-link">
                <i class="nav-icon fas fa-sign-in-alt"></i>
                <p>
                  Stock Going In
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="stock_out_admin.php" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Stock Going Out
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="master_barang_admin.php" class="nav-link">
                <i class="nav-icon fas fa-folder"></i>
                <p>
                  Master Barang
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="supplier_data_admin.php" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Supplier Data
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Layout Options
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="customer_payment_admin.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Customer Payments</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="supplier_payment_admin.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Supplier Payments</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="customer_data_admin.php" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Customer Data
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="ship_data_admin.php" class="nav-link">
                <i class="nav-icon fas fa-ship"></i>
                <p>
                  Ship Data
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="kontainer_data_admin.php" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Container Data
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Stock out</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="admin.php">Home</a></li>

                <li class="breadcrumb-item active"></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <section class="content">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-sm">
                  <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target=".bd-example-modal-lg">+ Tambah</button>
                </div>
                <div class="col-sm d-flex justify-content-end">
                  <a href="cetak_stock_out.php">
                    <button type="button" class="btn btn-success mb-2 ">Cetak Laporan</button>
                  </a>
                </div>
              </div>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">

                  <div class="input-group-append">

                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr role="row">
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
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <form method="POST">
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
                        <td>
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target='.bd-example-modal-lg-edit<?= $row["id_barang_keluar"] ?>'>Edit</button>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $row["id_barang_keluar"] ?>">
                            Delete
                          </button>
                        </td>
                      </tr>

                      <div class="modal fade bd-example-modal-lg-edit<?= $row["id_barang_keluar"] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">tambah data stock out</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form method="POST">
                              <div class="modal-body">
                                <div class="card-body">
                                  <?php
                                  $id = $row["id_barang_keluar"];
                                  $dataEdit = query("SELECT barang_keluar.id_barang_keluar,barang_keluar.tanggal,barang_keluar.contract_no,barang_keluar.consigne,barang_keluar.notify_party,barang_keluar.port_of_loading,barang_keluar.country_of_origin,barang_keluar.destination,barang_keluar.description,barang_keluar.packing,barang_keluar.freight,barang_keluar.gross_weight,barang_keluar.no_of_bags,barang_keluar.net_weight,master_barang.nama,master_barang.jenis_barang,master_barang.grade,kapal.nama_kapal,pembayaran_customer.nomor_nota,kontainer.nama_kontainer FROM barang_keluar INNER JOIN master_barang ON barang_keluar.id_barang = master_barang.id_barang INNER JOIN kapal ON barang_keluar.id_kapal = kapal.id_kapal INNER JOIN pembayaran_customer ON barang_keluar.id_pembayaran_customer = pembayaran_customer.id_pembayaran INNER JOIN kontainer ON barang_keluar.id_kontainer = kontainer.id_kontainer WHERE barang_keluar.id_barang_keluar = $id");
                                  ?>
                                  <?php foreach ($dataEdit as $rowEdit) : ?>
                                    <div class="form-row">
                                      <div class="form-group col-md-3" hidden>
                                        <label for="exampleInputEmail1">Nomor Kontrak : </label>
                                        <input type="text" class="form-control" name="idUpdate" id="idUpdate" value="<?= $rowEdit['id_barang_keluar'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Tanggal : </label>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $rowEdit['tanggal'] ?>">
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Nomor Kontrak : </label>
                                        <input type="text" class="form-control" name="contract_no" id="contract_no" value="<?= $rowEdit['contract_no'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Consigne : </label>
                                        <input type="text" class="form-control" name="consigne" id="consigne" value="<?= $rowEdit['consigne'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Notify Party : </label>
                                        <input type="text" class="form-control" name="notify_party" id="notify_party" value="<?= $rowEdit['notify_party'] ?>" required>
                                      </div>
                                    </div>
                                    <div class="form-row">
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Port Of Loading : </label>
                                        <input type="text" class="form-control" name="port_of_loading" id="port_of_loading" value="<?= $rowEdit['port_of_loading'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Country Of Origin : </label>
                                        <input type="text" class="form-control" name="country_of_origin" id="country_of_origin" value="<?= $rowEdit['country_of_origin'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Destination : </label>
                                        <input type="text" class="form-control" name="destination" id="destination" value="<?= $rowEdit['destination'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Freight : </label>
                                        <input type="text" class="form-control" name="freight" id="freight" value="<?= $rowEdit['freight'] ?>" required>
                                      </div>
                                    </div>
                                    <div class="form-row">
                                      <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Description : </label>
                                        <input type="text" class="form-control" name="description" id="description" value="<?= $rowEdit['description'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Packing : </label>
                                        <input type="text" class="form-control" name="packing" id="packing" value="<?= $rowEdit['packing'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Nama Barang :</label>
                                        <?php
                                        $datas = query("SELECT * FROM master_barang");
                                        ?>
                                        <select name="nama_barang" class="form-control" id="nama_barang">
                                          <?php foreach ($datas as $rows) : ?>
                                            <option value="<?= $rows['id_barang'] ?>"><?= $rows['nama'] ?> Grade <?= $rows['grade'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-row">
                                      <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Gross Of Weight : </label>
                                        <input type="text" class="form-control" name="grossWeight" id="grossWeight" value="<?= $rowEdit['gross_weight'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">No Of Bags : </label>
                                        <input type="text" class="form-control" name="noOfBags" id="noOfBags" value="<?= $rowEdit['no_of_bags'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Net Weight : </label>
                                        <input type="text" class="form-control" name="netWeight" id="netWeight" value="<?= $rowEdit['net_weight'] ?>" required>
                                      </div>
                                      <div class="form-group col-md-4" hidden>
                                        <label for="exampleInputEmail1">Net Weight : </label>
                                        <input type="text" class="form-control" name="netWeight2" id="netWeight2">
                                      </div>

                                    </div>
                                    <div class="form-row">
                                      <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Nota Pembayaran Customer</label>
                                        <?php
                                        $datas = query("SELECT * FROM pembayaran_customer");
                                        ?>
                                        <select name="nota_pembayaran" class="form-control" id="nota_pembayaran">
                                          <?php foreach ($datas as $rows) : ?>
                                            <option value="<?= $rows['id_pembayaran'] ?>"><?= $rows['nomor_nota'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">kapal</label>
                                        <?php
                                        $datas = query("SELECT * FROM kapal");
                                        ?>
                                        <select name="kapal" class="form-control" id="kapal">
                                          <?php foreach ($datas as $rows) : ?>
                                            <option value="<?= $rows['id_kapal'] ?>"><?= $rows['nama_kapal'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Kontainer</label>
                                        <?php
                                        $datas = query("SELECT * FROM kontainer");
                                        ?>
                                        <select name="kontainer" class="form-control" id="kontainer">
                                          <?php foreach ($datas as $rows) : ?>
                                            <option value="<?= $rows['id_kontainer'] ?>"><?= $rows['nama_kontainer'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                              <?php endforeach; ?>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                <button type="submit" id="submitUpdate" name="submitUpdate" class="btn btn-primary">Update Data</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="exampleModal<?= $row['id_barang_keluar'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form method="POST">
                              <div class="modal-body">
                                <?php
                                $id = $row['id_barang_keluar'];
                                $datass = query("SELECT * FROM barang_keluar where id_barang_keluar = $id");
                                ?>
                                <?php foreach ($datass as $rowss) : ?>
                                  <div class="card-body">
                                    <div class="form-group">
                                      <div class="form-group" hidden>
                                        <label for="exampleInputEmail1">ID: </label>
                                        <input type="text" class="form-control" id="idDelete" name="idDelete" value="<?= $rowss['id_barang_keluar'] ?>" readonly="true" required>
                                      </div>
                                      <div class="form-group">
                                        <p class="text-center">
                                          Apakah anda yakin ingin menghapus data ini ?
                                        </p>
                                      </div>
                                    </div>
                                  <?php endforeach; ?>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    <button type="submit" id="sumbitDelete" name="submitDelete" class="btn btn-primary">Hapus</button>
                                  </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- modal edit -->
                    <?php endforeach; ?>
                  </form>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </section>
      <!-- Main content -->
      <section class="content">

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0-rc
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>