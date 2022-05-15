<?php
session_start();
require 'function.php';

$data = query("SELECT * FROM pembayaran_customer INNER JOIN customer ON pembayaran_customer.customer_id = customer.id_customer");

if (!isset($_SESSION["staffKantor"])) {
  header("Location: ../login/index.php");
  exit;
}

if (isset($_POST["submit"])) {
  insertCustomerPayment($_POST);
} else if (isset($_POST["submitUpdate"])) {
  updateCustomerPayment($_POST);
} else if (isset($_POST["submitDelete"])) {
  deleteCustomerPayment($_POST);
}

?>

<!-- Ini nanti di edit dan disesuaikan bisa lihat contoh supplier payment admin -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Customer Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputPassword4">Jumlah Pembayaran: </label>
                <input type="text" class="form-control" id="jumlahPembayaran" name="jumlahPembayaran" placeholder="Masukkan Nomor Jumlah Pembayaran" required>
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">Total Barang: </label>
                <input type="text" class="form-control" id="totalBarang" name="totalBarang" placeholder="Masukkan Total Barang" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="inputEmail4">Bank</label>
                <input type="text" class="form-control" id="bank" name="bank" required>
              </div>
              <div class="form-group col-md-3">
                <label for="jabatan">Status Pembayaran : </label>
                <select class="form-control" name="statusPembayaran" id="statusPembayaran">
                  <option value="Lunas">Lunas</option>
                  <option value="Bayar di Muka">Bayar di Muka</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="jabatan">Customer : </label>
                <select class="form-control" name="customer" id="customer">
                  <?php $dataCustomer = query("SELECT * FROM customer"); ?>
                  <?php foreach ($dataCustomer as $rowCustomer) : ?>
                    <option value="<?= $rowCustomer['id_customer'] ?>"><?= $rowCustomer['nama'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="jabatan">Nomor Nota : </label>
                <select class="form-control" name="nomorNota" id="nomorNota">
                  <?php $dataCustomer = query("SELECT * FROM pembayaran_customer"); ?>
                  <?php foreach ($dataCustomer as $rowCustomer) : ?>
                    <option value="<?= $rowCustomer['id_pembayaran'] ?>"><?= $rowCustomer['nomor_nota'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputPassword4">Nama Barang</label>
                <input type="text" class="form-control" id="namaBarang" name="namaBarang" placeholder="Masukkan Nomor Nota" required>
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Jenis Barang</label>
                <input type="text" class="form-control" id="jenisBarang" name="jenisBarang" placeholder="Masukkan Jenis Barang" required>
              </div>
              <div class="form-group col-md-4">
                <label for="jabatan">Grade Barang : </label>
                <select class="form-control" name="grade" id="grade">
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
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
              <a href="staff_kantor.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="supplier_data_kantor.php" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
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
                  <a href="customer_payment_kantor.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Customer Payments</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="supplier_payment_kantor.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Supplier Payments</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="supplier_payment_kantor.php" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Customer Data
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="ship_data_kantor.php" class="nav-link">
                <i class="nav-icon fas fa-ship"></i>
                <p>
                  Ship Data
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="kontainer_data_kantor.php" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Kontainer Data
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
              <h1 class="m-0">Customer Payment Admin</h1>
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

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="col-md-2">
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target=".bd-example-modal-lg">+ Tambah</button>
                  </div>
                  <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                      <div class="col-sm-12 col-md-6"></div>
                      <div class="col-sm-12 col-md-6"></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                          <thead>
                            <tr role="row">
                              <th>Nomer Nota</th>
                              <th>Tanggal</th>
                              <th>Jumlah Pembayaran</th>
                              <th>Total Barang</th>
                              <th>Bank</th>
                              <th>Status Pembayaran</th>
                              <th>Customer</th>
                              <th>Nama Barang</th>
                              <th>Jenis Barang</th>
                              <th>Grade</th>
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
                                    <?= $row["jumlah_pembayaran"] ?>
                                  </td>
                                  <td>
                                    <?= $row["total_barang"] ?>
                                  </td>
                                  <td>
                                    <?= $row["bank"] ?>
                                  </td>
                                  <td>
                                    <?= $row["status_pembayaran"] ?>
                                  </td>
                                  <td>
                                    <?= $row["nama"] ?>
                                  </td>
                                  <td>
                                    <?= $row["nama_barang"] ?>
                                  </td>
                                  <td>
                                    <?= $row["jenis_barang"] ?>
                                  </td>
                                  <td>
                                    <?= $row["grade"] ?>
                                  </td>
                                  <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target='.bd-example-modal-lg-edit<?= $row["id_pembayaran"] ?>'>Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong<?= $row['id_pembayaran'] ?>">
                                      Delete
                                    </button>
                                  </td>
                                </tr>
                                <!-- Ini nanti di edit dan disesuaikan bisa lihat contoh supplier payment admin -->
                                <div class="modal fade" id="exampleModalLong<?= $row['id_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                          $id = $row['id_pembayaran'];
                                          $datas = query("SELECT * FROM pembayaran_customer where id_pembayaran = $id");
                                          ?>
                                          <?php foreach ($datas as $rows) : ?>
                                            <div class="card-body">
                                              <div class="form-group">
                                                <div class="form-group" hidden>
                                                  <label for="exampleInputEmail1">ID: </label>
                                                  <input type="text" class="form-control" id="idDelete" name="idDelete" value="<?= $rows['id_pembayaran'] ?>" readonly="true" required>
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
                                <!-- Ini nanti di edit dan disesuaikan bisa lihat contoh supplier payment admin -->
                                <div class="modal fade bd-example-modal-lg-edit<?= $row['id_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form method="POST">
                                        <div class="modal-body">
                                          <?php
                                          $id = $row['id_pembayaran'];
                                          $datas = query("SELECT * FROM pembayaran_customer where id_pembayaran = $id");
                                          ?>
                                          <?php foreach ($datas as $rows) : ?>
                                            <div class="form-row">
                                              <div class="form-group col-md-4">
                                                <label for="inputEmail4">Tanggal</label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $rows['tanggal'] ?>" required>
                                              </div>
                                              <div class="form-group col-md-4" hidden>
                                                <label for="inputPassword4">idPembayaran</label>
                                                <input type="text" class="form-control" id="idPembayaran" name="idPembayaran" value="<?= $rows['id_pembayaran'] ?>" placeholder="Masukkan Nomor Nota" required>
                                              </div>
                                              <div class="form-group col-md-4">
                                                <label for="inputPassword4">Jumlah Pembayaran: </label>
                                                <input type="text" class="form-control" id="jumlahPembayaran" name="jumlahPembayaran" value="<?= $rows['jumlah_pembayaran'] ?>" placeholder="Masukkan Nomor Jumlah Pembayaran" required>
                                              </div>
                                              <div class="form-group col-md-4">
                                                <label for="inputPassword4">Total Barang: </label>
                                                <input type="text" class="form-control" id="totalBarang" name="totalBarang" value="<?= $rows['total_barang'] ?>" placeholder="Masukkan Total Barang" required>
                                              </div>
                                            </div>
                                            <div class="form-row">
                                              <div class="form-group col-md-3">
                                                <label for="inputEmail4">Bank</label>
                                                <input type="text" class="form-control" id="bank" name="bank" value="<?= $rows['bank'] ?>" placeholder="Masukkan Bank" required>
                                              </div>
                                              <div class="form-group col-md-3">
                                                <label for="status_pembayaran">Status Pembayaran : </label>
                                                <select class="form-control" name="statusPembayaran" id="statusPembayaran">
                                                  <option value="Lunas" <?= ($rows['status_pembayaran'] == 'Lunas') ? 'selected="selected"' : '' ?>>Lunas</option>
                                                  <option value="Bayar di Muka" <?= ($rows['status_pembayaran'] == 'Bayar di Muka') ? 'selected="selected"' : '' ?>>Bayar di Awal</option>
                                                </select>
                                              </div>
                                              <div class="form-group col-md-3">
                                                <label for="jabatan">Customer : </label>
                                                <select class="form-control" name="customer" id="customer">
                                                  <?php $dataCustomer = query("SELECT * FROM customer"); ?>
                                                  <?php foreach ($dataCustomer as $rowCustomer) : ?>
                                                    <option value="<?= $rowCustomer['id_customer'] ?>"><?= $rowCustomer['nama'] ?></option>
                                                  <?php endforeach; ?>
                                                </select>
                                              </div>
                                              <div class="form-group col-md-3">
                                                <label for="inputPassword4">Nomor Nota</label>
                                                <input type="text" class="form-control" name="nomorNota" id="nomorNota" value="<?= $rows['nomor_nota'] ?>" placeholder="Masukkan Nomor Nota" required>
                                              </div>
                                            </div>
                                            <div class="form-row">
                                              <div class="form-group col-md-4">
                                                <label for="inputPassword4">Nama Barang</label>
                                                <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="<?= $rows['nama_barang'] ?>" placeholder="Masukkan Nomor Nota" required>
                                              </div>
                                              <div class="form-group col-md-4">
                                                <label for="inputEmail4">Jenis Barang</label>
                                                <input type="text" class="form-control" id="jenisBarang" name="jenisBarang" value="<?= $rows['jenis_barang'] ?>" placeholder="Masukkan Jenis Barang" required>
                                              </div>
                                              <div class="form-group col-md-4">
                                                <label for="status_pembayaran">Grade : </label>
                                                <select class="form-control" name="grade" id="grade">
                                                  <option value="A" <?= ($rows['grade'] == 'A') ? 'selected="selected"' : '' ?>>A</option>
                                                  <option value="B" <?= ($rows['grade'] == 'B') ? 'selected="selected"' : '' ?>>B</option>
                                                  <option value="C" <?= ($rows['grade'] == 'C') ? 'selected="selected"' : '' ?>>C</option>
                                                  <option value="D" <?= ($rows['grade'] == 'D') ? 'selected="selected"' : '' ?>>D</option>
                                                </select>
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