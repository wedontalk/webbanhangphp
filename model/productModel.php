<?php
    include_once(__DIR__.'./../lib/database.php');
?>
<?php
    class ProductModel {

        private $db;
    
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            return $this->db->store('product',$data);
        }
        public function read($id) {
            return $this->db->select('product','*', "id=$id");
        }
        public function selectCategory($data){
            return $this->db->select($data);
        }
        public function update($id, $data) {
            return $this->db->update('product',$data, "id=$id");
        }
    
        public function delete($id) {
            return $this->db->delete('product',"id=$id");
        }
        
    }
    
?>