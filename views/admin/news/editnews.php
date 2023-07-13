<?php
    include('../header.php');
    include('./../../../controller/newsController.php');
    $class = new NewsController();
    if(isset($_GET['nid']) && $_GET['nid'] != NULL){
            $id = $_GET['nid'];
            $resultpro = $class->edit($id);
            $row = $resultpro->fetch(PDO::FETCH_ASSOC);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name_news = $_POST['name_news'];
            $slug = $_POST['slug'];
            $short_description = $_POST['short_description'];
            $content = $_POST['content'];
            $action = $_POST['action'];
            $now = new DateTime();
            $showdate = $now->format('Y-m-d H:i:s');
            $data = [
                'name_news' => $name_news,
                'slug' => $slug,
                'short_description' => $short_description,
                'content' => $content,
                'created_at' => $showdate,
                'action' => $action
            ];
            $submitnews = $class->update($id, $data);
        }
    }
?>
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
            /* width: 1100px; */
        }
        .ck-rounded-corners{
            width: 100% !important;
        }
        #imageContainer img{
            width: 100px;
            height: 100px;
            margin: 5px 10px;
            /* border:1px solid; */
            border-radius: 5px;
            padding: 5px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            background-color: #e6aefb;
        }
    </style>
    <div class="layout-page">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <?php
                    if(isset($submitnews)){
                        echo '
                        <div>
                            <div class="alert alert-warning alert-dismissible me-auto" role="alert">'.$submitnews.'
                            <a href="./index.php" type="button" class="btn btn-warning" style="float:right;margin-top:-7px">Xem danh mục đã thêm</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>';
                    }
                ?>
                <div class="col-xl">
                    <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Sửa Tin Tức</h5>
                        <small class="text-muted float-end">edit News</small>
                    </div>
                    <div class="card-body">
                        <form action="editnews.php?nid=<?=$row['id']?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Title Tin Tức (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" id="slug" name="name_news" value="<?=$row['name_news']?>" placeholder="Nhập Name Danh Mục" onkeyup="ChangeToSlug()">
                                </div>
                            </div>
                            <!-- end name -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Slug Tin tức</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-link'></i></span>
                                <input type="text" id="convert_slug" class="form-control" name="slug" value="<?=$row['slug']?>" placeholder="Đường Dẫn Danh Mục" readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Hình Ảnh (*)</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-camera'></i></span>
                                    <input type="file" id="fileInput" class="form-control" name="file_upload" onchange="onFileSelected()" placeholder="Nhập file Hình Ảnh" multiple>
                                </div>
                                <div id="imageContainer">
                                    <?php if($row['image']):?>
                                        <img src="<?=showlinkimage()?>/upload/news/<?=$row['image']?>" alt="<?=$row['image']?>">
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-message">Mô Tả Ngắn</label>
                                <div class="input-group input-group-merge">
                                <textarea id="short_description" class="form-control" name="short_description" placeholder="Nhập Mô tả !!!"><?=$row['short_description']?></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-message">ConTent</label>
                                <div class="input-group input-group-merge">
                                <textarea id="content" class="form-control" name="content" placeholder="Nhập Thông tin chính"><?=$row['content']?></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="text-light fw-semibold d-block">Ẩn/Hiện Danh Mục</small>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" name="action" id="inlineRadio1" value="1" <?=($row['action'] == 1) ? 'checked':''?>>
                                    <label class="form-check-label" for="inlineRadio1">Hiện Danh Mục</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="action" id="inlineRadio2" value="2" <?=($row['action'] == 2) ? 'checked':''?>>
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
    ClassicEditor.create( document.querySelector( '#content' ) )
    .catch( error => {
        console.error( error );
    } );
    ClassicEditor.create( document.querySelector( '#short_description' ) )
    .catch( error => {
        console.error( error );
    } );



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
<!-- hình ảnh -->
<script>
      function onFileSelected() {
    // show
    var imageContainer = document.getElementById("imageContainer");
    // show hình đầu tiên là hình nền
    var firstFile = event.target.files[0];

        imageContainer.innerHTML = '';
    
        var reader = new FileReader();

        reader.onload = function (e) {
            var img = document.createElement("img");
            img.src = e.target.result;
            img.classList.add("image-preview");


            var pTag = document.createElement("p");
                pTag.innerHTML = firstFile.name;
            var container = document.createElement("div");
            container.appendChild(img);
            container.appendChild(pTag);

            imageContainer.appendChild(container);

        };

        reader.readAsDataURL(firstFile);

}
</script>