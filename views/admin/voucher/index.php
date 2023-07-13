<?php
    include ('../header.php');
    include('./../../../controller/voucherController.php');
    $class = new VoucherController();
    // $showslides = $class->select_slide();
    $per_page = 10;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $start_index = ($page - 1) * $per_page;
    }else{
        $start_index = 0;
    }
    $showpaginate = $class->voucher_list($start_index, $per_page);
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
                        <h5 class="card-header">Ds voucher</h5>
                        <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:30px"><input type="checkbox"></th>
                                        <th>title</th>
                                        <th>giảm giá</th>
                                        <th>Số Lượng</th>
                                        <th>Ngày Bắt Đầu</th>
                                        <th>Ngày Kết Thúc</th>
                                        <th>Tình Trạng</th>
                                        <th>Trạng Thái</th>
                                        <th style="width:100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <?php if($voucher != ''):?>
                                    <?php foreach ($voucher as $key => $value):?>
                                    <tr>
                                        <td><input type="checkbox" name="" id=""></td>
                                        <td>
                                            <strong><?=$value['name_voucher']?></strong>
                                        </td>
                                        <td>
                                            <?php if($value['format_money'] == 1):?>
                                                <?=number_format($value['discount']). ' VNĐ'?>
                                            <?php else:?>
                                                <?=$value['discount'].' %'?>
                                            <?php endif;?>
                                            
                                        </td>
                                        <td>
                                            <?=number_format($value['quantity_discount']);?>
                                        </td>
                                        <td>
                                            <?=$value['date_start']?>
                                        </td>
                                        <td>
                                            <?=$value['date_end']?>
                                        </td>
                                        <td>
                                            <?php
                                                // check date_end của voucher
                                                $now = new DateTime();
                                                $showdate = $now->format('Y-m-d H:i:s');
                                                if($value['date_end'] > $showdate){
                                                    echo '<span class="badge bg-label-success me-1">voucher Đang chạy</span>';
                                                }else{
                                                    echo '<span class="badge bg-label-dark me-1">voucher đã hết hạn</span>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if($value['action'] == 1):?>
                                                <span class="badge bg-label-primary me-1">Đang Hoạt Động</span>
                                            <?php elseif($value['action'] == 2):?>
                                                <span class="badge bg-label-warning me-1">Đã dừng</span>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="editvoucher.php?vchid=<?=$value['id']?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" onclick="deleteRecord(<?=$value['id']?>)"><i class="bx bx-trash me-1"></i> Delete</a>
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