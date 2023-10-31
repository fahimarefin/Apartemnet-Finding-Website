<?php
class DatabaseConnection {
    private $conn;

    public function __construct($db_server, $db_user, $db_password, $db_name) {
        $this->conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

        if (!$this->conn) {
            die("Error! Can't able to connect to the Database!" . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class Registration {
    private $conn;
    private $namePattern;
    private $emailPattern;
    private $passwordPattern;
    private $dobPattern;
    private $mobilePattern;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->namePattern = '/^(?!.*\s{2})[a-zA-Z\s]{4,20}$/';
        $this->emailPattern = '/^\S+@\S+\.\S+$/';
        $this->passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{7,25}$/';
        $this->dobPattern = '/^\d{4}-\d{2}-\d{2}$/';
        $this->mobilePattern = '/^01[3-9]\d{8}$/';
    }

    public function validateInput($fname, $lname, $email, $password, $dob, $mobile) {
        $errors = array();

        if (empty($fname) || empty($lname)) {
            $errors['name'] = 'First Name and Last Name are required';
        } elseif (!preg_match($this->namePattern, "$fname $lname")) {
            $errors['name'] = 'Name should have a first name and last name. Middle name is optional.';
        }

        if (empty($email)) {
            $errors['email'] = 'Email is required.';
        } elseif (!preg_match($this->emailPattern, $email)) {
            $errors['email'] = 'Invalid email Address.';
        }

        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        } elseif (!preg_match($this->passwordPattern, $password)) {
            $errors['password'] = 'Password must contain at least one lowercase letter, one uppercase letter, one digit, and be 7-25 characters long.';
        }

        if (empty($dob)) {
            $errors['dob'] = 'Date of Birth is required.';
        } elseif (!preg_match($this->dobPattern, $dob)) {
            $errors['dob'] = 'Invalid Date of Birth. Please use the format YYYY-MM-DD.';
        }

        if (empty($mobile)) {
            $errors['mobile'] = 'Mobile is required.';
        } elseif (!preg_match($this->mobilePattern, $mobile)) {
            $errors['mobile'] = 'Invalid mobile number.';
        }

        return $errors;
    }

    public function uploadProfilePicture() {
        if (!empty($_FILES['profile_picture']['name'])) {
            $uploadDir = 'uploadedimage/';
            $profilePicturePath = $uploadDir . basename($_FILES['profile_picture']['name']);

            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicturePath)) {
                return $profilePicturePath;
            } else {
                return "Error uploading file: " . $_FILES['profile_picture']['error'];
            }
        } else {
            return "No file uploaded.";
        }
    }

    public function registerUser($fname, $lname, $email, $password, $dob, $gender, $mobile, $profilePicturePath) {
        $sql = "INSERT INTO signup (first_name, last_name, email, password, dob, gender, mobile, profile_picture)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssss", $fname, $lname, $email, $password, $dob, $gender, $mobile, $profilePicturePath);

        if ($stmt->execute()) {
            return "Registration successful!";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "apartmentfinding";

$databaseConnection = new DatabaseConnection($db_server, $db_user, $db_password, $db_name);
$conn = $databaseConnection->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration = new Registration($conn);

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];

    $errors = $registration->validateInput($fname, $lname, $email, $password, $dob, $mobile);

    $profilePicturePath = $registration->uploadProfilePicture();

    if (empty($errors)) {
        $registrationResult = $registration->registerUser($fname, $lname, $email, $password, $dob, $gender, $mobile, $profilePicturePath);
        echo $registrationResult;
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

$databaseConnection->closeConnection();
?>
