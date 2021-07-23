<?php
require('../model/User.php');
$item = getDataCheck($_SESSION['cust_id']);
$datauser = getDataUser($_SESSION['cust_id']);
$data_cart = getcartCount($_SESSION['cust_id']);
$data_check = getcheckCount($_SESSION['cust_id']);
$proses_count = getProsesCount($_SESSION['cust_id']);
$data_proses = getDataProses($_SESSION['cust_id']);
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
	<section id="do_action">
		<div class="container">
			<div class="breadcrumbs">
				<div class="mainmenu pull-left">
					<ul class="nav navbar-nav collapse navbar-collapse">
						<li><a href="index.php">Beranda</a></li>
						<li><a href="alamat_lain.php">Alamat lain</a></li>
						<li><a href="aboutus.php">Tentang kami</a></li>
						<li><a href="bantuan.php">Bantuan</a></li>
						<li><a href="syarat_ketentuan.php">Syarat & Ketentuan</a></li>
						<li><a href="contactus.php">Kontak Kami</a></li>
					</ul>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="total_area">
					<div class="heading" style="text-align:center;">
						<h3>Data Pribadi</h3>
					</div>
					<div style="text-align:center;">
						<img src="images/Profile/<?php echo $datauser['cust_img'] ?>" style="object-fit:contain; width:300px;height: 300px; border: solid 1px #CCC; border-radius: 50%;" />
					</div>
					<ul style="text-align:center; width:50%; margin: auto;">
						<li>Name : <?php echo $datauser['cust_name'] ?></li>
						<li>Tanggal Lahir : <?php echo $datauser['cust_birth'] ?></li>
						<li>Provinsi : <?php echo $datauser['cust_province'] ?></li>
						<li>Kota : <?php echo $datauser['cust_city'] ?></li>
						<li>Alamat : <?php echo $datauser['cust_address'] ?></li>
						<li>no Hp : <?php echo $datauser['cust_phone'] ?></li>
						<li>Email : <?php echo $datauser['cust_email'] ?></li>
						<br>
					</ul>
					<div style="text-align:center;">
						<button style="background-color:grey;" type="button" class="btn btn-lg" data-toggle="modal" data-target="#myModal">Ubah Profile</button>
						<button style="background-color:grey;" type="button" class="btn btn-lg" data-toggle="modal" data-target="#myModal1">Ubah Password</button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/#do_action-->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ubah Profile</h4>
					<div class="signup-form">
						<!--sign up form-->
						<form action="../model/User.php" method="post" enctype="multipart/form-data">
							<h5>Foto Profile :</h5>
							<input type="file" name="img" />
							<h5>Nama :</h5>
							<input type="text" name="nama" value="<?php echo $datauser['cust_name'] ?>" required />
							<h5>Email :</h5>
							<input type="email" name="email" value="<?php echo $datauser['cust_email'] ?>" required />
							<h5>Tanggal Lahir :</h5>
							<input type="date" name="ultah" value="<?php echo $datauser['cust_birth'] ?>" required />
							<h5>No Hp :</h5>
							<input type="number" name="nohp" value="<?php echo $datauser['cust_phone'] ?>" required />
							<h5>Alamat :</h5>
							<input type="text" name="address" value="<?php echo $datauser['cust_address'] ?>" required />
							<h5>Kota :</h5>
							<select name="kota" id="kota">
								<?php while ($data = mysqli_fetch_assoc($data_area)) { ?>
									<option value="<?php echo $data['area_name'] ?>"><?php echo $data['area_name'] ?></option>
								<?php } ?>
							</select>
							<br>
							<br>
							<button type="submit" style="background-color:grey;" name="updateprofile" class="btn btn-default">Ubah</button>
						</form>
					</div>
					<!--/sign up form-->
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal1" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ubah Password</h4>
					<div class="signup-form">
						<!--sign up form-->
						<form action="../model/User.php" method="post">
							<h5>Password Baru :</h5>
							<input type="Password" name="pass1" required />
							<h5>Ketik Ulang Password :</h5>
							<input type="Password" name="pass2" required />
							<button style="background-color:grey;" type="submit" name="UbahPassword" class="btn btn-default">Ubah</button>
						</form>
					</div>
					<!--/sign up form-->
				</div>
			</div>
		</div>
	</div>
	<section id="cart_items">
		<div class="container">
			<div>
				<h1 style="text-align:center">Proses</h1>
			</div>
			<div class="table-responsive cart_info">
				<table id="example1" class="table table-condensed">
					<thead>
						<tr style="background-color:grey;" class="cart_menu">
							<td style="text-align: center">Nama</td>
							<td style="text-align: center">Harga</td>
							<td style="text-align: center">Kurir</td>
							<td style="text-align: center">Ongkir</td>
							<td style="text-align: center">Status</td>
							<td style="text-align: center">Tanggal Bayar</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						while ($data = mysqli_fetch_assoc($data_proses)) { ?>
							<tr>
								<td style="text-align: center">
									<h4><?php echo $data['name'] ?></h4>
								</td>
								<td style="text-align: center">
									<h4>Rp. <?php echo number_format($data['price']) ?></h4>
								</td>
								<td style="text-align: center">
									<h4><?php echo $data['kurir'] ?></h4>
								</td>
								<td style="text-align: center">
									<h4><?php echo $data['ongkir'] ?></h4>
								</td>
								<td style="text-align: center">
									<h4><?php echo $data['status'] ?></h4>
								</td>
								<td style="text-align: center">
									<h4><?php echo substr($data['create_date'],0,10) ?></h4>
								</td>
								<?php if ($data['status'] != "Pesanan dibatalkan") { ?>
									<td style="text-align: center">
										<a class="btn" href="../monkers/detail_proses.php?id=<?php echo $data['date_id'] ?>&ida=<?php echo $data['address_id'] ?>" type="submit" name="detailproses" class="cart_quantity_delete">Detail</a>
									</td>
								<?php } else { ?>
									<td style="text-align: center">
										<p style="color:red;">&#10008;</p>
									</td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<script src="../plugins/jquery/jquery.min.js"></script>

	<!-- <script src="js/jquery.js"></script> -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>

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
				"autoWidth": false,
				"lengthMenu": [
					[10, 25, 50, -1],
					[10, 25, 50, "All"]
				],
				"scrollX": true
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		});
	</script>

</body>

</html>