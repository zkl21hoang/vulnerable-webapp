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

    </div></div>
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
    $criteria = array("Title" => false, "Position Type" => false, "Contract Type" => false, "Application Type" => false, "Location" => false,);
    $query = array("Title" => "", "Position Type" => "", "Contract Type" => "", "Application Type" => "","Location" => "",);
// Check existence of form data
    if (!empty($_GET["search_title"])) {
        $query["Title"] = sanitise_function(($_GET["search_title"]));
        if (!preg_match("/^[a-zA-Z0-9 ,.!]{1,20}$/", $query["Title"])) {
            $error_message .= "<p>Position Title must be maximum of 20 alphanumeric characters including period, spaces, exclamation point, comma.</p>";
            $result = false;
        } else {
            $criteria["Title"] = true;
        }
    } else {
        $error_message .= "<p>Please enter the Job Title.</p>";
        $result = false;
    }
// Check existence of form data
    if (isset($_GET["search_by_position"])) {
        $query["Position Type"] = $_GET["search_by_position"];
        $criteria["Position Type"] = true;
    }
// Check existence of form data
    if (isset($_GET["search_by_contract"])) {
        $query["Contract Type"] = $_GET["search_by_contract"];
        $criteria["Contract Type"] = true;
    }
// Check existence of form data
    if (isset($_GET["search_by_application"])) {
        $query["Application Type"] = implode(", ", $_GET["search_by_application"]);
        $criteria["Application Type"] = true;
    }
// Check existence of form data
    if (!($_GET["search_by_location"] == "---")) {
        $query["Location"] = $_GET["search_by_location"];
        $criteria["Location"] = true;
    }

    if (!$result) {
        echo "<div class='container py-4'>
            <div class='alert alert-danger' role='alert'>
            <h2 class='alert-heading'>Error!</h2>
            <hr>
            <p>" . $error_message . "</p>
            </div>
            </div>";
    } else {
        search_function($query, $criteria);
    }
}

// Convert closing date string values to date type

function compare_date_function($date_1, $date_2) {
    $date_1 = date("dd/mm/yy", strtotime(str_replace("/", "-", $date_1)));
    $date_2 = date("dd/mm/yy", strtotime(str_replace("/", "-", $date_2)));
    if ($date_1 == $date_2) {
        return 0;
    }
    return ($date_1 < $date_2) ? 1 : -1;
}

// Function to perform the search

function search_job_titles_function ($query, $entry) {
    return str_contains (strtolower($entry["Job Title"]), strtolower($query["Title"]));
}

