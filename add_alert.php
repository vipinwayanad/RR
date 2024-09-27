<?php
// Include the database configuration file
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $product = $_POST['product'];
    $price_range = $_POST['price_range'];
    $quantity = $_POST['quantity'];
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Prepare the SQL query to insert the data
    $query = $conn->prepare("INSERT INTO product_alertss (product, price_range, quantity, message) VALUES (?, ?, ?, ?)");
    $query->bind_param('ssss', $product, $price_range, $quantity, $message);

    // Execute the query and check for success or failure
    if ($query->execute()) {
        echo "<script>alert('Product alert submitted successfully!');</script>";
        echo "<script>window.location.href = 'thankyou.php';</script>"; // Redirect back to form page
    } else {
        echo "<script>alert('Error submitting product alert. Please try again.');</script>";
    }

    // Close the query and database connection
    $query->close();
    $conn->close();
}
?>
