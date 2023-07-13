<?php
    include_once('../header.php');
    include_once('./../../../controller/brandController.php');
    $class = new BrandController();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name_brand = $_POST['name_brand'];
        $description = $_POST['description'];
        $action = $_POST['action'];
        $data = [
            'name_brand' => $name_brand,
            'description' => $description,
            'action' => $action
        ];
        $submit = $class->create($data);
    }
?>
    <div class="layout-page">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <?php
                    if(isset($submit)){
                        echo '
                        <div>
                            <div class="alert alert-warning alert-dismissible me-auto" role="alert">'.$submit.'
                            <a href="./index.php" type="button" class="btn btn-warning" style="float:right;margin-top:-7px">Xem danh mục đã thêm</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>';
                    }
                ?>
                <div class="col-xl">
                    <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Danh mục</h5>
                        <small class="text-muted float-end">Category manga</small>
                    </div>
                    <div class="card-body">
                        <form action="addbrand.php" method="post">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Name Danh mục (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" name="name_brand" placeholder="Nhập Name Danh Mục">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-message">description</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                                <textarea id="basic-icon-default-message" class="form-control" name="description" placeholder="Nhập Mô tả danh mục nếu có !!!"></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="text-light fw-semibold d-block">Ẩn/Hiện Danh Mục</small>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" name="action" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label" for="inlineRadio1">Hiện Danh Mục</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="action" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">Ẩn Danh Mục</label>
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
    include_once ('../footer.php');
?>