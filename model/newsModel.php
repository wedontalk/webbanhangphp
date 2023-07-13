<?php
    include_once(__DIR__.'./../lib/database.php');
?>
<?php
    class NewsModel{

        private $db;
    
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            return $this->db->store('news',$data);
        }
        public function read($id) {
            return $this->db->select('news','*', "id=$id");
        }
    
        public function update($id, $data) {
            return $this->db->update('news',$data, "id=$id");
        }
    
        public function delete($id) {
            return $this->db->delete('news',"id=$id");
        }
        
    }
    
?>