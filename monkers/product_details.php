<?php require('../connect/conn.php');
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
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Product Details | E-Shopper</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/prettyPhoto.css" rel="stylesheet">
	<link href="../css/price-range.css" rel="stylesheet">
	<link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
	<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="../images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->
<style>
.responsive {
  width: 100%;
  max-width: 400px;
  height: auto;
}

.thumb:hover{
    opacity: 50%;
    cursor: pointer;
}

@keyframes fadeIn{
    to{
        opacity: 1;
    }
}

.fade{
    opacity: 0;
    animation: fadeIn 0.5s forwards;
}

.aktif{
    opacity: 0.5;
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
									<li><a href="../login.php"><i class="fa fa-user"></i> Account</a></li>
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
											<span>Checkout</span>
											<span class="badge"><?php echo $data_check['juml']; ?></span>
										</a>
									</li>
								<?php } else { ?>
									<li><a href="../checkout.php" class="notification"><i class="fa fa-crosshairs"></i>Checkout</a></li>
								<?php } ?>
								<!-- cart -->
								<?php if ($data_cart['juml'] != 0) { ?>
									<li><a href="../cart.php" class="notification"><i class="fa fa-shopping-cart"></i>
											<span>Cart</span>
											<span class="badge"><?php echo $data_cart['juml']; ?></span>
										</a>
									</li>
								<?php } else { ?>
									<li><a href="../cart.php" class="notification"><i class="fa fa-shopping-cart"></i>Cart</a></li>
								<?php } ?>
								<?php
								if (!isset($_SESSION['cust_id'])) {
								?>
									<li><a href="../login.php"><i class="fa fa-lock"></i> Login</a></li>
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
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="../">Home</a></li>
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
								<div id="similar-product" class="carousel slide" data-ride="carousel">
									<!-- Wrapper for slides -->
									  <div class="carousel-inner">
										  <div class="item active thumbnail">
										  <?php while($data_img = mysqli_fetch_assoc($img2)){?>
											<a><img style="width:20%; height:auto;" class="thumb" src="../../dist/img/item/<?php echo $data_img['img_name']; ?>" alt=""></a>
											<?php } ?>
										  </div>
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
									<label>Quantity:</label>
									<form action="./model/User.php" method="post">
										<input type="number" min='1' value="1" required name="qty" />
										<input type="hidden" name="item_id" value="<?php echo $data['item_id'] ?>">
										<br>
										<br>
										<p><b> Ukuran : </b>
											<select name="ukuran">
											<?php while($data_ukuran = mysqli_fetch_assoc($ukuran)){ ?>
											  <option value="<?php echo $data_ukuran['size_name'] ?>"><?php echo $data_ukuran['size_name'] ?></option>
											  <?php }?>
											</select>
										</p>
											<br>
											<p><b>Warna: </b><?php echo $data_color['color_name']; ?></p>
											<p><b>Kategori: </b> <?php echo $data_type['type_name']; ?></p>
											<p><b>Deskripsi: </b> <?php echo $data['item_desc']; ?></p>
											<br>
										<button type="submit" name="addchart" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
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
										<img src="../images/home/iframe1.png" alt="" />
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
										<img src="../images/home/iframe2.png" alt="" />
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
										<img src="../images/home/iframe3.png" alt="" />
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
										<img src="../images/home/iframe4.png" alt="" />
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
							<img src="../images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--/Footer-->



	<script src="../js/jquery.js"></script>
	<script src="../js/price-range.js"></script>
	<script src="../js/jquery.scrollUp.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.prettyPhoto.js"></script>
	<script src="../js/main.js"></script>
	<script type="text/javascript">
		const jumb = document.querySelector('.jumbo');
		const asd = document.querySelector('.containere');
		const thumb = document.querySelectorAll('div.thumbnail img');

	asd.addEventListener('click',function(e){
	console.log(e.target)

	jumb.classList.add('fade'); //tambah class
	setTimeout(function(){
		jumb.classList.remove('fade');
	},500)
	jumb.src = e.target.getAttribute('src');	
	
	
	for(let i = 0 ; i < thumb.length ; i++){
		thumb[i].className = 'thumb'
	}
		
		//row2.className = 'thumb';
	e.target.classList.add('aktif');
	})

	</script>
</body>

</html>