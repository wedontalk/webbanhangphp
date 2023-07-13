<?php
    include_once(__DIR__.'./../model/newsModel.php');
    class NewsController{

        private $model;
        private $db;
    
        public function __construct() {
            $this->model = new NewsModel();
            $this->db = new Database();
        }
        // hàm dùng để phân trang
        public function news_list($start_index = 0, $per_page = 10){
            $data = [];
            $total_records = $this->db->count_records('news');
            $total_pages = ceil($total_records / $per_page);
        
            $news = $this->select_news($start_index, $per_page);
        
            $data['news'] = $news;
            $data['total_pages'] = $total_pages;
            $data['current_page'] = ($start_index / $per_page) + 1;
            return $data;
        }
        public function select_news($start_index, $per_page){
            $table = "SELECT * FROM news ORDER BY id ASC LIMIT $start_index, $per_page";
            $result = $this->db->select($table);
            return $result;
        }
        // end 2 hàm dùng để phân trang
        public function create($data) {
                if(empty($data['name_news'])){
                    $alert = "Tên tin tức không được để rỗng !!!";
                    return $alert;
                }else{
                    if(isset($_FILES['file_upload'])) {
                        $newFilename = date('YmdHis',time()).mt_rand().'.jpg';
                        move_uploaded_file($_FILES['file_upload']['tmp_name'], '../../../upload/news/' . $newFilename);
                        $data['image'] = $newFilename;
                        // $data['create_at'] = new DateTime();
                        $result = $this->model->create($data);
                        if($result){
                            $alert = "Thêm thành công";
                            return $alert;
                        }
                    }
                }
        }
        // end insert data
        public function read($id) {
            // return $this->model->read($id);
        }
        // end show data
        public function edit($id){
            $table = "SELECT * FROM news WHERE id = '$id'";
            return $this->db->select($table);
        }
        // end show danh sách data
        public function update($id, $data) {
            $datatitle = $data['name_news'];
            $showcheck = $this->edit($id);
            $row = $showcheck->fetch(PDO::FETCH_ASSOC);
            if(empty($datatitle)){
                $alert = "Tên tin tức không được để rỗng !!!";
                return $alert;
            }else{
                if(isset($_FILES['file_upload'])) {
                    $new_images = $_FILES['file_upload']['name'];
                    if($new_images){
                        $image_path = '../../../upload/news/' .$row['image'];
                        if(file_exists($image_path)) {
                          unlink($image_path);
                        }
                        $newFilename = date('YmdHis',time()).mt_rand().'.jpg';
                        move_uploaded_file($_FILES['file_upload']['tmp_name'], '../../../upload/news/' . $newFilename);
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
                $image_path = '../../../upload/news/' . $row['image'];
                if(file_exists($image_path)) {
                  unlink($image_path);
                }
            }
            $result = $this->model->delete($id);
            if($result){
              $alert = "Xóa thành công !!!";
              return $alert;
            }
        }
    }
    
?>