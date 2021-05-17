<?php
require('../model/User.php');
if (isset($_SESSION['cust_id'])) {
	$item = getDataCart($_SESSION['cust_id']);
	$datauser = getDataUser($_SESSION['cust_id']);
}
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
	<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->
<style>
.responsive {
  width: 70%;
  max-width: 200px;
  min-width: 100px;
  height: auto;
}
</style>
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
										<li><a href="../monkers/profile.php"><img src="images/Profile/<?php echo $datauser['cust_img'] ?>" style=" width:25px;height: 25px; border-radius: 50%;" />
												<span><?php echo $data['cust_name']; ?></span>
												<span class="badge"><?php echo $proses_count['juml']; ?></span>
											</a>
										</li>
									<?php } else { ?>
										<li><a href="../monkers/profile.php"><img src="images/Profile/<?php echo $datauser['cust_img'] ?>" style=" width:25px;height: 25px; border-radius: 50%;" /> <?php echo $data['cust_name']; ?></a></li>
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
											<span>Keranjang</span>
											<span class="badge"><?php echo $data_cart['juml']; ?></span>
										</a>
									</li>
								<?php } else { ?>
									<li><a href="cart.php" class="notification"><i class="fa fa-shopping-cart"></i>Keranjang</a></li>
								<?php } ?>
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
			<div class="breadcrumbs">
			<div class="mainmenu pull-left">
				<ul class="nav navbar-nav collapse navbar-collapse">
					<li><a href="index.php" >Home</a></li>
				</ul>
			</div>
			</div>
			<div>
				<h1 style="text-align:center">Keranjang</h1>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr  style="background-color:grey;" class="cart_menu">
							<td style="text-align: center">Gambar</td>
							<td style="text-align: center">Nama</td>
							<td style="text-align: center">Tipe</td>
							<td style="text-align: center">Jumlah</td>
							<td style="text-align: center">Ukuran</td>
							<td style="text-align: center">Harga</td>
							<td style="text-align: center">Hapus</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						if (isset($_SESSION['cust_id'])) {
							while ($data_cart = mysqli_fetch_assoc($item)) {
								$item_cart = getItemcart($data_cart['item_id']);
								$data_type = getTypeitem($item_cart['type_id']);
								$img = getImgItem($data_cart['item_id']);
								$totalharga += $item_cart['item_price'] * $data_cart['qty'];
						?>
								<tr>
									<td class="cart_product">
										<a href="../monkers/product_details.php/?id=<?php echo $data_cart['item_id']; ?>">
											<img class="responsive" style="width:200px" src="../dist/img/item/<?php echo $img['img_name']; ?>" alt="">
										</a>
									</td>
									<td  style="text-align: center">
										<h4><?php echo $item_cart['item_name'] ?></h4>
									</td>
									<td  style="text-align: center">
										<p><?php echo $data_type['type_name'] ?></p>
									</td>
									<td  style="text-align: center">
										<p><?php echo $data_cart['size'] ?></p>
									</td>
									<td style="text-align: center">
										<div >
											<?php echo $data_cart['qty'] ?>
										</div>
									</td>
									<td>
										<p class="cart_total_price" style="text-align: center">Rp. <?php echo number_format($item_cart['item_price']) ?></p>
									</td>
									<td class="cart_delete" style="text-align: center">
										<form action="../model/User.php" method="post">
											<input type="hidden" name="cart_id" value="<?php echo $data_cart['cart_id'] ?>">
											<button type="submit" name="deletecart" class="cart_quantity_delete"><i class="fa fa-times"></i></button>
										</form>
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

	<?php if ($totalharga != 0) { ?>
		<section id="do_action">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-offset-3">
						<div class="total_area">
							<div class="heading" style="text-align:center;">
								<h3>Total Harga</h3>
							</div>
							<ul>
								<!-- 							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li> -->
								<li>Total <span>Rp. <?php echo number_format($totalharga); ?></span></li>
							</ul>
							<form action="../model/User.php" method="post" style="text-align:center;">
								<input type="hidden" name="cust_id" value="<?php echo $_SESSION['cust_id'] ?>">
								<button type="submit" name="checkout" class="btn btn-default check_out">Check Out</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/#do_action-->
	<?php } ?>
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



	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>
</body>

</html>