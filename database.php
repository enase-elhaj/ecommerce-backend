<?php
class Database {
    private $host = "localhost";
    private $db_name = "e_commerce";
    private $username = "root"; // replace with your DB username
    private $password = ""; // replace with your DB password
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
