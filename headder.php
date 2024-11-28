<?php
require_once "config.php";

// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it isn't already started
}

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}


$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


</head>

<body>
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparrent">
            <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="index.php
                                "><img src="assets/img/logo/logo.png" alt="" style="float: left; width: 80%;"></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="Feedback.php">FeedBack</a></li>

                                            <!-- <li><a href="#">Job Types</a>
                                                <ul class="submenu">
                                                    <li><a href="ChefList.php">Chef</a></li>
                                                    <li><a href="single-blog.html">Blog Details</a></li>
                                                    <li><a href="elements.html">Elements</a></li>
                                                    <li><a href="job_details.html">job Details</a></li>
                                                </ul>
                                            </li> -->
                                            <!-- <li><a href="contact.html">Contact</a></li>? -->
                                            <li><a href="about.php">About</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header-btn -->
                                <div class="header-btn d-none f-right d-lg-block">
                                    <!--<a href="#" class="btn head-btn1">Register</a>
                                    <a href="login_karan_1.php" class="btn head-btn2">Login</a>-->
                                    <div
                                        style="position: relative; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center;">
                                        <a href="Details.php">
                                            <img src="assets/img/logo/profile_photo.png" alt="User Image"
                                                style="width: 50px; height: 50px; border-radius: 4px; transition: opacity 0.3s ease;"></a>
                                        <div style="
                                            position: absolute; 
                                            bottom: -25px; 
                                            left: 50%; 
                                            transform: translateX(-50%); 
                                            background-color: #333; 
                                            color: #fff; 
                                            padding: 5px; 
                                            border-radius: 4px; 
                                            white-space: nowrap; 
                                            visibility: hidden; 
                                            opacity: 0; 
                                            transition: opacity 0.3s ease; 
                                            font-size: 12px; 
                                            z-index: 10;
                                        " class="tooltip-text">
                                            <?php echo $username; ?>
                                        </div>
                                    </div>


                                    <script>
                                        // JavaScript to handle the hover effect
                                        document.querySelector('.header-btn').addEventListener('mouseover', function () {
                                            document.querySelector('.tooltip-text').style.visibility = 'visible';
                                            document.querySelector('.tooltip-text').style.opacity = '1';
                                        });

                                        document.querySelector('.header-btn').addEventListener('mouseout', function () {
                                            document.querySelector('.tooltip-text').style.visibility = 'hidden';
                                            document.querySelector('.tooltip-text').style.opacity = '0';
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
</body>

</html>