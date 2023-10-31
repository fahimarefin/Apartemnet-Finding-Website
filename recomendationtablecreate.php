<?php
class Database
{
  private $db_server = "localhost";
  private $db_user = "root";
  private $db_password = "";
  private $db_name = "apartmentfinding";
  private $conn;

  public function __construct()
  {
    $this->conn = new mysqli($this->db_server, $this->db_user, $this->db_password, $this->db_name);
    if (!$this->conn) {
      die("ERROR! Can't able to connect to the Server." . mysqli_connect_error());
    } else {
      echo "Connected Successfully. <br> <br>";
    }
  }

  public function createTable()
  {
    $tableName = "recomendationTable";
    $checkTableQuery = "SHOW TABLES LIKE '$tableName'";
    $checkResult = $this->conn->query($checkTableQuery);

    if ($checkResult->num_rows == 0) {


      $createTableQuery = "CREATE TABLE $tableName 
      ( 
        apartmentId   INT AUTO_INCREMENT PRIMARY KEY,
        image         VARCHAR(100) NOT NULL,
        squarefit   DECIMAL(10, 2) NOT NULL,
        price_per_squarefit DECIMAL(10, 2) NOT NULL,
        utility_coast DECIMAL(10, 2) NOT NULL,
        price         DECIMAL(10, 2) NOT NULL,
        specifiatcions VARCHAR(100) NOT NULL, 
        name          VARCHAR(100) NOT NULL, 
        Address       VARCHAR(100) NOT NULL
   
      ) 
      ENGINE=InnoDB 
      DEFAULT CHARSET=utf8";
      if ($this->conn->query($createTableQuery)) {
        echo "Table Created successfully. <br>";
      } else {
        echo "Can't able to create the table: " . $this->conn->error;
      }
    } else {
      echo "Table already exists. <br>";
    }
  }


  public function __destruct()
  {
    mysqli_close($this->conn);
  }
}

$database = new Database();
$database->createTable();
