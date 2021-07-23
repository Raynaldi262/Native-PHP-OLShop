<?php
require('../connect/conn.php');
require('../session/session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Laporan Stok</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

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
                            <h1>Laporan Stok</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" id="laporan">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="laporan.php">Laporan</a></li>
                                <li class="breadcrumb-item active">Laporan Stok</li>
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
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="POST">
                                        <table align="center" border="0" bordercolor="black">
                                            <tr>
                                                <td>
                                                    <input type="date" id="start" name="start" required>
                                                </td>
                                                <td><input type="submit" value="Cari" class="btn-info" name="search"></td>
                                            </tr>
                                        </table>
                                    </form>
                                    <br>
                                    <?php
                                    if (isset($_POST['search'])) {
                                        $start = date("d-m-Y", strtotime($_POST['start']));
                                    ?> <p align="center" class="title"><?php
                                                                        echo 'Data tanggal ' . $start ?>
                                        </p>
                                        <form action="">
                                            <input type='hidden' name='ins_start' id='ins_start' value='<?php echo $_POST['start']; ?>'>
                                            <input type='hidden' name='ins_end' id='ins_end' value='<?php echo $_POST['start']; ?>'>
                                        </form>
                                    <?php
                                    } else {
                                    ?>
                                        <p align="center" class="title"><?php
                                                                        echo 'Data Hari ini ' . date("Y-m-d") ?>
                                        </p>
                                        <form action="">
                                            <input type='hidden' name='ins_start' id='ins_start' value=''>
                                            <input type='hidden' name='ins_end' id='ins_end' value=''>
                                        </form>
                                    <?php } ?>
                                    <br>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Warna</th>
                                                <th>Ukuran</th>
                                                <th>Stok Awal</th>
                                                <th>Stok Masuk</th>
                                                <th>Stok keluar</th>
                                                <th>Stok Akhir</th>
                                                <!-- <th>Keuntungan</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            if (isset($_POST['search'])) {
                                                $start = $_POST['start'];

                                                $sql = "select a.item_name, color_name, size_name, (ifnull(detail_qty,0)+ifnull(stock_out,0)-ifnull(stock_in,0)) as stok  ,ifnull(stock_in,0) as stock_in, ifnull(stock_out,0) as stock_out, ifnull(detail_qty,0) as total_qty, ifnull(stok_price,0) as stok_price
                                                        FROM (  
                                                        select a.item_name, color_name, size_name, detail_qty, c.status, detail_id
                                                        from tbl_item a 
                                                        join tbl_color b on a.color_id = b.color_id
                                                        join (select size_name, detail_qty, status, item_id, detail_id
                                                        from tbl_item_detail a join tbl_size b on a.size_id = b.size_id) c
                                                        on a.item_id = c.item_id
                                                        where c.status = 'ACTIVE') a
                                                        left join (select detail_id, sum(stok_qty) as stock_in, stok_desc 
                                                        from tbl_stockinout where stok_desc = 'STOCK IN' and create_date >= '" . $start . " 00:00:00' and create_date <= '" . $start . " 23:59:59' 
                                                        GROUP by detail_id) b
                                                        on b.detail_id = a.detail_id
                                                        left join (select detail_id, sum(stok_qty) as stock_out, sum(stok_price) as stok_price, stok_desc 
                                                        from tbl_stockinout where stok_desc = 'STOCK OUT' and create_date >= '" . $start . " 00:00:00' and create_date <= '" . $start . " 23:59:59'
                                                        GROUP by detail_id) c
                                                        on c.detail_id = a.detail_id
                                                        left join (select detail_id, total_qty from (select detail_id, total_qty, row_number() over (partition by detail_id order by create_date desc) as no_urut from tbl_stockinout
                                                        where create_date >= '" . $start . " 00:00:00' and create_date <= '" . $start . " 23:59:59') as abc where no_urut = 1) d
                                                        on d.detail_id = a.detail_id
                                                        where stock_in is not null or stock_out is not null";

                                                $getStok = mysqli_query($conn, $sql);
                                            } else {
                                                $sql = "select a.item_name, color_name, size_name, (ifnull(detail_qty,0)+ifnull(stock_out,0)-ifnull(stock_in,0)) as stok  ,ifnull(stock_in,0) as stock_in, ifnull(stock_out,0) as stock_out, ifnull(detail_qty,0) as total_qty, ifnull(stok_price,0) as stok_price
                                                FROM (  
                                                select a.item_name, color_name, size_name, detail_qty, c.status, detail_id
                                                from tbl_item a 
                                                join tbl_color b on a.color_id = b.color_id
                                                join (select size_name, detail_qty, status, item_id, detail_id
                                                from tbl_item_detail a join tbl_size b on a.size_id = b.size_id) c
                                                on a.item_id = c.item_id
                                                where c.status = 'ACTIVE') a
                                                left join (select detail_id, sum(stok_qty) as stock_in, stok_desc 
                                                from tbl_stockinout where stok_desc = 'STOCK IN' and create_date >= CURDATE()
                                                GROUP by detail_id) b
                                                on b.detail_id = a.detail_id
                                                left join (select detail_id, sum(stok_qty) as stock_out, sum(stok_price) as stok_price, stok_desc 
                                                from tbl_stockinout where stok_desc = 'STOCK OUT' and create_date >= CURDATE()
                                                GROUP by detail_id) c
                                                on c.detail_id = a.detail_id
                                                left join (select detail_id, total_qty from (select detail_id, total_qty, row_number() over (partition by detail_id order by create_date desc) as no_urut from tbl_stockinout
                                                where create_date >= CURDATE()) as abc where no_urut = 1) d
                                                on d.detail_id = a.detail_id
                                                where stock_in is not null or stock_out is not null";

                                                $getStok = mysqli_query($conn, $sql);
                                            }
                                            while ($data = mysqli_fetch_array($getStok)) { ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $data['item_name']; ?></td>
                                                    <td><?php echo $data['color_name']; ?></td>
                                                    <td><?php echo $data['size_name']; ?></td>
                                                    <td><?php echo $data['stok']; ?></td>
                                                    <td><?php echo $data['stock_in']; ?></td>
                                                    <td><?php echo $data['stock_out']; ?></td>
                                                    <td><?php echo $data['total_qty']; ?></td>
                                                    <!-- <td><?php echo 'Rp ' . number_format($data['stok_price']); ?></td> -->
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
            var judul = $('.title').text();
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
                        messageTop: judul,
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6, 7],
                            modifier: {
                                page: "current"
                            }
                        }
                    },
                    {
                        text: 'PDF',
                        action: function(e, dt, node, config) {
                            var start = $('#ins_start').val();
                            var end = $('#ins_end').val();
                            console.log(start);
                            console.log(end);
                            window.location.href = 'laporan_stok_pdf.php?start=' + start + '&end=' + end + '&user=<?php echo $_SESSION['admin_id'] ?>'
                        }
                    },
                    // {
                    //     extend: "pdf",
                    //     messageTop: judul,
                    //     exportOptions: {
                    //         columns: [0, 1, 2, 3, 4, 7, 8],
                    //         modifier: {
                    //             page: "current"
                    //         }
                    //     }
                    // }, 
                    "colvis"
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $(function() {
            $("#include-navbar").load("left-navbar.php");
        });

        // $(function() {
        //     var dtToday = new Date(Date.now() - 604800000);
        //     console.log(dtToday)
        //     var month = dtToday.getMonth() + 1;
        //     var day = dtToday.getDate();
        //     var year = dtToday.getFullYear();
        //     if (month < 10)
        //         month = '0' + month.toString();
        //     if (day < 10)
        //         day = '0' + day.toString();

        //     var min = year + '-' + month + '-' + day;

        //     console.log(min);
        //     $('#start').attr('min', min);
        // });


        // $(function() {
        //     var dtToday = new Date();

        //     var month = dtToday.getMonth() + 1;
        //     var day = dtToday.getDate();
        //     var year = dtToday.getFullYear();
        //     if (month < 10)
        //         month = '0' + month.toString();
        //     if (day < 10)
        //         day = '0' + day.toString();

        //     var max = year + '-' + month + '-' + day;
        //     console.log(max);
        //     $('#start').attr('max', max);
        // });
    </script>
</body>

</html>