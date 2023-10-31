<?php
session_start();

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
        } else {
            echo "Connected Successfully. <br><br>";
        }
    }

    public function authenticateUser($email, $password)
    {
        $email = $this->conn->real_escape_string($email);

        $sql = "SELECT email, password, is_admin FROM signup WHERE email='$email'";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $plainPassword = $row['password'];
            $is_admin = $row['is_admin'];
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

            if (password_verify($password, $hashedPassword)) {
                echo "Debug: Password verification successful. Login successful.<br>";

                
                if ($is_admin == 1) {
                    echo "Debug: User is an admin.<br>";

                
                    $_SESSION['is_admin'] = 1;

                    return 'admin'; 
                } else {
                    echo "Debug: User is a normal user.<br>";

                    return 'normal'; 
                }
            } else {
                echo "Debug: Password verification failed. Login failed.<br>";
            }
        } else {
            echo "Debug: User not found.<br>";
        }

        return false;
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

$database = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "Debug: Attempting authentication for email: $email<br>";

    $userType = $database->authenticateUser($email, $password);

    if ($userType === 'admin') {
        echo "Authentication successful. You are logged in as an admin.<br>";
        session_start();
        $_SESSION['email'] = $email;
        header("Location: admin.php");
        exit();
    } elseif ($userType === 'normal') {
        echo "Authentication successful. You are logged in as a normal user.<br>";
        session_start();
        $_SESSION['email'] = $email;
        header("Location: profile.php");
        exit();
    } else {
        echo "Authentication failed. Incorrect email or password.";
    }

    $database->closeConnection();
}
?>
