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

    <?=validate_function();?>
    
    <div class='row py-4'>
        <div class='col-4 text-center'>
            <a href='index.php' class='btn btn-secondary'>Return to Home Page</a>
        </div>
        <div class='col-4 text-center'>
            <a href='postjobform.php' class='btn btn-secondary'>Post a job vacancy</a>
        </div>
        <div class='col-4 text-center'>
            <a href='searchjobform.php' class='btn btn-secondary'>Search a job vacancy</a>
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
<?php

// Sanitises data (Security - Injection)
function sanitise_function($data) {
    // Clear trailing spaces
    $data = trim($data);
    // Clear backslashes
    $data = stripslashes($data); 
    // URL Encode
    $data = htmlspecialchars($data);
    return $data;
}

function validate_function() {
    // Error message storage
    $error_message = "";
    // Initial Assumption to No Error
    $result = true;
    $job_vacancy = array("ID" => "", "Title" => "", "Description" => "", "Closing Date" => "", "Position Type" => "",
                        "Contract Type" => "", "Application Type" => "", "Location" => "",);
// Check existence of form data
    if (!empty($_POST["post_id"])) {
        // Check regular expression
        $job_vacancy["ID"] = sanitise_function($_POST["post_id"]);
        if (strlen($job_vacancy["ID"]) > 5) {
            $error_message .= "<p>Position ID must be maximum of 5 characters.</p>";
            $result = false;
        }
        // Check regular expression
        if (!preg_match("/^[P][0-9]{4}$/", $job_vacancy["ID"])) {
            $error_message .= "<p>Position ID must start with a 'P' and must be 4 digits.</p>";
            $result = false;
        }
    } else {
        $error_message .= "<p>Please enter position ID.</p>";
        $result = false;
    }
// Check existence of form data
    if (!empty($_POST["post_title"])) {
        $job_vacancy["Title"] = sanitise_function($_POST["post_title"]);
        // Check regular expression
        if (!preg_match("/^[a-zA-Z0-9 ,.!]{1,20}$/", $job_vacancy["Title"])) {
            $error_message .= "<p>Position Title must be maximum of 20 alphanumeric characters including period, spaces, exclamation point, comma.</p>";
            $result = false;
        }
    } else {
        $error_message .= "<p>Please enter Title.</p>";
        $result = false;
    }
// Check existence of form data
    if (!empty($_POST["post_description"])) {
        $job_vacancy["Description"] = sanitise_function($_POST["post_description"]);
        if (!preg_match("/^[\s\S]{1,260}$/", $job_vacancy["Description"])) {
            $error_message .= "<p>Description must be maximum of 260 characters.<p>";
            $result = false;
        }
    } else {
        $error_message .= "<p>Please enter description.</p>";
        $result = false;
    }
// Check existence of form data
    if (isset($_POST["post_closing_date"])) {
        $job_vacancy["Closing Date"] = $_POST["post_closing_date"];
        if (!preg_match("/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/[0-9]{2}$/", $job_vacancy["Closing Date"])) {
            $error_message .= "<p>Closing Date must be correct format 'dd/mm/yy'</p>";
            $result = false;
        }
    } else {
        $error_message .= "<p>Please enter closing date.</p>";
        $result = false;
    }
// Check existence of form data
    if (isset($_POST["post_type"])) {
        $job_vacancy["Position Type"] = $_POST["post_type"];
    } else {
        $error_message .= "<p>Please select Position Type.</p>";
        $result = false;
    }
// Check existence of form data
    if (isset($_POST["post_contract_type"])) {
        $job_vacancy["Contract Type"] = $_POST["post_contract_type"];
    } else {
        $error_message .= "<p>Please select Contract Type.</p>";
        $result = false;
    }
// Check existence of form data
    if (isset($_POST["post_app_post"]) || isset($_POST["post_app_mail"])) {

        if (isset($_POST["post_app_post"]) && !isset($_POST["post_app_mail"])) {
            $post_application = $_POST["post_app_post"];
            $job_vacancy["Application Type"] = $post_application;
        }
        
        if (isset($_POST["post_app_mail"]) && !isset($_POST["post_app_post"])) {
            $mail_application = $_POST["post_app_mail"];
            $job_vacancy["Application Type"] = $mail_application;
        }

        $multiple_application_type = "";
        if (isset($_POST["post_app_post"]) && isset($_POST["post_app_mail"])) {
            $multiple_application_type .= $_POST["post_app_post"] . ", " . $_POST["post_app_mail"];
            // Post, Mail
            $job_vacancy["Application Type"] = $multiple_application_type;
        }

    } else {
        // Form data is not provided -> Error message
        $error_message .= "<p>At least one Application Type need to be selected.</p>";
        $result = false;
    }
// Check existence of form data
    if (isset($_POST["post_location"]) && $_POST["post_location"] != "---") {
        $job_vacancy["Location"] = sanitise_function($_POST["post_location"]);
    } else {
        $error_message .= "<p>Please select a Location.</p>";
        $result = false;
    }
// If there are error -> indicate in web page
    if (!$result) { 
        echo "<div class='container py-4'>
            <div class='alert alert-danger' role='alert'>
            <h2 class='alert-heading'>Error!</h2>
            <hr>
            <p>$error_message</p>
            </div>
            </div>";
    }  else {
        $is_new_entry = new_entry_check($job_vacancy);
// Check whether or not post_id existed
        if ($is_new_entry) {
            new_entry_add($job_vacancy);
        } else {
            echo "<div class='container py-4'>
            <div class='alert alert-danger' role='alert'>
            <h2 class='alert-heading'>Error!</h2>
            <hr>
            <p>The Position ID existed. Please try again with different Position ID.</p>
            </div>
	    </div>";
        }
    }
}

