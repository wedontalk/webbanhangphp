	<?php
        // check xem nếu user đăng nhập rồi mới được vào trang thông tin 
        Session::check_user();
        if(Session::get('userID')){
            $id = Session::get('userID');
            $showusers = $us->show_user($id);
            $row = $showusers->fetch(PDO::FETCH_ASSOC);
            // show quận/huyện
            $id_provine_dis = $row['id_province'];
            $table_district = "SELECT * FROM district WHERE _province_id = '$id_provine_dis'";
            $show_district = $db->select($table_district);

            // show xã / phường
            $id_district_ward = $row['id_district'];
            $table_ward = "SELECT * FROM ward WHERE _district_id = '$id_district_ward'";
            $show_ward = $db->select($table_ward);


            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $id_province = $_POST['id_province'];
                    $id_district = $_POST['id_district'];
                    $id_wards = $_POST['id_wards'];
                    $address = $_POST['address'];
                    $data = [
                        'name' =>$name,
                        'email' =>$email,
                        'phone'=>$phone,
                        'id_province' =>$id_province,
                        'id_district' =>$id_district,
                        'id_wards'=>$id_wards,
                        'address'=>$address,
                    ];
                    $submit = $us->update($id, $data);
            }
        }        
    ?>
    
    <style>
        .picture-img img{
            display: block;
            margin:auto;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            padding: 5px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        }
        .group-user li a{
            color:#000;
        }
        .group-click{
            display: flex;
            flex-wrap: nowrap;
            justify-content: center;
        }
        #imageContainer img{
            width: 200px;
            height:200px;
            display:block;
            margin:auto;
            overflow:hidden;
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;

        }
        #imageContainer p{
            display: flex;
            justify-content:center;
        }
    </style>
    <!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Thông Tin Cá Nhân</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Trang Chủ<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=information">Thông Tin
                            <!-- <span class="lnr lnr-arrow-right"></span> -->
                        </a>
						<!-- <a href="category.html">Fashon Category</a> -->
					</nav>
				</div>
			</div>
		</div>
	</section>
    <section class="sample-text-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mt-3">
                    <div class="picture-img col-md-12">
                        <img src="./public/site/img/elements/d.jpg" alt="" class="">
                    </div>
                    <div class="col-md-12">
                    <div class="button-group-area mt-40 group-click">
                        <button class="genric-btn primary radius" data-toggle="modal" data-target="#chinhsua">Chỉnh sửa Avatar</button>
                        <button class="genric-btn primary radius">Mặt định</button>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <ul class="list-group group-user">
                            <li class="list-group-item"><a href="">Thông Tin Tài Khoản</a></li>
                            <li class="list-group-item"><a href="">Đổi Mật Khẩu</a></li>
                            <li class="list-group-item"><a href="">Sản Phẩm Yêu Thích</a></li>
                            <li class="list-group-item"><a href="">Lịch Sử Mua Hàng</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="col-md-8 mt-3">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-noti-tab" data-toggle="pill" href="#pills-noti" role="tab" aria-controls="pills-noti" aria-selected="true">Lịch Sử Thông Báo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Thông Tin Tài Khoản</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Cài Đặt Thông Báo</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                    <?php
                        if(isset($submit)){
                        echo '<div class="alert alert-danger" role="alert">'.$submit.'</div>';
                        }
                    ?>
                        <!-- lịch sử thông báo -->
                        <div class="tab-pane fade show active" id="pills-noti" role="tabpanel" aria-labelledby="pills-noti-tab">
                            <div class="card">
                                <div class="card-header">
                                    Thông Báo Từ Hệ Thống
                                </div>
                                <div class="card-body" style="min-height:200px">
                                    <ul>
                                        <li>Bạn Đã Cập Nhật Thông Tin Thành Công <hr></li>
                                        <li>Bạn Đã Đổi avatar - vào 29/12/2023 <hr></li>
                                        <li>Bạn Đã Cập Nhật Thông Tin Thành Công <hr></li>
                                        <li>Bạn Đã Cập Nhật Thông Tin Thành Công <hr></li>
                                        <li>Bạn Đã Cập Nhật Thông Tin Thành Công <hr></li>
                                        <li>Bạn Đã Cập Nhật Thông Tin Thành Công <hr></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- thông tin cá nhân -->
                        <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST">
                                        <input type="hidden" name="page" value="information">
                                      <div class="row">
                                        <div class="mb-3 col-md-6">
                                          <label for="firstName" class="form-label">Họ Và Tên</label>
                                          <input class="form-control" type="text" id="firstName" name="name" value="<?php echo Session::get('nameUser')?>" autofocus="">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                          <label for="email" class="form-label">E-mail</label>
                                          <input class="form-control" type="text" id="email" name="email" value="<?php echo Session::get('emailUser')?>" placeholder="john.doe@example.com">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                          <label class="form-label" for="phoneNumber">Số Điện Thoại</label>
                                          <div class="input-group input-group-merge">
                                            <span class="input-group-text">VN (+84)</span>
                                            <input type="text" id="phoneNumber" name="phone" class="form-control" value="<?php echo $row['phone']?>" placeholder="36 924 0111">
                                          </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                          <label for="state" class="form-label">Tỉnh / Thành Phố</label>
                                            <select id="id_city" class="form-select choose" name="id_province">
                                                <option selected>-- Chọn Tỉnh / Thành Phố --</option>
                                                <?php foreach ($us->select_thanhpho() as $key => $value):?>
                                                    <option value="<?php echo $value['id']?>" <?=($row['id_province'] == $value['id']) ? 'selected':''?>><?php echo $value['_name']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                          <label for="address" class="form-label">Quận / Huyện</label>
                                            <select id="province" class="form-select choose province" name="id_district" value="id_district">
                                                <option selected>-- Chọn Quận / Huyện --</option>
                                                <?php foreach ($show_district as $key => $value):?>
                                                    <option value="<?php echo $value['id']?>" <?=($row['id_district'] == $value['id']) ? 'selected':''?>><?php echo $value['_name']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">Phường / Xã</label>
                                            <select id="wards" class="form-select wards" name="id_wards">
                                                <option selected>-- Chọn Phường / Xã --</option>
                                                <?php foreach ($show_ward as $key => $value):?>
                                                    <option value="<?php echo $value['id']?>" <?=($row['id_wards'] == $value['id']) ? 'selected':''?>><?php echo $value['_name']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="address" class="form-label">Địa Chỉ Chi Tiết</label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']?>">
                                        </div>
                                      </div>
                                      <div class="mt-2">
                                        <button type="submit" class="btn btn-info me-2">Lưu Thông Tin</button>
                                        <!-- <button type="reset" class="btn btn-outline-secondary">reset</button> -->
                                      </div>
                                    </form>
                                  </div>
                            </div>
                        </div>
                        <!-- cài dặt thông báo -->
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="card">
                                <!-- Notifications -->
                                <h5 class="card-header">Chọn dịch Vụ</h5>
                                <div class="card-body">
                                <span>Chúng tôi cần sự cho phép của bạn để hiễn thị thông báo !
                                    <span class="notificationRequest"><strong>Xin vui lòng tích chọn những thông báo cho phép</strong></span></span>
                                <div class="error"></div>
                                </div>
                                <div class="table-responsive">
                                <table class="table table-striped table-borderless border-bottom">
                                    <thead>
                                    <tr>
                                        <th class="text-nowrap">Kiểu</th>
                                        <th class="text-nowrap text-center">✉️ Email</th>
                                        <th class="text-nowrap text-center">🖥 Trình duyệt</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-nowrap">Tin tức mới</td>
                                        <td>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck1" checked="">
                                        </div>
                                        </td>
                                        <td>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck2" checked="">
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Hoạt Động tài khoản</td>
                                        <td>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck4" checked="">
                                        </div>
                                        </td>
                                        <td>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck5" checked="">
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Thông báo khi bạn đăng nhập ở nơi khác</td>
                                        <td>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck7" checked="">
                                        </div>
                                        </td>
                                        <td>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck8" checked="">
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Cập Nhật Giỏ Hàng</td>
                                        <td>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck10" checked="">
                                        </div>
                                        </td>
                                        <td>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck11">
                                        </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="card-body">
                                <h6>Khi nào thì nên gửi thông báo ?</h6>
                                <form action="javascript:void(0);">
                                    <div class="row">
                                    <div class="col-sm-6 mt-3">
                                        <select id="sendNotification" class="form-select" name="sendNotification">
                                        <option selected="">Chỉ Khi tôi online</option>
                                        <option>Mọi Thời điểm</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mt-3">
                                        <button type="submit" class="btn btn-info me-2">lưu Thông Báo</button>
                                        <!-- <button type="reset" class="btn btn-outline-secondary">reset</button> -->
                                    </div>
                                    </div>
                                </form>
                                </div>
                                <!-- /Notifications -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!-- Modal -->
