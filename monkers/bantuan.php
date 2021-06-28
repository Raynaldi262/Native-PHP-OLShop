<?php
require('../model/User.php');
require('../connect/conn.php');

if (isset($_SESSION['cust_id'])) {
	$item = getDataCheck($_SESSION['cust_id']);
	$dataprofile = getDataUser($_SESSION['cust_id']);


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

input[type=text], select,input[type=number],input[type=email],input[type=date] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
.text{
	margin: 50px ;
	text-align: justify;
	text-justify: inter-word;
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
			<div class="breadcrumbs">
			<div class="mainmenu pull-left">
				<ul class="nav navbar-nav collapse navbar-collapse">
					<li><a href="index.php">Beranda</a></li>
					<li><a href="aboutus.php">Tentang kami</a></li>
					<li><a href="bantuan.php" class="active">Bantuan</a></li>
					<li><a href="syarat_ketentuan.php">Syarat & Ketentuan</a></li>
					<li><a href="contactus.php">Kontak Kami</a></li>
				</ul>
			</div>
			</div>
			<br>
			<br>
			<div>
				<h1 style="text-align:center">Bantuan</h1>
			</div><!-- 
			<button  style="background-color:grey;" type="button" class="btn btn-default check_out" data-toggle="modal" data-target="#tambahalamat">Tambah Alamat</button> -->

		</div>
	</section>
	<div class="text">
	<p>
		<h3>Cara Login & Daftar</h3>
		<ol>
			<li>Masuk ke menu login</li>
			<li>Masuk dengan akun yang sudah ada lalu klik masuk</li>
			<li>atau jika belum memiliki akun daftar pada kolom pendaftaran</li>
			<li>Isi data sesuai dengan data pribadi anda</li>
			<li>Lalu jika sudah klik daftar</li>
		</ol>
			<h3>Cara Pemesanan</h3>
		<ol>
		<li>Login dengan akun yang sudah daftar sebelumnya</li>
		<li>Pilih dan klik produk Monkers Apparel yang ingin di beli</li>
		<li>Pilih jumlah dan ukuran yang ingin di beli (Produk dan Ukuran yang tidak tersedia tidak akan muncul di website)</li>
		<li>Klik masukan ke keranjang</li>
		<li>Cek Kembali barang belanjaan dikeranjang, kalau sudah sesuai klik beli</li>
		<li>Pilih alamat dan pilih jenis kurir yang diinginkan</li>
		<li>Klik Bayar, akan muncul popup nomor rekening kami dan anda dapat mengupload bukti pembayaran disana (bukti pembayaran harus berekstensi .Jpg , .Jpeg, dan .Png)</li>
		<li>Setelah itu klik upload</li>
		<li>Selamat anda telah berhasil melakukan pemesanan</li>
		</ol>
			<h3>Cara Cek Status Pesanan & Cetak Invoice</h3>
		<ol>
		<li>Klik mennu profile</li>
		<li>Scroll ke bawah makan anda akan melihat table proses yang menampilkan status pesanan</li>
		<li>Klik “Detail” untuk melihat invoice pesanan yang dipilih</li>
		<li>Klik Cetak Inovice untuk mencetak invoice dari pesana yang sudah terkonfirmasi </li>
		</ol>
	</p>
	</div>
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