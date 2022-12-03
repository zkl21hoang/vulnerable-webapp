<?php
    session_start();

    if (isset($_SESSION["email_address"]) && !empty($_SESSION["email_address"])) {
        $user_email_address = $_SESSION["email_address"];
    }

    if (isset($_SESSION["profile_name"]) && !empty($_SESSION["profile_name"])) {
        $user_profile_name = $_SESSION["profile_name"];
    }

    if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    }

    if (isset($_SESSION["friend_profile_name"]) && !empty($_SESSION["friend_profile_name"])) {
        $friend_profile_name = $_SESSION["friend_profile_name"];
    }

    if (isset($_SESSION["num_of_friends"]) && !empty($_SESSION["num_of_friends"])) {
        $user_friends_total = $_SESSION["num_of_friends"];
    }

    if (isset($_SESSION["login_status"]) && !empty($_SESSION["login_status"])) {
        $login_status = $_SESSION["login_status"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administrator Panel</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="framework/css/style.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="framework/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <a class="nav-item nav-link active ps-4" href="../index.php">Home Page<span class="sr-only"></span></a>
                    <a class="nav-item nav-link active ps-4" href="panel.php">Admin Panel<span class="sr-only"></span></a>
                    <a class="nav-item nav-link active ps-4" href="logout.php">Log Out<span class="sr-only"></span></a>
                </ul>
            </div>
        </div>
    </nav>
<h3 class='py-3 text-center'>Administrator Panel</h3>
<?php
if (isset($_SESSION["login_status"]) && !empty($_SESSION["login_status"])) {
    // Retrieving the currently logged in user's friend id
    function getUsersId($conn, $user_email_address) {
        $query = "SELECT friend_id
                FROM friends
                WHERE friend_email = '$user_email_address';";
                        
        // Storing the result into the result variable
        $result = @mysqli_query($conn, $query)
                or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
    
        // Loop through the fetching from $result to assign the updated data of friend id to the SESSION user id
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION["user_id"] = $row["friend_id"];
            // Assign and update the friend id from database to $user_id variable
            $user_id = $_SESSION["user_id"];
        }
                        
         
        return $user_id;
    }
    
    // Retrieving the currently logged in user's profile name
    function getUserProfileName($conn, $user_id) {
        $query = "SELECT profile_name
                FROM friends
                WHERE friend_id = '$user_id';";
    
        // Storing the result into the $result variable
        $result = @mysqli_query($conn, $query)
                or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
    
        // Loop through the fetching from $result to assign the updated data of profile name to the SESSION profile name
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION["profile_name"] = $row["profile_name"];
            // Assign and update the profile name from database to $user_profile_name variable
            $user_profile_name = $_SESSION["profile_name"];
        }
    
         
        return $user_profile_name;
    }
    
    // Retrieving the currently logged in user's total count number of friends
    function getUserFriendsTotal($conn, $user_id) {
        $query = "SELECT num_of_friends
                FROM friends
                WHERE friend_id = '$user_id';";
    
        // Storing the result into the result variable
        $result = @mysqli_query($conn, $query)
                or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
    
        // Loop through the fetching from $result to assign the updated data of num_of_friends to the SESSION num_of_friends
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION["num_of_friends"] = $row["num_of_friends"];
            // Assign and update the num_of_friends from database to $user_friends_total variable
            $user_friends_total = $_SESSION["num_of_friends"];
        }
    
                        
         
        return $user_friends_total;
    }
    
    
    // Displaying the current logged in user's friends list
    // alphabet sorting by the profile name
    // Option for removing friends
    
    function displayingFriendsList($conn, $user_id) {
        $query = "SELECT friend_id, profile_name
                FROM friends as users
                INNER JOIN myfriends as friends
                ON users.friend_id = friends.friend_id2
                WHERE friends.friend_id1 = '$user_id'
                ORDER BY profile_name ASC;";
    
        // Storing the result into the result variable
        $result = @mysqli_query($conn, $query)
        or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
                        
        // In case there are results returned, then display
        if (@mysqli_num_rows($result) > 0) {
            echo "<div class='container'>
                <table class='table table-bordered table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th class='text-center'>Username</th>
                            <th class='text-center'>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
    
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>"
                    . "<td class='text-center'>{$row["profile_name"]}</td>"
                        . "<td class='text-center'>"
                            . "<a href='{$_SERVER['PHP_SELF']}?remove_friend={$row["friend_id"]}' class='btn btn-outline-danger'/>Remove</a>"
                        . "</td>"
                    . "</tr>";
            }
            echo "</tbody></table></div>";
    
        } else {
            echo "<div class='container'>
                    <div class='alert alert-danger' role='alert'>
                        <h3 class='py-2 text-center'>You currently do not have any friends.</h3>
                    </div>
                  </div>";
        }
                        
         
    }
    
    // Retrieving the currently logged in user's friends and those profile name
    function getFriendName($conn, $remove_friend_id) {
        $query = "SELECT profile_name
                FROM friends
                WHERE friend_id = '$remove_friend_id';";
                        
        // Storing the result into the result variable
        $result = @mysqli_query($conn, $query)
                or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
    
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION["friend_profile_name"] = $row["profile_name"];
            $friend_profile_name = $_SESSION["friend_profile_name"];
        }
         
                        
        return $friend_profile_name;
    }
    
    // Removing the user from the lists of friends of the currently logged in user
    function removingFriend($conn, $user_id, $remove_friend_id, $friend_profile_name, $user_profile_name) {
        $query = "DELETE FROM myfriends
            WHERE friend_id1 = '$user_id'
            AND friend_id2 = '$remove_friend_id';";
    
        // Storing the result into the result variable
        $result = @mysqli_query($conn, $query)
        or die("<p>Error: Error occured while removing {$friend_profile_name} from friend list of {$user_profile_name}</p>" . "<p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
    
         
    }
    
    // Updating the total number of friends of currently logged in user
    function updatingFriendTotal($conn, $user_id, $user_friends_total, $user_profile_name) {
        $query = "UPDATE friends
                SET num_of_friends = num_of_friends - 1
                WHERE friend_id = '$user_id';";
        // Storing the result into the result variable
        $result = @mysqli_query($conn, $query)
        or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
    
         
    }
    // displaying button
    function displayingbutton() {
        
    }

require_once("settings.php");

// Connects to MySQL serverpp
$conn = @mysqli_connect($host, $username, $password, $sql_database_name)
        or die("<p>Unable to connect to database server.</p>");

// linked to getUsersId to assign the retrieving data to $user_id
$user_id = getUsersId($conn, $user_email_address);
// linked to getUserProfileName to assign the retrieving data to $user_profile_name
$user_profile_name = getUserProfileName($conn, $user_id);
// linked to getUserFriendsTotal to assign the retrieving data to $user_friends_total
$user_friends_total = getUserFriendsTotal($conn, $user_id);
displayingFriendsList($conn, $user_id);
displayingbutton();

// If statement in order to delete friend if user click delete button then the remove friend would be set and not empty
if (isset($_GET["remove_friend"]) && !empty($_GET["remove_friend"])) {
    $remove_friend_id = $_GET["remove_friend"];
    $friend_profile_name = getFriendName($conn, $remove_friend_id);
    removingFriend($conn, $user_id, $remove_friend_id, $friend_profile_name, $user_profile_name);
    updatingFriendTotal($conn, $user_id, $user_friends_total, $user_profile_name);
    // After functioning the deletion linked to removingFriend and updatingFriendTotal function, redirect to panel.php
    // header('Location: panel.php'); Because some error happening when I used header redirect, so choose script instead
    // It redirects faster than using header('location:');
    echo "<script>
            location.href = 'panel.php';
        </script>";
}
                
// Close connection
mysqli_close($conn);
} else {
    header("Location: error.php");
}
?>
</body>
<!-- boostrap js  -->
<script src="framework/js/bootstrap.bundle.min.js"></script>
</html> 
