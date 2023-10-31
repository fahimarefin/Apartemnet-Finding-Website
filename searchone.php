<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Finder</title>
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

        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .search-options {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        #squareFitInput {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #f2f2f2;
            font-size: 16px;
        }

        #suggestions {
            flex: 1;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-primary {
            padding: 10px 20px;
            font-size: 16px;
        }

        #results {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .apartment-card {
            border: none;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
            background-color: #fff;
        }

        .apartment-card:hover {
            transform: scale(1.02);
        }

        .apartment-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .book-button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .book-button:hover {
            background-color: #0056b3;
        }

        .result-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            background-color: #fff;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
        }

        .result-card:hover {
            transform: scale(1.05);
        }

        .result-card img {
            height: 200px;
            width: 200px;
            border-radius: 5px;
            margin-right: 20px;
        }

        .result-card .details {
            flex: 1;
        }

        .result-card .details h5 {
            font-size: 20px;
            margin: 0;
        }

        .result-card .details p {
            margin: 5px 0;
            color: #555;
        }

        .result-card .actions {
            text-align: right;
        }

        .result-card .book-button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .result-card .book-button:hover {
            background-color: #0056b3;
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['email'])) {
                            echo '<a class="nav-link" href="profile.php">Home</a>';
                        } else {
                            echo '<a class="nav-link" href="home.php">Home</a>';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Apartment Search</h1>
        <div class="search-options">
            <input type="number" id="squareFitInput" placeholder="Square Fit" class="form-control">
            <div id="suggestions"></div>
            <button class="btn btn-primary" onclick="searchApartments()">Search</button>
        </div>
        <div id="results"></div>
        <div id="debug-info"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showSuggestions() {
            const squareFitInput = document.getElementById("squareFitInput");
            const suggestionsContainer = document.getElementById("suggestions");
            const suggestions = ["500 sq ft", "800 sq ft", "1000 sq ft", "1200 sq ft", "1500 sq ft"];
            const userInput = squareFitInput.value.toLowerCase();
            suggestionsContainer.innerHTML = "";

            for (let suggestion of suggestions) {
                if (suggestion.toLowerCase().includes(userInput)) {
                    const suggestionElement = document.createElement("div");
                    suggestionElement.textContent = suggestion;
                    suggestionElement.addEventListener("click", () => {
                        squareFitInput.value = suggestion;
                        suggestionsContainer.innerHTML = "";
                    });
                    suggestionsContainer.appendChild(suggestionElement);
                }
            }
        }

        function searchApartments() {
            const squareFitInput = document.getElementById("squareFitInput").value;
            const results = document.getElementById("results");
            const debugInfo = document.getElementById("debug-info");
            debugInfo.innerHTML = "";

            const searchData = { "squareFit": squareFitInput };

            fetch("search.php", {
                method: "POST",
                body: JSON.stringify(searchData),
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    results.innerHTML = `<p>Search Criteria:</p>
                    <p>Square Fit: ${squareFitInput}</p>
                    <p>Results:</p>`;

                    if (data.length === 0) {
                        results.innerHTML += "<p>No apartments found.</p>";
                    } else {
                        data.forEach((apartment) => {
                            const resultCard = document.createElement("div");
                            resultCard.classList.add("result-card");

                            resultCard.innerHTML = `
                                <img src="${apartment.image}" alt="Apartment Image">
                                <div class="details">
                                    <b><h3>${apartment.name}</h3></b>
                                    <p>Square Fit: ${apartment.squarefit} sq ft</p>
                                    <p>Price per Square Fit: $${apartment.price_per_squarefit}</p>
                                    <p>Utility Coast: $${apartment.utility_coast}</p>
                                    <p>Price: $${apartment.price}</p>
                                    <p>Specifications: ${apartment.specifiatcions}</p>
                                    <p>Address: ${apartment.Address}</p>
                                </div>
                                <div class="actions">
                                    <a href="#" class="book-button" onclick="bookApartment(${apartment.id})">Book Now</a>
                                </div>
                            `;

                            results.appendChild(resultCard);
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    debugInfo.innerHTML = "<p>An error occurred while fetching data.</p>";
                });
        }

        function bookApartment(apartmentId) {
            window.location.href = `appointment.php?apartmentId=${apartmentId}`;
        }

        document.getElementById("squareFitInput").addEventListener("input", showSuggestions);
    </script>
</body>

</html>
