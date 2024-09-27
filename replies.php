<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    // Redirect to login if the customer is not logged in
    header("Location: login.php");
    exit();
}

// Database connection
$connection = new mysqli("localhost", "root", "", "recommendr");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get the logged-in customer's ID from the session
$customer_id = $_SESSION['customer_id'];

// Fetch replies specific to the logged-in customer
$sql = "SELECT * FROM replay_messages WHERE customer_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Replies</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 90%;
            margin: 20px auto;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .reply-box {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .reply-box h2 {
            color: #4CAF50;
        }

        .reply-box p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Your Replies</h1>

        <!-- Display customer replies -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="reply-box">
                    <h2>Reply from <?php echo htmlspecialchars($row['shop_name']); ?></h2>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($row['shop_address']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['shop_phone']); ?></p>
                    <p><strong>Message:</strong> <?php echo htmlspecialchars($row['message']); ?></p>
                    <p><strong>Replied At:</strong> <?php echo htmlspecialchars($row['replay_time']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No replies found.</p>
        <?php endif; ?>

    </div>

</body>
</html>

<?php
$stmt->close();
$connection->close();
?>
