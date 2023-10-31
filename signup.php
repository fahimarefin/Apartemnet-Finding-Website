<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="form.css">

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
            <a class="navbar-brand" href="#">
                <img src="images/ap.jpg" alt="Company Logo" class="logo-image">
                Apartment Finder
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Search Apartments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-md-6">
                <div class="form-container">
                    <h2 class="text-center mb-4">Sign Up</h2>
                    <form method="POST" action="signupone.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" id="fname" name="fname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" id="lname" name="lname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Gender:</label>
                            <div class="form-check">
                                <input type="radio" id="male" name="gender" value="male" class="form-check-input" required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="female" name="gender" value="female" class="form-check-input" required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile Number:</label>
                            <input type="text" id="mobile" name="mobile" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="profile_picture" style="font-weight: bold; color: #333;">Profile Picture:</label>
                            <div style="display: flex; align-items: center;">
                                <input type="file" name="profile_picture" id="profile_picture" style="display: none;" onchange="updateFileName()">
                                <label for="profile_picture" style="cursor: pointer; margin-left: 10px; padding: 8px 12px; background-color: #007bff; color: #fff; border-radius: 5px;">
                                    <i class="fas fa-upload"></i> Choose File
                                </label>
                                <span id="file-name" style="margin-left: 10px;"></span>
                            </div>
                        </div>

                        <script>
                            function updateFileName() {
                                const fileInput = document.getElementById("profile_picture");
                                const fileNameSpan = document.getElementById("file-name");

                                if (fileInput.files.length > 0) {
                                    fileNameSpan.textContent = fileInput.files[0].name;
                                } else {
                                    fileNameSpan.textContent = "";
                                }
                            }
                        </script>

                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>