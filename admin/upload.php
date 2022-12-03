<?php
    session_start();

?>
<!DOCTYPE html>
<html>
        <head>
                <title>Upload Page</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
                <link rel="stylesheet" type="text/css" href="assets/css/style.css">
                <link rel="stylesheet" type="text/css" href="assets/css/icons.css">
                <link rel="stylesheet" type="text/css" href="assets/css/indieflower.css">
                <script src="assets/js/jquery-3.6.0.min.js"></script>
                <script src="assets/js/script.js"></script>
                <?php if(!isset($_GET["submit"])){echo "<script src=\"assets/js/firstload.js\"></script>\n";};?>

                <script src="assets/js/client-side-filter.js"></script>

        </head>
        <body>
        <?php
        if (isset($_SESSION["login_status"]) && !empty($_SESSION["login_status"]) && $_SESSION["user_id"] == "1") {
                header('Content-type: text/html; cherset=utf-8');
                if (isset($_POST["submit"]) && is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])){
                        $targetdir = "images/";
                        $targetfile = $targetdir . basename($_FILES["fileToUpload"]["name"]);
                        require "assets/php/filter.php";
                        if ($uploadFail == False){
                                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetfile);
                                header("location: upload.php?submit=success");
                        } 
                        else {
                                header("location: upload.php?submit=invalid");
                        }
                }
                else if ($_SERVER["REQUEST_METHOD"] == "POST"){
                        header("location: upload.php?submit=failure");
                }
        
                echo "<main>
                        <div id='maintext'>
                                <h1>Upload Form</h1>
                                <h2>Administrator Only</h2>
                                <button class='Btn' id='uploadBtn'>Select File</button>
                                <form method='post' enctype='multipart/form-data'>
                                        <input type='file' name='fileToUpload' id='fileSelect' style='display:none'>
                                        <input class='Btn' type='submit' value='Upload' name='submit' id='submitBtn'>
                                </form>
                                <p style='display:none;' id='errorMsg'>Invalid File Type</p>
                                <p style='display:none;' id='uploadtext'></p>";
                                
                                 
                                        echo "<p class=\"responseMsg\" style=\"display:none;\" "; if ($_GET["submit"] == "success"){echo "id=successMsg>File successfully uploaded";}else if($_GET["submit"] == "failure"){echo "id=failMsg>No File Selected";}else if($_GET["submit"] == "invalid"){echo "id=invalidMsg>JPEG only please!";}else{echo ">";};echo "</p>\n";
                                
                                
                echo    "</div><br/><br/><div><a class='Btn' href='panel.php'>Back to Admin Panel</a></div>
                </main>";
        }
        else {
                header("Location: error.php");
        }
        ?>
        </body>
</html>