<div class="modal fade" id="chinhsua" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chỉnh Sửa Avatar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label" for="basic-icon-default-fullname">Hình Ảnh (*)</label>
            <div class="input-group input-group-merge">
                <input type="file" id="fileInput" class="form-control" name="file_upload" onchange="onFileSelected()" placeholder="Nhập file Hình Ảnh" multiple>
            </div>
            <div id="imageContainer" class="mt-4"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Lưu avatar</button>
    </div>
    </div>
  </div>
</div>



<script>
    function onFileSelected() {
            // get file
        var selectedFiles = event.target.files;
        // show
        var imageContainer = document.getElementById("imageContainer");
        // show hình đầu tiên là hình nền
        var firstFile = event.target.files[0];

        imageContainer.innerHTML = '';
        for (var i = 0; i < selectedFiles.length; i++) {
            var reader = new FileReader();
            var file = selectedFiles[i];

            reader.onload = function (e) {
                var img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add("image-preview");


                var pTag = document.createElement("p");
                    pTag.innerHTML = file.name;
                if (firstFile) {
                    pTag.innerHTML = "Avatar";
                    firstFile = false;
                }
                var container = document.createElement("div");
                container.appendChild(img);
                container.appendChild(pTag);

                imageContainer.appendChild(container);

            };

            reader.readAsDataURL(file);
        }
    }
</script>