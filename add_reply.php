<?php
include 'config.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alert_id = $_POST['alert_id'];
    $shop_owner_id = $_POST['shop_owner_id'];
    $reply_message = $_POST['reply_message'];

    $query = "INSERT INTO replies (alert_id, shop_owner_id, reply_message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $alert_id, $shop_owner_id, $reply_message);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Reply added successfully.";
    } else {
        echo "Error adding reply.";
    }
}
?>
