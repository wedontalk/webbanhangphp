<?php
    include('../header.php');
    include('./../../../controller/vouchercontroller.php');
    $class = new VoucherController();

    // if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // $name_voucher = $_POST['name_voucher'];
        // $format_money = $_POST['format_money'];
        // $discount = $_POST['discount'];
        // $quantity_discount = $_POST['quantity_discount'];
        // $date_start = $_POST['date_start'];
        // $date_end = $_POST['date_end'];
        // $action = $_POST['action'];
        // $data = [
        //     'name_voucher' => $name_voucher,
        //     'format_money' => $format_money,
        //     'discount' => $discount,
        //     'quantity_discount' => $quantity_discount,
        //     'date_start' => $date_start,
        //     'date_end' => $date_end,
        //     'action' => $action
        // ];
    //     $submitvoucher = $class->create($data);
    // }

    if(isset($_GET['vchid']) && $_GET['vchid'] != NULL){
        // start show value use edit
        $id = $_GET['vchid'];
        $resultcate = $class->edit($id);
        $row = $resultcate->fetch(PDO::FETCH_ASSOC);
        // end show value use edit

        // start edit category 
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name_voucher = $_POST['name_voucher'];
            $format_money = $_POST['format_money'];
            $discount = $_POST['discount'];
            $quantity_discount = $_POST['quantity_discount'];
            $date_start = $_POST['date_start'];
            $date_end = $_POST['date_end'];
            $action = $_POST['action'];
            $data = [
                'name_voucher' => $name_voucher,
                'format_money' => $format_money,
                'discount' => $discount,
                'quantity_discount' => $quantity_discount,
                'date_start' => $date_start,
                'date_end' => $date_end,
                'action' => $action
            ];
            $submitvoucher = $class->update($id, $data);
        }
    }
?>
    <div class="layout-page">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <?php
                    if(isset($submitvoucher)){
                        echo '
                        <div>
                            <div class="alert alert-warning alert-dismissible me-auto" role="alert">'.$submitvoucher.'
                            <a href="./index.php" type="button" class="btn btn-warning" style="float:right;margin-top:-7px">Xem danh mục đã thêm</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>';
                    }
                ?>
                <div class="col-xl">
                    <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Voucher</h5>
                        <small class="text-muted float-end">Voucher</small>
                    </div>
                    <div class="card-body">
                        <form action="editvoucher.php?vchid=<?=$row['id']?>" method="post">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Name Danh mục (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" name="name_voucher" value="<?=$row['name_voucher']?>" placeholder="Nhập title voucher">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Loại giảm giá</label>
                                <select class="form-select" id="format_money" name="format_money" aria-label="Default select example">
                                <option value="2" <?=($row['format_money'] == 2) ? 'selected':'' ?>>Loại %</option>
                                <option value="1" <?=($row['format_money'] == 1) ? 'selected':'' ?>>Loại Tiền</option>
                                </select>
                            </div>
                            <!-- end name -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Giảm Giá</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-money'></i></span>
                                <input type="number" class="form-control" id="discount" name="discount" value="<?=$row['discount']?>" min="0" placeholder="nhập giá muốn giảm">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Số Lượng</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-credit-card-alt'></i></span>
                                <input type="number" class="form-control" name="quantity_discount" value="<?=$row['quantity_discount']?>" placeholder="Nhập số lượng giảm giá">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Ngày Bắt đầu</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-time'></i></span>
                                <input type="datetime-local" class="form-control" name="date_start" value="<?=$row['date_start']?>" placeholder="Nhập số lượng giảm giá">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Ngày Kết Thúc</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-timer'></i></span>
                                <input type="datetime-local" class="form-control" name="date_end" value="<?=$row['date_end']?>" placeholder="Nhập số lượng giảm giá">
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="text-light fw-semibold d-block">Ẩn/Hiện Trạng Thái</small>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" name="action" id="inlineRadio1" value="1" <?=($row['action'] == 1) ?'checked':''?>>
                                    <label class="form-check-label" for="inlineRadio1">Đang Hoạt Động</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="action" id="inlineRadio2" value="2" <?=($row['action'] == 2) ?'checked':''?>>
                                    <label class="form-check-label" for="inlineRadio2">Không Hoạt Động</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu Ngay</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include ('../footer.php');
?>
<script>
   jQuery(document).ready(function($) {
       $('#discount').attr('max','100');
       $('#format_money').on('change', function(){
        var format_money = $(this).val();     
        if(format_money == 2){
            $('#discount').attr('max','100');
        }else{
            $('#discount').attr('max','10000000');
        }
    })
   });
</script>