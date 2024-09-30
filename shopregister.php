<?php
// Include the database connection
include 'connection.php';

// Get form data from the POST request
$shop_name = $_POST['shopname'];
$owner_name = $_POST['ownername'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Hash the password for secure storage
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Define the account type as 'shop'
$accountType = 'shop_owner';

// Prepare and bind for account_login table
$stmt1 = $conn->prepare("INSERT INTO account_login (email, account_password, account_type) VALUES (?, ?, ?)");
$stmt1->bind_param("sss", $email, $hashedPassword, $accountType);

// Execute the first query
if ($stmt1->execute()) {
    // If account creation is successful, insert shop details into shop_detail table
    $stmt2 = $conn->prepare("INSERT INTO shop_detail (shopname, ownername, email, phone, address) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("sssss", $shop_name, $owner_name, $email, $phone, $address);

    // Execute the second query
    if ($stmt2->execute()) {
        header("Location:login.php?message=account created successfully");
    } else {
        echo "Error: Could not insert shop details - " . $stmt2->error;
    }

    // Close second statement
    $stmt2->close();
} else {
    // Error handling if account_login insertion fails
    echo "Error: Could not insert login details - " . $stmt1->error;
}

// Close first statement and the database connection
$stmt1->close();
$conn->close();
?>
