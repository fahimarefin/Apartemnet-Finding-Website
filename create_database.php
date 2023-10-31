<?php
class Database {
    private $db_server = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->db_server, $this->db_user, $this->db_password);
        if (!$this->conn) {
            die("ERROR! Can't able to connect to the Server." . mysqli_connect_error());
        } else {
            echo "Connected Successfully. <br> <br>";
        }
    }

    public function createDatabase() {
      $databaseName = "apartmentfinding";
      
      $sql = "CREATE DATABASE IF NOT EXISTS $databaseName";
      
      if (mysqli_query($this->conn, $sql)) {
          echo "Database Created successfully. <br>";
      } else {
          if (mysqli_errno($this->conn) == 1007) {
              echo "Database already exists. <br>";
          } else {
              echo "Can't able to connect to the database. Error: " . mysqli_error($this->conn);
          }
      }
  }
  

    public function __destruct() {
        mysqli_close($this->conn);
    }
}

$database = new Database();
$database->createDatabase();
?>
