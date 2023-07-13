<?php
    include_once(__DIR__.'./../lib/database.php');
?>
<?php
    class SlideModel{

        private $db;
    
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            return $this->db->store('slide',$data);
        }
        public function read($id) {
            return $this->db->select('slide','*', "id=$id");
        }
        public function update($id, $data) {
            return $this->db->update('slide',$data, "id=$id");
        }
    
        public function delete($id) {
            return $this->db->delete('slide',"id=$id");
        }

    }
    
?>