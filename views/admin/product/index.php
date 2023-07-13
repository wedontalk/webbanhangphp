<?php
    include_once('../header.php');
    include_once('./../../../controller/productController.php');
    $class = new ProductController();
    $per_page = 10;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $start_index = ($page - 1) * $per_page;
    }else{
        $start_index = 0;
    }
    $showpaginate = $class->product_list($start_index, $per_page);
    extract($showpaginate);
?>
    <?php
        if(isset($_GET['deleteid']) && $_GET['deleteid'] != null){
            $id = $_GET['deleteid'];
            $delete = $class->delete($id);
            // echo '<script>document.location.reload(true)</script>';
        }
    ?>
    <script>
        function deleteRecord(id) {
        var confirmDelete = confirm("Bạn có chắc chắn muốn xóa trường này ?");
        document.body.innerHTML = '';
        if (confirmDelete) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "?deleteid=" + id, true);
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.body.innerHTML = xhr.responseText;
                setTimeout(function() {
                        document.location.reload(true);
                }, 1000);
            }
            };
            xhr.send();
        }
        }
    </script>
    <style>
        .khungchitiet{
            word-wrap:break-word;
            overflow: hidden;
            white-space: initial;
            text-overflow: ellipsis;
        }
        .khung-box{
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
            padding: 10px 15px;
            min-height:200px;
            /* background:#ebeef0; */
            border-radius:5px;
        }
        .khung-box strong{
            color:#03c3ec;
            width: 150px;
        }
        .img-avatar{
            display: block;
        }
        .body-collap{
            display: inline-flex;
            
        }
        .body-collap img{
            margin:5px 10px;
        }
        .body-collap p{
            width: 125px;
            margin: 5px 10px;
            word-wrap:break-word;
            overflow: hidden;
            white-space: initial;
            text-overflow: ellipsis;  
        }
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
                        <h5 class="card-header">Ds Danh Mục</h5>
                        <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:30px"><input type="checkbox"></th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Giá</th>
                                        <th>Giá Giảm</th>
                                        <th>Hình Ảnh</th>
                                        <th>Trạng Thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($product != ""):?>
                                    <?php foreach ($product as $key => $value):?>
                                    <tr>
                                        <td><input type="checkbox" name="" id=""></td>
                                        <td>
                                            <strong>
                                                <?php if(strlen($value['name']) >= 31):?>
                                                    <?= mb_substr($value['name'], 0, 30) .'...'?>
                                                <?php else:?>
                                                    <?=$value['name']?>
                                                <?php endif;?>
                                            </strong>
                                        </td>   
                                        <td>
                                            <?=number_format($value['price']).'VNĐ'?>
                                        </td>
                                        <td>
                                            <?=number_format($value['price_discount']).'VNĐ'?>
                                        </td>
                                        <td>
                                        <?php if(json_decode($value['image'])):?>
                                            <img src="<?=showlinkimage()?>/upload/images/<?=json_decode($value['image'])[0]?>" alt="" width="100px" height="100px">
                                        <?php endif;?>
                                        </td>
                                        <td>
                                            <?php if($value['action'] == 1):?>
                                                <span class="badge bg-label-primary me-1">Sản Phẩm Hiện</span>
                                            <?php elseif($value['action'] == 2):?>
                                                <span class="badge bg-label-warning me-1">Sản Phẩm Ẩn</span>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modelproduct<?=$value['id']?>"><i class='bx bx-news me-1'></i> Chi Tiết</button>
                                                <a class="dropdown-item" href="editproduct.php?prid=<?=$value['id']?>"><i class="bx bx-edit-alt me-1"></i> Chỉnh Sửa</a>
                                                <a class="dropdown-item" onclick="deleteRecord(<?=$value['id']?>)"><i class="bx bx-trash me-1"></i> Xóa</a>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- model product -->

                                    <div class="modal fade" id="modelproduct<?=$value['id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel4">Thông Tin:
                                                <?php if(strlen($value['name']) >= 31):?>
                                                    <?= mb_substr($value['name'], 0, 30) .'...'?>
                                                <?php else:?>
                                                    <?=$value['name']?>
                                                <?php endif;?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <?php if(json_decode($value['image'])):?>
                                                            <img class="card-img card-img-left img-avatar" src="<?=showlinkimage()?>/upload/images/<?=json_decode($value['image'])[0]?>" alt="<?=$value['name']?>">
                                                            <?php endif;?>
                                                            <button class="btn btn-primary me-1 collapsed mt-2 col-12" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                Xem Thêm
                                                            </button>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="khungchitiet khung-box row">
                                                                    <h3><strong class="text-primary"><?=$value['name']?></strong></h3>
                                                                    <p>Đường Dẫn: <span class="text-muted"><?=$value['slug']?></span></p>
                             
                                                                    <p><strong>Danh mục: </strong><span class="badge bg-label-primary"> <?=$value['category_name']?></span></p>
                                                                    <p><strong>Nhãn Hàng: </strong><span class="badge bg-label-warning"> <?=$value['brand_name']?></span></p>
                                                                    <p><strong>Lượt Xem: </strong><span class="me-2"><?=$value['view']?></span><i class='bx bx-street-view mb-1'></i></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="khungchitiet khung-box">
                                                                <p><strong>Giá: </strong><span><?=number_format($value['price']).' VNĐ'?></span></p>
                                                                <p><strong>Giá Giảm: </strong><span><?=number_format($value['price_discount']).' VNĐ'?></span></p>
                                                                <p><strong>Số Lượng: </strong><span><?=$value['quantity']?></span></p>
                                                                <p><strong>Ngày Cập Nhật: </strong><span><?=$class->diffForHumans($value['update_at'])?></span></p>
                                                                <p><strong>Ngày Đăng: </strong><span><?=$class->diffForHumans($value['create_at'])?></span></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <div class="khungchitiet khung-box">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <p><strong>Chiều Dài: </strong><span><?=$value['length']?> mm</span></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <p><strong>Chiều Rộng: </strong><span><?=$value['width']?> mm</span></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <p><strong>Chiều Cao: </strong><span><?=$value['height']?> mm</span></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                    <p><strong>Cân Nặng: </strong><span><?=$value['weight']?> gr</span></p>
                                                                    </div>
                                                                </div>
                                                                <p><strong>Màu Sắc: </strong><span><?=$value['color']?></span></p>
                                                                <p><strong>Tình Trạng: </strong>
                                                                    <span>
                                                                        <?php if($value['quality'] == 1):?>
                                                                            Mới.
                                                                        <?php else:?>
                                                                            Đã qua sử dụng.
                                                                        <?php endif;?>
                                                                    </span>
                                                                </p>
                                                                <p><strong>Đóng gói dạng: </strong>
                                                                    <span>
                                                                    <?php if($value['packing_form'] == 1):?>
                                                                            Hộp.
                                                                        <?php else:?>
                                                                            Bao Bì.
                                                                        <?php endif;?>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="collapse" id="collapseExample">
                                                                <div class="p-3 mt-4 border khungchitiet body-collap">
                                                                    <?php if(json_decode($value['image'])):?>
                                                                        <?php foreach(json_decode($value['image']) as $imagefile):?>
                                                                            <div class="inlinebox" style="padding: 0 10px">
                                                                                <img src="<?=showlinkimage()?>/upload/images/<?=$imagefile?>" alt="<?=$imagefile?>" height="125px" width="125px">
                                                                                <p><?=$imagefile?></p>
                                                                            </div>
                                                                        <?php endforeach;?>
                                                                    <?php endif;?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="divider divider-primary">
                                                                <div class="divider-text">Mô Tả Sản Phẩm</div>
                                                            </div>
                                                            <div class="khungchitiet">
                                                                <div class="alert alert-secondary" role="alert" style="color:#000"><?=$value['description']?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                            <?php
                                if($total_pages > 1){
                                    $pagination = '<ul class="pagination mt-4">';
                                    if($current_page > 1){
                                        $pagination .= 
                                        '
                                            <li class="page-item first">
                                                <a class="page-link" href="?page='.($current_page-1).'"><i class="tf-icon bx bx-chevron-left"></i></a>
                                            </li>
                                        ';
                                    }
                                    for($i = max(1, $current_page - 3); $i <= min($current_page + 3, $total_pages); $i++){
                                        if($i == $current_page){
                                            if($current_page > 3){
                                                $pagination .='<li class="page-item"><a class="page-link">...</a></li>';
                                            }
                                            $pagination .= '<li class="page-item active"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                                        } else {
                                            $pagination .= '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                                        }
                                    }
                                    if($current_page < $total_pages){
                                        $pagination .= 
                                        '
                                            <li class="page-item next">
                                                <a class="page-link" href="?page='.($current_page+1).'"><i class="tf-icon bx bx-chevron-right"></i></a>
                                            </li>
                                        ';
                                    }
                                    $pagination .= '</ul>';
                                    echo $pagination;
                                }
                            ?>
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