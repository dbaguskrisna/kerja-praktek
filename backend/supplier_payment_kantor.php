<?php
session_start();
require 'function.php';

$data = query("SELECT *
FROM pembayaran_supplier
INNER JOIN supplier ON supplier_id_supplier = id_supplier");

if (!isset($_SESSION["staffKantor"])) {
  header("Location: ../login/index.php");
  exit;
}

if (isset($_POST["submitPembayaran"])) {
  insertSupplierPayment($_POST);
} else if (isset($_POST["submitUpdate"])){
  updateSupplierPayment($_POST);
} else if (isset($_POST["submitDelete"])){
  deleteSupplierPayment($_POST);
}
  

?>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <label>Tanggal: </label>
              <input type="datetime-local" id="tanggal" name="tanggal">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Supplier</label>
              <?php
              $datas = query("SELECT * FROM supplier");
              ?>
              <select class="form-control" name="supplier" id="supplier">
                <?php foreach ($datas as $rows) : ?>
                  <option value="<?= $rows['id_supplier'] ?>"><?= $rows['nama_supplier'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jumlah Transfer</label>
              <input type="text" class="form-control" name="jumlahTransfer" id="jumlahTransfer" placeholder="">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Bank</label>
              <input type="text" class="form-control" id="bank" name="bank" placeholder="masukkan Nomor Telefon">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Total Barang</label>
              <input type="text" class="form-control" id="totalBarang" name="totalBarang" placeholder="masukkan Nomor Rekening">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Grade Barang</label>
              <input type="text" class="form-control" id="gradeBarang" name="gradeBarang" placeholder="masukkan Nomor Telefon">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Status Pembayaran</label>
              <input type="text" class="form-control" id="statusPembayaran" name="statusPembayaran" placeholder="masukkan Nomor Rekening">
            </div>
          </div>
          <!-- /.card-body -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" id='submitPembayaran' name='submitPembayaran' class="btn btn-primary">Tambahkan Data</button>
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
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
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
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Staff Kantor</a>
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
              <a href="supplier_data.php" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Supplier Data
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="supplier_payment_kantor.php" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Supplier Payments
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="ship_data_gudang.php" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Ship Data
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
              <h1 class="m-0">Supplier Payment</h1>
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
                  <h3 class="card-title">DataTable with minimal features &amp; hover style</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah</button>
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
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Tanggal</th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending">Nama Supplier</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Bank</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Jumlah Pembayaran</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Total Barang</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Status Pembayaran</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <form method="POST">
                              <?php foreach ($data as $row) : ?>
                                <tr role="row" class="even">
                                  <td class="dtr-control sorting_1" tabindex="0"><?= $row["tanggal"] ?></td>
                                  <td><?= $row["nama_supplier"] ?></td>

                                  <td><?= $row["bank"] ?></td>
                                  <td><?= $row["jumlah_pembayaran"] ?></td>
                                  <td><?= $row["total_barang"] ?></td>
                                  <td><?= $row["status_pembayaran"] ?></td>
                                  <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg-edit<?= $row["id"] ?>">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $row["id"] ?>">
                                      Delete
                                    </button>
                                  </td>
                                </tr>

                                <div class="modal fade bd-example-modal-lg-edit<?= $row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <form method="POST">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Supplier</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="card-body">
                                          <?php
                                          $id = $row["id"];
                                          $datas = query("SELECT *
                                          FROM pembayaran_supplier
                                          INNER JOIN supplier ON supplier_id_supplier = id_supplier WHERE id = $id");
                                          ?>
                                          <?php foreach ($datas as $rows) : ?>
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Nama Supplier</label>
                                              <input type="text" class="form-control" name="id" id="id" value="<?= $rows['id'] ?>" readonly="true" hidden>
                                            </div>
                                            <div class="form-group">
                                              <label>Tanggal: </label>
                                              <input type="datetime-local" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d\TH:i:s', strtotime($row['tanggal'])); ?>">
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Nama Supplier</label>
                                              <input type="text" class="form-control" name="supplier" id="supplier" value="<?= $rows['nama_supplier'] ?>" readonly="true">
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Jumlah Transfer</label>
                                              <input type="text" class="form-control" name="jumlahTransfer" id="jumlahTransfer" value="<?= $rows['jumlah_pembayaran'] ?>">
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Bank</label>
                                              <input type="text" class="form-control" id="bank" name="bank" value="<?= $rows['bank'] ?>">
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Total Barang</label>
                                              <input type="text" class="form-control" id="totalBarang" name="totalBarang" value="<?= $rows['total_barang'] ?>">
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Grade Barang</label>
                                              <input type="text" class="form-control" id="gradeBarang" name="gradeBarang" value="<?= $rows['grade_barang'] ?>">
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Status Pembayaran</label>
                                              <input type="text" class="form-control" id="statusPembayaran" name="statusPembayaran" value="<?= $rows['status_pembayaran'] ?>">
                                            </div>
                                        </div>
                                      <?php endforeach; ?>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        <button type="submit" id='submitUpdate' name='submitUpdate' class="btn btn-primary">Update Pembayaran</button>
                                      </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal fade" id="exampleModal<?= $row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <form method="POST">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <p style="text-align:center">Apakah anda yakin ingin menghapus data ini ?</p>
                                        <div class="form-group">
                                          <input type="text" class="form-control" name="id" id="id" value="<?= $rows['id'] ?>" readonly="true" hidden>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" id="submitDelete" name="submitDelete" class="btn btn-primary">Hapus</button>
                                      </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              <?php endforeach ?>
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