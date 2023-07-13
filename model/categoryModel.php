<?php
    include_once(__DIR__.'./../lib/database.php');
?>
<?php
    class CategoryModel{

        private $db;
    
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            return $this->db->store('category',$data);
        }
        public function read($id) {
            return $this->db->select('category','*', "id=$id");
        }
    
        public function update($id, $data) {
            return $this->db->update('category',$data, "id=$id");
        }
    
        public function delete($id) {
            return $this->db->delete('category',"id=$id");
        }
        
    }
    
?>