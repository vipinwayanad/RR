<?php
// Include the database connection file
session_start();
include('config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
    $email = $_POST['email'];
    $phone = $_POST['phone']; // Get phone number
    $user_type = $_POST['userType'];

    // Validate user_type and set table name accordingly
    switch ($user_type) {
        case 'customer':
            $table = 'customers';
            break;
        case 'shop_owner':
            $table = 'shop_owners';
            break;
        case 'admin':
            $table = 'admins';
            break;
        default:
            die("Invalid user type.");
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO $table (username, password, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $email, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
