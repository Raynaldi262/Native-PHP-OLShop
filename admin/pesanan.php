<?php require('../model/dataPesanan.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Pesanan</title>

  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" crossorigin="anonymous">

</head>
<style>
  #tambah_warna {
    margin-left: 50% !important;
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
              <ol class="breadcrumb float-sm-right" id="pesanan">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Pesanan</li>
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
                  <table id="example1" class="table table-bordered table-striped" style="width: 150%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Pesanan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Pesanan</th>
                        <th>Jenis Pengiriman</th>
                        <th>Total Harga</th>
                        <th>Bukti Transfer</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      while ($data = mysqli_fetch_assoc($getPesanan)) { ?>
                        <tr>
                          <td><?php echo $i ?></td>
                          <td><?php echo $data['date_id']; ?></td>
                          <td><?php echo $data['cust_name']; ?></td>
                          <td><?php echo $data['cust_address']; ?></td>
                          <td> <button type="button" class="btn btn-primary detailPesanan" data-toggle="modal" data-target="#modal-detailPesanan" id="<?php echo $data['date_id']; ?>">
                              Detail
                            </button></td>
                          <td><?php echo $data['kurir']; ?></td>
                          <td><?php echo $data['price']; ?></td>
                          <td> <a href='../Eshopper/images/bayar/<?php echo $data['img_bayar']; ?>' data-toggle="lightbox" data-gallery="gallery">
                              <img src="../Eshopper/images/bayar/<?php echo $data['img_bayar']; ?> " alt=""></a></td>
                          <td>
                            <button type="button" class="btn btn-warning ubahItem" data-toggle="modal" data-target="#modal-ubahItem" id="<?php echo $data['item_id']; ?>">
                              Konfirmasi
                            </button>
                            <button type="button" class="btn btn-danger hapusItem" data-toggle="modal" data-target="#modal-hapusItem" id="<?php echo $data['item_id']; ?>">
                              Tolak
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

  <!-- modal DETAIL Data -->
  <div class="modal fade" id="modal-detailPesanan">
    <div class="modal-dialog">
      <div class="modal-content col-12">
        <div class="modal-header">
          <h4 class="modal-title">Detail Pesanan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body lampiran" style="text-align: center;">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal DETAIL data-->

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- lightbox -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" crossorigin="anonymous"></script>
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
      })
    });

    $(function() {
      $("#include-navbar").load("left-navbar.php");
    });

    // konfirmasi hapus data disini
    $(document).on("click", ".detailPesanan", function() {
      var pesananID = $(this).attr('id');
      $.ajax({
        url: "../model/dataPesanan.php", //the page containing php script
        type: "post", //request type,
        dataType: 'json',
        data: {
          get_pesanan: 1,
          pesananID: pesananID
        },
        success: function(data) {
          $('.lampiran').empty();
          var pesanan = 0;
          var ongkir = data[0].price;
          var total = 0;
          data.forEach(function(datas) {
            var kalimat = datas.type_name + ' (' + datas.color_name + ', ' + datas.item_size + ', ' + datas.item_weight + ' gram / pcs) ' + datas.qty + ' X Rp ' + numeral(datas.item_price).format('0,0');
            $(".lampiran").append("<span class='label label-important'>" + kalimat + '</span> <br>')
            pesanan += datas.qty * datas.item_price;
          });
          ongkir = ongkir - pesanan;
          total = pesanan + ongkir;
          $(".lampiran").append("<br><span class='label label-important'>" + 'Pesanan = Rp ' + numeral(pesanan).format('0,0') + '</span> <br>')
          $(".lampiran").append("<span class='label label-important'>" + 'Ongkir = Rp ' + numeral(ongkir).format('0,0') + '</span> <br>')
          $(".lampiran").append("<span class='label label-important'>" + 'Total = Rp ' + numeral(total).format('0,0') + '</span> <br>')

        }
      });
    });

    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    });
  </script>
</body>

</html>