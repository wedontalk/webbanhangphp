<?php
    include_once(__DIR__.'./../model/productModel.php');
    // include(__DIR__.'../../helpers/linkurladmin.php');
    class ProductController{

        private $model;
        private $db;
        private $view;
    
        public function __construct() {
            $this->model = new ProductModel();
            $this->db = new Database();
        }
        // hàm dùng để phân trang
        public function product_list($start_index = 0, $per_page = 10){
            $data = [];
            $total_records = $this->db->count_records('product');
            $total_pages = ceil($total_records / $per_page);
        
            $product = $this->select_product($start_index, $per_page);
            $data['product'] = $product;
            $data['total_pages'] = $total_pages;
            $data['current_page'] = ($start_index / $per_page) + 1;
            return $data;
        }
        public function select_product($start_index, $per_page){
            $table = "SELECT product.*,brand.name_brand as brand_name, category.name_cate as category_name 
            FROM product 
            JOIN category ON product.id_category = category.id
            JOIN brand ON product.id_brand = brand.id
            ORDER BY product.id 
            ASC LIMIT $start_index, $per_page";
            $result = $this->db->select($table);
            return $result;
        }

        public function select_product_new_limit_8(){
          $table="SELECT * FROM product WHERE action = 1 ORDER BY id DESC Limit 8";
          $result = $this->db->select($table);
          return $result;
        }
        public function select_product_outstanding_limit_8(){
          $table="SELECT * FROM product WHERE action = 1 ORDER BY view DESC Limit 8";
          $result = $this->db->select($table);
          return $result;
        }
        public function select_prd_limit_6(){
            $table="SELECT * FROM product WHERE action = 1 ORDER BY view DESC Limit 6";
            $result = $this->db->select($table);
            return $result;
        }
        // end 2 hàm dùng để phân trang
        public function create($data) {
            $dataname = $data['name'];
            $table = "SELECT * FROM product WHERE name = '$dataname' LIMIT 1";
            $checkdata = $this->db->select($table);
            if($checkdata->rowCount() > 0){
                $alert = "Tên danh mục này đã tồn tại trong Database !!!";
                return $alert;
            }else{
                if(empty($dataname)){
                    $alert = "Tên danh mục không được để rỗng !!!";
                    return $alert;
                }else{
                    if(isset($_FILES['file_upload'])) {
                      foreach ($_FILES['file_upload']['name'] as $key => $name){
                          $newFilename = date('YmdHis',time()).mt_rand().'.jpg';
                          move_uploaded_file($_FILES['file_upload']['tmp_name'][$key], '../../../upload/images/' . $newFilename);
                          $image[] = $newFilename;
                      }
                      $layhinh = implode(", ", $image);
                      $chuyenhinh = explode(", ", $layhinh);
                      $luuhinh = json_encode($chuyenhinh, JSON_UNESCAPED_SLASHES);
                      $data['image'] = $luuhinh;
                      // data color
                      $gettag = implode(", ", $_POST['color']);
                      $data['color'] = $gettag;
                      // $data['create_at'] = new DateTime();
                      $result = $this->model->create($data);
                      if($result){
                              $alert = "Thêm thành công";
                              return $alert;
                      }
                    }else{
                      $alert = "Bạn chưa thêm hình ảnh cho sản phẩm";
                      return $alert;
                    }
                }
            }
        }
        // end insert data
        public function read($id) {
            return $this->model->read($id);
        }
        // end show data
        public function edit($id){
            $table = "SELECT * FROM product WHERE id = '$id'";
            return $this->db->select($table);
        }
        // end show danh sách data
        public function update($id, $data) {
            $dataname = $data['name'];
            // $table = "SELECT * FROM product WHERE id = '$id' LIMIT 1";
            // $checkdata = $this->db->select($table);
            $showcheck = $this->edit($id);
            $row = $showcheck->fetch(PDO::FETCH_ASSOC);
            if(empty($dataname)){
                $alert = "Tên sản phẩm không được để rỗng !!!";
                return $alert;
            }else{
              if(isset($_FILES['file_upload'])) {
                $new_images = array_filter($_FILES['file_upload']['name']);
                if($new_images){
                  // $images_to_delete = json_decode($product['image'], true);
                  if(json_decode($row['image'])){
                    foreach (json_decode($row['image'], true) as $value) {
                      $image_path = '../../../upload/images/' . $value;
                      if(file_exists($image_path)) {
                        unlink($image_path);
                      }
                    }
                  }else{
                    $oneimage = json_decode($row['image'])[0];
                    $image_path = '../../../upload/images/' . $oneimage;
                    if(file_exists($image_path)) {
                      unlink($image_path);
                    }
                  }

                  foreach ($_FILES['file_upload']['name'] as $key => $name){
                      $newFilename = date('YmdHis',time()).mt_rand().'.jpg';
                      move_uploaded_file($_FILES['file_upload']['tmp_name'][$key], '../../../upload/images/' . $newFilename);
                      $image[] = $newFilename;
                  }
                  $layhinh = implode(", ", $image);
                  $chuyenhinh = explode(", ", $layhinh);
                  $luuhinh = json_encode($chuyenhinh, JSON_UNESCAPED_SLASHES);
                  $data['image'] = $luuhinh;
                  $gettag = implode(", ", $_POST['color']);
                  $data['color'] = $gettag;
                  $result = $this->model->update($id, $data);
                  if($result){
                      $alert = "sửa thành công !!";
                      return $alert;
                  }
                }


              }
            }
            $gettag = implode(", ", $_POST['color']);
            $data['color'] = $gettag;
            $result = $this->model->update($id, $data);
            if($result){
                $alert = "sửa thành công !!";
                return $alert;
            }
        }
        // end update data
        public function delete($id) {
          $showcheck = $this->edit($id);
          $row = $showcheck->fetch(PDO::FETCH_ASSOC);
          if(json_decode($row['image'])){
            foreach (json_decode($row['image'], true) as $value) {
              $image_path = '../../../upload/images/' . $value;
              if(file_exists($image_path)) {
                unlink($image_path);
              }
            }
          }else{
            $oneimage = json_decode($row['image'])[0];
            $image_path = '../../../upload/images/' . $oneimage;
            if(file_exists($image_path)) {
              unlink($image_path);
            }
          }
          $table="SELECT * FROM order_detail where id_product = '$id'";
          $result = $this->db->select($table);
          if($result != false){
            $result->execute();
            $rowcount = $result->rowCount();
            if($rowcount > 0){
              $alert = "Không thể xóa bởi vì sản phẩm đã được liên kết với đơn mua của khách";
              return $alert;
            }else{
              $result = $this->model->delete($id);
              if($result){
                $alert = "Xóa thành công !!!";
                return $alert;
              }
            }
          }else{
            $alert = "Không thể xóa !!!";
            return $alert;
          }
        }

        public function categorywithproduct($table){
            return $this->model->selectCategory($table);
        }

        function diffForHumans($date) {
            $now = new DateTime();
            $date = new DateTime($date);
            $diff = $now->diff($date);
          
            // Tính toán số thời gian khác biệt ở các mức khác nhau
            $year = $diff->y;
            $month = $diff->m;
            $day = $diff->d;
            $hour = $diff->h;
            $minute = $diff->i;
            $second = $diff->s;
          
            // Tìm chuỗi giá trị thời gian khác biệt
            $diffString = '';
            if ($year > 0) {
              $diffString .= "$year năm ";
            }
            if ($month > 0) {
              $diffString .= "$month tháng ";
            }
            if ($day > 0) {
              $diffString .= "$day ngày ";
            }
            if ($hour > 0) {
              $diffString .= "$hour giờ ";
            }
            if ($minute > 0) {
              $diffString .= "$minute phút ";
            }
            if ($second > 0) {
              $diffString .= "$second giây ";
            }
          
            // Tách chuỗi giá trị thời gian khác biệt thành mảng và xác định vài giá trị đầu tiên
            $parts = explode(' ', trim($diffString));
            $firstPart = $parts[0];
            $secondPart = isset($parts[1]) ? $parts[1] : '';
          
            // Xác định chuỗi kết quả dựa trên các thời gian khác biệt tính được
            if ($year > 0 || $month > 0 || $day > 0 || $hour > 0 || $minute > 0 || $second > 0) {
              if ($year == 0 && $month == 0 && $day == 0 && $hour == 0 && $minute == 0) {
                // giây
                $diffString = $second . " giây";
              } else if ($year == 0 && $month == 0 && $day == 0 && $hour == 0) {
                // phút và giây
                $diffString = $minute . " phút";
              } else if ($year == 0 && $month == 0 && $day == 0) {
                // giờ, phút và giây
                $diffString = $hour . " giờ ";
              } else if ($year == 0 && $month == 0) {
                // ngày, giờ, phút và giây
                $diffString = $day . " ngày " . $hour . " giờ ";
              } else {
                // năm, tháng, ngày, giờ, phút và giây
                $diffString = $firstPart . " " . $secondPart . " ";
              }
              return $diffString . " trước";
            } else {
              return $second;
            }
        }
          
        public function show_detail_prd_slug($slug){
          $table = "SELECT product.*,category.name_cate, category.slug AS cate_slug
          FROM product
          JOIN category ON product.id_category = category.id
          WHERE product.slug = '$slug' AND product.action = 1 LIMIT 1";
          $result = $this->db->select($table);
          return $result->fetch(PDO::FETCH_ASSOC);
        }

        // phần search user
        public function product_search($search, $start_index = 0, $per_page = 6){
          $data = [];
          $total_records = $this->db->count_search('product',$search);
          $total_pages = ceil($total_records / $per_page);
      
          $product = $this->search_query($search, $start_index, $per_page);
          $data['product'] = $product;
          $data['total_pages'] = $total_pages;
          $data['current_page'] = ($start_index / $per_page) + 1;
          return $data;
        }


        public function search_query($search, $start_index, $per_page){
          $table = "SELECT product.*,category.name_cate, category.slug AS cate_slug
          FROM product
          JOIN category ON product.id_category = category.id
          WHERE product.action = 1 AND product.name LIKE'%$search%' LIMIT $start_index, $per_page";
          $result = $this->db->select($table);
          return $result;
        }

        // phần show product category
        public function product_list_user_cate($slug, $start_index = 0, $per_page = 10){
          $data = [];
          $total_records = $this->db->count_records('product');
          $total_pages = ceil($total_records / $per_page);
      
          $product = $this->select_product_user($slug, $start_index, $per_page);
          $data['product'] = $product;
          $data['total_pages'] = $total_pages;
          $data['current_page'] = ($start_index / $per_page) + 1;
          return $data;
      }
      public function select_product_user($slug, $start_index, $per_page){
          $table = "SELECT product.*,product.slug as slug_product ,category.slug, category.name_cate as category_name 
          FROM product 
          JOIN category ON product.id_category = category.id
          WHERE category.slug = '$slug' AND product.action = 1 LIMIT $start_index, $per_page";
          $result = $this->db->select($table);
          return $result;
      }



      // show cửa hàng user
      public function list_product_action_1($start_index = 0, $per_page = 10){
        $data = [];
        $total_records = $this->db->count_records('product');
        $total_pages = ceil($total_records / $per_page);
    
        $product = $this->select_product_action_1($start_index, $per_page);
        $data['product'] = $product;
        $data['total_pages'] = $total_pages;
        $data['current_page'] = ($start_index / $per_page) + 1;
        return $data;
      }

      public function select_product_action_1($start_index, $per_page){
          $table = "SELECT product.*,brand.name_brand as brand_name, category.name_cate as category_name 
          FROM product 
          JOIN category ON product.id_category = category.id
          JOIN brand ON product.id_brand = brand.id
          WHERE product.action = 1
          ORDER BY product.id 
          LIMIT $start_index, $per_page";
          $result = $this->db->select($table);
          return $result;
      }
    }
    
?>