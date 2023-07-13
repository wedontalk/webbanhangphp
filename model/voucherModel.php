<?php
    include_once(__DIR__.'./../lib/database.php');
?>
<?php
    class VoucherModel{

        private $db;
    
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            return $this->db->store('voucher',$data);
        }
        public function read($id) {
            return $this->db->select('voucher','*', "id=$id");
        }
        public function update($id, $data) {
            return $this->db->update('voucher',$data, "id=$id");
        }
    
        public function delete($id) {
            return $this->db->delete('voucher',"id=$id");
        }

    }
    
?>