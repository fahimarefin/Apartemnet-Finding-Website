<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "You do not have admin privileges to access this page.";
    exit();
}

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "apartmentfinding";

$conn = new mysqli($db_server, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getAllUsers($conn)
{
    $sql = "SELECT * FROM signup";
    $result = $conn->query($sql);

    $users = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    return $users;
}

function deleteUser($conn, $email)
{
    $email = $conn->real_escape_string($email);

    $sql = "DELETE FROM signup WHERE email = '$email'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Check if the table 'recommendationTable' exists before querying it
function getAllRecommendations($conn)
{
    $sql = "SHOW TABLES LIKE 'recommendationTable'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "SELECT * FROM recommendationTable"; // Use the correct table name
        $result = $conn->query($sql);

        $recommendations = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $recommendations[] = $row;
            }
        }

        return $recommendations;
    } else {
        return array(); // Return an empty array if the table doesn't exist
    }
}

if (isset($_GET['delete']) && isset($_GET['email'])) {
    $emailToDelete = $_GET['email'];
    if (deleteUser($conn, $emailToDelete)) {
        echo "User with email $emailToDelete has been deleted successfully.";
    } else {
        echo "Error deleting user.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $firstName = $conn->real_escape_string($_POST['first_name']);
    $lastName = $conn->real_escape_string($_POST['last_name']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $profilePicture = $_FILES['profile_picture']['name'];

    $uploadDir = 'uploadedimage/';
    $targetFile = $uploadDir . basename($profilePicture);

    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {

        $sql = "INSERT INTO signup (email, first_name, last_name, password, dob, gender, mobile, profile_picture, is_admin)
            VALUES ('$email', '$firstName', '$lastName', '$password', '$dob', '$gender', '$mobile', '$targetFile', 0)";

        if ($conn->query($sql) === TRUE) {
            echo "User has been inserted successfully.";
        } else {
            echo "Error inserting user: " . $conn->error;
        }
    } else {
        echo "Error uploading profile picture.";
    }
}

$users = getAllUsers($conn);
$recommendations = getAllRecommendations($conn);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .user-form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #333;
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4">Welcome to the Admin Panel</h1>
        <div class="mt-4">
            <h2>User Information</h2>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>Profile Picture</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['first_name']; ?></td>
                            <td><?php echo $user['last_name']; ?></td>
                            <td><?php echo $user['dob']; ?></td>
                            <td><?php echo $user['gender']; ?></td>
                            <td><?php echo $user['mobile']; ?></td>
                            <td><img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" class="img-thumbnail"></td>
                            <td><a href="?delete=true&email=<?php echo $user['email']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            

            <h2 class="mt-4">Insert New User</h2>
            <form class="user-form" method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Date of Birth:</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Gender:</label>
                    <select name="gender" class="form-control" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mobile:</label>
                    <input type="text" name="mobile" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Profile Picture:</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" name="insert" class="btn btn-primary">Insert User</button>
            </form>
        </div>

        <a href="logout.php" class="btn btn-secondary mt-4">Logout</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const profilePictureInput = document.getElementById("profile_picture");

            profilePictureInput.addEventListener("change", function() {
                const file = profilePictureInput.files[0];

                if (file) {
                    const fileSize = file.size;
                    const allowedFileSize = 1024 * 1024;


                    if (fileSize > allowedFileSize) {
                        alert("Profile picture size should not exceed 1 MB.");
                        profilePictureInput.value = "";
                    }

                }
            });
        });
    </script>
</body>

</html>