<?php
    include_once('database.php');
    $db = new Database();
?>
<?php
if(isset($_REQUEST['action']) && isset($_REQUEST['id_ward'])){
    $action = $_REQUEST['action'];
    $id_district = $_REQUEST['id_ward'];
    if(!empty($action)){
        $output = array();
        if($action == 'id_wards'){
            $table = "SELECT * FROM project WHERE _district_id = '$id_district'";
            $result = $db->select($table);
            $output[] = array('id' => '', 'name' => '-----Chọn địa chỉ-----');
            foreach ($db->select($table) as $key => $street) {
                $output[] = array('id' => $street['id'], 'name' => $street['_name']);
            }
        }
        // header('Content-Type: application/json'); // set content type header to JSON
        echo json_encode($output);
        exit();
    }
}
?>