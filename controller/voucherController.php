<?php
    include_once(__DIR__.'./../model/voucherModel.php');
    class VoucherController{

        private $model;
        private $db;
    
        public function __construct() {
            $this->model = new VoucherModel();
            $this->db = new Database();
        }
        // hàm dùng để phân trang
        public function voucher_list($start_index = 0, $per_page = 10){
            $data = [];
            $total_records = $this->db->count_records('voucher');
            $total_pages = ceil($total_records / $per_page);
        
            $voucher = $this->select_voucher($start_index, $per_page);
        
            $data['voucher'] = $voucher;
            $data['total_pages'] = $total_pages;
            $data['current_page'] = ($start_index / $per_page) + 1;
            return $data;
        }
        public function select_voucher($start_index, $per_page){
            $table = "SELECT * FROM voucher ORDER BY id ASC LIMIT $start_index, $per_page";
            $result = $this->db->select($table);
            return $result;
        }
        // end 2 hàm dùng để phân trang
        public function create($data) {
            $now = new DateTime();
            $showdate = $now->format('Y-m-d H:i:s');
            if(empty($data['name_voucher'])){
                $alert = "Tên danh mục không được để rỗng !!!";
                return $alert;
            }else{
                if($data['date_start'] > $data['date_end']){
                    $alert = "Không Thành Công (thời gian kết thúc phải lớn hơn thời gian hiện tại)";
                    return $alert;
                }elseif ($showdate > $data['date_end']) {
                    $alert = "Không Thành Công (thời gian kết thúc phải lớn hơn thời gian hiện tại)";
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
            return $this->model->read($id);
        }
        // end show data
        public function edit($id){
            $table = "SELECT * FROM voucher WHERE id = '$id'";
            return $this->db->select($table);
        }
        // end show danh sách data
        public function update($id, $data) {
            $now = new DateTime();
            $showdate = $now->format('Y-m-d H:i:s');
            $dataname = $data['name_voucher'];
            if(empty($dataname)){
                $alert = "Tên voucher không được để rỗng !!!";
                return $alert;
            }else{
                if($data['date_start'] > $data['date_end']){
                    $alert = "Không Thành Công (thời gian kết thúc phải lớn hơn thời gian hiện tại)";
                    return $alert;
                }elseif ($showdate > $data['date_end']) {
                    $alert = "Không Thành Công (thời gian kết thúc phải lớn hơn thời gian hiện tại)";
                    return $alert;
                }else{
                    $result = $this->model->update($id, $data);
                    if($result){
                        $alert = "Sửa thành công";
                        return $alert;
                    }
                }
            }
        }
        // end update data
        public function delete($id) {
            $result = $this->model->delete($id);
            if($result){
                $alert = "Xóa thành công !!!";
                return $alert;
            }
            
        }
    }
    
?>