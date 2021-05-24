<?php require('../model/AdminUser.php'); ?>
<style>
  .dropdown-menu {
    min-width: 150px;
    text-align: center;
  }

  aside {
    position: fixed !important;
  }
</style>
<nav class="main-header navbar navbar-expand navbar-dark bg-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index.php" class="nav-link">Beranda</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <!-- <li class="nav-item dropdown d-none d-sm-inline-block user-panel ">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        <span class="brand-text font-weight-light dropdown-toggle">Alexander Pierce</span>
      </a>
    </li> -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#" style="margin-top: -8px;">
        <div class="d-sm-inline-block user-panel">
          <img src="../dist/img/admin/<?php echo $admin['admin_img'] ?>" class="img-circle elevation-2" alt="User Image">
          <span class="brand-text font-weight-light dropdown-toggle"><?php echo $admin['admin_name'] ?></span>
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 100px;">
        <a href="profile.php" class="dropdown-item">
          <p>Profil</p>
        </a>
        <a href="../login_admin/logout_admin.php" class="dropdown-item" id="exit">
          <p>Keluar</p>
        </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../monkers" class="brand-link">
    <img src="../dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Monkers Apparel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="pesanan.php" class="nav-link active" id="pesanan">
            <p>
              Pesanan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="stok.php" class="nav-link" id="stok">
            <p>
              Stok
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="laporan.php" class="nav-link" id="laporan">
            <p>
              Laporan
            </p>
          </a>
        </li>
        <?php if ($_SESSION['role_id'] == 1 or $_SESSION['role_id'] == 2) { ?>
          <li class="nav-item">
            <a href="customer.php" class="nav-link" id="data_customer">
              <p>
                Data Pelanggan
              </p>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a href="ongkir.php" class="nav-link" id="data_ongkir">
            <p>
              Data Ongkir
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="banner.php" class="nav-link" id="data_banner">
            <p>
              Banner Halaman Utama
            </p>
          </a>
        </li>
        <?php if ($_SESSION['role_id'] == 1) { ?>
          <li class="nav-item">
            <a href="data_admin.php" class="nav-link" id="data_admin">
              <p>
                Data Admin
              </p>
            </a>
          </li>
        <?php } ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<script>
  $(document).ready(function() {
    var active = $('.breadcrumb').attr('id');

    $(".nav-link").removeClass("active");

    // $(".nav-link").attr('id', active).addClass('active');
    var a = $(".nav-link#" + active).addClass('active');
  });
</script>