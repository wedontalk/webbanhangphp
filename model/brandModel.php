<?php
    include_once(__DIR__.'./../lib/database.php');
?>
<?php
    class BrandModel{

        private $db;
    
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            return $this->db->store('brand',$data);
        }
        public function read($id) {
            return $this->db->select('brand','*', "id=$id");
        }
    
        public function update($id, $data) {
            return $this->db->update('brand',$data, "id=$id");
        }
    
        public function delete($id) {
            return $this->db->delete('brand',"id=$id");
        }
        
    }
    
?>