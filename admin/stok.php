<?php require('../model/dataStok.php');
$tipe = [];
$color = [];

while ($datas = mysqli_fetch_assoc($getColor)) {
    $color[] = $datas; //assign whole values to array
}

while ($datas = mysqli_fetch_assoc($getTipe)) {
    $tipe[] = $datas; //assign whole values to array
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Stok</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<style>
    #tambah_warna {
        margin-left: 62% !important;
    }

    img {
        width: 100px;
        height: 100px;
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
                            <h1>Stok</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" id="stok">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Stok</li>
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
                                    <h3 class="card-title">Data stok barang</h3>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambahWarna" id="tambah_warna">
                                        Tambah warna
                                    </button>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambahItem" id="tambah_data">
                                        Tambah Item
                                    </button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped" style="width: 150%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Gambar</th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Warna</th>
                                                <th>Ukuran</th>
                                                <th>Berat</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            while ($data = mysqli_fetch_assoc($getItem)) { ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td> <img src="../dist/img/item/<?php echo $data['item_img']; ?>" alt=""></td>
                                                    <td><?php echo $data['item_name']; ?></td>
                                                    <td><?php echo $data['type_name']; ?></td>
                                                    <td><?php echo $data['color_name']; ?></td>
                                                    <td><?php echo $data['item_size']; ?></td>
                                                    <td><?php echo $data['item_weight']; ?></td>
                                                    <td><?php echo $data['item_price']; ?></td>
                                                    <td><?php echo $data['item_qty']; ?></td>
                                                    <td><?php echo $data['item_desc']; ?></td>
                                                    <td>
                                                        <?php if ($_SESSION['role_id'] != 3) { ?>
                                                            <button type="button" class="btn btn-warning ubahItem" data-toggle="modal" data-target="#modal-ubahItem" id="<?php echo $data['item_id']; ?>">
                                                                Ubah Data
                                                            </button>
                                                            <button type="button" class="btn btn-danger hapusItem" data-toggle="modal" data-target="#modal-hapusItem" id="<?php echo $data['item_id']; ?>">
                                                                Hapus
                                                            </button>
                                                        <?php } ?>
                                                        <button type="button" class="btn btn-success ubahStok" data-toggle="modal" data-target="#modal-ubahStok" id="<?php echo $data['item_id']; ?>">
                                                            Ubah Stok
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

    <!-- modal Tambah Warna -->
    <div class="modal fade" id="modal-tambahWarna">
        <div class="modal-dialog">
            <div class="modal-content col-8">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Warna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/dataStok.php" method="post">
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Warna : </div>
                            <input type="text" class="form-control" placeholder="Warna" name="warna" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info" name="add_color" value="Tambah Warna">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Tambah Warna-->

    <!-- modal tambah item -->
    <div class="modal fade" id="modal-tambahItem">
        <div class="modal-dialog">
            <div class="modal-content col-12">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/dataStok.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="img" required> <span class="text-muted">jpg, png</span></td>
                        <br><br>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Nama : </div>
                            <input type="text" class="form-control" placeholder="Nama Barang" name="item_name" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Kategori : </div>
                            <select id="item_type" name="item_type">
                                <?php foreach ($tipe as $data) { ?>
                                    <option value=" <?php echo $data['type_id']; ?> "><?php echo $data['type_name']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Warna : </div>
                            <select id="item_color" name="item_color">
                                <?php foreach ($color as $data) { ?>
                                    <option value=" <?php echo $data['color_id']; ?> "><?php echo $data['color_name']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Ukuran : </div>
                            <input type="text" class="col-8 form-control" placeholder="Ukuran barang" name="item_size" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Berat : </div>
                            <input type="number" class="col-4 form-control" placeholder="Berat barang" name="item_weight" min="1" required>
                            <div class="col-2 input-group-text">gram</div>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Deskripsi : </div>
                            <textarea class="form-control" placeholder="Deskripsi barang " name="item_desc" rows="4" cols="50"></textarea>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Jumlah : </div>
                            <input type="number" class="col-3 form-control" placeholder="Jumlah stok " name="item_qty" min="1" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Harga : </div>
                            <input type="number" class="col-3 form-control" placeholder="Harga / barang " name="item_price" min="1" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" name="add_item" value="Tambah Data">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal tambah data -->

    <!-- modal edit data -->
    <div class="modal fade" id="modal-ubahItem">
        <div class="modal-dialog">
            <div class="modal-content col-12">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/dataStok.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id" id="edit_id">
                        <input type="file" name="img"> <span class="text-muted">jpg, png</span></td>
                        <br><br>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Nama : </div>
                            <input type="text" class="form-control" placeholder="Nama Barang" name="edit_name" id="edit_name">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Kategori : </div>
                            <select id="edit_type" name="edit_type">
                                <?php foreach ($tipe as $data) { ?>
                                    <option class="type" value=" <?php echo $data['type_id']; ?> "><?php echo $data['type_name']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Warna : </div>
                            <select id="edit_color" name="edit_color">
                                <?php foreach ($color as $data) { ?>
                                    <option class="color" value=" <?php echo $data['color_id']; ?> "><?php echo $data['color_name']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Ukuran : </div>
                            <input type="text" class="col-8 form-control" placeholder="Ukuran barang" name="edit_size" id="edit_size">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Berat : </div>
                            <input type="number" class="col-4 form-control" placeholder="Berat barang" name="edit_weight" id="edit_weight" min="1">
                            <div class="col-2 input-group-text">gram</div>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Deskripsi : </div>
                            <textarea class="form-control" placeholder="Deskripsi barang " name="edit_desc" id="edit_desc" rows="4" cols="50"></textarea>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Harga : </div>
                            <input type="number" class="col-3 form-control" placeholder="Harga / barang " name="edit_price" id="edit_price" min="1">
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
    <div class="modal fade" id="modal-hapusItem">
        <div class="modal-dialog">
            <div class="modal-content col-8">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/dataStok.php" method="post">
                        <input type='hidden' name='id_hapus' value="" id="id_hapus">
                        <p id="hapus"></p>
                        <input type="submit" class="btn btn-danger" name="delete_item" value="Hapus Barang">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal HAPUS data-->

    <!-- modal Tambah Stok -->
    <div class="modal fade" id="modal-ubahStok">
        <div class="modal-dialog">
            <div class="modal-content col-10">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Stok</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/dataStok.php" method="post">
                        <input type="hidden" name="stok_id" id="stok_id">
                        <input type="hidden" name="stok_name" id="stok_name">
                        <div class="input-group mb-3">
                            <div class="col-7 input-group-text">Stok Tersedia : </div>
                            <input type="number" class="form-control" name="stok_old" id="stok_old" readonly>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-7 input-group-text">Penambahan/Pengurangan : </div>
                            <input type="number" class="form-control" placeholder="Banyak" name="stok" min="1" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="add_stok" value="Tambahkan Stok">
                        <input type="submit" class="btn btn-danger" name="dec_stok" value="Kurangkan Stok">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Tambah Stok-->

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
    <script src="../plugins/datatables-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                // "responsive": true,
                "autoWidth": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "scrollX": true,
                "buttons": [{
                    extend: "csv",
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7, 8],
                        modifier: {
                            page: "current"
                        }
                    }
                }, {
                    extend: "pdf",
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7, 8],
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

        //isi data sblm diedit
        $(document).on("click", ".ubahItem", function() {
            var itemId = $(this).attr('id');

            $.ajax({
                url: "../model/dataStok.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    getItemWhere: 1,
                    item_id: itemId
                },
                success: function(data) {
                    $("select option").each(function() {
                        $(this).prop("selected", "false");
                    });


                    $("#edit_id").val(data.item_id);
                    $("#edit_name").val(data.item_name);
                    $("select option.type").each(function() {
                        if ($(this).val().replace(/ /g, '') == data.type_id) {
                            // $(this).attr("selected", "selected");
                            $(this).prop("selected", "true");
                        }
                    });
                    $("select option.color").each(function() {
                        if ($(this).val().replace(/ /g, '') == data.color_id) {
                            // $(this).attr("selected", "selected");
                            $(this).prop("selected", "true");
                        }
                    });
                    $("#edit_size").val(data.item_size);
                    $("#edit_weight").val(data.item_weight);
                    $("#edit_desc").val(data.item_desc);
                    $("#edit_price").val(data.item_price);
                }
            });
        });

        // konfirmasi hapus data disini
        $(document).on("click", ".hapusItem", function() {
            var itemId = $(this).attr('id');
            $.ajax({
                url: "../model/dataStok.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    get_item: 1,
                    itemId: itemId
                },
                success: function(data) {
                    $("#id_hapus").val(data.item_id);
                    $("#hapus").text('Anda yakin menghapus ' + data.item_name + ' ?');
                }
            });
        });

        // Tambah stok disini
        $(document).on("click", ".ubahStok", function() {
            var itemId = $(this).attr('id');
            $.ajax({
                url: "../model/dataStok.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    stok_item: 1,
                    itemId: itemId
                },
                success: function(data) {
                    $('#stok_id').val(data.item_id);
                    $('#stok_name').val(data.item_name);
                    $("#stok_old").val(data.item_qty);
                    // $("#hapus").text('Anda yakin menghapus ' + data.item_name + ' ?');
                }
            });
        });
    </script>
</body>

</html>