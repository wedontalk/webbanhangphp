<?php
    include_once(__DIR__.'./../model/slideModel.php');
    class SlideController{

        private $model;
        private $db;
    
        public function __construct() {
            $this->model = new SlideModel();
            $this->db = new Database();
        }
        
        public function select_slide(){
            $table = "SELECT * FROM slide ORDER BY thu_tu ASC";
            $result = $this->db->select($table);
            return $result;
        }
        // end 2 hàm dùng để phân trang
        public function create($data) {
            $datatitle = $data['title'];
            $table = "SELECT * FROM slide WHERE title = '$datatitle'";
            $checkdata = $this->db->select($table);
            if($checkdata->rowCount() > 0){
                $alert = "Tên slider này đã tồn tại trong Database !!!";
                return $alert;
            }else{
                if(empty($datatitle)){
                    $alert = "Tên danh mục không được để rỗng !!!";
                    return $alert;
                }else{
                    $showthu_tu = "SELECT MAX(thu_tu) AS maxthu_tu FROM slide";
                    $checkthu_tu = $this->db->select($showthu_tu);
                    $invNum = $checkthu_tu->fetch(PDO::FETCH_ASSOC);
                    if(isset($_FILES['file_upload'])) {
                        $newFilename = date('YmdHis',time()).mt_rand().'.jpg';
                        move_uploaded_file($_FILES['file_upload']['tmp_name'], '../../../upload/slider/' . $newFilename);

                        $data['image'] = $newFilename;
                        // $data['create_at'] = new DateTime();
                        $data['thu_tu'] = $invNum['maxthu_tu'] +=1;
                        $result = $this->model->create($data);
                        if($result){
                            $alert = "Thêm thành công";
                            return $alert;
                        }
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
            $table = "SELECT * FROM slide WHERE id = '$id'";
            return $this->db->select($table);
        }
        // end show danh sách data
        public function update($id, $data) {
            $datatitle = $data['title'];
            $showcheck = $this->edit($id);
            $row = $showcheck->fetch(PDO::FETCH_ASSOC);
            if(empty($datatitle)){
                $alert = "Tên danh mục không được để rỗng !!!";
                return $alert;
            }else{
                if(isset($_FILES['file_upload'])) {
                    $new_images = $_FILES['file_upload']['name'];
                    if($new_images){
                        $image_path = '../../../upload/slider/' .$row['image'];
                        if(file_exists($image_path)) {
                          unlink($image_path);
                        }
                        $newFilename = date('YmdHis',time()).mt_rand().'.jpg';
                        move_uploaded_file($_FILES['file_upload']['tmp_name'], '../../../upload/slider/' . $newFilename);
                        $data['image'] = $newFilename;
                    }
                    $result = $this->model->update($id, $data);
                    if($result){
                        $alert = "sửa thành công !!";
                        return $alert;
                    }
                }
            }
        }
        // end update data
        public function delete($id) {
            $showcheck = $this->edit($id);
            $row = $showcheck->fetch(PDO::FETCH_ASSOC);
            if($row['image'] && $row['image'] != ''){
                $image_path = '../../../upload/slider/' . $row['image'];
                if(file_exists($image_path)) {
                  unlink($image_path);
                }
            }
            $result = $this->model->delete($id);
            if($result){
              $alert = "Xóa thành công !!!";
              return $alert;
            }
            // if($checkdata->rowCount() > 0){
            //     $alert = "Có sản phẩm đang liên kết với danh mục này (không thể xóa) !!";
            //     return $alert;
            // }else{
            //     $result = $this->model->delete($id);
            //     if($result){
            //         $alert = "Xóa thành công !!!";
            //         return $alert;
            //     }

            // }
        }

        public function sortUpdate($data){
            foreach ($data['id'] as $key => $val) {
                $id = $val;
                $thu_tu = $key;
                $table = "UPDATE slide SET thu_tu='$thu_tu' WHERE id='$id'";
                $stmt = $this->db->updateTable($table);
            }
        }

        public function select_slide_user_banner(){
            $table="SELECT * FROM slide WHERE action = 1 ORDER BY thu_tu";
            $result = $this->db->select($table);
            return $result;
        }
    }
    
?>