<?php
require('../model/User.php');

$item = getDetailProses($_GET['id']);
$data_order = getDataOrder($_GET['id']);
$dataproses = getProsesDataDetail($_GET['id']);
$dataprofile = getDataUser($_SESSION['cust_id']);
if ($_GET['ida'] != 0) {
	$datauser = getDataAlamat2($_GET['ida']);
} else {
	$datauser = getDataUser($_SESSION['cust_id']);
}

$linkid =  $_GET['id'];
if (isset($_SESSION['cust_id'])) {
	$data_cart = getcartCount($_SESSION['cust_id']);
	$data_check = getcheckCount($_SESSION['cust_id']);
	$proses_count = getProsesCount($_SESSION['cust_id']);
} else {
	$data_cart['juml'] = 0;
	$data_check['juml'] = 0;
	$proses_count['juml'] = 0;
}
$totalharga = 0;
$totalberat = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Monkers Apparel</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">
	<link href="css/price-range.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">


	<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<!--/head-->

<body>
	<header id="header">
		<!--header-->
		<div class="header-middle">
			<!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img width="100" src="images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php
								if (!isset($_SESSION['cust_id'])) {
								?>
									<li><a href="../monkers/login.php"><i class="fa fa-user"></i> Akun</a></li>
								<?php
								} else {
									$data = custLogin($_SESSION['cust_id']);
								?>
									<?php if ($proses_count['juml'] != 0) { ?>
										<li><a href="../monkers/profile.php"><img src="images/Profile/<?php echo $dataprofile['cust_img'] ?>" style=" width:25px;height: 25px; border-radius: 50%;" />
												<span><?php echo $data['cust_name']; ?></span>
												<span class="badge"><?php echo $proses_count['juml']; ?></span>
											</a>
										</li>
									<?php } else { ?>
										<li><a href="../monkers/profile.php"><img src="images/Profile/<?php echo $dataprofile['cust_img'] ?>" style=" width:25px;height: 25px; border-radius: 50%;" /> <?php echo $data['cust_name']; ?></a></li>
									<?php } ?>
								<?php
								}
								?>
								<!-- checkout -->
								<?php if ($data_check['juml'] != 0) { ?>
									<li><a href="checkout.php" class="notification"><i class="fa fa-shopping-cart"></i>
											<span>Pengiriman</span>
											<span class="badge"><?php echo $data_check['juml']; ?></span>
										</a>
									</li>
								<?php } else { ?>
									<li><a href="checkout.php" class="notification"><i class="fa fa-crosshairs"></i>Pengiriman</a></li>
								<?php } ?>
								<!-- cart -->
								<?php if ($data_cart['juml'] != 0) { ?>
									<li><a href="cart.php" class="notification"><i class="fa fa-shopping-cart"></i>
											<span>Keranjang</span>
											<span class="badge"><?php echo $data_cart['juml']; ?></span>
										</a>
									</li>
								<?php } else { ?>
									<li><a href="cart.php" class="notification"><i class="fa fa-shopping-cart"></i>Keranjang</a></li>
								<?php } ?>
								<!-- logout -->
								<?php
								if (!isset($_SESSION['cust_id'])) {
								?>
									<li><a href="../monkers/login.php"><i class="fa fa-lock"></i> Masuk</a></li>
								<?php
								} else {
								?>
									<li><a href="../login_user/logout_user.php"><i class="fa fa-lock"></i> Keluar</a></li>
								<?php
								}
								?>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header-middle-->

		<div class="header-bottom">
			<!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header-bottom-->
	</header>
	<!--/header-->

	<section id="cart_items">
		<div class="container">
			<div class="mainmenu pull-left">
				<ul class="nav navbar-nav collapse navbar-collapse">
					<li><a href="../monkers/">Beranda</a></li>
					<li><a href="../monkers/aboutus.php">Tentang kami</a></li>
					<li><a href="../monkers/bantuan.php">Bantuan</a></li>
					<li><a href="../monkers/syarat_ketentuan.php">Syarat & Ketentuan</a></li>
					<li><a href="../monkers/contactus.php">Kontak Kami</a></li>
				</ul>
			</div>
			<br>
			<div>
				<h1 style="text-align:center">Detail Barang</h1>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr style="background-color:grey;" class="cart_menu">
							<td style="text-align: center">Gambar</td>
							<td style="text-align: center">Nama</td>
							<td style="text-align: center">Tipe</td>
							<td style="text-align: center">Warna</td>
							<td style="text-align: center">Ukuran</td>
							<td style="text-align: center">Jumlah</td>
							<td style="text-align: center">Harga</td>
							<td style="text-align: center">Berat</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						if (isset($_SESSION['cust_id'])) {
							while ($data_check = mysqli_fetch_assoc($item)) {
								$item_cart = getItemcart($data_check['item_id']);
								$data_type = getTypeitem($item_cart['type_id']);
								$img = getImgItem($data_check['item_id']);
								$totalharga += $item_cart['item_price'] * $data_check['qty'];
								$totalberat += $item_cart['item_weight'] * $data_check['qty'];
						?>
								<tr>
									<td class="cart_product">
										<a href="../monkers/product_details.php/?id=<?php echo $data_check['item_id']; ?>">
											<img style="width:200px" src="../dist/img/item/<?php echo $img['img_name']; ?>" alt="">
										</a>
									</td>
									<td class="cart_description" style="text-align: center">
										<h4><?php echo $item_cart['item_name'] ?></h4>
									</td>
									<td class="cart_price" style="text-align: center">
										<?php echo $data_type['type_name'] ?>
									</td>
									<td class="cart_quantity" style="text-align: center">
										<div class="cart_quantity_button">
											<?php echo $data_check['color_name'] ?>
										</div>
									</td>
									<td class="cart_quantity" style="text-align: center">
										<div class="cart_quantity_button">
											<?php echo $data_check['size'] ?>
										</div>
									</td>
									<td class="cart_quantity" style="text-align: center">
										<div class="cart_quantity_button">
											<?php echo $data_check['qty'] ?>
										</div>
									</td>
									<td class="cart_total">
										<p class="cart_total_price" style="text-align: center">Rp. <?php echo number_format($item_cart['item_price']) ?></p>
									</td>
									<td class="cart_price" style="text-align: center">
										<p><?php echo $item_cart['item_weight'] ?> Grm</p>
									</td>
								</tr>
						<?php }
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<div class="heading" style="text-align:center;">
							<h3>Data Pribadi</h3>
						</div>
						<ul>
							<?php if (isset($_SESSION['cust_id'])) { ?>
								<li>Nama : <?php echo $datauser['cust_name'] ?></li>
								<li>Alamat : <?php echo $datauser['cust_address'] ?></li>
								<li>Kota : <?php echo $datauser['cust_city'] ?></li>
								<li>no Hp : <?php echo $datauser['cust_phone'] ?></li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<!-- Jika tidak ada barang tombol bayar dihilangkan -->
				<div class="col-sm-6">
					<div class="total_area">
						<div class="heading" style="text-align:center;">
							<h3>Total Harga</h3>
						</div>
						<ul>
							<?php $totalharga += $dataproses['ongkir']; ?>
							<li>Kurir : <span><?php echo $dataproses['kurir']; ?></span></li>
							<li>Berat : <span><?php echo $totalberat; ?> Gram</span></li>
							<li>Ongkir : <span>Rp. <?php echo number_format($dataproses['ongkir']); ?></span></li>
							<li>Total : <span>Rp. <?php echo number_format($totalharga); ?></span></li>
							<!-- <a type="button" class="btn " data-toggle="modal" data-target="#invoice">Download Invoice</a> -->
							<br>
							<?php if ($dataproses['status'] != 'Menunggu Konfrimasi') { ?>
								<a href="invoice.php?id=<?php echo $linkid ?>&idu=<?php echo $_SESSION['cust_id'] ?>&ida=<?php echo $_GET['ida'] ?>&custid=<?php echo $_SESSION['cust_id'] ?>&adminid=">
									<button type="button" class="btn btn-success">
										<i class="fa fa-print"> Cetak Invoice</i>
									</button>
								</a>
							<?php } else { ?>
								<h5>Sedang Menunggu Konfrimasi</h5>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/#do_action-->
	<script src="../plugins/jquery/jquery.min.js"></script>

	<!-- <script src="js/jquery.js"></script> -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>
	<!-- jQuery -->
	<!-- <script src="../plugins/jquery/jquery.min.js"></script> -->
	<!-- Bootstrap 4 -->
	<!-- <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
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
	<script>
		$(function() {
			var judul = $('.title').text();
			$("#example1").DataTable({
				"responsive": true,
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
						columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
						modifier: {
							page: "current"
						}
					}
				}, {
					extend: "pdf",
					messageTop: judul,
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
						modifier: {
							page: "current"
						}
					}
				}, "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		});
	</script>
</body>

</html>