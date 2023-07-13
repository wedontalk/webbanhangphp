<?php
    $filepath = realpath(dirname(__FILE__));
   include_once(__DIR__.'./../../lib/session.php');
   Session::init();
   $page_title = "web bán hàng test";
?>
<?php
	include_once($filepath.'/../../lib/database.php');
	include_once($filepath.'/../../helpers/format.php');
	spl_autoload_register(function($className){
		include_once(__DIR__."/../../controller/".strtolower($className).".php");
	});
	$db = new Database();
	$fm = new Format();
	$ct = new CartController();
	$sl = new SlideController();
	$us = new UserController();
	$cate = new CategoryController();
	$prd = new ProductController();
	$brad = new BrandController();
?>
<?php
	header('Cache-control: no-cache, must-revalidate');
	header('pragma: no-cache');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	header('Cache-Control: max-age-2592000');
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="./public/site/img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title><?=$page_title?></title>
	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="./public/site/css/linearicons.css">
	<link rel="stylesheet" href="./public/site/css/font-awesome.min.css">
	<link rel="stylesheet" href="./public/site/css/themify-icons.css">
	<link rel="stylesheet" href="./public/site/css/bootstrap.css">
	<link rel="stylesheet" href="./public/site/css/owl.carousel.css">
	<link rel="stylesheet" href="./public/site/css/nice-select.css">
	<link rel="stylesheet" href="./public/site/css/nouislider.min.css">
	<link rel="stylesheet" href="./public/site/css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="./public/site/css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="./public/site/css/magnific-popup.css">
	<link rel="stylesheet" href="./public/site/css/main.css">
		<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
	<style>
		.img-fluid {
			max-width: 100%;
			height: auto;
			min-height:250px;
			max-height:300px;
		}
		.thongtin li{
			cursor: url(https://cdn.custom-cursor.com/db/18131/32/cartoons-chikn-nuggit-sassparilla-pointer.png), pointer !important;
		}
	</style>
</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="./index.php"><img src="./public/site/img/logo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item active"><a class="nav-link" href="./index.php">Trang Chủ</a></li>
							<li class="nav-item"><a class="nav-link" href="?page=product">Cửa Hàng</a></li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Danh Mục</a>
								<ul class="dropdown-menu">
									<?php
										foreach ($cate->select_cate_user_menu() as $key => $value):
									?>
									<li class="nav-item"><a class="nav-link" href="?page=category&cate=<?=$value['slug']?>"><?php echo $value['name_cate']?></a></li>
									<?php endforeach;?>
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="?page=news">Tin Tức</a></li>
							<li class="nav-item"><a class="nav-link" href="contact.html">Liên Hệ</a></li>
						

							<?php if(Session::get('loginUser',true)):?>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false"><?php echo 'Xin Chào - '.Session::get('nameUser')?></a>
								<ul class="dropdown-menu thongtin">
									<li class="nav-item"><a class="nav-link" href="?page=information">Thông Tin User</a></li>
									<li class="nav-item"><a class="nav-link" <?=(Session::get('cart') != null) ? 'href="?page=cart"':'onclick="click_message()"'?>>Giỏ Hàng</a></li>
									<li class="nav-item"><a class="nav-link" href="?page=register">Sản Phẩm Yêu Thích</a></li>
									<form action="" method="post">
										<li class="nav-item">
										<button class="genric-btn default nav-link" style="width:100%;display:inline-flex" name="log_out">Đăng Xuất</button></li>
									</form>
									<?php
										if(isset($_POST["log_out"])){
										// session_unset();
										Session::destroy();
										}
									?>
								</ul>
							</li>
							<?php else:?>
								<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Đăng Nhập</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="?page=login">Đăng Nhập</a></li>
									<li class="nav-item"><a class="nav-link" href="?page=register">Đăng Ký</a></li>
								</ul>
							</li>
							<?php endif;?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
	
							<li class="nav-item"><a <?=(Session::get('cart') != null) ? 'href="?page=cart"':'onclick="click_message()"'?> class="cart"><span class="ti-bag"></span></a></li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between" role="search" action="" method="GET">
					<input type="hidden" name="page" value="search">
					<input type="text" class="form-control" id="search_input" name="query" value="<?php echo (isset($_GET["query"]) && $_GET["query"]!=""?$_GET["query"]:"")?>" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->