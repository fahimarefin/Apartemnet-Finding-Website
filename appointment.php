<?php
session_start();

function getApartmentInfo() {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=apartmentfinding", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM recomendationTable LIMIT 1");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $apartmentInfo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $apartmentInfo;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function generateAutomaticBookingDate() {
    return date("Y-m-d");
}

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$apartmentInfo = getApartmentInfo();

if (!$apartmentInfo) {
    echo "Apartment not found!";
    exit();
}

$bookingDate = generateAutomaticBookingDate();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Booking</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <style>
        
        body {
            background-color: #f5f5f5;
        }
        .container {
            padding: 20px;
        }
        .user-info, .apartment-info, .booking-info {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 5px;
        }
        h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Apartment Booking</h1>
        <div class="user-info mt-4">
            <h2>User Information</h2>
          
            <p><strong>Name:</strong> <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'N/A'; ?></p>
            <p><strong>Email:</strong> <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'N/A'; ?></p>
        </div>
        <div class="apartment-info mt-4">
            <h2>Apartment Information</h2>
           
            <p><strong>Name:</strong> <?php echo isset($apartmentInfo['name']) ? $apartmentInfo['name'] : 'N/A'; ?></p>
            <p><strong>Square Fit:</strong> <?php echo isset($apartmentInfo['squarefit']) ? $apartmentInfo['squarefit'] . ' sq ft' : 'N/A'; ?></p>
            <p><strong>Price per Square Fit:</strong> $<?php echo isset($apartmentInfo['price_per_squarefit']) ? $apartmentInfo['price_per_squarefit'] : 'N/A'; ?></p>
            <p><strong>Utility Cost:</strong> $<?php echo isset($apartmentInfo['utility_coast']) ? $apartmentInfo['utility_coast'] : 'N/A'; ?></p>
            <p><strong>Total Price:</strong> $<?php echo isset($apartmentInfo['price']) ? $apartmentInfo['price'] : 'N/A'; ?></p>
           
            <p><strong>Specifications:</strong> <?php echo isset($apartmentInfo['specifications']) ? $apartmentInfo['specifications'] : 'N/A'; ?></p>
            <p><strong>Address:</strong> <?php echo isset($apartmentInfo['Address']) ? $apartmentInfo['Address'] : 'N/A'; ?></p>
        </div>
        <div class="booking-info mt-4">
            <h2>Booking Information</h2>
            
            <p><strong>Booking Date:</strong> <?php echo $bookingDate; ?></p>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
