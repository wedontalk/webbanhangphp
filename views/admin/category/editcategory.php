<?php
    include('../header.php');
    include('./../../../controller/categoryController.php');
    $class = new CategoryController();

    if(isset($_GET['cateid']) && $_GET['cateid'] != NULL){
        // start show value use edit
        $id = $_GET['cateid'];
        $resultcate = $class->edit($id);
        $row = $resultcate->fetch(PDO::FETCH_ASSOC);
        // end show value use edit

        // start edit category 
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name_cate = $_POST['name_cate'];
            $slug = $_POST['slug'];
            $description = $_POST['description'];
            $action = $_POST['action'];
            $data = [
                'name_cate' => $name_cate,
                'slug' => $slug,
                'description' => $description,
                'action' => $action
            ];
            $submitcate = $class->update($id, $data);
        }
    }
?>
    <div class="layout-page">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <?php
                    if(isset($submitcate)){
                        echo '
                        <div>
                            <div class="alert alert-warning alert-dismissible me-auto" role="alert">'.$submitcate.'
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        <script>
                            setTimeout(function(){document.location.href="index.php",true} , 1000);   
                        </script>
                        
                        ';
                    }
                ?>
                <div class="col-xl">
                    <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Sửa Danh mục</h5>
                        <small class="text-muted float-end">Edit Category manga</small>
                    </div>
                    <div class="card-body">
                        <form action="editcategory.php?cateid=<?=$row['id']?>" method="post">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Name Danh mục (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" value="<?=$row['name_cate']?>" id="slug" name="name_cate" placeholder="Nhập Name Danh Mục" onkeyup="ChangeToSlug()">
                                </div>
                            </div>
                            <!-- end name -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Slug Danh mục</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-link'></i></span>
                                <input type="text" id="convert_slug" class="form-control" value="<?=$row['slug']?>" name="slug" placeholder="Đường Dẫn Danh Mục" readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-message">description</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                                <textarea id="basic-icon-default-message" class="form-control" name="description" placeholder="Nhập Mô tả danh mục nếu có !!!"><?=$row['description']?></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="text-light fw-semibold d-block">Ẩn/Hiện Danh Mục</small>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" name="action" id="inlineRadio1" value="1" 
                                    <?php if ($row['action'] == 1):?>
                                        checked
                                    <?php endif;?>
                                    >
                                    <label class="form-check-label" for="inlineRadio1">Hiện Danh Mục</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="action" id="inlineRadio2" value="2"
                                    <?php if ($row['action'] == 2):?>
                                        checked
                                    <?php endif;?>
                                    >
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
    include ('../footer.php');
?>
<script>
    function ChangeToSlug()
    {
        var slug;
     
        //Lấy text từ thẻ input title 
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
        document.getElementById('convert_slug').value = slug+'.html';
    }
</script>