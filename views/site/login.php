<?php
    include_once('./helpers/userlogin.php');  // include login từ helpers
	Session::checkLogin_user();
    $class = new Userlogin();
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$username = $_POST['user_name'];
		$password = md5($_POST['password']);
		$login_check = $class->login_user($username, $password);
	}
?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Đăng Nhập/Đăng ký</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Trang Chủ<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=register">Đăng Nhập/Đăng ký</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="./public/site/img/login.jpg" alt="">
						<div class="hover">
							<h4>Bạn mới vào website của chúng tôi ?</h4>
							<p>Hãy đăng ký tài khoản ngay để nhận được những ưu đãi và trải nghiệm tuyệt vời nhé !!</p>
							<a class="primary-btn" href="?page=register">Tạo Tài Khoản ngay</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
						<?php
							if(isset($login_check)){
							echo '<div class="alert alert-danger" role="alert">'.$login_check.'</div>';
							}
						?>
					<div class="login_form_inner">
						<h3>Đăng Nhập</h3>
						<form class="row login_form" action="" method="POST" id="contactForm" novalidate="novalidate">
							<input type="hidden" name="page" value="login">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="user_name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="pass" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Ghi Nhớ</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Đăng Nhập</button>
								<a href="#">Quên Mật Khẩu ?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->