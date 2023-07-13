<?php
    include ('../header.php');
    include('./../../../controller/orderController.php');
    $class = new OrderController();
    if(isset($_GET['ordid']) && $_GET['ordid'] != NULL){
        $id = $_GET['ordid'];
        $resultpro = $class->show($id);

        $showthongtin = $class->showproduct($id);
        $rowtt = $showthongtin->fetch(PDO::FETCH_ASSOC);
    }
?>
    <style>
        .ui-state-highlight {background:#c3ddf7; height: 1.5em; line-height: 1.2em; }
    </style>
    <div class="layout-page">
        <?php include('../menusearch.php')?>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="col-xl">
                        <div id="message"></div>
                    <div class="card mb-4">
                        <h5 class="card-header">Chi Tiết Đơn Hàng</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        <img src="<?=showlinkimage()?>/public/admin/assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                                        <div class="button-wrapper">
                                            <div class="col-md-12">
                                                <label for="order_code" class="form-label">Mã Đơn Hàng</label>
                                                <input type="text" class="form-control" id="order_code" name="order_code" value="<?=$rowtt['order_code']?>" disabled>
                                            </div>
                                            <hr>
                                            <div class="col-md-12">
                                                Trạng Thái: 
                                            <?php if($rowtt['action'] == 1):?>
                                                <span class="badge bg-primary me-1">Đã Đặt hàng</span>
                                            <?php elseif($rowtt['action'] == 2):?>
                                                <span class="badge bg-warning me-1">Đang chuẩn bị</span>
                                            <?php elseif($rowtt['action'] == 3):?>
                                                <span class="badge bg-info me-1">Đang Giao</span>
                                            <?php elseif($rowtt['action'] == 4):?>
                                                <span class="badge bg-success me-1">Thành Công</span>
                                            <?php elseif($rowtt['action'] == 5):?>
                                                <span class="badge bg-danger me-1">Đã Hủy</span>
                                            <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <strong style="color:#768de9">Tổng Tiền Hàng : <span style="color:#000"><?=number_format($rowtt['total_price']). ' VNĐ'?></span></strong>
                                    <br><strong>+</strong><br>
                                    <strong>Tiền Ship : <span><?=number_format($rowtt['fee_ship']). ' VNĐ'?></span></strong>
                                    <hr>
                                    <?php
                                        $showmoney = $rowtt['total_price'] + $rowtt['fee_ship'];
                                        ?>
                                    <strong style="color:#d8316d">Tổng Tiền: <span style="color:#000"><?=number_format($showmoney). ' VNĐ'?></span></strong>
                                </div>
                            </div>
                        </div>
                        <div class="divider divider-info">
                            <div class="divider-text">Thông tin Khách Hàng</div>
                        </div>
                        <div class="card-body">
                        <form id="" method="POST" >
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Họ Và Tên</label>
                                <input class="form-control" type="text" id="firstName" name="firstName" value="<?=$rowtt['name']?>" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Email</label>
                                <input class="form-control" type="text" name="lastName" id="lastName" value="<?=$rowtt['email']?>" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Địa Chỉ</label>
                                <input class="form-control" type="text" id="email" name="email" value="<?=$rowtt['address']?>" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="organization" name="organization" value="<?=$rowtt['phone']?>" disabled>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="phoneNumber">Ghi Chú</label>
                                <div class="input-group input-group-merge">
                                    <textarea name="" id="" cols="30" rows="5" style="width:100%" disabled><?=$rowtt['note']?></textarea>
                                </div>
                            </div>
                            </div>
                            <!-- <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div> -->
                        </form>
                        </div>
                        <!-- /Account -->
                    </div>
                    <div class="card mb-4">
                        <h5 class="card-header">Ds đơn hàng</h5>
                        <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình Ảnh</th>
                                        <th>số lượng</th>
                                        <th>giá</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <?php if($resultpro != ''):?>
                                    <?php foreach ($resultpro as $key => $value):?>
                                    <tr>
                                        <td>
                                            <strong><?=$value['product_name']?></strong>
                                        </td>
                                        <td>
                                            <?php if(json_decode($value['image'])):?>
                                                <img src="<?=showlinkimage()?>/upload/images/<?=json_decode($value['image'])[0]?>" alt="" width="100px" height="100px">
                                            <?php endif;?>
                                        </td>
                                        <td><?=number_format($value['ord_quantity'])?></td>
                                        <td><?=number_format($value['detail_price']). ' VNĐ'?></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    


                    
                </div>
            </div>
        </div>
    </div>
<?php
    include ('../footer.php');
?>