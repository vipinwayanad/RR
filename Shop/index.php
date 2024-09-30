<?php 
session_start();

// Database connection (dummy connection details, replace with real credentials)
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'recommendr';

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$shop_id = $_SESSION['shop_id']; // Assuming session stores shop ID

// Fetch total accepted items (status = 'accept')
$accepted_items_query = "SELECT COUNT(*) as total_accepted FROM reply_messages WHERE shop_id = ? AND status = 'accept'";
$stmt = $conn->prepare($accepted_items_query);
$stmt->bind_param('i', $shop_id);
$stmt->execute();
$accepted_items_result = $stmt->get_result();
$accepted_items = $accepted_items_result->fetch_assoc()['total_accepted'];

// Fetch total earnings from accepted replies
$earnings_query = "SELECT SUM(price) as total_earnings FROM reply_messages WHERE shop_id = ? AND status = 'accept'";
$stmt = $conn->prepare($earnings_query);
$stmt->bind_param('i', $shop_id);
$stmt->execute();
$earnings_result = $stmt->get_result();
$total_earnings = $earnings_result->fetch_assoc()['total_earnings'];

// Fetch recent replies (limit to 5)
$recent_replies_query = "SELECT reply_id, description, price, status FROM reply_messages WHERE shop_id = ? ORDER BY reply_id DESC LIMIT 5";
$stmt = $conn->prepare($recent_replies_query);
$stmt->bind_param('i', $shop_id);
$stmt->execute();
$recent_replies_result = $stmt->get_result();
$recent_replies = $recent_replies_result->fetch_all(MYSQLI_ASSOC);

// Handle notification form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notification'])) {
    $notification = $_POST['notification'];
    
    // Add logic to send notification (e.g., save to database or send via email)
    // ...
    $success_message = "Notification sent successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Owner Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #4CAF50;
            overflow: hidden;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 9999;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #3e8e41;
        }

        .container {
            margin-top: 80px;
            padding: 20px;
        }

        .stats-card {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        .stats-card h2 {
            margin: 0 0 10px;
            color: #4CAF50;
        }

        .stats-card p {
            margin: 0;
            font-size: 18px;
            color: #555;
        }

        /* Recent Replies Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            color: #888;
        }

        .notification-form {
            margin-top: 20px;
        }

        .notification-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .notification-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .notification-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .success-message {
            color: green;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="#dashboard">Dashboard</a>
        <a href="shopnotification.php">Notification</a>
        <a href="#logout">Logout</a>
    </div>

    <!-- Container -->
    <div class="container">
        
        <!-- Shop Statistics -->
        <div class="stats-card">
            <h2>Shop Overview</h2>
            <p>Total Accepted Items: <strong><?php echo $accepted_items; ?></strong></p>
            <p>Total Earnings: <strong>₹<?php echo number_format($total_earnings, 2); ?></strong></p>
        </div>

        <!-- Recent Replies Section -->
        <div class="stats-card">
            <h2>Recent Replies</h2>
            <table>
                <tr>
                    <th>Reply ID</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($recent_replies as $reply): ?>
                <tr>
                    <td><?php echo $reply['reply_id']; ?></td>
                    <td><?php echo htmlspecialchars($reply['description']); ?></td>
                    <td><?php echo ucfirst($reply['status']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Send Notification Section -->
        <div class="stats-card notification-form">
            <h2>Send Notification</h2>
            <?php if (isset($success_message)): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <textarea name="notification" placeholder="Enter notification message..." required></textarea>
                <input type="submit" value="Send Notification">
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Shop Owner Dashboard</p>
    </div>

</body>
</html>
