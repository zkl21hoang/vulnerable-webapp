<!DOCTYPE html>
<html lang="en">
<head>
    <title>SwinburneITsec - Pratical Project</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="framework/css/style.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="framework/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div>
<nav class="navbar sticky-top navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand ps-3" href="index.php">
            <img src="images/lg.png" alt="Logo" style="height:35px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <a class="nav-item nav-link active ps-4" href="postjobform.php">Post Jobs<span class="sr-only"></span></a>
                <a class="nav-item nav-link active ps-4" href="searchjobform.php">Search Jobs<span class="sr-only"></span></a>
                <a class="nav-item nav-link active ps-4" href="about.php">About Us<span class="sr-only"></span></a>
                <li class="nav-item dropdown ps-4">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Support
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Help Centre</a></li>
                        <li><a class="dropdown-item" href="#">Support Inbox</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Report a Problem</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/ourplatform1.png" class="d-block w-100" alt="facebook">
            <div class="carousel-caption d-none d-md-block py-1">
              <h3 style="color:#CB8CFF">With Our Platform</h3>
              <p style="color:#CB8CFF">Choose a job you love, and you will never have to work a day in your life.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/postjob1.png" class="d-block w-100" alt="twitter">
            <div class="carousel-caption d-none d-md-block py-1">
              <h3>Post A Job</h3>
              <p>Our dream is to make everyone in the world gets their suitable job.</p>
              <!-- 1920-895 -->
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/searchjob1.png"  class="d-block w-100" alt="instagram">
            <div class="carousel-caption d-none d-md-block py-1">
              <h3>Search A Job</h3>
              <p>Twenty years from now you will be more disappointed by the things that you didn't do than by the ones you did do.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        </div>
    </div>
    <div class="justify-content-center">
        <div class="h2 text-center align-middle py-3"></div>
    </div>
</div>
<br />

<div class="container-lg">
    <div class="row text-center align-middle py-2">
        <div class="col-lg-6 px-3">
            <img src="images/postjobicon.png" style="width:250px;"> 
            <div class="h4 py-3">
                <a href="postjobform.php" class="btn btn-success btn-lg btn-radius">Post A Job</a>
            </div>
        </div>
        <div class="col-lg-6 px-3 py-3">
            <img src="images/findjobicon.png" style="width:240px;">
            <div class="h4 py-3">
                <a href="searchjobform.php" class="btn btn-warning btn-lg btn-radius">Search A Job</a>
            </div>
        </div>
    </div>
    <br />
</div>
</div>
</div>
<footer class="bg-dark text-light">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-4">
                    <div class="p py-4 text-center">Address</div>
                </div>
                <div class="col-lg-4">
                    <div class="p py-4 text-center">Copyright © 2021, ZKL, Inc. All rights reserved.</div>
                </div>
                <div class="col-lg-4">
                    <div class="p py-4 text-center">Contact us: <a href="mailto:name@mail.com" style="color:orangered">name@mail.com</a></div>
                </div>
            </div>
        </div>
</footer>
</body>
<!-- boostrap js  -->
<script src="framework/js/bootstrap.bundle.min.js"></script>
</html> 
