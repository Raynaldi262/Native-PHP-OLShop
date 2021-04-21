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
                        <th>Status</th>
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

                          <td><?php echo $data['status']; ?></td>
                          <td>
                            <form action="../model/dataPesanan.php" method="post">
                              <input type="hidden" name="item_id" id="item_id" value="<?php echo $data['date_id']; ?>">
                              <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $data['cust_id']; ?>">
                              <input type="hidden" name="price" id="price" value="<?php echo $data['price']; ?>">

                              <?php if ($data['status'] == 'Menunggu Konfrimasi') { ?>
                                <input type="submit" class="btn btn-success" name="acc_item" value="Terima">
                                <input type="submit" class="btn btn-danger" name="dec_item" value="Tolak">
                              <?php } ?>
                            </form>
                            <?php if ($data['status'] == 'Proses Pengemasan') { ?>
                              <button type="button" class="btn btn-primary kirim" data-toggle="modal" data-target="#modal-kirim" id="<?php echo $data['date_id']; ?>">
                                Kirim Pesanan
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
    <footer class=" main-footer">
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

  <!-- modal Kirim Data -->
  <div class="modal fade" id="modal-kirim">
    <div class="modal-dialog">
      <div class="modal-content col-10">
        <div class="modal-header">
          <h4 class="modal-title">Kirim Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body lampiran2" style="text-align: center;">
        </div>
        <div class="modal-body" style="text-align: center;">
          <form action="../model/dataPesanan.php" method="post">
            <input type='hidden' name='id_pesanan' value="" id="id_pesanan">
            <div class="input-group mb-3">
              <div class="col-4 input-group-text">No Resi : </div>
              <input type="text" class="col-12 form-control" placeholder="Nomor Resi" name="resi" id="resi" required>
              <div class="input-group-append">
              </div>
            </div>
            <input type="submit" class="btn btn-success" name="kirim_pesanan" value="Kirim">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal HAPUS data-->

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

    // Detail pesanan
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
          var ongkir = 0;
          var total = 0;
          data.forEach(function(datas) {
            var kalimat = datas.item_name + ', ' + datas.type_name + ' (' + datas.color_name + ', ' + datas.item_size + ', ' + datas.item_weight + ' gram / pcs) ' + datas.qty + ' X Rp ' + numeral(datas.item_price).format('0,0');
            $(".lampiran").append("<span class='label label-important'>" + kalimat + '</span> <br>')
            pesanan += datas.qty * datas.item_price;
            ongkir = datas.ongkir;
          });

          total += (parseInt(pesanan) + parseInt(ongkir));
          $(".lampiran").append("<br><span class='label label-important'>" + 'Pesanan = Rp ' + numeral(pesanan).format('0,0') + '</span> <br>')
          $(".lampiran").append("<span class='label label-important'>" + 'Ongkir = Rp ' + numeral(ongkir).format('0,0') + '</span> <br>')
          $(".lampiran").append("<span class='label label-important'>" + 'Total = Rp ' + numeral(total).format('0,0') + '</span> <br>')

        }
      });
    });

    $(document).on("click", ".kirim", function() {
      var pesananID = $(this).attr('id');
      $.ajax({
        url: "../model/dataPesanan.php", //the page containing php script
        type: "post", //request type,
        dataType: 'json',
        data: {
          get_id: 1,
          pesananID: pesananID
        },
        success: function(data) {
          $('.lampiran2').empty();
          data.forEach(function(datas) {
            var kalimat = datas.type_name + ' (' + datas.color_name + ', ' + datas.item_size + ', ' + datas.item_weight + ' gram / pcs) ' + datas.qty + ' X Rp ' + numeral(datas.item_price).format('0,0');
            $(".lampiran2").append("<span class='label label-important'>" + kalimat + '</span> <br>')

            $("#id_pesanan").val(datas.id);
          });
        }
      });
    });


    // lighbox
    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    });
  </script>
</body>

</html>