<?php
    /**
    *Session Class
    **/
    class Session{
        public static function init(){
            if (version_compare(phpversion(),'8.0.19','<')) {
                if (session_id() == "") {
                session_start();
                }
            } else {
                if (session_status() == PHP_SESSION_NONE) {
                session_start();
                }
            }
            
        }
        
        public static function set($key, $val){
            $_SESSION[$key] = $val;
        }
        
        public static function get($key){
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            
            } else {
                return false;
            }
        }
        
        public static function checkSession(){
            self::init();
            if (self::get("adminLogin")== false) {
                self::destroy();
                header("Location:login.php");
            }
            // exit(header("Location:index .php"));
        }
        
        public static function checkLogin(){
            self::init();
            if (self::get("adminLogin")== true) {
                header("Location:index.php");
            }
        }
        // check login của user
        public static function check_session_user(){
            self::init();
            if (self::get("loginUser")== false) {
                self::destroy();
                header("Location:index.php");
            }
        }

        public static function check_user(){
            self::init();
            if (self::get("loginUser")== false) {
                if(isset($_GET['page']) && $_GET['page'] !=null){
                    $page = $_GET['page'];
                    if($page = 'login'){
                        echo' <script> location.replace("index.php"); </script>';
                    }
                }
            } 
        }

        public static function checkLogin_user(){
            self::init();
            if (self::get("loginUser")== true) {
                if(isset($_GET['page']) && $_GET['page'] !=null){
                    $page = $_GET['page'];
                    if($page = 'login'){
                        echo' <script> location.replace("index.php"); </script>';
                    }
                }
            }
        }
        
        public static function destroy(){
            session_destroy();
            // echo '
            // <script>
            //     window.location.reload(true);
            // </script>
            // ';
            echo' <script> location.replace("index.php?page=login"); </script>';
        }
    }
?>