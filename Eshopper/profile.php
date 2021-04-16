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
    <title>Cart | E-Shopper</title>
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
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header-middle"><!--header-middle-->
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
								if(!isset($_SESSION['cust_id'])){
									?>
									<li><a href="/SkripsiR/Eshopper/login.php"><i class="fa fa-user"></i> Account</a></li>
									<?php
								}else{
									$data = custLogin($_SESSION['cust_id']);
									?>
								<?php if($proses_count['juml'] != 0){?>
								<li><a href="/SkripsiR/Eshopper/profile.php"><img src="images/Profile/<?php echo $datauser['cust_img']?>" 
									 style=" width:25px;height: 25px; border-radius: 50%;"/>
									 <span><?php echo $data['cust_name'];?></span>
								 	<span class="badge"><?php echo $proses_count['juml']; ?></span>
								 	</a>
								</li>
								<?php }else{ ?>
									<li><a href="/SkripsiR/Eshopper/profile.php"><img src="images/Profile/<?php echo $datauser['cust_img']?>" 
								 style=" width:25px;height: 25px; border-radius: 50%;"/> <?php echo $data['cust_name'];?></a></li>
								<?php } ?>
								<?php
								}
								?>
								<!-- checkout -->
								<?php if($data_check['juml'] != 0){?>
								<li><a href="checkout.php" class="notification"><i class="fa fa-shopping-cart"></i>												
									<span>Checkout</span>
 									<span class="badge"><?php echo $data_check['juml']; ?></span>
									</a>
								</li>
								<?php }else{ ?>
									<li><a href="checkout.php" class="notification"><i class="fa fa-crosshairs"></i>Checkout</a></li>
								<?php } ?>
								<!-- cart -->
								<?php if($data_cart['juml'] != 0){?>
								<li><a href="cart.php" class="notification"><i class="fa fa-shopping-cart"></i>												
									<span>Cart</span>
 									<span class="badge"><?php echo $data_cart['juml']; ?></span>
									</a>
								</li>
								<?php }else{ ?>
									<li><a href="cart.php" class="notification"><i class="fa fa-shopping-cart"></i>Cart</a></li>
								<?php } ?>
								<?php
								if(!isset($_SESSION['cust_id'])){
									?>
									<li><a href="/SkripsiR/Eshopper/login.php"><i class="fa fa-lock"></i> Login</a></li>
									<?php
								}else{
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
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
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
		</div><!--/header-bottom-->
	</header><!--/header-->
		<section id="do_action">
		<div class="container" >
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="../Eshopper/">Home</a></li>
				</ol>
			</div>
			<div class="row">
				<div class="total_area">
						<div class="heading" style="text-align:center;">
							<h3>Data Pribadi</h3>
						</div>
						<div style="text-align:center;" >
							<img src="images/Profile/<?php echo $datauser['cust_img']?>" 
								 style="object-fit:contain; width:300px;height: 300px; border: solid 1px #CCC; border-radius: 50%;"/>
						</div>
						<ul>
							<li>Name : <?php echo $datauser['cust_name']?></li>
							<li>Tanggal Lahir : <?php echo $datauser['cust_birth']?></li>
							<li>Provinsi : <?php echo $datauser['cust_province']?></li>
							<li>Kota : <?php echo $datauser['cust_city']?></li>
							<li>Alamat :  <?php echo $datauser['cust_address']?></li>
							<li>no Hp :  <?php echo $datauser['cust_phone']?></li>
							<li>Email : <?php echo $datauser['cust_email']?></li>
						</ul>
						<div style="text-align:center;">
							<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Ubah Profile</button>
							<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">Ubah Password</button>
						</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	<div class="modal fade" id="myModal" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Update Profile</h4>
					<div class="signup-form"><!--sign up form-->
						<form action="../model/User.php" method="post" enctype="multipart/form-data">
							<h5>Foto Profile :</h5>
							<input type="file" name="img"/>
							<h5>Nama :</h5>
							<input type="text" name="nama" value="<?php echo $datauser['cust_name']?>" required/>
							<h5>Email :</h5>
							<input type="email" name="email" value="<?php echo $datauser['cust_email']?>" required/>
							<h5>Tanggal Lahir :</h5>
							<input type="date" name="ultah" value="<?php echo $datauser['cust_birth']?>" required/>
							<h5>No Hp :</h5>
							<input type="number" name="nohp" value="<?php echo $datauser['cust_phone']?>" required/>
							<h5>Alamat :</h5>
							<input type="text" name="address" value="<?php echo $datauser['cust_address']?>" required/>
							<h5>Provinsi :</h5>
							<input type="text" name="provinsi" value="<?php echo $datauser['cust_province']?>" required/>
							<h5>Kota :</h5>
							<select name="kota" id="kota">
							<?php while($data = mysqli_fetch_assoc($data_area)) { ?>
  								<option value="<?php echo $data['area_name'] ?>"><?php echo $data['area_name'] ?></option>
  							<?php } ?>
							</select>
							<br>
							<br>
							<button type="submit" name="updateprofile" class="btn btn-default">Update</button>
						</form>
					</div><!--/sign up form-->
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
					<div class="signup-form"><!--sign up form-->
						<form action="../model/User.php" method="post">
							<h5>Password Baru :</h5>
							<input type="Password" name="pass1" required/>
							<h5>Ketik Ulang Password :</h5>
							<input type="Password" name="pass2" required/>
							<button type="submit" name="UbahPassword" class="btn btn-default">Ubah</button>
						</form>
					</div><!--/sign up form-->
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
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td style="text-align: center">Proses id</td>
							<td style="text-align: center">Harga</td>
							<td style="text-align: center">Kurir</td>
							<td style="text-align: center">Status</td>
							<td style="text-align: center">Tanggal Bayar</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
							while ($data = mysqli_fetch_assoc($data_proses)){?>
						<tr>
							<td style="text-align: center">
								<h4><?php echo $data['date_id']?></h4>
							</td>
							<td style="text-align: center">
								<h4>Rp. <?php echo number_format($data['price'])?></h4>
							</td>
							<td style="text-align: center">
								<h4><?php echo $data['kurir']?></h4>
							</td>
							<td style="text-align: center">
								<h4><?php echo $data['status']?></h4>
							</td>
							<td style="text-align: center">
								<h4><?php echo $data['create_date']?></h4>
							</td>
							<td style="text-align: center">
							<a class="btn" href="/SkripsiR/Eshopper/detail_proses.php?id=<?php echo $data['date_id']?>" type="submit" name="detailproses" class="cart_quantity_delete">Detail</a>
							</td>
						</tr>
					<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->



	<footer id="footer"><!--Footer-->
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
		
	</footer><!--/Footer-->
	


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>