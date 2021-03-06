<?php
namespace dark_horse\hw3;
session_start();
use dark_horse\hw3\controllers as ctrl;
require_once("src/controllers/LogoutPageController.php");
require_once("src/controllers/VoteController.php");
require_once("src/views/LoginPageView.php");
require_once("src/controllers/LoginPageController.php");
require_once("src/controllers/FrontPageController.php");
require_once("src/controllers/SignupPageController.php");
require_once("src/controllers/UploadPageController.php");

// Default destination.
$destination = new ctrl\FrontPageController();

// Navigational requests.
if (isset($_GET["nav"])) {
    // Request for logged in users.
    if (isset($_SESSION["user_name"])) {
        // Logout request.
        if ($_GET["nav"] == "logout") 
            $destination = new ctrl\LogoutPageController();
        
        // Vote request.
        else if ($_GET["nav"] == "vote") 
            $destination = new ctrl\VoteController();

        // Upload request.
        else if ($_GET["nav"] == "upload")
            $destination = new ctrl\UploadController();
    }
    
    // Requests for users not logged in.
    else {
        // Login request.
        if ($_GET["nav"] == "login") 
            $destination = new ctrl\LoginPageController();

        // Signup request.
        else if ($_GET["nav"] == "signup") 
            $destination = new ctrl\SignupPageController();
    }
}

// Login credentials sent.
else if (isset($_GET["user"]) and isset($_GET["pass"])) 
    $destination = new ctrl\LoginPageController();

// Some signup info sent.
else if (isset($_GET["newuser"])
     or  isset($_GET["newpass1"])
     or  isset($_GET["newpass2"])
     or  isset($_GET["newname"]))
    $destination = new ctrl\SignupPageController();

// Display page.
$destination->submit($_GET);
?>
