    <?php
        include('../header.php');
        include('./../../../controller/slideController.php');
        $class = new SlideController();

        if(isset($_GET['slid']) && $_GET['slid'] != NULL){
            // start show value use edit
            $id = $_GET['slid'];
            $resultcate = $class->edit($id);
            $row = $resultcate->fetch(PDO::FETCH_ASSOC);
            // end show value use edit
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $title = $_POST['title'];
                $link = $_POST['link'];
                $action = $_POST['action'];
                $now = new DateTime();
                $showdate = $now->format('Y-m-d H:i:s');
                $data = [
                    'title' => $title,
                    'link' => $link,
                    'create_at' => $showdate,
                    'action' => $action
                ];
                $submitslide = $class->update($id,$data);
        }
    }
    ?>
            <style>
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
                    if(isset($submitslide)){
                        echo '
                        <div>
                            <div class="alert alert-warning alert-dismissible me-auto" role="alert">'.$submitslide.'
                            <a href="./index.php" type="button" class="btn btn-warning" style="float:right;margin-top:-7px">Xem danh mục đã thêm</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>';
                    }
                ?>
                <div class="col-xl">
                    <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">sửa Slider</h5>
                        <small class="text-muted float-end">update slider</small>
                    </div>
                    <div class="card-body">
                        <form action="editslide.php?slid=<?=$row['id']?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Title slider (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" name="title" value="<?=$row['title']?>" placeholder="Nhập Name slider">
                                </div>
                            </div>
                            <!-- end name -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Link slider</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-link'></i></span>
                                <input type="text" class="form-control" name="link" value="<?=$row['link']?>" placeholder="Nhập link slider" >
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
                                    <img src="<?=showlinkimage()?>/upload/slider/<?=$row['image']?>" alt="<?=$row['image']?>">
                                    <?php endif;?>
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