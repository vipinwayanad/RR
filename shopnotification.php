<?php
// Database connection
session_start();
$connection = new mysqli("localhost", "root", "", "recommendr");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// If form is submitted, process the replay
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alert_id = $_POST['alert_id'];
    $shop_name = $connection->real_escape_string($_POST['shop_name']);
    $shop_address = $connection->real_escape_string($_POST['shop_address']);
    $shop_phone = $connection->real_escape_string($_POST['shop_phone']);
    $replay_message = $connection->real_escape_string($_POST['replay_message']);

    // Insert the reply into the replay_messages table
    $stmt = $connection->prepare("INSERT INTO replay_messages (customer_id, shop_owner_id, shop_name, shop_address, shop_phone, message, replay_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iisssss", $customer_id, $shop_owner_id, $shop_name, $shop_address, $shop_phone, $replay_message, $replay_time);

    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>window.location.href = 'Replaytnq.php';</script>"; // Redirect or show success
    } else {
        $message = "Error: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}

// Fetch product alerts from the database
$sql = "SELECT * FROM product_alertss";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Alerts and Replies</title>
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

        .alert-box {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .alert-box h2 {
            color: #4CAF50;
        }

        .alert-box p {
            font-size: 16px;
            color: #555;
        }

        .reply-form {
            margin-top: 20px;
        }

        .reply-form input[type="text"],
        .reply-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .reply-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        .reply-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .success-message {
            color: green;
            font-size: 18px;
            text-align: center;
        }

        .error-message {
            color: red;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Product Alerts</h1>

        <!-- Display success or error message -->
        <?php if (isset($message)): ?>
            <div class="success-message"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Display product alerts -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="alert-box">
                    <h2><?php echo htmlspecialchars($row['product']); ?></h2>
                    <p><strong>Price Range:</strong> <?php echo htmlspecialchars($row['price_range']); ?></p>
                    <p><strong>Quantity:</strong> <?php echo htmlspecialchars($row['quantity']); ?></p>
                    <p><strong>Message:</strong> <?php echo htmlspecialchars($row['message']); ?></p>
                    <p><strong>Created At:</strong> <?php echo htmlspecialchars($row['created_at']); ?></p>

                    <!-- Replay Form -->
                    <div class="reply-form">
                        <h3>Reply to this Alert</h3>
                        <form method="POST" action="">
                            <input type="hidden" name="alert_id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="shop_name" placeholder="Shop Name" required>
                            <input type="text" name="shop_address" placeholder="Shop Address" required>
                            <input type="text" name="shop_phone" placeholder="Shop Phone" required>
                            <textarea name="replay_message" placeholder="Enter your reply here..." rows="4" required></textarea>
                            <input type="submit" value="Send Reply">
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No product alerts found.</p>
        <?php endif; ?>
    </div>

</body>
</html>

<?php
$connection->close();
?>
