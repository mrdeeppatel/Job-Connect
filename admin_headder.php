<?php
require "config.php";

// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it isn't already started
}

// Check if the user is logged in
if (!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true) {
    header("location: admin_login.php");
    exit;
}


$admin_username = $_SESSION["admin_username"];
?>