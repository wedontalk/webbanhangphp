    <?php
    // unset($_SESSION['cart']);
        if(Session::get('cart') == null){
            echo' <script> location.replace("index.php"); </script>';
        }else{
            $carts = Session::get('cart');
        }

        if(isset($_POST['id']) && isset($_POST['newVal'])){
            $id = $_POST['id'];
            $newVal = $_POST['newVal'];
            $table = "SELECT * FROM product WHERE id= '$id'";
            $result = $db->select($table);
            $value = $result->fetch(PDO::FETCH_ASSOC);

            if(isset($carts[$id])){
                    $carts[$id]['quantity'] = $newVal;
                    Session::set('cart', $carts);
                    $carts = Session::get('cart');
                    echo 'thành công';
            }
            exit();
        }
        if(isset($_POST['deleteid']) && $_POST['deleteid'] != null){
            $deleteid = $_POST['deleteid'];
            if($deleteid){
                $carts = Session::get('cart');
                unset($carts[$deleteid]);
                Session::set('cart',$carts);
                $carts = Session::get('cart');
            }
        }
    ?>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <?php
                if(isset($alert)){
                    echo $alert;
                }
            ?>
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sản Phẩm</th>
                                <th scope="col">Màu Sắc</th>
                                <th scope="col">Giá Tiền</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Tổng</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="updatecart">
                            <?php
                            $tongmoney = 0;
                            if(Session::get('cart')):?>
                            <?php foreach (Session::get('cart') as $value):?>
                            <tr id="cart">
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="./upload/images/<?php echo $value['product_img']?>" alt="<?php echo $value['product_img']?>" width="120px">
                                        </div>
                                        <div class="media-body">
                                            <p><?php echo $value['product_name']?></p>
                                        </div>
                                    </div>
                                </td>
                                <td><p><?php echo $value['product_color']?></p></td>
                                <td>
                                    <h5><?php echo number_format($value['detail_price'])?></h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <button class="increase items-count" data-id="<?php echo $value['cardID']?>" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        <input type="text" name="qty" id="sst" maxlength="12" value="<?php echo $value['quantity']?>" data-id="<?php echo $value['cardID']?>" title="Quantity:" class="input-text qty">
                                        <button class="reduced items-count" data-id="<?php echo $value['cardID']?>" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        $tongvalue = $value['detail_price'] * $value['quantity'];
                                        $tongmoney += $tongvalue;
                                    ?>
                                    <h5><?php echo number_format($tongvalue)?></h5>
                                </td>
                                <td><input type="submit" id="deleteCart" value="x" data-id="<?php echo $value['cardID']?>"></td>
                            </tr>
                            <?php endforeach;?>
                            <?php endif;?>
                            <tr class="bottom_button">
                                <td>
                                    <a href="" class="gray_btn" style="cursor:pointer">Quay trở lại</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="cupon_text d-flex align-items-center">
                                        <input type="text" placeholder="Coupon Code">
                                        <a class="primary-btn" href="#">Apply</a>
                                        <a class="gray_btn" href="#">Close Coupon</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>$<?php echo number_format($tongmoney)?></h5>
                                </td>
                            </tr>
                            <tr class="out_button_area">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>

                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="?page=product">Tiếp Tục Mua Sắm</a>
                                        <a class="primary-btn" <?=(Session::get('cart') ? 'href="?page=checkout"':'onclick="alertify.alert("Thông Báo Giỏ Hàng","Đã Cập Nhật Thành Công" })"')?>>Tiến Hành Thanh Toán</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->