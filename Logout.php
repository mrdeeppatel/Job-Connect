<?php
// Start the session
session_start();
// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to login page or any other page after logging out
header("location: login2.php");
exit;
?>