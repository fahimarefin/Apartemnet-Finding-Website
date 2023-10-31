<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apartment Recommendations</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      max-width: 800px;
      margin: auto;
    }

    .card {
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
      margin-right: 20px;
    }

    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2>Apartment Recommendations</h2>
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
        }
      }

      public function fetchData()
      {
          $sql = "SELECT * FROM recomendationTable";
          $result = $this->conn->query($sql);
      
          if ($result) {
              if ($result->num_rows > 0) {
                  $counter = 0;
                  while ($row = $result->fetch_assoc()) {
                      if ($counter % 3 == 0) {
                          echo '<div class="row">';
                      }
                      echo '<div class="col-md-4">';
                      echo '<div class="card" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); margin-right: 20px;">';
                      echo '<img src="' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '" style="height: 200px; object-fit: cover;">';
                      echo '<div class="card-body">';
                      echo '<h3 class="card-title">' . $row['name'] . '</h3>';
                      echo '<p class="card-text">Square Feet: ' . $row['squarefit'] . '</p>'; // Corrected column name
                      echo '<p class="card-text">Price: ' . $row['price'] . '</p>';
                      echo '<p class="card-text">Specifications: ' . $row['specifiatcions'] . '</p>';
                      echo '<p class="card-text">Address: ' . $row['Address'] . '</p>';
                      echo '<a href="#" class="btn btn-primary">View Details</a>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                      $counter++;
                      if ($counter % 3 == 0) {
                          echo '</div>';
                      }
                  }
                  if ($counter % 3 != 0) {
                      echo '</div>';
                  }
                  $result->free_result();
              } else {
                  echo "No records found";
              }
          } else {
              echo "ERROR: Could not able to execute $sql. " . $this->conn->error;
          }
      }
    }

    $database = new Database();
    $database->fetchData();
    ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#apartmentTable tr').hover(
        function() {
          $(this).addClass('table-hover');
        },
        function() {
          $(this).removeClass('table-hover');
        }
      );

      $('#apartmentTable tr').click(function() {
        var name = $(this).find('td:nth-child(5)').text();
        var address = $(this).find('td:nth-child(6)').text();
        alert('Clicked on ' + name + ' at ' + address);
      });
    });
  </script>
</body>
</html>
