<?php
// Database configuration
$servername = "localhost";  // Database server (usually 'localhost')
$username = "root";  // Your database username
$password = "";  // Your database password
$dbname = "recommendr";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If needed, you can echo a success message
// echo "Connected successfully";
?>
