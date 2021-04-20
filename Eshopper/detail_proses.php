<?php
require('../model/User.php');

$item = getDetailProses($_GET['id']);
$datauser = getDataUser($_SESSION['cust_id']);
$data_onkir = getDataOngkir($datauser['cust_city']);
$data_order = getDataOrder($_GET['id']);
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
	<title>Cart | E-Shopper</title>
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
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php
								if (!isset($_SESSION['cust_id'])) {
								?>
									<li><a href="../Eshopper/login.php"><i class="fa fa-user"></i> Account</a></li>
								<?php
								} else {
									$data = custLogin($_SESSION['cust_id']);
								?>
									<?php if ($proses_count['juml'] != 0) { ?>
										<li><a href="../Eshopper/profile.php"><img src="images/Profile/<?php echo $datauser['cust_img'] ?>" style=" width:25px;height: 25px; border-radius: 50%;" />
												<span><?php echo $data['cust_name']; ?></span>
												<span class="badge"><?php echo $proses_count['juml']; ?></span>
											</a>
										</li>
									<?php } else { ?>
										<li><a href="../Eshopper/profile.php"><img src="images/Profile/<?php echo $datauser['cust_img'] ?>" style=" width:25px;height: 25px; border-radius: 50%;" /> <?php echo $data['cust_name']; ?></a></li>
									<?php } ?>
								<?php
								}
								?>
								<!-- checkout -->
								<?php if ($data_check['juml'] != 0) { ?>
									<li><a href="checkout.php" class="notification"><i class="fa fa-shopping-cart"></i>
											<span>Checkout</span>
											<span class="badge"><?php echo $data_check['juml']; ?></span>
										</a>
									</li>
								<?php } else { ?>
									<li><a href="checkout.php" class="notification"><i class="fa fa-crosshairs"></i>Checkout</a></li>
								<?php } ?>
								<!-- cart -->
								<?php if ($data_cart['juml'] != 0) { ?>
									<li><a href="cart.php" class="notification"><i class="fa fa-shopping-cart"></i>
											<span>Cart</span>
											<span class="badge"><?php echo $data_cart['juml']; ?></span>
										</a>
									</li>
								<?php } else { ?>
									<li><a href="cart.php" class="notification"><i class="fa fa-shopping-cart"></i>Cart</a></li>
								<?php } ?>
								<!-- logout -->
								<?php
								if (!isset($_SESSION['cust_id'])) {
								?>
									<li><a href="../Eshopper/login.php"><i class="fa fa-lock"></i> Login</a></li>
								<?php
								} else {
								?>
									<li><a href="../login_user/logout_user.php"><i class="fa fa-lock"></i> Logout</a></li>
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
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="../Eshopper/">Home</a></li>
				</ol>
			</div>
			<div>
				<h1 style="text-align:center">Detail Barang</h1>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td style="text-align: center">Gambar</td>
							<td style="text-align: center">Nama</td>
							<td style="text-align: center">Tipe</td>
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
								$totalharga += $item_cart['item_price'] * $data_check['qty'];
								$totalberat += $item_cart['item_weight'] * $data_check['qty'];
						?>
								<tr>
									<td class="cart_product">
										<a href="../Eshopper/product_details.php/?id=<?php echo $data_cart['item_id']; ?>">
											<img style="width:200px" src="../dist/img/item/<?php echo $item_cart['item_img']; ?>" alt="">
										</a>
									</td>
									<td class="cart_description" style="text-align: center">
										<h4><?php echo $item_cart['item_name'] ?></h4>
									</td>
									<td class="cart_price" style="text-align: center">
										<p><?php echo $data_type['type_name'] ?></p>
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
								<li>Email : <?php echo $datauser['cust_email'] ?></li>
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
							<?php $hargaongkir = KiloBarang($totalberat, $data_onkir['ongkir_price']);
							$totalharga += $hargaongkir; ?>
							<li>Kurir : <span><?php echo $data_onkir['ongkir_type']; ?></span></li>
							<li>Berat : <span><?php echo $totalberat; ?> Gram</span></li>
							<li>Ongkir : <span>Rp. <?php echo number_format($hargaongkir); ?></span></li>
							<li>Total : <span>Rp. <?php echo number_format($totalharga); ?></span></li>
							<!-- <a type="button" class="btn " data-toggle="modal" data-target="#invoice">Download Invoice</a> -->
							<a href="invoice.php?id=<?php echo $linkid ?>">
								<button type="button" class="btn btn-success">
									<i class="fa fa-print"> Print Invoice</i>
								</button>
							</a>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/#do_action-->
	<footer id="footer">
		<!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</footer>
	<!--/Footer-->
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