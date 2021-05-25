<?php
require('../connect/conn.php');
require('../model/User.php');
if (isset($_SESSION['cust_id'])) {
	$datauser = getDataUser($_SESSION['cust_id']);
	$data_cart = getcartCount($_SESSION['cust_id']);
	$data_check = getcheckCount($_SESSION['cust_id']);
	$proses_count = getProsesCount($_SESSION['cust_id']);
} else {
	$data_cart['juml'] = 0;
	$data_check['juml'] = 0;
	$proses_count['juml'] = 0;
}

if (isset($_GET['id'])) {
	$id_item = $_GET['id'];
	$data = getDetailitem($id_item);
	$img = getImgItem($data['item_id']);
	$img2 = getImgItem2($data['item_id']);
	$ukuran = getUkuranItem($data['item_id']);
	$data_type = getTypeitem($data['type_id']);
	$data_color = getColoritem($data['color_id']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Product Details | E-Shopper</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/prettyPhoto.css" rel="stylesheet">
	<link href="../css/price-range.css" rel="stylesheet">
	<link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" crossorigin="anonymous">

</head>
<!--/head-->
<style>
	.responsive {
		width: 100%;
		max-width: 400px;
		height: auto;
	}

	.img2>a>img {
		height: 60px !important;
		width: 60px !important;
		margin-right: 10px !important;
		margin-bottom: 10px !important;
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
							<a href="../"><img width="100" src="../images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php
								if (!isset($_SESSION['cust_id'])) {
								?>
									<li><a href="../login.php"><i class="fa fa-user"></i> Akun</a></li>
								<?php
								} else {
									$data_user = custLogin($_SESSION['cust_id']);
								?>
									<?php if ($proses_count['juml'] != 0) { ?>
										<li><a href="../profile.php"><img src="../images/Profile/<?php echo $datauser['cust_img'] ?>" style=" width:25px;height: 25px; border-radius: 50%;" />
												<span><?php echo $datauser['cust_name']; ?></span>
												<span class="badge"><?php echo $proses_count['juml']; ?></span>
											</a>
										</li>
									<?php } else { ?>
										<li><a href="../profile.php"><img src="../images/Profile/<?php echo $datauser['cust_img'] ?>" style=" width:25px;height: 25px; border-radius: 50%;" /> <?php echo $datauser['cust_name']; ?></a></li>
									<?php } ?>
								<?php
								}
								?>
								<!-- checkout -->
								<?php if ($data_check['juml'] != 0) { ?>
									<li><a href="../checkout.php" class="notification"><i class="fa fa-shopping-cart"></i>
											<span>Pengiriman</span>
											<span class="badge"><?php echo $data_check['juml']; ?></span>
										</a>
									</li>
								<?php } else { ?>
									<li><a href="../checkout.php" class="notification"><i class="fa fa-crosshairs"></i>Pengiriman</a></li>
								<?php } ?>
								<!-- cart -->
								<?php if ($data_cart['juml'] != 0) { ?>
									<li><a href="../cart.php" class="notification"><i class="fa fa-shopping-cart"></i>
											<span>Keranjang</span>
											<span class="badge"><?php echo $data_cart['juml']; ?></span>
										</a>
									</li>
								<?php } else { ?>
									<li><a href="../cart.php" class="notification"><i class="fa fa-shopping-cart"></i>Keranjang</a></li>
								<?php } ?>
								<?php
								if (!isset($_SESSION['cust_id'])) {
								?>
									<li><a href="../login.php"><i class="fa fa-lock"></i> Masuk</a></li>
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
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="../">Beranda</a></li>
								<li><a href="aboutus.php">Tentang kami</a></li>
								<li><a href="contactus.php">Kontak Kami</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header-bottom-->
	</header>
	<!--/header-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-11 padding-right">
					<div class="product-details">
						<!--product-details-->
						<div class="col-sm-5">
							<div class="containere">
								<div class="view-product">
									<img style="width:500px; height:auto;" class="responsive jumbo" src="../../dist/img/item/<?php echo $img['img_name']; ?>" alt="" />
								</div>
								<div>
									<div class="img2">
										<?php while ($data_img = mysqli_fetch_assoc($img2)) { ?>
											<a href='../../dist/img/item/<?php echo $data_img['img_name']; ?>' data-toggle="lightbox" data-gallery="gallery">
												<img style="width:20%; height:auto;" src="../../dist/img/item/<?php echo $data_img['img_name']; ?>" alt=""></a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information" style="float:right;width: 300px;">
								<!--/product-information-->
								<h2><?php echo $data['item_name']; ?></h2>
								<span>
									<span>Rp. <?php echo number_format($data['item_price']); ?></span>
									<br>
									<label>Jumlah:</label>
									<form action="./model/User.php" method="post">
										<input type="number" min='1' value="1" required name="qty" id="qty" />
										<input type="hidden" name="item_id" id="item_id" value="<?php echo $data['item_id'] ?>">
										<br>
										<br>
										<p><b> Ukuran : </b>
											<select name="ukuran" id="ukuran">
												<?php while ($data_ukuran = mysqli_fetch_assoc($ukuran)) { ?>
													<option id="<?php echo $data_ukuran['detail_qty'] ?>" value="<?php echo $data_ukuran['size_name'] ?>"><?php echo $data_ukuran['size_name'] ?></option>
												<?php } ?>
											</select>
										</p>
										<br>
										<p><b>Warna: </b><?php echo $data_color['color_name']; ?></p>
										<p><b>Kategori: </b> <?php echo $data_type['type_name']; ?></p>
										<p><b>Deskripsi: </b> <?php echo $data['item_desc']; ?></p>
										<br>
										<button type="submit" name="addchart" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Masukan Keranjang</button>
									</form>
								</span>

							</div>
							<!--/product-information-->
						</div>
					</div>
					<!--/product-details-->
				</div>
			</div>
	</section>
	<!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
	<script src="../js/jquery.js"></script>
	<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="../js/price-range.js"></script>
	<script src="../js/jquery.scrollUp.min.js"></script>
	<!-- <script src="../js/bootstrap.min.js"></script> -->
	<script src="../js/jquery.prettyPhoto.js"></script>
	<script src="../js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" crossorigin="anonymous"></script>

	<script>
		$(function() {
			var qty = $("#ukuran > option:selected").attr('id');
			$("#qty").attr('max', qty);
		});

		$('#ukuran').change(function() {
			var qty = $("#ukuran > option:selected").attr('id');
			$("#qty").attr('max', qty);
		})
		// lighbox
		$(document).on("click", '[data-toggle="lightbox"]', function(event) {
			event.preventDefault();
			$(this).ekkoLightbox();
		});
	</script>
</body>

</html>