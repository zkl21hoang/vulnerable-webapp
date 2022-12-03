<!DOCTYPE html>
<html lang="en">
<head>
    <title>SwinburneITsec - Project</title>
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

<div class="container py-4">
    <h2>Search Job Vacancy</h2>
            <form action="searchjobprocess.php" method="get">
                    <div class="row py-2">
                        <div class="form-group">
                            <label for="search_title" class="text_labels">Job Title: </label>
                            <input type="text" name="search_title" class="form-control" id="search_title"/>
                        </div>
                    </div>
                    <div class="row py-2">
                        <h3>Advanced Search:</h3>
                    </div>
                    <div class="row py-2">
                        <div class="col-4">
                            <span class="text_labels">Position:</span>
                        </div>
                        <div class="col-4 custom-control custom-radio">
                            <input type="radio" name="search_by_position" class="custom-control-input" id="search_by_position_full_time" value="Full Time"/>
                            <label class="custom-control-label" for="search_by_position_full_time">Full Time</label>
                        </div>
                        <div class="col-4 custom-control custom-radio">
                            <input type="radio" name="search_by_position" class="custom-control-input" id="search_by_position_part_time" value="Part Time"/>
                            <label class="custom-control-label" for="search_by_position_part_time">Part Time</label>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-4">
                            <span class="text_labels">Contract:</span>
                        </div>
                        <div class="col-4 custom-control custom-radio">
                            <input type="radio" name="search_by_contract" class="custom-control-input" id="search_by_contract_ongoing" value="Ongoing"/>
                            <label class="custom-control-label" for="search_by_contract_ongoing">Ongoing</label>
                        </div>
                        <div class="col-4 custom-control custom-radio">
                            <input type="radio" name="search_by_contract" class="custom-control-input" id="search_by_contract_fixed_term" value="Fixed Term"/>
                            <label class="custom-control-label" for="search_by_contract_fixed_term">Fixed Term</label>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-4">
                            <span class="text_labels">Application by:</span>
                        </div>
                        <div class="col-4 form-check custom-control custom-checkbox">
                            <input type="checkbox" name="search_by_application[]" class="custom-control-input" id="search_by_application_post" value="Post"/>
                            <label class="custom-control-label" for="search_by_application_post">Post</label>
                        </div>
                        <div class="col-4 form-check custom-control custom-checkbox">
                            <input type="checkbox" name="search_by_application[]" class="custom-control-input" id="search_by_application_mail" value="Mail"/>
                            <label class="custom-control-label" for="search_by_application_mail">Mail</label>
                        </div>
                    </div>
                    <div class="row py-2">
                            <div class="form-group">
                                <label for="search_by_location" class="text_labels">Location:</label>
                                <select class="form-control" name="search_by_location" id="search_by_location">
                                    <option value="---" selected>---</option>
                                    <option value="VIC">VIC</option>
                                    <option value="NSW">NSW</option>
                                    <option value="ACT">ACT</option>
                                    <option value="NT">NT</option>
                                    <option value="TAS">TAS</option>
                                    <option value="SA">SA</option>
                                    <option value="WA">WA</option>
                                    <option value="QLD">QLD</option>
                                </select>
                            </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-6">
                            <input class="btn btn-secondary btn-lg" type="submit" value="Search"/>
                        </div>
                        <div class="col-6">
                            <input class="btn btn-secondary btn-lg" type="reset" Value="Clear"/>
                        </div>
                    </div>
            </form>
            <div class="h4 py-3">
                <a href="index.php" class="btn btn-secondary btn-lg btn-radius">Return to Home Page</a>
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
                    <div class="p py-4 text-center">Contact us: <a href="mailto:mailto:name@mail.com" style="color:orangered">name@mail.com</a></div>
                </div>
            </div>
        </div>
    </footer>
</body>
<!-- boostrap js  -->
<script src="framework/js/bootstrap.bundle.min.js"></script>
</html> 