function search_function($query, $criteria) {
    // Store error message
    $error_message = "";
    // Assumption of No Error
    $result = true;
    // Task 8 requirement
    $current_date = date("d/m/y");
    // File with directory
    $filename = "data/postjobs/jobs.txt";
    // Empty array to store the job vacancy closing dates
    $job_vacancy_closing_dates = array();
    // Empty array to store the all job vacancies
    $all_entries = array();
    // Empty array to store search results
    $search_results = array();
    // Check whether or not file is existed
    if (file_exists($filename)) {
        // Open the file in read permission mode
        $jobsFile = fopen($filename, "r");
        // Loop to the end of the file
        while(!feof($jobsFile)) {
            // Read each line from the file txt
            $single_entry = fgets($jobsFile);
            // Ignore blank lines
            if ($single_entry != "") {
                $data = "";
                // Explode value from single_entry to data (array)
                $data = explode("\t", $single_entry);
                $entry = array("ID" => $data[0], "Job Title" => $data[1], "Description" => $data[2], "Closing Date" => $data[3],
                    "Position" => $data[4], "Contract" => $data[5], "Application by" => $data[6], "Location" => $data[7],);
                $all_entries[] = $data;

                if ($criteria["Title"] && !$criteria["Position Type"] && !$criteria["Contract Type"] && !$criteria["Application Type"] && !$criteria["Location"]) {
                    if (search_job_titles_function($query, $entry)) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Position Type"] && !$criteria["Contract Type"] && !$criteria["Application Type"] && !$criteria["Location"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Position Type"], $entry)) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Contract Type"] && !$criteria["Position Type"] && !$criteria["Application Type"] && !$criteria["Location"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Contract Type"], $entry)) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Application Type"] && !$criteria["Location"] && !$criteria["Position Type"] && !$criteria["Contract Type"]) {
                    if (search_job_titles_function($query, $entry) && str_contains($entry["Application by"], $query["Application Type"])) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Location"] && !$criteria["Position Type"] && !$criteria["Contract Type"] && !$criteria["Application Type"]) {
                    if (search_job_titles_function($query, $entry) && str_contains($entry["Location"], $query["Location"])) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Position Type"] && $criteria["Contract Type"] && !$criteria["Location"] && !$criteria["Application Type"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Position Type"], $entry) && in_array($query["Contract Type"], $entry)) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Position Type"] && $criteria["Application Type"] && !$criteria["Location"] && !$criteria["Contract Type"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Position Type"], $entry) && str_contains($entry["Application by"], $query["Application Type"])) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Position Type"] && $criteria["Location"] && !$criteria["Contract Type"] && !$criteria["Application Type"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Position Type"], $entry) && str_contains($entry["Location"], $query["Location"])) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Contract Type"] && $criteria["Application Type"] && !$criteria["Location"] && !$criteria["Position Type"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Contract Type"], $entry) && str_contains($entry["Application by"], $query["Application Type"])) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Contract Type"] && $criteria["Location"] && !$criteria["Position Type"] && !$criteria["Application Type"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Contract Type"], $entry) && str_contains($entry["Location"], $query["Location"])) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Application Type"] && $criteria["Location"] && !$criteria["Position Type"] && !$criteria["Contract Type"]) {
                    if (search_job_titles_function($query, $entry) && str_contains($entry["Application by"], $query["Application Type"]) && str_contains($entry["Location"], $query["Location"])) {
                        $search_results[] = $entry;
                    }
                }
                
                if ($criteria["Title"] && $criteria["Position Type"] && $criteria["Contract Type"] && $criteria["Application Type"] && !$criteria["Location"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Position Type"], $entry) && in_array($query["Contract Type"], $entry) && str_contains($entry["Application by"], $query["Application Type"])) {
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Position Type"] && $criteria["Contract Type"] && $criteria["Location"] && !$criteria["Application Type"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Position Type"], $entry) && in_array($query["Contract Type"], $entry) && str_contains($entry["Location"], $query["Location"])) {       
                        $search_results[] = $entry;
                    }
                }

                if ($criteria["Title"] && $criteria["Position Type"] && $criteria["Application Type"] && $criteria["Location"] && !$criteria["Contract Type"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Position Type"], $entry) && str_contains($entry["Application by"], $query["Application Type"]) && str_contains($entry["Location"], $query["Location"])) {
                        $search_results[] = $entry;
                    }
                }
                if ($criteria["Title"] && $criteria["Position Type"] && $criteria["Application Type"] && $criteria["Location"] && $criteria["Contract Type"]) {
                    if (search_job_titles_function($query, $entry) && in_array($query["Position Type"], $entry) && in_array($query["Contract Type"], $entry) && str_contains($entry["Application by"], $query["Application Type"]) && str_contains($entry["Location"], $query["Location"])) {
                        $search_results[] = $entry;
                    }
                }
            }   
        }
        // Close the txt file
        fclose($jobsFile);
        // Sort by Day (Task 8)
        foreach ($search_results as $jobs) {
            $job_vacancy_closing_dates[] = $jobs["Closing Date"];
            usort($job_vacancy_closing_dates, "compare_date_function");
        }
        $check_result_today = 0;
        foreach ($job_vacancy_closing_dates as $value) {
            $day_check = date("dd/mm/yy", strtotime(str_replace("/", "-", $value)));
            if ($day_check >= date("dd/mm/yy", strtotime(str_replace("/", "-", date("d/m/y"))))) {
                $check_result_today += 1;
            }
        }
        // Check if any search results are found
        if (!empty($search_results) && $check_result_today > 0) {
            echo "<div class='container py-4'>
            <div class='alert alert-success' role='alert'>
            <h2 class='alert-heading'>Search results '" . $query["Title"] . "':</h2>";
            foreach ($job_vacancy_closing_dates as $value) {
                $check_day = date("dd/mm/yy", strtotime(str_replace("/", "-", $value)));
                if ($check_day >= date("dd/mm/yy", strtotime(str_replace("/", "-", date("d/m/y"))))) {
                    echo "<hr />";
                    foreach ($search_results as $jobs) {
                            if ($jobs["Closing Date"] == $value) {
                                foreach ($jobs as $key1 => $value1) {
                                echo "<p>" . $key1 . ": " . $value1 . "</p>"; // Show the results
                                }
                            }
                    }
                }
            }
        // Check if search results do not exist
        } else {
            echo "<div class='container py-4'>
                <div class='alert alert-danger' role='alert'>
                <h2 class='alert-heading'>Job vacancies with the following criteria cannot be found: </h2>
                <hr>
                <p>Job Title: " . $query["Title"] . "</p>";
                // Check if Position Type is selected
                if ($criteria["Position Type"]) { 
                    echo "<p>Position: " . $query["Position Type"] . "</p>";
                }
                // Check if Contract Type is selected 
                if ($criteria["Contract Type"]) {
                    echo "<p>Contract: " . $query["Contract Type"] . "</p>";
                }
                // Check if Application Type is selected
                if ($criteria["Application Type"]) {
                    echo "<p>Application by: " . $query["Application Type"] . "</p>";
                }
                // Check if Location is selected
                if ($criteria["Location"]) {
                    echo "<p>Location: " . $query["Location"] . "</p>";
                }
        }
        echo "</div></div>";
    } else {
        $error_message .= "<p>Error! The Job Vacancy records haven't existed.</p>";
        $result = false;
    }
    // If there are errors -> display
    if (!$result) {
        echo "<div class='container py-4'> 
        <div class='alert alert-danger' role='alert'>
        <h2 class='alert-heading'>Error!</h2>
        <hr>
        <p>$error_message</p>
        </div>
        </div>";
    }
}
?>
