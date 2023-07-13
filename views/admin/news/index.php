<?php
    include ('../header.php');
    include('./../../../controller/newsController.php');
    $class = new NewsController();
    $per_page = 10;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $start_index = ($page - 1) * $per_page;
    }else{
        $start_index = 0;
    }
    $showpaginate = $class->news_list($start_index, $per_page);
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
        .body-des tr td{
            /* width: 125px; */
            /* margin: 5px 10px; */
            word-wrap:break-word;
            white-space: initial;
            text-overflow: ellipsis;  
        }
        .khungchitiet{
            word-wrap:break-word;
            overflow: hidden;
            white-space: initial;
            text-overflow: ellipsis;
        }
        .khung-box{
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
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
            max-height:250px;
            /* max-width:250px; */
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
                        <h5 class="card-header">Ds Tin Tức</h5>
                        <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:30px"><input type="checkbox"></th>
                                        <th>Name Tin Tức</th>
                                        <th>Slug Tin Tức</th>
                                        <th>Hình Ảnh</th>
                                        <th>Mô Tả ngắn</th>
                                        <th style="width:450px">Thông tin</th>
                                        <th>Ngày Đăng</th>
                                        <th>Status</th>
                                        <th style="width:100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="body-des">
                                    <?php foreach ($news as $key => $value):?>
                                    <tr>
                                        <td><input type="checkbox" name="" id=""></td>
                                        <td>
                                            <strong><?=$value['name_news']?></strong>
                                        </td>
                                        <td><?=$value['slug']?></td>
                                        <td><img src="<?=showlinkimage()?>/upload/news/<?=$value['image']?>" alt="<?=$value['image']?>" width="100px" height="100px"></td>
                                        <td>
                                            <?php if(strlen($value['short_description']) >= 31):?>
                                                <?= mb_substr($value['short_description'], 0, 30) .'...'?>
                                            <?php else:?>
                                                <?=$value['short_description']?>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <?php if(strlen($value['content']) >= 81):?>
                                                <?= mb_substr($value['content'], 0, 80) .'...'?>
                                            <?php else:?>
                                                <?=$value['content']?>
                                            <?php endif;?>
                                        </td>
                                        <td><?=$value['created_at']?></td>
                                        <td>
                                            <?php if($value['action'] == 1):?>
                                                <span class="badge bg-label-primary me-1">Hiện</span>
                                            <?php elseif($value['action'] == 2):?>
                                                <span class="badge bg-label-warning me-1">Ẩn</span>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalnews<?=$value['id']?>"><i class='bx bx-news me-1'></i> Chi Tiết</button>
                                                <a class="dropdown-item" href="editnews.php?nid=<?=$value['id']?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" onclick="deleteRecord(<?=$value['id']?>)"><i class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- modal description -->
                                    <div class="modal fade" id="modalnews<?=$value['id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel4">Thông Tin:
                                                <?php if(strlen($value['name_news']) >= 31):?>
                                                    <?= mb_substr($value['name_news'], 0, 30) .'...'?>
                                                <?php else:?>
                                                    <?=$value['name_news']?>
                                                <?php endif;?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <img class="card-img card-img-left img-avatar" src="<?=showlinkimage()?>/upload/news/<?=$value['image']?>" alt="<?=$value['image']?>">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="khungchitiet khung-box row">
                                                                    <h3><strong class="text-primary"><?=$value['name_news']?></strong></h3>
                                                                    <p><strong>Ngày Đăng: </strong><span> <?=$value['created_at']?></span></p>
                                                                    <div class="alert alert-warning" role="alert" style="color:#000"><?=$value['short_description']?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="divider divider-primary">
                                                                <div class="divider-text">Content news</div>
                                                            </div>
                                                            <div class="khungchitiet">
                                                                <div class="alert alert-secondary" role="alert" style="color:#000"><?=$value['content']?></div>
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