<?php
include 'config.php'; // Include your database connection

$alert_id = $_GET['alert_id']; // Get alert_id from URL

$query = "SELECT r.reply_id, r.reply_message, so.shop_owner_id, so.username 
          FROM replies r 
          JOIN shop_owners so ON r.shop_owner_id = so.shop_owner_id 
          WHERE r.alert_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $alert_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<p><strong>Shop Owner: </strong>" . htmlspecialchars($row['username']) . "</p>";
    echo "<p>" . htmlspecialchars($row['reply_message']) . "</p>";
    echo "<a href='shop_details.php?shop_owner_id=" . $row['shop_owner_id'] . "'>View Shop Details</a>";
    echo "</div><hr>";
}
?>
