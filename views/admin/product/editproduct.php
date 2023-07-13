<?php
    include('../header.php');
    include('./../../../controller/productController.php');
    $class = new ProductController();

    if(isset($_GET['prid']) && $_GET['prid'] != NULL){
        $id = $_GET['prid'];
        $resultpro = $class->edit($id);
        $row = $resultpro->fetch(PDO::FETCH_ASSOC);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = $_POST['name'];
            $slug = $_POST['slug'];
            $price = $_POST['price'];
            $price_discount = $_POST['price_discount'];
            $id_category = $_POST['id_category'];
            $id_brand = $_POST['id_brand'];
            $quantity = $_POST['quantity'];
            $width = $_POST['width'];
            $length = $_POST['length'];
            $height = $_POST['height'];
            $color = $_POST['color'];
            $weight = $_POST['weight'];
            $quality = $_POST['quality'];
            $packing_form = $_POST['packing_form'];
            // $image[] = $_POST['file_upload'][0];
            $description = $_POST['description'];
            $action = $_POST['action'];
            $now = new DateTime();
            $showdate = $now->format('Y-m-d H:i:s');
            $data = [
                'name' => $name,
                'slug' => $slug,
                'price' => $price,
                'price_discount' => $price_discount,
                'id_category' => $id_category,
                'id_brand' => $id_brand,
                'quantity' => $quantity,
                'description' => $description,
                'width' => $width,
                'length' => $length,
                'height' => $height,
                'weight' => $weight,
                'quality' => $quality,
                'packing_form' => $packing_form,
                'update_at' => $showdate,
                'action' => $action
            ];
            $submitproduct = $class->update($id, $data);
        }
    }
    $table = "SELECT * FROM category";
    $showcate = $class->categorywithproduct($table);
    $query = "SELECT * FROM brand";
    $showbrand = $class->categorywithproduct($query);
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
            #imageContainer{
                display:inline-flex;
                overflow: auto;
                width:100%;
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
            #imageContainer p{
                margin: 5px 10px;
                font-size:15px;
                word-wrap:break-word;
                overflow: hidden;
                white-space: initial;
                text-overflow: ellipsis;  
                color:cornflowerblue;
                width:100px;
            }
        </style>
    <div class="layout-page">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <?php
                    if(isset($submitproduct)){
                        echo '
                        <div>
                            <div class="alert alert-warning alert-dismissible me-auto" role="alert">'.$submitproduct.'
                            <a href="./index.php" type="button" class="btn btn-warning" style="float:right;margin-top:-7px">Xem danh mục đã thêm</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>';
                    }
                ?>
                <div class="col-xl">
                    <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Danh Mục Sản Phẩm</h5>
                        <small class="text-muted float-end">Product</small>
                    </div>
                    <div class="card-body">
                        <form action="editproduct.php?prid=<?=$id?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Name Sản Phẩm (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" id="slug" name="name" value="<?=$row['name']?>" placeholder="Nhập Name Danh Mục" onkeyup="ChangeToSlug()">
                                </div>
                            </div>
                            <!-- end name -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Slug Sản Phẩm</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-link'></i></span>
                                <input type="text" id="convert_slug" class="form-control" name="slug" value="<?=$row['slug']?>" placeholder="Đường Dẫn Danh Mục" readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Chọn Danh Mục (*)</label>
                                <select id="defaultSelect" class="form-select" name="id_category">
                                    <option selected>-- Chọn Một Danh Mục --</option>
                                    <?php foreach ($showcate as $key => $value):?>
                                    <option value="<?=$value['id']?>" <?=($value['id'] == $row['id_category']) ? 'selected':''?>><?=$value['name_cate']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Chọn Nhãn Hàng (*)</label>
                                <select id="defaultSelect" class="form-select" name="id_brand">
                                    <option selected>-- Chọn Một Nhãn Hàng --</option>
                                    <?php foreach ($showbrand as $key => $value):?>
                                    <option value="<?=$value['id']?>" <?=($value['id'] == $row['id_brand']) ? 'selected':''?>><?=$value['name_brand']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Giá (*)</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input type="number" id="price" class="form-control" placeholder="100.000" name="price" value="<?=$row['price']?>">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Giá Giảm</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" placeholder="80.000" name="price_discount" value="<?=$row['price_discount']?>">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Số Lượng (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" name="quantity" value="<?=$row['quantity']?>" placeholder="Nhập Số Lượng Sản Phẩm">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Hình Ảnh (*)</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-camera'></i></span>
                                    <input type="file" id="fileInput" class="form-control" name="file_upload[]" onchange="onFileSelected()" placeholder="Nhập file Hình Ảnh" multiple>
                                </div>
                                <div id="imageContainer">
                                    <?php if(json_decode($row['image'])):?>
                                        <?php foreach (json_decode($row['image']) as $key => $value):?>
                                            <div>
                                                <img src="<?=showlinkimage()?>/upload/images/<?=$value?>" alt="" width="100px" height="100px">
                                                <p>
                                                    <?php if($key == 0):?>    
                                                        Hình Nền
                                                    <?php else:?>
                                                        <?=$value?>
                                                    <?php endif;?>
                                                </p>
                                            </div>
                                            <?php endforeach;?>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-message">description (*)</label>
                                <div class="input-group">
                                    <textarea id="editor" class="form-control" name="description" placeholder="Nhập Mô tả danh mục nếu có !!!"><?=$row['description']?></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="text-light fw-semibold d-block">Ẩn/Hiện Danh Mục</small>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" name="action" id="inlineRadio1" value="1" <?=($row['action'] == 1) ? 'checked':''?>>
                                    <label class="form-check-label" for="inlineRadio1">Hiện Sản Phẩm</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="action" id="inlineRadio2" value="2" <?=($row['action'] == 2) ? 'checked':''?>>
                                    <label class="form-check-label" for="inlineRadio2">Ẩn Sản Phẩm</label>
                                </div>
                            </div>
                            <div class="divider">
                                <div class="divider-text">Chi Tiết Sản Phẩm</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Chiều Dài (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" name="length" value="<?=$row['length']?>" placeholder="Nhập Số Lượng Sản Phẩm">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Chiều Rộng (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" name="width" value="<?=$row['width']?>" placeholder="Nhập Số Lượng Sản Phẩm">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Chiều Cao (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" name="height" value="<?=$row['height']?>" placeholder="Nhập Số Lượng Sản Phẩm">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Cân Nặng (*)</label>
                                <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-rename'></i></span>
                                <input type="text" class="form-control" name="weight" value="<?=$row['weight']?>" placeholder="Nhập Số Lượng Sản Phẩm">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Màu Sắc (*)</label>
                                <div class="input-group input-group-merge">
                                <input type="text" class="form-control" name="color[]" value="<?=$row['color']?>" placeholder="Nhập màu sắc" data-role="tagsinput">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Chất Lượng (*)</label>
                                <select id="defaultSelect" class="form-select" name="quality">
                                    <option value="1" <?=($row['quality'] == 1) ? 'selected':''?>>Mới</option>
                                    <option value="2" <?=($row['quality'] == 2) ? 'selected':''?>>Đã Sử dụng</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Đóng Gói (*)</label>
                                <select id="defaultSelect" class="form-select" name="packing_form">
                                    <option value="1" <?=($row['packing_form'] == 1) ? 'selected':''?>>Hộp</option>
                                    <option value="2" <?=($row['packing_form'] == 2) ? 'selected':''?>>Bao Bì</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu Ngay</button>
                            <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
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
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create( document.querySelector( '#editor' ) )
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
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|\[|\]|\{|\}|_/gi, '');
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

<script>
    function onFileSelected() {
        // get file
    var selectedFiles = event.target.files;
    // show
    var imageContainer = document.getElementById("imageContainer");
    // show hình đầu tiên là hình nền
    var firstFile = event.target.files[0];

    imageContainer.innerHTML = '';
    for (var i = 0; i < selectedFiles.length; i++) {
        var reader = new FileReader();
        var file = selectedFiles[i];

        reader.onload = function (e) {
            var img = document.createElement("img");
            img.src = e.target.result;
            img.classList.add("image-preview");


            var pTag = document.createElement("p");
                pTag.innerHTML = file.name;
            if (firstFile) {
                pTag.innerHTML = "Hình nền";
                firstFile = false;
            }
            var container = document.createElement("div");
            container.appendChild(img);
            container.appendChild(pTag);

            imageContainer.appendChild(container);

        };

        reader.readAsDataURL(file);
    }
}
</script>
<!-- <script>
    var input = document.getElementById("price");

    // Định dạng giá trị người dùng nhập
    input.addEventListener("input", function() {
    // Lấy giá trị người dùng nhập vào
    var value = this.value;

    // Định dạng giá trị người dùng nhập và cập nhật lại trường nhập
    this.value = numeral(value).format('0');
    });
</script> -->