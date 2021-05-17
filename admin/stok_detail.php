<?php require('../model/dataDetail.php');
$itemid = $_GET['itemid'];
$items = [];
$item = [];

$getItem = getItem($conn, $itemid); // ini buat item yg atas
$item = mysqli_fetch_assoc($getItem);

$getItems = getItems($conn, $itemid);   //ini buat detailnya
while ($datas = mysqli_fetch_assoc($getItems)) {
    $items[] = $datas; //assign whole values to array
}

$ukuran = [];
while ($datas = mysqli_fetch_assoc($getSize)) {
    $ukuran[] = $datas; //assign whole values to array
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Stok Detail</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<style>
    #tambah_ukuran {
        margin-left: 50% !important;
    }

    .column {
        float: left;
        width: 50%;
    }

    .modal-lg {
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
                            <h1>Stok</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" id="stok">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
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
                                    <h3 class="card-title">Data detail barang</h3>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambahUkuran" id="tambah_ukuran">
                                        Tambah Ukuran
                                    </button>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambahItem" id="tambah_data">
                                        Tambah Barang
                                    </button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table align="center">
                                        <tbody>
                                            <tr>
                                                <td>Nama: </td>
                                                <td><?php echo $item['item_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tipe: </td>
                                                <td><?php echo $item['type_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Warna : </td>
                                                <td><?php echo $item['color_name']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Size</th>
                                                <th>Qty</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($items as $data) { ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $data['size_name']; ?></td>
                                                    <td><?php echo $data['detail_qty']; ?></td>
                                                    <td>
                                                        <?php if ($_SESSION['role_id'] != 3) { ?>
                                                            <button type="button" class="btn btn-success ubahStok" data-toggle="modal" data-target="#modal-ubahStok" id="<?php echo $data['detail_id']; ?>">
                                                                Ubah Stok
                                                            </button>
                                                            <button type="button" class="btn btn-danger hapusItem" data-toggle="modal" data-target="#modal-hapusItem" id="<?php echo $data['detail_id']; ?>">
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

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- modal Tambah Ukuran -->
    <div class="modal fade" id="modal-tambahUkuran">
        <div class="modal-dialog">
            <div class="modal-content col-8">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Ukuran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <div>
                        <table class="col-12">
                            <tbody>
                                <?php foreach ($ukuran as $data) { ?>
                                    <tr id="dataUkuran">
                                        <td><?php echo $data['size_name']; ?></td>
                                        <td>
                                            <form action="../model/dataDetail.php" method="GET">
                                                <input type='hidden' name='id' value="<?php echo $data['size_id']; ?>">
                                                <input type='hidden' name='itemid' value="<?php echo $itemid; ?>">
                                                <input type="submit" class="btn btn-danger" name="deleteSize" value="Hapus">
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <form action="../model/dataDetail.php" method="GET">
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Ukuran : </div>
                            <input type='hidden' name='itemid' value="<?php echo $itemid; ?>">
                            <input type="text" class="form-control" placeholder="Ukuran" name="ukuran" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info" name="add_size" value="Tambah Ukuran">
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
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/dataDetail.php" method="GET" enctype="multipart/form-data">
                        <input type='hidden' name='itemid' value="<?php echo $itemid; ?>">
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Ukuran : </div>
                            <select id="size" name="size" required>
                                <?php foreach ($ukuran as $data) { ?>
                                    <option value=" <?php echo $data['size_id']; ?> "><?php echo $data['size_name']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-4 input-group-text">Jumlah : </div>
                            <input type="number" class="col-4 form-control" placeholder="Jumlah stok " name="item_qty" min="1" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" name="add_item" value="Tambah">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal tambah data -->

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
                    <form action="../model/dataDetail.php" method="get">
                        <input type='hidden' name='itemid' value="<?php echo $itemid; ?>">
                        <input type='hidden' name='id_hapus' value="" id="id_hapus">
                        <p id="hapus">Anda yakin ingin menghapus?</p>
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
                    <form action="../model/dataDetail.php" method="GET">
                        <input type="hidden" name="stok_id" id="stok_id">
                        <input type="hidden" name="stok_itemid" id="stok_itemid">
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
                "scrollX": true
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $(function() {
            $("#include-navbar").load("left-navbar.php");
        });

        // konfirmasi hapus data disini
        $(document).on("click", ".hapusItem", function() {
            var id = $(this).attr('id');
            $("#id_hapus").val(id);
        });

        // Tambah stok disini
        $(document).on("click", ".ubahStok", function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "../model/dataDetail.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    stok_item: 1,
                    id: id
                },
                success: function(data) {
                    $('#stok_itemid').val(<?php echo $itemid; ?>);
                    $('#stok_id').val(data.detail_id);
                    $("#stok_old").val(data.detail_qty);
                }
            });
        });
    </script>
</body>

</html>