<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer_id']) || $_SESSION['account_type'] != 'customer') {
    // If not logged in, redirect to login page
    header("Location: LoginPage.php");
    exit();
}

// Fetch the customer ID
$customer_id = $_SESSION['customer_id'];

// Database connection (assumed already included)
include '../connection.php';

// Handle form submission for adding new needs
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $_POST['item'];

    // Insert the new need into the database
    if (!empty($item)) {
        $query = $conn->prepare("INSERT INTO customer_need (customer_id, item) VALUES (?, ?)");
        $query->bind_param('is', $customer_id, $item);
        if ($query->execute()) {
            $success_message = "Your need has been posted successfully.";
        } else {
            $error_message = "Error: Unable to post your need. Please try again.";
        }
    } else {
        $error_message = "Please enter a valid need.";
    }
}
$query = $conn->prepare("SELECT * FROM customer_need WHERE customer_id = ?");
$query->bind_param('i', $customer_id);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <style>
        /* General Layout */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f8f8;
}

header {
    background-color: #4CAF50;
    padding: 10px 0;
    color: white;
    text-align: center;
}

.nav-menu {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 20px;
}

.nav-menu a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.container {
    margin: 0 auto;
    max-width: 1000px;
}

.content-section {
    margin: 20px;
    background-color: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background-color: #45a049;
}

/* Shops Section */
.shops-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.shop {
    border: 1px solid #ddd;
    padding: 15px;
    width: 30%;
    border-radius: 10px;
}


    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1>Welcome, <span id="customerName"><?php echo htmlspecialchars($_SESSION['name']); ?></span></h1>
            <nav aria-label="Main Navigation">
                <ul class="nav-menu">
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="alerts.php">Alerts</a></li>
                    <li><a href="notification.php">Notifications <span id="notificationIcon" class="hidden">🔔</span></a></li>
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
        <h2>Your Posted Needs</h2>
        <div id="notificationBar">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<p>' . htmlspecialchars($row['item']) . '</p>';
                }
            } else {
                echo '<p>No needs posted yet.</p>';
            }
            ?>
        </div>
        <div id="notificationActions">
            <button onclick="markAllAsRead()">Mark All as Read</button>
            <button onclick="deleteAllNotifications()">Delete All</button>
        </div>
    </section>

    <!-- Form to Add New Needs -->
    <section id="addNeed" class="content-section">
        <h2>Post a New Need</h2>

        <?php if (isset($success_message)): ?>
            <p style="color:green;"><?php echo $success_message; ?></p>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-box">
                <label for="item">What do you need?</label>
                <input type="text" id="item" name="item" required>
            </div>
            <button type="submit">Post Need</button>
        </form>
    </section>

    <!-- JavaScript Files -->
    <script>
    function markAllAsRead() {
    // Mark all notifications as read
    const notificationBar = document.getElementById('notificationBar');
    notificationBar.innerHTML = "<p>All notifications marked as read.</p>";
}

function deleteAllNotifications() {
    // Clear notifications
    const notificationBar = document.getElementById('notificationBar');
    notificationBar.innerHTML = "<p>No notifications available.</p>";
}

// Simulate browsing shop products
function browseShop(shopId) {
    alert("Browsing products for " + shopId);
}

// Initialize notifications on page load
document.addEventListener('DOMContentLoaded', fetchNotifications);
</script>
</body>
</html>
