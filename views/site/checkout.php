<?php
    
?>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Thanh Toán</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Trang Chủ<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Thanh Toán</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <?php if(Session::get('loginUser')):?>
            <div class="cupon_area">
                <div class="check_title">
                    <h2>Bạn Có Mã Giảm Giá? <a href="#">Nhấn vào đây để thêm mã Giảm Giá của bạn</a></h2>
                </div>
                <input type="text" placeholder="Nhập mã giảm giá">
                <a class="tp_btn" href="#">Thêm Mã Giảm Giá</a>
            </div>
            <div class="billing_details">
                <form class="contact_form" action="#" method="post" novalidate="novalidate">
                <div class="row">
                    <div class="col-lg-7">
                        <h3>Chi Tiết Đơn Hàng</h3>
                        <div class="row">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="first" name="name">
                                <span class="placeholder" data-placeholder="Họ Và Tên"></span>
                            </div>
                            
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number" name="phone">
                                <span class="placeholder" data-placeholder="Số Điện Thoại"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email">
                                <span class="placeholder" data-placeholder="Địa chỉ Email"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <select id="id_city" class="nice-select country_select form-control choose" name="id_province">
                                    <option selected>-- Chọn Tỉnh / Thành Phố --</option>
                                    <?php foreach ($us->select_thanhpho() as $key => $value):?>
                                        <option value="<?php echo $value['id']?>"><?php echo $value['_name']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <select id="province" class="nice-select country_select form-control choose province" name="id_district" value="id_district">
                                    <option selected>-- Chọn Quận / Huyện --</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <select id="wards" class="nice-select country_select form-control wards" name="id_wards">
                                    <option selected>-- Chọn Phường / Xã --</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="address" name="address">
                                <span class="placeholder" data-placeholder="Địa Chỉ Chi Tiết"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Ghi Chú Đơn Hàng</h3>
                                </div>
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Ghi Chú Đơn Hàng nếu có"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="order_box">
                            <h2>Đơn Hàng Của Bạn</h2>
                            <?php
                                $tongthu = 0;
                            ?>
                            <ul class="list">
                                <li><a href="#">Sản Phẩm <span>Tổng</span></a></li>
                                <?php foreach(Session::get('cart') as $cart):?>

                                    <?php $tongmoney = $cart['detail_price'] * $cart['quantity'];
                                          $tongthu += $tongmoney;
                                    ?>
                                <li><a href="#"><?=$cart['product_name']?><span class="middle" style="margin-left:0">x<?=$cart['quantity']?></span> <span class="last">$<?= number_format($tongmoney)?></span></a></li>
                                <?php endforeach;?>
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Tổng Phụ <span>$<?php echo number_format($tongthu)?></span></a></li>
                                <li><a href="#">Phí Ship <span>$ 20.000</span></a></li>
                                <li><a href="#">Tổng Thu <span>$<?php echo number_format($tongthu += 20000)?></span></a></li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="selector">
                                    <label for="f-option5">Thanh Toán COD</label>
                                    <div class="check"></div>
                                </div>
                                <p>Bạn sẽ thanh toán khi nhận sản phẩm</p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="selector">
                                    <label for="f-option6">MOMO </label>
                                    <img src="img/product/card.jpg" alt="">
                                    <div class="check"></div>
                                </div>
                                <p>Bạn sẽ thanh toán toàn bộ chi phí trước và nhận sản phẩm sau</p>
                            </div>
                            <a class="primary-btn" href="#">Tiến Hành Thanh Toán</a>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <?php else:?>
                <div class="returning_customer">
                <div class="check_title">
                    <h2>Nếu chưa đăng ký tài khoản vui lòng click tại đây? <a href="?page=register">Click để đăng ký tài khoản</a></h2>
                </div>
                <p>Bạn Vui lòng đăng nhập tài khoản để tiến hành mua hàng !</p>
                <form class="row contact_form" action="index.php?page=login" method="post" novalidate="novalidate">
                    <input type="hidden" name="page" value="login">
                    <div class="col-md-6 form-group p_star">
                        <input type="text" class="form-control" id="name" name="user_name">
                        <span class="placeholder" data-placeholder="Username or Email"></span>
                    </div>
                    <div class="col-md-6 form-group p_star">
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="placeholder" data-placeholder="Password"></span>
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" value="submit" class="primary-btn">login</button>
                        <!-- <div class="creat_account">
                            <input type="checkbox" id="f-option" name="selector">
                            <label for="f-option">Remember me</label>
                        </div> -->
                        <a class="lost_pass" href="#">Lost your password?</a>
                    </div>
                </form>
            </div>
            <?php endif;?>
        </div>
    </section>
    <!--================End Checkout Area =================-->