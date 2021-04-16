<?php require('../model/AdminUser.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Data Admin</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
</head>
<style>
    #tambah_data {
        margin-left: 65%;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <div class="" id="include-navbar"></div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" id="data_admin">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Data Admin</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Admin Monkers Apparel</h3>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambahAdmin" id="tambah_data">
                                        Tambah Admin
                                    </button>
                                </div>
                                <!-- /.card-header -->
                                <div class=" card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Tanggal Lahir</th>
                                                <th>No Telepon</th>
                                                <th>Status</th>
                                                <th>Wewenang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            while ($data = mysqli_fetch_assoc($admin_data)) { ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $data['admin_name']; ?></td>
                                                    <td><?php echo $data['admin_birth']; ?></td>
                                                    <td><?php echo $data['admin_phone']; ?></td>
                                                    <td><?php echo $data['admin_status']; ?></td>
                                                    <td><?php echo $data['status']; ?></td>
                                                    <td>
                                                        <?php if ($data['role_id'] != 1) { ?>
                                                            <button type="button" class="btn btn-warning adminData" data-toggle="modal" data-target="#modal-adminData" id="<?php echo $data['admin_id']; ?>">
                                                                Ubah
                                                            </button>
                                                            <button type="button" class="btn btn-danger hapusData" data-toggle="modal" data-target="#modal-hapusData" id="<?php echo $data['admin_id']; ?>">
                                                                Hapus
                                                            </button>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.1.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- modal tambah data -->
    <div class="modal fade" id="modal-tambahAdmin">
        <div class="modal-dialog">
            <div class="modal-content col-8">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/AdminUser.php" method="post">
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Username : </div>
                            <input type="text" class="form-control" placeholder="Username" name="ins_usname">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Nama : </div>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="ins_nama">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Tgl Lahir : </div>
                            <input type="date" class="form-control" placeholder="Tgl Lahir" name="ins_lahir">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">No Telepon : </div>
                            <input type="text" class="form-control" placeholder="No. Telp" name="ins_hp">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Status : </div>
                            <select id="ins_status" name="ins_status">
                                <option value="active">Active</option>
                                <option value="in-active">In-Active</option>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Wewenang : </div>
                            <select id="ins_wewenang" name="ins_wewenang">
                                <option value="2">Manager</option>
                                <option value="3">Admin</option>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="insert_admin" value="Tambah Data">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal tambah data -->

    <!-- modal Edit Data -->
    <div class="modal fade" id="modal-adminData">
        <div class="modal-dialog">
            <div class="modal-content col-8">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/AdminUser.php" method="post">
                        <input type='hidden' name='id' value="" id="id">
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Nama : </div>
                            <input type="text" class="form-control" placeholder="Username" id="nama" value="" readonly>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Tgl Lahir : </div>
                            <input type="text" class="form-control" placeholder="Username" id="lahir" value="" readonly>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">No Telepon : </div>
                            <input type="text" class="form-control" placeholder="Username" id="hp" value="" readonly>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Status : </div>
                            <select id="status" name="status">
                                <option value="active">Active</option>
                                <option value="in-active">In-Active</option>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Wewenang : </div>
                            <select id="wewenang" name="wewenang">
                                <option value="2">Manager</option>
                                <option value="3">Admin</option>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="save_admin" value="Simpan Perubahan">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Edit data-->


    <!-- modal HAPUS Data -->
    <div class="modal fade" id="modal-hapusData">
        <div class="modal-dialog">
            <div class="modal-content col-8">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/AdminUser.php" method="post">
                        <input type='hidden' name='id_hapus' value="" id="id_hapus">
                        <p id="hapus"></p>
                        <input type="submit" class="btn btn-danger" name="delete_admin" value="Hapus Data">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal HAPUS data-->


    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "scrollX": true,
                "responsive": false,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "autoWidth": false,
                "buttons": [{
                    extend: "csv",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                        modifier: {
                            page: "current"
                        }
                    }
                }, {
                    extend: "pdf",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                        modifier: {
                            page: "current"
                        }
                    }
                }, "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $(function() {
            $("#include-navbar").load("left-navbar.php");
        });

        $(document).on("click", ".adminData", function() {
            var adminID = $(this).attr('id');
            $.ajax({
                url: "../model/AdminUser.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    get_admin: 1,
                    admin_id: adminID
                },
                success: function(data) {
                    $("#id").val(data.admin_id);
                    $("#nama").val(data.admin_name);
                    $("#lahir").val(data.admin_birth);
                    $("#hp").val(data.admin_phone);
                    $("select option").each(function() {
                        if ($(this).val() == data.admin_status) {
                            $(this).attr("selected", "selected");
                        }

                        if ($(this).val() == data.role_id) {
                            $(this).attr("selected", "selected");
                        }
                    });

                }
            });
        });


        $(document).on("click", ".hapusData", function() {
            var adminID = $(this).attr('id');
            $.ajax({
                url: "../model/AdminUser.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    get_admin: 1,
                    admin_id: adminID
                },
                success: function(data) {
                    $("#id_hapus").val(data.admin_id);
                    $("#hapus").text('Anda yakin menghapus ' + data.admin_name + ' ?');
                }
            });
        });
    </script>
</body>

</html>