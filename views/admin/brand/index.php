<?php
    include ('../header.php');
    include('./../../../controller/brandController.php');
    $class = new BrandController();
    $per_page = 10;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $start_index = ($page - 1) * $per_page;
    }else{
        $start_index = 0;
    }
    $showpaginate = $class->brand_list($start_index, $per_page);
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
                                        <th>Name Nhãn Hàng</th>
                                        <!-- <th>Slug Danh Mục</th> -->
                                        <th style="width:300px">Description</th>
                                        <th>Status</th>
                                        <th style="width:100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($brand != ""):?>
                                    <?php foreach ($brand as $key => $value):?>
                                    <tr>
                                        <td><input type="checkbox" name="" id=""></td>
                                        <td>
                                            <strong><?=$value['name_brand']?></strong>
                                        </td>
                                        <td>
                                            <?php if(strlen($value['description']) >= 31):?>
                                            <?= mb_substr($value['description'], 0, 30) .'...'?>
                                            <?php else:?>
                                                <?=$value['description']?>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <?php if($value['action'] == 1):?>
                                                <span class="badge bg-label-primary me-1">Nhãn Hàng Hiện</span>
                                            <?php elseif($value['action'] == 2):?>
                                                <span class="badge bg-label-warning me-1">Nhãn Hàng Ẩn</span>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="editbrand.php?brid=<?=$value['id']?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" onclick="deleteRecord(<?=$value['id']?>)"><i class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
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