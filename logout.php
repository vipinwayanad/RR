<?php
// Start the session
session_start();

// Destroy all session variables
session_unset();

// Destroy the session itself
session_destroy();

// Redirect to the login page or home page
header("Location: LoginPage.html"); // Change this to your desired page
exit();
?>
