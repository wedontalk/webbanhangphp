<?php
    include_once(__DIR__.'./../model/brandModel.php');
    class BrandController{

        private $model;
        private $db;
    
        public function __construct() {
            $this->model = new BrandModel();
            $this->db = new Database();
        }
        // hàm dùng để phân trang
        public function brand_list($start_index = 0, $per_page = 10){
            $data = [];
            $total_records = $this->db->count_records('brand');
            $total_pages = ceil($total_records / $per_page);
        
            $brand = $this->select_brand($start_index, $per_page);
        
            $data['brand'] = $brand;
            $data['total_pages'] = $total_pages;
            $data['current_page'] = ($start_index / $per_page) + 1;
            return $data;
        }
        public function select_brand($start_index, $per_page){
            $table = "SELECT * FROM brand ORDER BY id ASC LIMIT $start_index, $per_page";
            $result = $this->db->select($table);
            return $result;
        }
        // end 2 hàm dùng để phân trang
        public function create($data) {
            $dataname = $data['name_brand'];
            $table = "SELECT * FROM brand WHERE name_brand = '$dataname' LIMIT 1";
            $checkdata = $this->db->select($table);
            if($checkdata->rowCount() > 0){
                $alert = "Tên nhãn hàng này đã tồn tại trong Database !!!";
                return $alert;
            }else{
                if(empty($dataname)){
                    $alert = "Tên nhãn hàng không được để rỗng !!!";
                    return $alert;
                }else{
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
            $table = "SELECT * FROM brand WHERE id = '$id'";
            return $this->db->select($table);
        }
        // end show danh sách data
        public function update($id, $data) {
            $dataname = $data['name_brand'];
            if(empty($dataname)){
                $alert = "Tên danh mục không được để rỗng !!!";
                return $alert;
            }else{
                $result = $this->model->update($id, $data);
                if($result){
                        $alert = "Sửa thành công";
                        return $alert;
                }
            }
        }
        // end update data
        public function delete($id) {
            $table = "SELECT * FROM product WHERE id_brand = '$id'";
            $checkdata = $this->db->select($table);
            if($checkdata->rowCount() > 0){
                $alert = "Có sản phẩm đang liên kết với danh mục này (không thể xóa) !!";
                return $alert;
            }else{
                $result = $this->model->delete($id);
                if($result){
                    $alert = "Xóa thành công !!!";
                    return $alert;
                }

            }
        }


        public function select_user_brand(){
            $table = "SELECT * FROM brand where action = 1 ORDER BY id ASC";
            $result = $this->db->select($table);
            return $result;
        }
    }
    
?>