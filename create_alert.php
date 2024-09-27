<?php
// Database connection
require 'config.php'; // include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = $_POST['product'];
    $customer_id = $_POST['customer_id'];

    // Insert alert into the database
    $query = "INSERT INTO alerts (product, customer_id, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $product, $customer_id);
    
    if ($stmt->execute()) {
        // Get all shop owners to send notifications to
        $shopOwnersQuery = "SELECT id, username FROM shop_owners";
        $result = $conn->query($shopOwnersQuery);
        
        while ($row = $result->fetch_assoc()) {
            $shopOwnerID = $row['id'];
            
            // Insert notification into some notification table
            $notificationQuery = "INSERT INTO notifications (shop_owner_id, alert_id) VALUES (?, ?)";
            $notificationStmt = $conn->prepare($notificationQuery);
            $alert_id = $conn->insert_id; // get the last inserted alert ID
            $notificationStmt->bind_param("ii", $shopOwnerID, $alert_id);
            $notificationStmt->execute();
        }

        echo "Alert created successfully!";
    } else {
        echo "Error creating alert.";
    }
}
?>
