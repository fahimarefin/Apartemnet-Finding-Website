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
    $tableName = "signup";
    $checkTableQuery = "SHOW TABLES LIKE '$tableName'";
    $checkResult = $this->conn->query($checkTableQuery);

    if ($checkResult->num_rows == 0) {
      $sql = "CREATE TABLE signup (
        email VARCHAR(100) PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        password VARCHAR(500) NOT NULL,
        dob DATE NOT NULL,
        gender ENUM('Male', 'Female', 'Other') NOT NULL,
        mobile VARCHAR(15) NOT NULL,
        profile_picture VARCHAR(255),
        is_admin BOOLEAN NOT NULL DEFAULT 0
      )";

      if ($this->conn->query($sql)) {
        echo "Table Created successfully. <br>";
      } else {
        echo "Can't able to create the table: " . $this->conn->error;
      }
    } else {
      echo "Table already exists. <br>";
    }
  }

  public function makeUserAdmin($email)
  {
    $sql = "UPDATE signup SET is_admin = 1 WHERE email = '$email'";

    if ($this->conn->query($sql)) {
      echo "Fahim has been designated as an admin. <br>";
    } else {
      echo "Error updating user: " . $this->conn->error;
    }
  }

  public function close()
  {
    mysqli_close($this->conn);
  }
}

$database = new Database();
$database->createTable();
$database->makeUserAdmin("fahimarefin99@gmail.com");
$database->close();
?>
