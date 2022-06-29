<?php
session_start();
require 'function.php';

$data = query("SELECT barang_masuk.id_barang_masuk ,pembayaran_supplier.nomor_nota, barang_masuk.tanggal, barang_masuk.truck, barang_masuk.coly, barang_masuk.gross, barang_masuk.netto, barang_masuk.nama, barang_masuk.jenis_barang, barang_masuk.grade, barang_masuk.asal, kontainer.nama_kontainer FROM barang_masuk INNER JOIN pembayaran_supplier ON barang_masuk.id_pembayaran_supplier = pembayaran_supplier.id_pembayaran INNER JOIN kontainer ON barang_masuk.id_kontainer = kontainer.id_kontainer;");

if (!isset($_SESSION["admin"])) {
  header("Location: ../login/index.php");
  exit;
}

if (isset($_POST["submit"])) {
  insertStockin($_POST);
} else if (isset($_POST["submitUpdate"])) {
  updateStockin($_POST);
} else if (isset($_POST["submitDelete"])) {
  deleteStockin($_POST);
} else if (isset($_POST['submitDownGrade'])) {
  downGrade($_POST);
}

?>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Stock In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Pilih Nomor Nota</label>
                <?php
                $datas = query("SELECT * FROM pembayaran_supplier WHERE pembayaran_supplier.status_nota = 0");
                ?>
                <select name="noNota" class="form-control" id="noNota">
                  <?php foreach ($datas as $rows) : ?>
                    <option value="<?= $rows['id_pembayaran'] ?>"><?= $rows['nomor_nota'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Tanggal : </label>
                <input type="date" class="form-control" name="tanggal" id="tanggal" required>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Nomor Truck : </label>
                <input type="text" class="form-control" name="truck" id="truck" placeholder="masukkan nomor truck" required>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Container</label>
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cetak Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="jabatan">Silahkan Pilih Bulan : </label>
                <select class="form-control" name="season" id="season">
                <option value="1">Januari</option>
                      <option value="2">Febuari</option>
                      <option value="3">Maret</option>
                      <option value="4">April</option>
                      <option value="5">Mei</option>
                      <option value="6">Juni</option>
                      <option value="7">Juli</option>
                      <option value="8">Agustus</option>
                      <option value="9">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <a href="cetak_stock_in.php">
            <button type="button" class="btn btn-success mb-2 ">Cetak Laporan</button>
          </a>
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
              <a href="return_admin.php" class="nav-link">
                <i class="nav-icon fas fa-undo"></i>
                <p>
                  Return Barang
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
                  Payments
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
              <h1 class="m-0">Stock In</h1>
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
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target=".bd-example-modal-lg">+ Tambah</button>
                    </div>
                    <div class="col-sm d-flex justify-content-end">
                      <a href="cetak_stock_in.php">
                        <button type="button" class="btn btn-success mb-2 ">Cetak Laporan</button>
                      </a>
                    </div>
                  </div>
                  <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                      <div class="col-sm-12 col-md-6"></div>
                      <div class="col-sm-12 col-md-6"></div>
                    </div>
                    <div class="row">
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                          <thead>
                            <tr role="row">
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
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <form method="POST">
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
                                    <?= $row["coly"] ?> kg
                                  </td>
                                  <td>
                                    <?= $row["gross"] ?> kg
                                  </td>
                                  <td>
                                    <?= $row["netto"] ?> kg
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
                                  <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target='.bd-example-modal-lg-edit<?= $row["id_barang_masuk"] ?>'>Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong<?= $row['id_barang_masuk'] ?>">
                                      Delete
                                    </button>
                                  
                                  </td>
                                </tr>

                                <div class="modal fade" id="exampleModalLong<?= $row['id_barang_masuk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                          $id = $row['id_barang_masuk'];
                                          $datas = query("SELECT * FROM barang_masuk where id_barang_masuk = $id");
                                          ?>
                                          <?php foreach ($datas as $rows) : ?>
                                            <div class="card-body">
                                              <div class="form-group">
                                                <div class="form-group" hidden>
                                                  <label for="exampleInputEmail1">ID: </label>
                                                  <input type="text" class="form-control" id="idDelete" name="idDelete" value="<?= $rows['id_barang_masuk'] ?>" readonly="true" required>
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

                                <div class="modal fade bd-example-modal-lg-edit<?= $row["id_barang_masuk"] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Stock In</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form method="POST">
                                        <div class="modal-body">
                                          <?php
                                          $id = $row['id_barang_masuk'];
                                          $dataEdit = query("SELECT barang_masuk.truck,barang_masuk.id_kontainer,barang_masuk.id_barang_masuk,pembayaran_supplier.nomor_nota FROM barang_masuk INNER JOIN pembayaran_supplier ON barang_masuk.id_pembayaran_supplier = pembayaran_supplier.id_pembayaran where id_barang_masuk =  $id");
                                          ?>
                                          <?php foreach ($dataEdit as $rowEdit) : ?>
                                            <div class="card-body">
                                              <div class="form-row">
                                                <div class="form-group col-md-3" hidden>
                                                  <label for="exampleInputEmail1">Truck : </label>
                                                  <input type="text" class="form-control" name="idUpdate" id="idUpdate" value="<?= $rowEdit['id_barang_masuk'] ?>" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                  <label for="exampleInputEmail1">Nomor Nota : </label>
                                                  <input type="text" class="form-control" name="truck" id="truck" value="<?= $rowEdit['nomor_nota'] ?>" readonly>
                                                </div>
                                                <div class="form-group col-md-4">
                                                  <label for="exampleInputEmail1">Truck : </label>
                                                  <input type="text" class="form-control" name="truck" id="truck" value="<?= $rowEdit['truck'] ?>" required>
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

                              <?php endforeach; ?>
                            </form>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
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