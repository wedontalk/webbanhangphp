<?php
    include ('../header.php');
    include('./../../../controller/slideController.php');
    $class = new SlideController();
    $showslides = $class->select_slide();
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

        if(isset($_POST['array_id'])){
            $id = $_POST['array_id'];
            // $arr = $data['array_id'];
            foreach ($id as $key => $val) {
                $data = [
                    'id' => $id,
                    'thu_tu' => $key
                ];
                $submitsli = $class->sortUpdate($data);
            }
        }
    ?>
    <style>
        .ui-state-highlight {background:#c3ddf7; height: 1.5em; line-height: 1.2em; }
        .sortable_slider tr td{
            word-wrap:break-word;
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
                        <h5 class="card-header">Ds slide</h5>
                        <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:30px"><input type="checkbox"></th>
                                        <th>title</th>
                                        <th>Link</th>
                                        <th style="width:300px">Hình Ảnh</th>
                                        <th>Trạng Thái</th>
                                        <th style="width:100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="sortable_slider">
                                    <?php foreach ($showslides as $key => $value):?>
                                    <tr id="<?=$value['id']?>">
                                        <td><input type="checkbox" name="" id=""></td>
                                        <td>
                                            <strong><?=$value['title']?></strong>
                                        </td>
                                        <td><?=$value['link']?></td>
                                        <td>
                                            <img src="<?=showlinkimage()?>/upload/slider/<?=$value['image']?>" alt="<?=$value['image']?>" height="120px">
                                        </td>
                                        <td>
                                            <?php if($value['action'] == 1):?>
                                                <span class="badge bg-label-primary me-1">Slide Hiện</span>
                                            <?php elseif($value['action'] == 2):?>
                                                <span class="badge bg-label-warning me-1">Slide Ẩn</span>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="editslide.php?slid=<?=$value['id']?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" onclick="deleteRecord(<?=$value['id']?>)"><i class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
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