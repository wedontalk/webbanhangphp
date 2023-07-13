<?php
    include_once(__DIR__.'./../lib/database.php');
?>
<?php
    class UserModel{

        private $db;
    
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            return $this->db->store('tbl_user',$data);
        }
        public function read($id) {
            return $this->db->select('tbl_user','*', "id=$id");
        }
        public function update($id, $data) {
            return $this->db->update('tbl_user',$data, "id=$id");
        }
    
        public function delete($id) {
            return $this->db->delete('tbl_user',"id=$id");
        }

    }
    
?>