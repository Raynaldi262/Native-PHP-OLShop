<?php
require('../model/User.php');
require('../connect/conn.php');
$dataprofile = getDataUser($_SESSION['cust_id']);

if (isset($_SESSION['cust_id'])) {
	$item = getDataCheck($_SESSION['cust_id']);

	if (!isset($_GET['ida'])) {
	$datauser = getDataUser($_SESSION['cust_id']);
	}else{
	$datauser = getDataAlamat2($_GET['ida']);
	$address_id = $datauser['address_id'];
	}


	if (isset($_GET['id'])) {
		$data_onkir = getDataOngkir($_GET['id']);
	} else {
		$data_onkir['ongkir_price'] = 0;
	}
	$data_kurir = getDataKurir($datauser['cust_city']);
	$data_alamat = getDataAlamat($_SESSION['cust_id']);
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
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$totalharga = 0;
$totalberat = 0;
$data_area = getDataArea($conn);

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

	<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
									<li><a href="../monkers/login.php"><i class="fa fa-user"></i> Account</a></li>
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
									<li><a href="../monkers/login.php"><i class="fa fa-lock"></i> Login</a></li>
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
			<div class="mainmenu pull-left">
				<ul class="nav navbar-nav collapse navbar-collapse">
					<li><a href="index.php">Home</a></li>
				</ul>
			</div>
			</div>
			<div>
				<h1 style="text-align:center">Checkout</h1>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu" style="background-color:grey;">
							<td style="text-align: center">Gambar</td>
							<td style="text-align: center">Nama</td>
							<td style="text-align: center">Tipe</td>
							<td style="text-align: center">Ukuran</td>
							<td style="text-align: center">Jumlah</td>
							<td style="text-align: center">Harga</td>
							<!-- <td style="text-align: center">Berat</td> -->
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
									<td>
										<a href="../monkers/product_details.php/?id=<?php echo $item_cart['item_id']; ?>">
											<img class="responsive" src="../dist/img/item/<?php echo $img['img_name']; ?>" alt="">
										</a>
									</td>
									<td style="text-align: center">
										<h4><?php echo $item_cart['item_name'] ?></h4>
									</td>
									<td style="text-align: center">
										<p><?php echo $data_type['type_name'] ?></p>
									</td>
									<td style="text-align: center">
										<p><?php echo $data_check['size'] ?></p>
									</td>
									<td style="text-align: center">
										<div class="cart_quantity_button">
											<?php echo $data_check['qty'] ?>
										</div>
									</td>
									<td>
										<p class="cart_total_price" style="text-align: center">Rp. <?php echo number_format($item_cart['item_price']) ?></p>
									</td>
									<!-- <td class="cart_price" style="text-align: center">
										<p><?php //echo $item_cart['item_weight'] ?> Grm</p>
									</td> -->
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
							<h3>Alamat <?php echo $datauser['cust_name'] ?></h3>
						</div>
						<ul>
						<form action="../model/User.php" method="post">
							<select name="alamat" onchange="this.form.submit()" required>
								<?php if (isset($_GET['ida'])) { ?>
									<option value="" selected disabled><?php echo $datauser['cust_name'] ?></option>
								<?php } else { ?><option value="" selected disabled>Pilih Alamat</option> <?php } ?>
								<?php while ($alamat = mysqli_fetch_assoc($data_alamat)) { ?>
									<option value="<?php echo $alamat['address_id'] ?>"><?php echo $alamat['cust_name'] ?></option>
								<?php } ?>
									<option value="0" >Alamat Pribadi</option>
							</select>
							<?php if(isset($_GET['id'])){ ?>
							<input type="hidden" name="id" value="<?php echo $_GET['id']?>">
						<?php }?>
						<input type="hidden" name="link" value="<?php echo $actual_link?>">
						</form>
							<?php if (isset($_SESSION['cust_id'])) { ?>
								<li>Nama : <?php echo $datauser['cust_name'] ?></li>
								<li>Alamat : <?php echo $datauser['cust_address'] ?></li>
								<li>Kota : <?php echo $datauser['cust_city'] ?></li>
								<li>no Hp : <?php echo $datauser['cust_phone'] ?></li>
								<li>Email : <?php echo $datauser['cust_email'] ?></li>
							<?php } ?>
						</ul>
						<button  style="background-color:grey;" type="button" class="btn btn-default check_out" data-toggle="modal" data-target="#tambahalamat">Tambah Alamat</button>
						
					</div>
				</div>
				<!-- Jika tidak ada barang tombol bayar dihilangkan -->
				<?php if ($totalharga != 0) { ?>
					<div class="col-sm-6">
						<div class="total_area">
							<div class="heading" style="text-align:center;">
								<h3>Total Harga</h3>
							</div>
							<ul>
								<?php $hargaongkir = KiloBarang($totalberat, $data_onkir['ongkir_price']);
								$totalharga1 = $totalharga + $hargaongkir; ?>
								<form action="../model/User.php" method="post">
									<select name="ongkir" id="ongkir" onchange="this.form.submit()" required>
										<?php if (isset($_GET['id'])) { ?>
											<option value="" selected disabled><?php echo $data_onkir['ongkir_type'] ?></option>
										<?php } else { ?><option value="" selected disabled>Pilih Ongkir</option> <?php } ?>
										<?php while ($kurir = mysqli_fetch_assoc($data_kurir)) { ?>
											<option value="<?php echo $kurir['ongkir_id'] ?>"><?php echo $kurir['ongkir_type'] ?></option>
										<?php } ?>
									</select>
								<?php if(isset($_GET['ida'])){ ?>
									<input type="hidden" name="ida" value="<?php echo $_GET['ida']?>">
								<?php }?>
									<input type="hidden" name="link" value="<?php echo $actual_link?>">
								</form>
								<li>Berat : <span><?php echo $totalberat; ?> Gram</span></li>
								<li>Ongkir : <span>Rp. <?php echo number_format($hargaongkir); ?></span></li>
								<li>Total : <span>Rp. <?php echo number_format($totalharga1); ?></span></li>
							</ul>
							<form action="../model/User.php" method="post" style="text-align:center;">
								<button  style="background-color:grey;" type="button" class="btn btn-default check_out" data-toggle="modal" data-target="#myModal">Bayar</button>
								<button  style="background-color:grey;" type="submit" name="batalcheck" class="btn btn-default check_out">Batal</button>
							</form>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<!--Bayarrrrrrrrrrrrrrrn-->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Unggah Bukti Pembayaran</h4>
					<div class="signup-form">
						<form action="../model/User.php" method="post" enctype="multipart/form-data">
							<h5>Masukan Bukti Pembayaran :</h5>
							<input type="file" name="img" />
							<input type="hidden" name="kurir" value="<?php echo $data_onkir['ongkir_type']; ?>">
							<input type="hidden" name="hargaongkir" value="<?php echo $hargaongkir; ?>">
							<input type="hidden" name="addressid" value="<?php echo $address_id; ?>">
							<input type="hidden" name="nama" value="<?php echo $datauser['cust_name']; ?>">
							<input type="hidden" name="totalharga" value="<?php echo $totalharga; ?>">
							<button type="submit" name="bayar" class="btn btn-default">Upload</button>
						</form>
					</div>
					<!--/sign up form-->
				</div>
			</div>
		</div>
	</div>
		<!--add alamat-->
	<div class="modal fade" id="tambahalamat" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Alamat</h4>
					<div class="signup-form">
						<form action="../model/User.php" method="post">
							<h5>Nama :</h5>
							<input type="text" name="nama" placeholder="Name" required />
							<h5>Email :</h5>
							<input type="email" name="email" placeholder="Email" required />
							<h5>No Hp :</h5>
							<input type="number" name="nohp" placeholder="Nomor Hp" required />
							<h5>Alamat :</h5>
							<input type="text" name="address" placeholder="Alamat" required />
							<h5>Provinsi :</h5>
							<input type="text" name="provinsi" placeholder="Provinsi" required />
							<h5>Kota :</h5>
							<select name="kota" id="kota">
								<?php while ($data = mysqli_fetch_assoc($data_area)) { ?>
									<option value="<?php echo $data['area_name'] ?>"><?php echo $data['area_name'] ?></option>
								<?php } ?>
							</select>
							<br>
							<br>
							<button type="submit" name="tambahalamat"  style="background-color:grey;" class="btn btn-default">Tambah</button>
						</form>
					</div>
					<!--/sign up form-->
				</div>
			</div>
		</div>
	</div>
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
	<script>
		$('.selector select[name=perPage]').on('change', function(e) {
			$(e.currentTarget).closest('form').submit();
		});
	</script>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>
</body>

</html>