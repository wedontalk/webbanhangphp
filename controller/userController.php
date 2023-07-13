<?php
    include_once(__DIR__.'./../lib/database.php');
    include_once(__DIR__.'./../helpers/format.php');
    include_once(__DIR__.'./../model/userModel.php');
    class userController{

        private $db;
        private $fm;
        private $model;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
            $this->model = new UserModel();
        }

        public function register($data){
            $name = $this->fm->validation($data['name']);
            $email = $this->fm->validation($data['email']);
            $username = $this->fm->validation($data['user_name']);
            $password = $this->fm->validation($data['password']);
            $repassword = $this->fm->validation(md5($_POST['repassword']));

            if(empty($name)){
                $alert = "Họ và Tên không được rỗng !!!";
                return $alert;
            }elseif(empty($email)){
                $alert = "Email không được rỗng !!!";
                return $alert;
            }elseif(empty($username)){
                $alert = "Tài Khoản không được rỗng !!!";
                return $alert;
            }elseif(empty($password)){
                $alert = "password không được rỗng !!!";
                return $alert;
            }elseif(empty($repassword)){
                $alert = "mật khẩu lặp lại không được rỗng !!!";
                return $alert;
            }else{
                $table = "SELECT * FROM tbl_user WHERE user_name = '$username' || email = '$email' LIMIT 1";
                $result = $this->db->select($table);
                if($result != false){
                    $result->execute();
                    $rowcount = $result->rowCount();
                    $value = $result->fetch(PDO::FETCH_ASSOC);
                    if($rowcount > 0){
                        $alert = "Username hoặc Email này đã được đăng ký !!!";
                        return $alert;
                    }else{
                        if($password == $repassword){
                            $result = $this->model->create($data);
                            $alert = "Đăng Ký Thành Công !";
                            if($alert){
                                echo'
                                <script> 
                                    setTimeout(function() {
                                        location.replace("index.php?page=login"); 
                                    }, 2000);
                                </script>
                                ';
                            }
                            return $alert;
                        }else{
                            $alert = "mật khẩu và Mật khẩu lặp lại không trùng nhau !!!";
                            return $alert;
                        }
                    }
                }
            }
        }

        public function select_thanhpho(){
            $table = "SELECT * FROM province ORDER BY id ASC";
            return $this->db->select($table);
        }
        public function update($id,$data){
            if(empty($data['name'])){
                $alert = 'Họ và Tên Không được để rỗng';
                return $alert;
            }elseif(empty($data['email'])){
                $alert = 'Email Không được để rỗng';
                return $alert;
            }elseif(empty($data['phone'])){
                $alert = 'Số Điện Thoại Không được để rỗng';
                return $alert;
            }elseif(empty($data['id_province'])){
                $alert = 'Tỉnh / Thành Phố Không được để rỗng';
                return $alert;
            }elseif(empty($data['id_district'])){
                $alert = 'Quận / Huyện Không được để rỗng';
                return $alert;
            }elseif(empty($data['id_wards'])){
                $alert = 'Xã / Phường Không được để rỗng';
                return $alert;
            }elseif(empty($data['address'])){
                $alert = 'Địa Chỉ Chi Tiết không được để rỗng';
                return $alert;
            }
            $result = $this->model->update($id, $data);
            if($result){
                $alert = 'Cập Nhật Thông Tin Thành Công';
                if($alert){
                   echo'
                    <script> 
                        setTimeout(function() {
                            location.replace("index.php?page=information"); 
                        }, 2000);
                    </script>';
                }
                return $alert;
            }
        }
        public function show_user($id){
            $table = "SELECT * FROM tbl_user WHERE id = '$id'";
            return $this->db->select($table);
        }
        
    }
    
?>