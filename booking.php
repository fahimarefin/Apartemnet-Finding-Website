<?php
class Database
{
    private $db_server = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "apartmentfinding";
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->db_server, $this->db_user, $this->db_password, $this->db_name);
        if (!$this->conn) {
            die("ERROR! Can't able to connect to the Server." . mysqli_connect_error());
        }
    }

    public function close()
    {
        mysqli_close($this->conn);
    }
}

class ApartmentBooking
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function bookApartment($apartmentId)
    {
        $apartmentId = $this->db->conn->real_escape_string($apartmentId);
        $checkApartmentQuery = "SELECT * FROM recomendationTable WHERE id = $apartmentId";
        $apartmentResult = $this->db->conn->query($checkApartmentQuery);

        if ($apartmentResult->num_rows == 1) {
            $sql = "UPDATE recomendationTable SET booked = 1 WHERE id = $apartmentId";

            if ($this->db->conn->query($sql)) {
                return true; // Booking was successful
            } else {
                return false; // Booking failed
            }
        } else {
            return false; // Apartment not found or not available
        }
    }
}

// Create a new instance of the Database class
$database = new Database();

// Create a new instance of the ApartmentBooking class
$apartmentBooking = new ApartmentBooking($database);

// Check if the POST request contains 'apartmentId'
if (isset($_POST['apartmentId'])) {
    $apartmentId = $_POST['apartmentId'];

    // Call the bookApartment method and handle the response
    $bookingStatus = $apartmentBooking->bookApartment($apartmentId);

    if ($bookingStatus) {
        echo "Booking successful. Thank you!";
    } else {
        echo "Booking failed. Please try again later.";
    }
} else {
    http_response_code(400);
    echo "Invalid request data.";
}

// Close the database connection
$database->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Booking</title>
    <!-- Include any necessary CSS stylesheets here -->
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h1>Apartment Booking</h1>
    
    <!-- HTML form to input apartment ID -->
    <form id="bookingForm" method="post">
        <label for="apartmentId">Apartment ID:</label>
        <input type="text" id="apartmentId" name="apartmentId" required>
        <button type="submit">Book Apartment</button>
    </form>

    <div id="bookingStatus">
        <!-- Display booking status here -->
    </div>

    <!-- Include any necessary JavaScript code here -->
    <script>
        // Add your JavaScript code here
        document.getElementById("bookingForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get the apartment ID from the form
            const apartmentId = document.getElementById("apartmentId").value;

            // Make an AJAX request to book the apartment
            fetch("booking.php", {
                method: "POST",
                body: JSON.stringify({ apartmentId }),
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error("Network response was not ok");
                }
            })
            .then((data) => {
                // Display the booking status
                document.getElementById("bookingStatus").textContent = data;
            })
            .catch((error) => {
                console.error("Error:", error);
                // Display an error message
                document.getElementById("bookingStatus").textContent = "Booking failed. Please try again later.";
            });
        });
    </script>
</body>
</html>
