<?php
    include_once('./lib/database.php');
    $db = new Database();
?>
<?php

if(isset($_REQUEST['action']) && isset($_REQUEST['id_province'])){
    $action = $_REQUEST['action'];
    $ma_id = $_REQUEST['id_province'];
    if(!empty($action)){
        $output = array();
        if($action == 'id_city'){
            $table = "SELECT * FROM district WHERE _province_id = '$ma_id'";
            $result = $db->select($table);
            $output[] = array('id' => '', 'name' => '-----Chọn quận huyện-----');
            foreach ($db->select($table) as $value) {
                $output[] = array('id' => $value['id'], 'name' => $value['_name']);
            }
        }else{
            $table = "SELECT * FROM ward WHERE _district_id = '$ma_id'";
            $result = $db->select($table);
            $output[] = array('id' => '', 'name' => '-----Chọn xã phường-----');
            foreach ($result as $key => $ward) {
                $output[] = array('id' => $ward['id'], 'name' => $ward['_name']);
            }
        }
        // header('Content-Type: application/json'); // set content type header to JSON
        echo json_encode($output);
        exit();
    }
}

?>