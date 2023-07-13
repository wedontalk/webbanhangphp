<?php
    include ('../header.php');
    include('./../../../controller/orderController.php');
    $class = new OrderController();
    // $showslides = $class->select_slide();
    $per_page = 10;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $start_index = ($page - 1) * $per_page;
    }else{
        $start_index = 0;
    }
    $showpaginate = $class->order_list($start_index, $per_page);
    extract($showpaginate);
?>
    <script>
        function deleteRecord(id) {
        var confirmDelete = confirm("Bạn có chắc chắn muốn xóa trường này ?");
        if (confirmDelete) {
            window.location = '?deleteid='+id;
            };
        }
    </script>
    <?php
        if(isset($_GET['deleteid']) && $_GET['deleteid'] != null){
            $id = $_GET['deleteid'];
            $delete = $class->delete($id);
            // echo '<script>document.location.reload(true)</script>';
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
                        <?php
                        if(isset($delete)){
                        echo '
                        <div>
                            <div class="alert alert-warning alert-dismissible me-auto" role="alert">'.$delete.'
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <script>
                                setTimeout(function(){window.location="index.php"} , 2000);
                            </script>
                        </div>';
                        }?>
                    <div class="card mb-4">
                        <h5 class="card-header">Ds đơn hàng</h5>
                        <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:30px"><input type="checkbox"></th>
                                        <th>Mã Đơn Hàng</th>
                                        <th>Họ và Tên</th>
                                        <th>Tổng Tiền</th>
                                        <th>Phí Ship</th>
                                        <th>Thanh Toán</th>
                                        <th>Trạng Thái ship</th>
                                        <th>Trạng Thái</th>
                                        <th style="width:100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <?php if($orders != ''):?>
                                    <?php foreach ($orders as $key => $value):?>
                                    <tr>
                                        <td><input type="checkbox" name="" id=""></td>
                                        <td>
                                            <strong><?=$value['order_code']?></strong>
                                        </td>
                                        <td>
                                            <strong><?=$value['name']?></strong>
                                        </td>
                                        <td><?=number_format($value['total_price']). '  '?></td>
                                        <td><?=number_format($value['fee_ship']). ' VNĐ'?></td>
                                        <td>
                                            <?php if($value['status_pay'] == 1):?>
                                                <span class="badge bg-label-warning me-1">Thanh Toán COD</span>
                                            <?php else:?>
                                                <span class="badge bg-label-info me-1">Thanh Toán Online</span>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <?php if($value['transport_ship'] == 1):?>
                                                <span class="badge bg-label-dark me-1">Viettel</span>
                                            <?php elseif($value['transport_ship'] == 2):?>
                                                <span class="badge bg-label-warning me-1">Giao hàng Nhanh</span>
                                            <?php elseif($value['transport_ship'] == 3):?>
                                                <span class="badge bg-label-success me-1">Giao hàng Tiết Kiệm</span>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <?php if($value['action'] == 1):?>
                                                <span class="badge bg-label-primary me-1">Đã Đặt hàng</span>
                                            <?php elseif($value['action'] == 2):?>
                                                <span class="badge bg-label-warning me-1">Đang chuẩn bị</span>
                                            <?php elseif($value['action'] == 3):?>
                                                <span class="badge bg-label-info me-1">Đang Giao</span>
                                            <?php elseif($value['action'] == 4):?>
                                                <span class="badge bg-label-success me-1">Thành Công</span>
                                            <?php elseif($value['action'] == 5):?>
                                                <span class="badge bg-label-danger me-1">Đã Hủy</span>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="detailorder.php?ordid=<?=$value['id']?>"><i class="bx bx-edit-alt me-1"></i> Chi tiết</a>
                                            </div>
                                            </div>
                                        </td>
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