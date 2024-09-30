<?php
include "connection.php";

// Get form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Set account type
$accountType = 'customer';

// Prepare and bind for account_login
$stmt1 = $conn->prepare("INSERT INTO account_login (email, account_password, account_type) VALUES (?, ?, ?)");
$stmt1->bind_param("sss", $email, $hashedPassword, $accountType);

// Execute first statement
if ($stmt1->execute()) {
    // Prepare and bind for customer_detail
    $stmt2 = $conn->prepare("INSERT INTO customer_detail (firstname, lastname, email, phone, address) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("sssss", $firstname, $lastname, $email, $phone, $address);

    // Execute second statement
    if ($stmt2->execute()) {
        header("Location:login.php?message=account created successfully");
    } else {
        echo "Error: " . $stmt2->error;
    }

    $stmt2->close();
} else {
    echo "Error: " . $stmt1->error;
}

// Close statements and connection
$stmt1->close();
$conn->close();
?>
