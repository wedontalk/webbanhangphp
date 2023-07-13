<?php
    include_once('./lib/session.php');
    Session::checkLogin_user();

    include_once('./lib/database.php');
    include_once('format.php');
?>

<?php

class Userlogin{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function login_user($username,$password){
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);
        if(empty($username) || empty($password)){
            $alert = "Tài khoản hoặc mật khẩu không được rỗng !!!";
            return $alert;
        }else{
            $table = "SELECT * FROM tbl_user WHERE user_name = '$username' AND password = '$password' LIMIT 1";
            $result = $this->db->select($table);

            if($result != false){
                $result->execute();
                $rowcount = $result->rowCount();
                $value = $result->fetch(PDO::FETCH_ASSOC);
                if($rowcount > 0){
                    Session::set('loginUser', true);
                    Session::set('userID', $value['id']);
                    Session::set('nameUser', $value['user_name']);
                    Session::set('emailUser', $value['email']);
                    Session::set('passUser', $value['password']);
                    Session::set('nameUser', $value['name']);
                    echo' <script> location.replace("index.php"); </script>';
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