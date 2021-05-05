<?php
require('../connect/conn.php');

function getItem($conn, $id)
{
    $sql = "select * from 
    (Select a.date_id id, qty, item_name, type_name, item_size, color_name, item_weight, item_qty as stock, item_price, ongkir
    from tbl_proses a 
    join tbl_detailorder b on a.date_id = b.date_id
    join (select item_id, item_name, type_name, item_size, color_name, item_weight, item_qty, item_price from tbl_item a 
        join tbl_color b on a.color_id = b.color_id 
        join tbl_item_type c on a.type_id = c.type_id) as c
    on b.item_id = c.item_id ) as a
    where id = '" . $id . "' ";

    $result = mysqli_query($conn, $sql);
    $results = [];

    while ($datas = mysqli_fetch_assoc($result)) {
        $results[] = $datas; //assign whole values to array
    }

    return $results;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Laporan Pesanan</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" crossorigin="anonymous">

</head>
<style>
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
                            <h1>Laporan Pesanan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" id="laporan">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="laporan.php">Laporan</a></li>
                                <li class="breadcrumb-item active">Laporan Pesanan</li>
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
                                    <h3 class="card-title">Data Pesanan</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="POST">
                                        <table align="center" border="0" bordercolor="black">
                                            <tr>
                                                <td><b>Dari Tanggal</b></td>
                                                <td>
                                                    <input type="date" id="start" name="start" required>
                                                </td>
                                                <td><b>Sampai Tanggal</b></td>
                                                <td><input type="date" id="end" name="end" required></td>
                                                <td><input type="submit" value="Cari" class="btn-info" name="search"></td>
                                            </tr>
                                        </table>
                                    </form>
                                    <br>
                                    <?php
                                    if (isset($_POST['search'])) {
                                        $start = date("d-m-Y", strtotime($_POST['start']));
                                        $end = date("d-m-Y", strtotime($_POST['end']));
                                    ?> <p align="center" class="title"><?php
                                                                        echo 'Data tanggal ' . $start . ' sampai tanggal ' . $end;  ?>
                                        </p>
                                    <?php
                                    }
                                    ?>
                                    <br>
                                    <table id="example1" class="table table-bordered table-striped" style="width: 150%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>invoice</th>
                                                <th>resi</th>
                                                <th>Nama</th>
                                                <th>AlamatP</th>
                                                <th>Pesanan</th>
                                                <th>tgl pesanan</th>
                                                <th>Total Harga</th>
                                                <th>Pengiriman</th>
                                                <th>Ongkir</th>
                                                <th>Bukti Transfer</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            if (isset($_POST['search'])) {
                                                $start = $_POST['start'];
                                                $end = $_POST['end'];

                                                $sql = "select order_id, order_invoice, order_resi, b.cust_id, cust_name, cust_address, a.create_date as create_date,
                                                            order_totprice, order_shipping, order_shipping_price, order_transfer, order_status, item_id
                                                        from tbl_order a
                                                        join (select cust_id, cust_name, cust_address, cust_phone from tbl_customer) as b
                                                        on a.cust_id = b.cust_id
                                                        where create_date >= '" . $start . " 00:00:00' and create_date <= '" . $end . " 23:59:59'";

                                                $getOrder = mysqli_query($conn, $sql);
                                            } else {
                                                $sql = "select order_id, order_invoice, order_resi, b.cust_id, cust_name, cust_address, a.create_date as create_date,
                                                            order_totprice, order_shipping, order_shipping_price, order_transfer, order_status, item_id
                                                        from tbl_order a
                                                        join (select cust_id, cust_name, cust_address, cust_phone from tbl_customer) as b
                                                        on a.cust_id = b.cust_id";

                                                $getOrder = mysqli_query($conn, $sql);
                                            }
                                            while ($data = mysqli_fetch_array($getOrder)) { ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $data['order_invoice']; ?></td>
                                                    <td><?php echo $data['order_resi']; ?></td>
                                                    <td><?php echo $data['cust_name']; ?></td>
                                                    <td><?php echo $data['cust_address']; ?></td>
                                                    <td>

                                                        <?php
                                                        $result = getItem($conn, $data['item_id']);

                                                        foreach ($result as $datas) {
                                                            echo $datas['item_name'] . ', ' . $datas['type_name'] . ' (' . $datas['item_size'] . ', ' . $datas['color_name']
                                                                . ', ' . $datas['item_weight'] . 'gram/pcs ) ' . $datas['qty'] . ' x Rp ' . number_format($datas['item_price']);

                                                        ?>
                                                            <br><br>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo date('d-m-Y', strtotime($data['create_date'])); ?></td>
                                                    <td><?php echo $data['order_totprice']; ?></td>
                                                    <td><?php echo $data['order_shipping']; ?></td>
                                                    <td><?php echo $data['order_shipping_price']; ?></td>
                                                    <td> <a href='../Eshopper/images/bayar/<?php echo $data['order_transfer']; ?>' data-toggle="lightbox" data-gallery="gallery">
                                                            <img src="../Eshopper/images/bayar/<?php echo $data['order_transfer']; ?> " alt=""></a>
                                                    </td>
                                                    <td><?php echo $data['order_status']; ?></td>
                                                    <td>
                                                        <a class="link" href='../Eshopper/invoice.php?id=<?php echo $data['item_id']; ?>&idu=<?php echo $data['cust_id']; ?> '>
                                                            <button type="button" class="btn btn-success print">
                                                                <i class="fa fa-print"> Print Invoice</i>
                                                            </button>
                                                        </a>
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

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <!-- lightbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" crossorigin="anonymous"></script>
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
            var judul = $('.title').text();
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
                    messageTop: judul,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 11],
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


        $(document).on("click", '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
</body>

</html>