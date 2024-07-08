<?php 

    class Database {
        private $host = "localhost";
        private $db = "to-do-list";
        private $username = "root";
        private $password = "";
        public $conn;

        public function getConnection() {
            

            try {
                $this->conn = new PDO("mysql:host=". $this->host . ";dbname=" . $this->db, $this->username, $this->password);
            } catch(PDOException $exception) {
                echo "Connection Error: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }

?>