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
					<li><a href="aboutus.php" class="active">Tentang kami</a></li>
					<li><a href="bantuan.php">Bantuan</a></li>
					<li><a href="syarat_ketentuan.php">Syarat & Ketentuan</a></li>
					<li><a href="contactus.php">Kontak Kami</a></li>
				</ul>
			</div>
			</div>
			<br>
			<div>
				<h1 style="text-align:center">Syarat & Ketentuan</h1>
			</div><!-- 
			<button  style="background-color:grey;" type="button" class="btn btn-default check_out" data-toggle="modal" data-target="#tambahalamat">Tambah Alamat</button> -->
		</div>
	</section>
	<div class="text">
	<p>
	<h3>A.	Ketentuan Umum </h3>
	<ol>
		<li>Dengan menggunakan, berbelanja dan/atau mendaftarkan diri Anda di website Monkers Apparel, berarti Anda setuju untuk terikat dan patuh pada syarat dan ketentuan yang berlaku.</li>
		<li>Syarat dan ketentuan ini dapat berubah sewaktu-waktu dan kami tidak berkewajiban untuk memberitahukannya kepada Anda.</li>
		<li>Syarat dan ketentuan ini kami buat untuk kepentingan bersama, untuk menjaga hak dan kewajiban masing-masing pihak, dan tidak dimaksudkan untuk merugikan salah satu pihak.</li>
	</ol>
	<h3>B.	Informasi Produk</h3>
	<ol>
		<li>Dengan melakukan transaksi pemesanan secara online di website Monkers Apparel, Anda kami anggap telah mengerti informasi produk yang akan Anda beli.</li>
		<li>Produk yang tersedia di website Monkers Apparel sesuai dengan katalog online. Kami berusaha menyajikan data seakurat mungkin tanpa rekayasa agar Anda selaku pembeli tidak dirugikan.</li>
		<li>Informasi produk kami peroleh secara resmi dari katalog produk, official website, brosur, maupun informasi pendukung lainnya dari pihak terkait.</li>
		<li>Perbedaan warna dalam foto/gambar produk yang kami tampilkan di website Monkers Apparel bisa diakibatkan oleh faktor pencahayaan dan setting/resolusi monitor komputer, dan karena itu tidak dapat dijadikan acuan.</li>
		<li>Harga produk dalam situs ini adalah benar pada saat dicantumkan.Harga yang tercantum adalah harga produk semata, tidak termasuk ongkos kirim. Ongkos kirim dihitung otomatis (berdasarkan harga dari jasa ekspedisi) sesuai dengan alamat pengiriman yang Anda berikan pada saat transaksi pemesanan.</li>
	</ol>
	<h3>C.	Pemesanan dan Pembatalan</h3>
	<ol>
		<li>Keterangan mengenai produk dan cara belanja di website Monkers Apparel kami anggap telah Anda pelajari terlebih dahulu.</li>
		<li>Kami meng-update informasi produk secara berkala. Tetapi, jika ada kesalahan teknis yang menyebabkan harga, stok, atau informasi lainnya menjadi tidak benar dan Anda terlanjur melakukan pemesanan, maka kami akan menginformasikan dan memberi pilihan kepada Anda untuk tetap memesan produk tersebut atau membatalkannya.</li>
		<li>Pembayaran harus dilakukan langsung dilakukan saat anda memesan produk dan mengupload bukti pembayaran ke menu yang sudah tersedia.</li>
		<li>Pembatalan pesanan dapat Anda lakukan sebelum pembayaran. Jika Anda telah melakukan pembayaran, pesanan tidak dapat Anda batalkan.</li>
	</ol>
	<h3>D.	Pembayaran</h3>
	<ol>
		<li>Mata uang yang dipakai untuk pembayaran adalah Rupiah (IDR	).
		<li>Pembayaran bisa melalui ATM, internet banking, mobile banking, maupun transfer antarbank ke rekening bank yang telah kami informasikan kepada Anda.</li>
		<li>Pembayaran dianggap lunas jika uang telah kami terima sesuai dengan jumlah yang harus dibayarkan. Segera lakukan konfirmasi kepada kami melalui fitur Konfirmasi Pembayaran yang tersedia di website.</li>
		<li>Segala biaya yang timbul dari transaksi pembayaran (seperti fee pihak ketiga, biaya transfer, biaya kliring, switching, dan sebagainya) ditanggung oleh pembeli.</li>
		<li>Keterlambatan proses transfer antarbank bukan tanggung jawab kami.</li>
		<li>Kelalaian penulisan rekening dan informasi lainnya atau kelalaian pihak bank pada saat Anda melakukan pembayaran bukan tanggung jawab kami.</li>
	</ol>
	<h3>E.	Pengiriman</h3>
	<ol>
		<li>Pesanan Anda akan kami kirim segera setelah pembayaran lunas. Status pemesanan dan nomor resi akan kami informasikan melalui fitur “Data Pribadi” di Website Monkers Apparel. </li>
		<li>Nomor Resi akan diinformasikan saat status pemesanan sudah berubah menjadi “Pesanan dikirim”</li>
		<li>Pesanan Anda akan kami kirim ke alamat yang Anda berikan saat transaksi pemesanan.</li>
		<li>Kesalahan Anda dalam memberikan alamat pengiriman sehingga menyebabkan paket kiriman tidak sampai atau tidak Anda terima bukan tanggung jawab kami.</li>
		<li>Pengiriman dilakukan oleh pihak jasa ekspedisi yang kami tunjuk sebagaimana telah kami tampilkan saat Anda melakukan transaksi pemesanan. Biaya pengiriman ditanggung oleh pembeli.</li>
		<li>Lama waktu pengiriman menyesuaikan paket ekspedisi yang Anda pilih saat transaksi pemesanan. Jaminan kepastian waktu pengiriman sepenuhnya menjadi tanggung jawab pihak jasa ekspedisi. Konpensasi atas keterlambatan dan atau kehilangan barang sepenuhnya tunduk pada peraturan pihak jasa ekspedisi.</li>
		<li>Anda dapat memantau status pengiriman melalui layanan “tracking” pada website dan Call Center pihak jasa ekspedisi yang bersangkutan. Anda juga dapat meminta bantuan kami untuk mengetahui status pengiriman pesanan Anda.</li>
		<li>Setelah paket kiriman Anda terima, segera konfirmasikan kepada kami melalui Bantuan (Whatsapp). Apabila Anda tidak melakukan konfirmasi penerimaan barang setelah 7 (tujuh) hari dari status pesanan menajdi “Pesanan dikirim”, maka kami anggap kiriman tersebut telah Anda terima.</li>
	</ol>
	<h3>F.	Retur Produk</h3>
	<ol>
		<li>Kami pastikan pesanan Anda telah kami cek ulang sesuai data pesanan serta kami kemas dengan baik sebelum kami kirim. Pada saat menerima paket kiriman, Anda wajib melakukan pengecekan terhadap kondisi produk.</li>
		<li>Jika produk yang Anda terima tidak sesuai data pesanan atau terdapat cacat produksi, maka produk tersebut dapat ditukarkan dengan produk yang sama kepada kami.</li>
		<li>Biaya pengiriman/pengembalian produk tidak sesuai pesanan atau cacat produksi kepada kami ditanggung oleh pembeli, sedangkan biaya pengiriman produk pengganti kepada Anda ditanggung oleh kami.</li>
		<li>Pemberitahuan penerimaan produk tidak sesuai pesanan atau cacat produksi kami layani paling lambat 7 (tujuh) hari dari status pesanan menajdi “Pesanan dikirim”,. Jika dalam batas waktu tersebut tidak ada pemberitahuan, maka produk yang kami kirimkan dianggap telah sesuai dengan data pesanan Anda dan tidak cacat produksi.</li>
		<li>Produk pengganti akan kami kirimkan kepada Anda segera setelah kami menerima dan memverifikasi pengembalian produk tidak sesuai pesanan atau cacat produksi dari Anda. Cantumkan keterangan mengenai produk yang Anda kirimkan kembali kepada kami untuk memudahkan kami melakukan verifikasi.</li>
		<li>Jika stok produk pengganti tidak tersedia di gudang, kami akan mengirimkannya setelah stok produk kembali tersedia. Dan jika stok produk pengganti telah habis, Anda dapat menukarnya dengan produk lain yang harganya sama (atau setara) atau Anda dapat meminta pengembalian uang sesuai jumlah yang telah Anda bayarkan kepada kami.</li>
		<li>Produk yang Anda beli di luar Website Monkers Apparel tidak dapat dikembalikan/ditukarkan kepada kami.</li>
	</ol>
	<h3>G.	Pengembalian Uang (Refund)</h3>
	<ol>
		<li>Pengembalian uang (refund) hanya berlaku untuk produk yang Anda tukarkan sementara kami tidak dapat mengirimkan kembali produk pengganti kepada Anda karena stok habis.</li>
		<li>Pengembalian uang dilakukan dalam waktu 10 hari kerja, terhitung sejak tanggal kesepakatan refund.</li>
		<li>Besarnya uang yang dikembalikan sesuai dengan jumlah yang tertera pada invoice untuk produk tersebut, ditambah ongkos kirim penukaran/pengembalian dari Anda kepada kami; sedangkan ongkos pengiriman produk dari kami kepada Anda tidak dapat diminta kembali.</li>
		<li>Pengembalian uang dilakukan melalui transfer ke rekening Anda.</li>
		<li>Kami akan memberikan konfirmasi kepada Anda dalam bentuk WA bahwa pengembalian uang telah kami lakukan.</li>
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