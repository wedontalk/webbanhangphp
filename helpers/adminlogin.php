<?php
    include_once('../../lib/session.php');
    Session::checkLogin();

    include_once('../../lib/database.php');
    include_once('format.php');
?>

<?php
    class AdminLogin
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_admin($userAdmin, $passAdmin){
            $userAdmin = $this->fm->validation($userAdmin);
            $passAdmin = $this->fm->validation($passAdmin);

            // $userAdmin = bindParam(':userAdmin', $userAdmin);
            if(empty($userAdmin) || empty($passAdmin)){
                $alert = "Tài khoản hoặc mật khẩu không được rỗng !!!";
                return $alert;
            }else{
                $table = "SELECT * FROM tbl_admin WHERE userAdmin = '$userAdmin' OR emailAdmin = '$userAdmin' AND passAdmin = '$passAdmin' LIMIT 1";
                $result = $this->db->select($table);

                if($result != false){
                    $result->execute();
                    $rowcount = $result->rowCount();
                    $value = $result->fetch(PDO::FETCH_ASSOC);
                    if($rowcount > 0){
                        Session::set('adminLogin', true);
                        Session::set('adminId', $value['id']);
                        Session::set('adminUser', $value['userAdmin']);
                        Session::set('adminEmail', $value['emailAdmin']);
                        Session::set('adminPass', $value['passAdmin']);
                        Session::set('adminName', $value['nameAdmin']);
                        header('location:index.php');
                    }else{
                        $alert = "tài khoản hoặc mật khẩu không đúng !!!";
                        return $alert;
                    }
                }else{
                    $alert = "tài khoản hoặc mật khẩu không đúng";
                    return $alert;
                }
            }
        }
    }
    
?>