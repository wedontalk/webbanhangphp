<!-- Start Banner Area -->
<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['user_name'];
		$password = md5($_POST['password']);
		$repassword = md5($_POST['repassword']);
		$data = [
			'name' =>$name,
			'email' =>$email,
			'user_name'=>$username,
			'password' =>$password
		];
		$submit = $us->register($data);
	}
?>

<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Đăng Nhập/Đăng ký</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Trang Chủ<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=login">Đăng Nhập/Đăng ký</a>
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
				<div class="col-lg-12">
					<div class="login_form_inner">
						<?php
							if(isset($submit)){
							echo '<div class="alert alert-danger" role="alert">'.$submit.'</div>';
							}
						?>
						<h3>Đăng Ký Tài Khoản</h3>
						<form class="row login_form" action="" method="post" id="contactForm" novalidate="novalidate">
							<input type="hidden" name="page" value="register">
							<div class="col-md-6 form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Họ Và Tên" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Họ Và tên'">
							</div>
                            <div class="col-md-6 form-group">
								<input type="text" class="form-control" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Tài Khoản" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tài Khoản'">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Mật Khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mật Khẩu'">
							</div>
                            <div class="col-md-12 form-group">
								<input type="password" class="form-control" id="repassword" name="repassword" placeholder="Nhập lại Mật Khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập Lại Mật Khẩu'">
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Đăng Ký</button>
								<!-- <a href="#">Quên Mật Khẩu ?</a> -->
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->