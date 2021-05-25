<?php
require('../model/User.php');
require('../connect/conn.php');
$data_area = getDataArea($conn)
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Login | Monkers Apparel</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
</head>
<!--/head-->
<style>
	#form {
		margin-top: -20px;
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
								<li><a href="../monkers/login.php"><i class="fa fa-user"></i> Akun</a></li>
								<li><a href="checkout.php"><i class="fa fa-crosshairs"></i> Pengiriman</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Keranjang</a></li>
								<li><a href="login.php" class="active"><i class="fa fa-lock"></i> Masuk</a></li>
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
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Beranda</a></li>
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
	<section id="form">
		<!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
						<!--login form-->
						<h2>Login </h2>
						<form action="../login_user/login_check_user.php" method="post">
							<h5>Email :</h5>
							<input type="text" placeholder="email" name="email" required />
							<h5>Kata Sandi :</h5>
							<input type="password" placeholder="password" name="password" required />
							<button type="submit" style="background-color:grey;" name="login" class="btn btn-default">Masuk</button>
						</form>
					</div>
					<!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 style="background-color:grey;" class="or">Atau</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form">
						<!--sign up form-->
						<h2>Buat Akun Baru</h2>
						<form action="../model/User.php" method="post">
							<h5>Nama :</h5>
							<input type="text" name="nama" placeholder="Name" required />
							<h5>Email :</h5>
							<input type="email" name="email" placeholder="Email" required />
							<h5>Kata Sandi :</h5>
							<input type="password" name="password" placeholder="Kata Sandi" min='1' max='50' required />
							<h5>Tanggal Lahir :</h5>
							<input type="date" name="ultah" placeholder="Tanggal Lahir" required />
							<h5>No Hp :</h5>
							<input type="number" name="nohp" placeholder="Nomor Hp" required />
							<h5>Alamat :</h5>
							<input type="text" name="address" placeholder="Alamat" required />
							<h5>Kota :</h5>
							<select name="kota" id="kota">
								<?php while ($data = mysqli_fetch_assoc($data_area)) { ?>
									<option value="<?php echo $data['area_name'] ?>"><?php echo $data['area_name'] ?></option>
								<?php } ?>
							</select>
							<br>
							<br>
							<button type="submit" style="background-color:grey;" name="singup" class="btn btn-default">Daftar</button>
						</form>
					</div>
					<!--/sign up form-->
				</div>
			</div>
		</div>
	</section>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>