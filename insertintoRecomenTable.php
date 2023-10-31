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
    if ($this->conn->connect_error) {
      die("Error: Can't able to connect to the database." . $this->conn->connect_error);
    } else {
      echo "Database connected successfully. <br>";
    }
  }



  public function insertValues()
  {
    $sql = "INSERT INTO `recomendationTable` 
        (image,squarefit,price_per_squarefit, utility_coast,price, specifiatcions, name, Address) 
VALUES      (
  'images/istockphoto-1165384568-612x612.jpg', 
  1150,
         6500, 
         600000,
         8075000,
         '3 Bed Drawing,Dinning', 
         'Shapno Builders Limited',
         'House:20,Block:G,Road:1,South-Bannasree-Dhaka'), 
         (
  'images/istockphoto-962881644-612x612.jpg', 
  750,
  6500,
  600000,
         5507500,
         '2 Bed Drawing,Dinning', 
         'Home Land Limited',
         'House:22,Block:F,Road:1,Bannasree-Dhaka'), 
         (
  'images/apartment-apartment-building-flats-wallpaper-preview.jpg', 
  1500,
  7500,
  1000000,
         12250000, 
         '5 Bed Drawing,Dinning', 
         'Dom INNO',
         'House:22,Block:F,Road:1,Dhanmondi-Dhaka'),
         (
  'images/0_23-0.Apartment-vs-House.aa5b55c5.jpg', 
  1000,
  7500,
  1000000,
         8500000, 
         '3 Bed Drawing,Dinning', 
         'Dom INNO',
         'House:20,Block:G,Road:5,Dhanmondi-Dhaka'),
         (
  'images/4aa955a400be6c95a34a61bb0094ba35.jpg', 
  1200,
  7000,
  900000,
         9300000, 
         '4 Bed Drawing,Dinning', 
         'Shapno Builders Limited',
         'House:20,Block:G,Road:5,South-Banasree-Dhaka'),
         (
  'images/065_201806brioloftsrenderingsandimages22.jpg', 
  1100,
  7000,
  800000,
         9200000, 
         '4 Bed Drawing,Dinning', 
         'Shapno Builders Limited',
         'House:23,Block:F,Road:1,Banasree-Dhaka'),
         (
  'images/103ac847ff54e52fd1c581a4227a11c4.jpg', 
  1100,
  7000,
  800000,
         9200000, 
         '4 Bed Drawing,Dinning', 
         'Shapno Builders Limited',
         'House:23,Block:F,Road:1,Banasree-Dhaka'),
         (
  'images/590-Park-4K-Exterior.jpg', 
  950,
  5500,
  600000,
         8525000, 
         '3 Bed Drawing,Dinning', 
         'Dream Builders Limited',
         'House:21,Block:A,Road:1,Khilgaon-Dhaka'),
         (
  'images/0261682_golden-shower-apartment_245.jpg', 
  1500,
  7500,
  1000000,
         12250000, 
         '5 Bed Drawing,Dinning', 
         'Assure Group',
         'House:21,Block:A,Road:1,Bashundhara-Dhaka'),
         (
  'images/apartment-apartment-building-flats-wallpaper-preview.jpg', 
  1000,
  12000,
  1200000,
         13200000, 
         '3 Bed Drawing,Dinning', 
         'Bashundhara Group',
         'House:10,Block:E,Road:5,Bashundhara-Dhaka'),
         (
  'images/image_29.jpg', 
  2000,
  15000,
  1200000,
         31200000, 
         '5 Bed Drawing,Dinning', 
         'Navana Real Estate',
         'Gulshan-Dhaka'),
         (
  'images/istockphoto-585292106-612x612.jpg', 
  1800,
  15000,
  1200000,
         28200000, 
         '5 Bed Drawing,Dinning', 
         'Navana Real Estate',
         'Gulshan-Dhaka'),
         (
  'images/istockphoto-1185256981-170667a.jpg', 
  2500,
  15000,
  1200000,
         38700000, 
         '6 Bed Drawing,Dinning', 
         'Amin Mohammad Group',
         'Banani-Dhaka'),
         (
  'images/perspective-for-bp-set-1-copy_900xx1799-1012-0-139.jpg', 
  2200,
  12500,
  1000000,
         25800000, 
         '6 Bed Drawing,Dinning', 
         'Amin Mohammad Group',
         'Banani-Dhaka'),
         (
  'images/photo-1624204386084-dd8c05e32226.jpg', 
  1700,
  12500,
  1000000,
         22250000, 
         '4 Bed Drawing,Dinning', 
         'Amin Mohammad Group',
         'House:9,Block:H,Road:5,Bashundhara-Dhaka')";
    if ($this->conn->query($sql)) {
      echo "Values Inserted Successfully";
    } else {
      echo "Can't able to add values. <br>" . $this->conn->error;
    }
  }

  public function closeConnection()
  {
    $this->conn->close();
  }
}

$database = new Database();
$database->insertValues();
$database->closeConnection();