function new_entry_check($job_vacancy) {
    $result = true;
    umask(0007); // permision 770 for dir
    $dir = "data/postjobs";
    // Check the existence of directory
    if (!file_exists($dir)) {
        // If not create the suitable directory
        mkdir($dir, 02770);
    }
    // the file location with directory
    $filename = "data/postjobs/jobs.txt";
    // Check whether or not file can be read
    if (file_exists($filename)) {
        // Empty Array to store match
        $item_data = array();
        // Open the file with read permission
        $jobsFile = fopen($filename, "r");
        // Loop to the end of the file
        while(!feof($jobsFile)) {
            // Read each line in the file
            $single_entry = fgets($jobsFile);
            // Ignore blank lines
            if ($single_entry != "") {
                $data = "";
                // Exploding from the string into array
                $data = explode("\t", $single_entry);
                // Create a string  in order to store Position ID
                $item_data[] = $data[0];
            }
        }
        // Close the text file
        fclose($jobsFile);
        // Check whether or not the Position ID exists in the array
        if (in_array($job_vacancy["ID"], $item_data)) {
            $result = false;
        }
    }
    // If file does not exist, so it must be a new data
    return $result;
}

function new_entry_add($job_vacancy) {
    // the file location with directory
    $filename = "data/postjobs/jobs.txt";
    // Open the file with the append permission
    $jobsFile = fopen($filename, "a");
    $data = "";
    $data .= $job_vacancy["ID"] ."\t" 
        . $job_vacancy["Title"] . "\t" 
        . $job_vacancy["Description"] . "\t" 
        . $job_vacancy["Closing Date"] . "\t"
        . $job_vacancy["Position Type"] . "\t"
        . $job_vacancy["Contract Type"] . "\t"
        . $job_vacancy["Application Type"] . "\t"
        . $job_vacancy["Location"] . "\n";
    if (is_writable($filename)) {
        // Write string to file txt
        fwrite($jobsFile, $data);
    }
    // Close the file txt
    fclose($jobsFile);
    echo "<div class='container py-4'>
        <div class='alert alert-success' role='alert'>
        <h2 class='alert-heading'>Success!</h2>
        <hr>
        <p>The job vacancy has been added.</p>
        </div>
        </div>";
}
    ?>
