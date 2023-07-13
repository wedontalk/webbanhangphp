<?php
    $filepath = realpath(dirname(__FILE__));
    // include(__DIR__.'./../model/categoryModel.php');
    include_once($filepath.'./../lib/database.php');
    // include('returnView.php');
    include_once($filepath.'./../helpers/format.php');
    class CartController{

        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }


        public function add_to_card($color, $quantity, $id){
            $color = $this->fm->validation($color);
            $quantity = $this->fm->validation($quantity);
            $sid = Session_id();
            $table = "SELECT * FROM product WHERE id= '$id'";
            $result = $this->db->select($table);
            $value = $result->fetch(PDO::FETCH_ASSOC); //lấy ra danh sách product
            // echo print_r($value);
            // tiến hành thêm vào session giỏ hàng
            
            if($value['quantity'] >= $quantity){
                $carts = Session::get('cart', []);
                if(isset($carts[$id])){
                    $carts[$id]['quantity'] = $carts[$id]['quantity'] + $quantity;
                }else{
                    if($value['price_discount'] == 0 || $value['price_discount'] == null){
                        $carts[$id] = [
                            'cardID' => $id,
                            'id_product'=> $value['id'],
                            'detail_price'=> $value['price'],
                            'quantity'=> $quantity,
                            'product_name'=> $value['name'],
                            'product_img'=> json_decode($value['image'])[0],
                            'product_color' => $color
                        ];
                    }else{
                        $carts[$id] = [
                            'cardID' => $id,
                            'id_product'=> $value['id'],
                            'detail_price'=> $value['price_discount'],
                            'quantity'=> $quantity,
                            'product_name'=> $value['name'],
                            'product_img'=> json_decode($value['image'])[0],
                            'product_color' => $color
                        ];
                    }
                }
                Session::set('cart', $carts);
                $carts = Session::get('cart');
                echo' <script> location.replace("index.php?page=cart"); </script>';
            }else{
                $alert = "alert";
                return $alert;
            }
        } 
    }
    
?>