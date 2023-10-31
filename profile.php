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
            die("ERROR! Can't able to connect to the Server. " . $this->conn->connect_error);
        }
    }

    public function getProfilePicturePath($userEmail)
    {
        $sql = "SELECT profile_picture FROM signup WHERE email=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userEmail);
        
        if (!$stmt->execute()) {
            die("Error executing query: " . $stmt->error);
        }
    
        $stmt->bind_result($profilePicturePath);
    
        if ($stmt->fetch()) {
            $stmt->close();
            return $profilePicturePath;
        } else {
            die("No result found for email: " . $userEmail);
        }
    }

    public function getUserData($userEmail)
    {
        $sql = "SELECT * FROM signup WHERE email=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();
        $stmt->close();

        return $userData;
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

session_start();

$database = new Database();

$loggedInUserEmail = $_SESSION['email'];
$profilePicturePath = $database->getProfilePicturePath($loggedInUserEmail);
$userData = $database->getUserData($loggedInUserEmail);

$database->closeConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Finder</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="home.css">
    <style>
        body {
            background-color: #f0f0f0;
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
        }

        .logo-image {
            width: 80px;
            height: 50px;
            border-radius: 50px;
        }

      
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="images/ap.jpg" alt="Company Logo" class="logo-image mr-2">
            <span class="text-xl">Apartment Finder</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="searchone.php">Search Apartments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container mx-auto mt-8">
        <div class="flex justify-center">
            <div class="w-1/4 text-center">
                <img src="<?php echo $profilePicturePath; ?>" alt="Profile Picture" class="rounded-full w-32 h-32 mx-auto mb-3">
                <h2 class="text-2xl font-semibold"><?php echo $userData['first_name']; ?></h2>
                <p class="text-gray-600"><?php echo $loggedInUserEmail; ?></p>
                <a href="logout.php" class="inline-block mt-4 px-4 py-2 bg-gray-500 text-white rounded">Logout</a>
            </div>
            <div class="w-3/5 ml-8">
                <h4 class="text-xl font-semibold mb-4">About</h4>
                <p class="mb-2"><strong>Date of Birth:</strong> <?php echo $userData['dob']; ?></p>
                <p class="mb-2"><strong>Gender:</strong> <?php echo $userData['gender']; ?></p>
                <p class="mb-2"><strong>Mobile:</strong> <?php echo $userData['mobile']; ?></p>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>