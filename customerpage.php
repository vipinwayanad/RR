<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer_id']) || $_SESSION['role'] != 'customer') {
    // If not logged in, redirect to login page
    header("Location: LoginPage.php");
    exit();
}

// Fetch the customer ID
$customer_id = $_SESSION['customer_id'];

// Database connection (assumed already included)
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="customerpage.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1>Welcome, <span id="customerName"><?php echo htmlspecialchars($_SESSION['user']); ?></span></h1>
            <nav aria-label="Main Navigation">
                <ul class="nav-menu">
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="alerts.php">Alerts</a></li>
                    <li><a href="#notifications">Notifications <span id="notificationIcon" class="hidden">🔔</span></a></li>
                    <li><a href="#shops">Browse Shops</a></li>
                    <li><a href="replies.php">Replies</a></li>
                    <li><a href="shopdetails.php">Shop Details</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Marquee Section -->
    <section id="marquee" aria-label="Promotional Message">
        <marquee behavior="scroll" direction="left">Get the best deals on your favorite products! Shop Now!</marquee>
    </section>

    <!-- Notifications Section -->
    <section id="notifications" class="content-section">
        <h2>Notifications</h2>
        <div id="notificationBar">
            <?php
            // Fetch notifications from the database
            $query = $conn->prepare("SELECT message FROM replay_messages WHERE customer_id = ?");
            $query->bind_param('i', $customer_id);
            $query->execute();
            $result = $query->get_result();

            while ($row = $result->fetch_assoc()) {
                echo '<p>' . htmlspecialchars($row['message']) . '</p>';
            }
            ?>
        </div>
        <div id="notificationActions">
            <button onclick="markAllAsRead()">Mark All as Read</button>
            <button onclick="deleteAllNotifications()">Delete All</button>
        </div>
    </section>

    <!-- Product Alerts Section -->
    <!-- ... same as above ... -->

    <!-- Browse Shops Section -->
    <!-- ... same as above ... -->

    <!-- JavaScript Files -->
    <script src="customerpage.js"></script>
</body>
</html>
