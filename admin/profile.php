<?php require('../model/AdminUser.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
</head>

<?php
//login confirmation
confirm_logged_in();
?>
<style>
    .image {
        max-height: 200px;
        max-width: 200px;
        text-align: center;
    }

    .table {
        table-layout: fixed;
        line-height: 10px;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Right navbar -->
        <div class="" id="include-navbar"></div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Profile</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" id="profile">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-8 ml-auto mr-auto">
                            <div class="card profile" style="text-align: center;">
                                <div class="image ml-auto mr-auto" style="margin-top: 10px;">
                                    <img src="../dist/img/admin/<?php echo $admin['admin_img'] ?>" class="card-img-top img-circle elevation-2">
                                </div>
                                <div class="card-body">
                                    <h5><?php echo $admin['admin_name'] ?></h5>
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: right;">Username : </td>
                                                <td style="text-align: left;"><?php echo $admin['username_adm'] ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Tanggal Lahir : </td>
                                                <td style="text-align: left;"><?php echo $admin['admin_birth'] ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">No Telepone : </td>
                                                <td style="text-align: left;"><?php echo $admin['admin_phone'] ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Status : </td>
                                                <td style="text-align: left;"><?php echo $admin['status'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-profile">
                                        Edit Profile
                                    </button>
                                    <div class="" id="include-modal"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- modal -->
    <div class="modal fade" id="modal-profile">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/AdminUser.php" method="post" enctype="multipart/form-data">
                        <input type='hidden' name='admin_id' value="<?php echo $admin['admin_id'] ?>">
                        <input type="file" name="img"> <span class="text-muted">jpg, png</span></td>
                        <br><br>

                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Nama Lengkap : </div>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="<?php echo $admin['admin_name'] ?>">
                            <div class="input-group-append">
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Username : </div>
                            <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $admin['username_adm'] ?>">
                            <div class="input-group-append">
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">No Telpone : </div>
                            <input type="text" class="form-control" placeholder="No.Tlp" name="phone" value="<?php echo $admin['admin_phone'] ?>">
                            <div class="input-group-append">
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Password Lama: </div>
                            <input type="password" class="form-control" placeholder="Password Lama" name="pass">
                            <div class="input-group-append">
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Password Baru: </div>
                            <input type="password" class="form-control" placeholder="Password Baru" name="pass_new">
                            <div class="input-group-append">
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Konfirmasi Password: </div>
                            <input type="password" class="form-control" placeholder="Ulangi Password Baru" name="pass_confrim">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="edit_profile" value="Save Changes">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    $(function() {
        $("#include-navbar").load("left-navbar.php");
    });
</script>

</html>