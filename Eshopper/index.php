<?php require('../model/User.php');
require('../connect/conn.php');
if(isset($_SESSION['cust_id'])){
	$data_cart = getcartCount($_SESSION['cust_id']);
	$data_check = getcheckCount($_SESSION['cust_id']);
	$datauser = getDataUser($_SESSION['cust_id']);
	$proses_count = getProsesCount($_SESSION['cust_id']);	
}else{
	$data_cart['juml'] = 0;
	$data_check['juml'] = 0;
	$proses_count['juml'] = 0;
}

$data_banner = getDataBanner($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
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
</head><!--/head-->
<style>
.centere {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
</style>
<body>	
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
									<li><a href="./Eshopper/login.php"><i class="fa fa-user"></i> Account</a></li>
									<?php
								}else{
									$data = custLogin($_SESSION['cust_id']);
									?>
								<?php if($proses_count['juml'] != 0){?>
								<li><a href="../Eshopper/profile.php"><img src="images/Profile/<?php echo $datauser['cust_img']?>" 
									 style=" width:25px;height: 25px; border-radius: 50%;"/>
									 <span><?php echo $data['cust_name'];?></span>
								 	<span class="badge"><?php echo $proses_count['juml']; ?></span>
								 	</a>
								</li>
								<?php }else{ ?>
									<li><a href="../Eshopper/profile.php"><img src="images/Profile/<?php echo $datauser['cust_img']?>" 
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
									<li><a href="../Eshopper/login.php"><i class="fa fa-lock"></i> Login</a></li>
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
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.php" ></a></li> 
										<li><a href="login.php">Login</a></li> 
                                    </ul>
                                </li> 
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
						<?php $active = 'active';
						while ($data_ban = mysqli_fetch_assoc($data_banner)){?>
							<div class="item <?php echo $active ?>">
								<div class="col-sm-6">
									<img style="width: 1000px; height: 500px;" src="../dist/img/banner/<?php echo $data_ban['banner_img']?>"alt="" />
								</div>
							</div>
							
						<?php $active = ''; } ?>
						</div>
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">				
				<div class="col-sm-15">
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tshirt" data-toggle="tab">Item</a></li>
							</ul>
						</div>
							<?php while ($data = mysqli_fetch_assoc($item_data)){?>
								<a href="../Eshopper/product_details.php/?id=<?php echo $data['item_id']; ?>">
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="../dist/img/item/<?php echo $data['item_img']; ?>" alt="" />
												<h2>Rp. <?php echo number_format($data['item_price']); ?></h2>
												<p><?php echo $data['item_name']; ?></p>
												<form action="../model/User.php" method="post">
													<input type="hidden" name="item_id" value="<?php echo $data['item_id']?>">
													<button type="submit" name="addchart" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</form>	
											</div>
										</div>
									</div>
								</div>
								</a>
								<?php }?>
						</div><!--/category-tab-->
				</div>
			</div>
		</div>
	</section>
	
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
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>