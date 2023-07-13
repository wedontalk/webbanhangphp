<?php
    if(isset($_GET['slugdetail']) && $_GET['slugdetail'] != NULL){
        $slug = $_GET['slugdetail'];
        $showdetail = $prd->show_detail_prd_slug($slug);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $id = $showdetail['id'];
        $quantity = $_POST['qty'];
        $color = $_POST['color'];
        $addtocard = $ct->add_to_card($color, $quantity, $id);

    }
?>
<style>
    .s_product_text{
        margin-top:0px;
    }
    .s_product_text p{
        border:none;
        margin:0;
        padding:0;
    }
    .nice-select{
        display:none
    }
    .list select{
        display:inline-block !important;
    }
</style>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Chi Tiết Sản Phẩm</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">Trang Chủ<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Cửa Hàng<span class="lnr lnr-arrow-right"></span></a>
                    <a href="single-product.html">Chi Tiết Sản Phẩm</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_Product_carousel">
                    
                    <?php if(json_decode($showdetail['image'])):?>
                    <?php foreach (json_decode($showdetail['image']) as $key => $value):?>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="./upload/images/<?php echo $value?>" alt="<?php echo $value?>">
                    </div>
                    <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3><?php echo $showdetail['name']?></h3>
                    <?php if($showdetail['price_discount'] == NULL || $showdetail['price_discount'] == 0):?>
                        <h2><?php echo ' $ ' . number_format($showdetail['price']) . 'VNĐ'?></h2>
                    <?php else:?>
                        <h2><?php echo ' $ ' . number_format($showdetail['price_discount']) . 'VNĐ'?></h2>
                    <?php endif;?>
                    <ul class="list">
                        <li><a class="active" href="?page=category&cate=<?php echo $showdetail['cate_slug']?>"><span>Danh Mục</span> : <?php echo $showdetail['name_cate']?></a></li>
                        <li><a href="#"><span>Tồn Kho</span> : <?php echo $showdetail['quantity']?> sản phẩm</a></li>
                    </ul>
                    <br>
                    <form action="" method="post">
                    <div class="list">
                        Màu sắc :
                        <select class="form-select" name="color">
                            <?php foreach ([$showdetail['color']] as $color):?>
                                <?php $mausac = explode(',', $color);?>
                                <?php foreach ($mausac as $val):?>
                                    <option value="<?php echo $val?>"><?php echo $val?></option>
                                <?php endforeach;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <br>
                    <div class="product_count">
                        <label for="qty">Số Lượng:</label>
                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text">
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                            class="increase" type="button"><i class="lnr lnr-chevron-up"></i></button>
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                            class="reduced" type="button"><i class="lnr lnr-chevron-down"></i></button>
                    </div>
                    <div class="card_area d-flex align-items-center">
                        <input type="submit" name="submit" value="Thêm Giỏ Hàng" class="primary-btn">
                        <!-- <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a> -->
                        <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mô Tả Chi Tiết</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                    aria-selected="false">Thông Tin Chi Tiết</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                    aria-selected="false">Đánh Giá</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?=$showdetail['description']?>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>Chiều Rộng</h5>
                                </td>
                                <td>
                                    <h5><?php echo $showdetail['width']?> mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Chiều Dài</h5>
                                </td>
                                <td>
                                    <h5><?php echo $showdetail['length']?> mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Chiều Cao</h5>
                                </td>
                                <td>
                                    <h5><?php echo $showdetail['height']?> mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Cân Nặng</h5>
                                </td>
                                <td>
                                    <h5><?php echo $showdetail['weight']?> kg</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Chất Lượng</h5>
                                </td>
                                <td>
                                    <?php if($showdetail['quality'] == 1):?>
                                    <h5>Mới</h5>
                                    <?php else:?>
                                    <h5>Cũ</h5>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Đóng Gói dạng</h5>
                                </td>
                                <td>
                                <?php if($showdetail['packing_form'] == 1):?>
                                    <h5>Hộp</h5>
                                    <?php else:?>
                                    <h5>Bao Bì</h5>
                                    <?php endif;?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row total_rate">
                            <div class="col-6">
                                <div class="box_total">
                                    <h5>Overall</h5>
                                    <h4>4.0</h4>
                                    <h6>(03 Reviews)</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rating_list">
                                    <h3>Based on 3 Reviews</h3>
                                    <ul class="list">
                                        <li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="review_list">
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="img/product/review-1.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Blake Ruiz</h4>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo</p>
                            </div>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="img/product/review-2.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Blake Ruiz</h4>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo</p>
                            </div>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="img/product/review-3.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Blake Ruiz</h4>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Add a Review</h4>
                            <p>Your Rating:</p>
                            <ul class="list">
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                            <p>Outstanding</p>
                            <form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Full name'">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="number" name="number" placeholder="Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Review" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="primary-btn">Submit Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Description Area =================-->