<?php
require('../model/dataOngkir.php');
$area = [];
$prov = [];

while ($datas = mysqli_fetch_assoc($getArea)) {
    $area[] = $datas; //assign whole values to array
}

while ($datas = mysqli_fetch_assoc($getProv)) {
    $prov[] = $datas; //assign whole values to array
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Harga Ongkir</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<style>
    #tambahprov {
        margin-left: 48% !important;
    }

    .column {
        float: left;
        width: 25%;
        /* Should be removed. Only for demonstration */
    }

    .modal-content {
        width: 900px !important;
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
                            <h1>Harga Ongkir</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" id="data_ongkir">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item active">Harga Ongkir</li>
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
                                    <h3 class="card-title">Data Harga Ongkir</h3>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambahProvinsi" id="tambahprov">
                                        Tambah Provinsi
                                    </button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahArea" id="tambah_area">
                                        Tambah Kota
                                    </button>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambahOngkir" id="tambah_ongkir">
                                        Tambah Ongkir
                                    </button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kota</th>
                                                <th>Jenis Pengiriman</th>
                                                <th>Harga</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            while ($data = mysqli_fetch_assoc($getOngkir)) { ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $data['area_name']; ?></td>
                                                    <td><?php echo $data['ongkir_type']; ?></td>
                                                    <td><?php echo $data['ongkir_price']; ?></td>
                                                    <td><?php echo $data['status']; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning ubahOngkir" data-toggle="modal" data-target="#modal-ubahOngkir" id="<?php echo $data['ongkir_id']; ?>">
                                                            Ubah
                                                        </button>
                                                        <button type="button" class="btn btn-danger hapusOngkir" data-toggle="modal" data-target="#modal-hapusOngkir" id="<?php echo $data['ongkir_id']; ?>">
                                                            Hapus
                                                        </button>
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

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- modal Tambah Area -->
    <div class="modal fade" id="modal-tambahProvinsi">
        <div class="modal-dialog modal-lg">
            <div class="modal-content col-12">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Provinsi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <?php foreach ($prov as $data) {  ?>
                        <div class="column">
                            <form action="../model/dataOngkir.php" method="post">
                                <div class="input-group mb-3">
                                    <div class="col-7 input-group-text"><?php echo $data['prov_name']; ?></div>
                                    <input type='hidden' name='prov_id' value="<?php echo $data['prov_id']; ?>">
                                    <input type="submit" class="btn btn-danger" name="deleteProv" value="Hapus">
                                    <div class="input-group-append">
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                    <br>
                    <form action="../model/dataOngkir.php" method="post">
                        <div class="input-group mb-3">
                            <div class="col-2 input-group-text">Provinsi : </div>
                            <input type="text" class="form-control col-4" placeholder="Nama Provinsi" name="prov" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="add_prov" value="Tambah Provinsi">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Tambah Area-->

    <!-- modal Tambah Area -->
    <div class="modal fade" id="modal-tambahArea">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Area Ongkir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <?php foreach ($area as $data) {  ?>
                        <div class="column">
                            <form action="../model/dataOngkir.php" method="post">
                                <div class="input-group mb-3">
                                    <div class="col-7 input-group-text"><?php echo $data['area_name']; ?></div>
                                    <input type='hidden' name='kota_id' value="<?php echo $data['area_id']; ?>">
                                    <input type="submit" class="btn btn-danger" name="deleteKota" value="Hapus">
                                    <div class="input-group-append">
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                    <br>
                    <form action="../model/dataOngkir.php" method="post">
                        <div class="input-group mb-3">
                            <div class="col-2 input-group-text">Provinsi : </div>
                            <select id="provid" name="provid" class="col-4">
                                <?php foreach ($prov as $data) { ?>
                                    <option value=" <?php echo $data['prov_id']; ?> "><?php echo $data['prov_name']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-2 input-group-text">Nama Kota : </div>
                            <input type="text" class="form-control col-4" placeholder="Nama Area" name="Area" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="add_area" value="Tambah Area">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Tambah Area-->

    <!-- modal Tambah Ongkir -->
    <div class="modal fade" id="modal-tambahOngkir">
        <div class="modal-dialog">
            <div class="modal-content col-10">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Ongkir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/dataOngkir.php" method="post">
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Area : </div>
                            <select id="area_id" name="area_id">
                                <?php foreach ($area as $data) { ?>
                                    <option value=" <?php echo $data['area_id']; ?> "><?php echo $data['area_name']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Tipe pengiriman : </div>
                            <input type="text" class="form-control" placeholder="Tipe Pengiriman" name="tipe" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Harga ongkir : </div>
                            <input type="number" class="col-4 form-control" placeholder="Harga ongkir" name="harga" min="1" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Status : </div>
                            <select id="status" name="status">
                                <option value="active">active</option>
                                <option value="in-active">in-active</option>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info" name="add_ongkir" value="Tambah Ongkir">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Tambah Ongkir-->


    <!-- modal edit ongkir -->
    <div class="modal fade" id="modal-ubahOngkir">
        <div class="modal-dialog">
            <div class="modal-content col-12">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Ongkir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/dataOngkir.php" method="post">
                        <input type='hidden' name='edit_id' id='edit_id'>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Area : </div>
                            <select id="edit_area" name="edit_area">
                                <?php foreach ($area as $data) { ?>
                                    <option class="area" value=" <?php echo $data['area_id']; ?> "><?php echo $data['area_name']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Tipe pengiriman : </div>
                            <input type="text" class="form-control" placeholder="Tipe Pengiriman" name="edit_tipe" id="edit_tipe" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Harga ongkir : </div>
                            <input type="number" class="col-4 form-control" placeholder="Harga ongkir" name="edit_harga" id="edit_harga" min="1" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Status : </div>
                            <select id="edit_status" name="edit_status">
                                <option value="active">active</option>
                                <option value="in-active">in-active</option>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" name="edit_item" value="Ubah Data">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Edit data -->


    <!-- modal HAPUS Data -->
    <div class="modal fade" id="modal-hapusOngkir">
        <div class="modal-dialog">
            <div class="modal-content col-8">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Ongkir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/dataOngkir.php" method="post">
                        <input type='hidden' name='id_hapus' value="" id="id_hapus">
                        <p id="hapus"></p>
                        <input type="submit" class="btn btn-danger" name="delete_ongkir" value="Hapus Ongkir">
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
                "responsive": true,
                "autoWidth": false,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "scrollX": true,
                "buttons": [{
                    extend: "csv",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4],
                        modifier: {
                            page: "current"
                        }
                    }
                }, {
                    extend: "pdf",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4],
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


        // Tambah Kota
        $(document).on("click", ".tambahArea", function() {
            var ongkirID = $(this).attr('id');
            $.ajax({
                url: "../model/dataOngkir.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    get_ongkir: 1,
                    ongkir_id: ongkirID
                },
                success: function(data) {
                    $("#id_hapus").val(data.ongkir_id);
                    $("#hapus").text('Anda yakin menghapus ongkir area ' + data.area_name + ' dengan tipe pengiriman ' + data.ongkir_type + ' ?');
                }
            });
        });

        //isi data edit ongkir
        $(document).on("click", ".ubahOngkir", function() {
            var ongkirId = $(this).attr('id');

            $.ajax({
                url: "../model/dataOngkir.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    getOngkirWhere: 1,
                    ongkir_id: ongkirId
                },
                success: function(data) {
                    $("select option").each(function() {
                        $(this).prop("selected", "false");
                    });


                    $("#edit_id").val(data.ongkir_id);
                    $("select option.area").each(function() {
                        if ($(this).val().replace(/ /g, '') == data.area_id) {
                            $(this).prop("selected", "true");
                            // $(this).attr("selected", "selected");
                        }
                    });
                    $("select option").each(function() {
                        if ($(this).val().replace(/ /g, '') == data.status) {
                            $(this).prop("selected", "true");
                            // $(this).attr("selected", "selected");
                        }
                    });
                    $("#edit_tipe").val(data.ongkir_type);
                    $("#edit_harga").val(data.ongkir_price);
                }
            });
        });

        // konfirmasi hapus data disini
        $(document).on("click", ".hapusOngkir", function() {
            var ongkirID = $(this).attr('id');
            $.ajax({
                url: "../model/dataOngkir.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    get_ongkir: 1,
                    ongkir_id: ongkirID
                },
                success: function(data) {
                    $("#id_hapus").val(data.ongkir_id);
                    $("#hapus").text('Anda yakin menghapus ongkir area ' + data.area_name + ' dengan tipe pengiriman ' + data.ongkir_type + ' ?');
                }
            });
        });
    </script>
</body>

</html>