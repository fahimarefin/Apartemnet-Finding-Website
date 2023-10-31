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
            border-radius:  50px; 
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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Log In</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
  
  <div class="container-fluid px-0">
  <div class="animate__animated animate__slideInLeft">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/Kiln-Apartments-1-2500x1406.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h1><b>Home is where your story begins</b></h1>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/pexels-expect-best-323705.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h1><b>Apartment hunting is like embarking on a treasure hunt where every address 
              unveils a hidden gem waiting to be discovered and cherished</b></h1>
          </div>
        </div>
        </div>
        <div class="carousel-item">
          <img src="images/photo-1624204386084-dd8c05e32226.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h1><b>The search for the ideal apartment is a journey of self-discovery, where the spaces you 
              gravitate toward reflect the facets of your personality and the colors of your dreams.</b></h1>
            
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

<main class="container-fluid px-0">
  <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-8 fst-italic">Apartment Finding  Anytime/Anywhere Your Trusted Place</h1>
      <p class="lead my-3">
        "Amidst sprawling landscapes, a mysterious door appeared - 'Apartment Finding Anytime/Anywhere.' 
        With a curious twist, it offered instant teleportation to diverse homes. Randomly, people stepped in, 
        exploring unknown lives. Each door led to surprises, from rustic cabins to futuristic domes.
         A place trusted for adventure, 
        it satisfied wanderlust souls seeking novel dwellings, transcending space and time."
      </p>
     
    </div>
  </div>
  <h1 class="d-inline-block mb-2 text-primary" style="margin-left: 20px;"><i>OUR MISSION STATEMENT</i></h1>


  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">Mission</strong>
          
          <p class="card-text mb-auto">
            We are dedicated to revolutionizing apartment hunting. Through a user-centric platform,
             we offer diverse listings, virtual tours, and accurate details, streamlining the search process.
             Our goal is to make finding an ideal apartment effortless and stress-free.</p>
          
          
        </div>
        <div class="col-auto d-none d-lg-block">
        
          <img src="images/ap.jpg" width="250" height="200" >

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Vision</strong>
          <p class="mb-auto">Envisioning a world where apartment searching knows no boundaries, 
            we strive to be the go-to source. We aim to empower individuals by providing a trusted, 
            all-encompassing solution that redefines how they discover their perfect living spaces.</p>
        </div>
        <div class="col-auto d-none d-lg-block">
         
          <img src="images/ap.jpg" width="250" height="200" >
          

        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
