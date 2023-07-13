<?php
    class Database {
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "shopnest";
        private $conn;
    
        public function __construct() {
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "Connected successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        public function select($table){
            // $stmt = $this->conn->query($query);
            $stmt = $this->conn->prepare($table);
            $stmt->execute();
            return $stmt;
        }

        public function updateTable($table){
            $stmt = $this->conn->prepare($table);
            $stmt->execute();
            return $stmt;
        }

        public function select1($table){
            // $stmt = $this->conn->query($query);
            $stmt = $this->conn->prepare($table);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        
        public function selectWhere($table, $columns = "*", $where = null, $orderBy = null) {
            $query = "SELECT $columns FROM $table";
            if ($where) {
                $query .= " WHERE $where";
            }
            if ($orderBy) {
                $query .= " ORDER BY $orderBy";
            }
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function store($table, $data) {
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));
            $query = "INSERT INTO $table ($columns) VALUES ($values)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($data);
            return $this->conn->lastInsertId(); // returns the ID of the newly inserted row
        }
    
        public function update($table, $data, $where) {
            $set = [];
            foreach ($data as $key => $value) {
                $set[] = "$key=:$key";
            }
            $set = implode(", ", $set);
            $query = "UPDATE $table SET $set WHERE $where";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($data);
            return $stmt->rowCount(); // returns the number of affected rows
        }
    
        public function delete($table, $where) {
            $query = "DELETE FROM $table WHERE $where";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount(); // returns the number of affected rows
        }

        // dùng để phân trang
        public function count_records($table){
            try {
                $stmt = $this->conn->prepare("SELECT COUNT(*) as total_count FROM $table");
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['total_count'];
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }


        public function count_search($table, $search){
            try {
                $stmt = $this->conn->prepare("SELECT COUNT(*) as total_count FROM $table WHERE name like '%$search%'");
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['total_count'];
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    
?>