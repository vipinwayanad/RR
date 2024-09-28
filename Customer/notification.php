<?php
session_start();

$customer_id = $_SESSION['customer_id'];

// Database connection settings
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'recommendr';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle different actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'delete') {
        $id = $_GET['id'];

        $deleteQuery = $conn->prepare("DELETE FROM replay_messages WHERE id = ? AND customer_id = ?");
        $deleteQuery->bind_param("ii", $id, $customer_id);
        if ($deleteQuery->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
    } elseif ($action === 'delete_all') {
        $deleteAllQuery = $conn->prepare("DELETE FROM replay_messages WHERE customer_id = ?");
        $deleteAllQuery->bind_param("i", $customer_id);
        if ($deleteAllQuery->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    exit;
}

// Fetch notifications from the database
$query = $conn->prepare("SELECT * FROM replay_messages WHERE customer_id = ?");
$query->bind_param("i", $customer_id);
$query->execute();
$result = $query->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        /* Inline CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        header button {
            background-color: white;
            color: #4CAF50;
            border: none;
            padding: 10px;
            margin: 5px;
            cursor: pointer;
        }

        header button:hover {
            background-color: #45a049;
        }

        main {
            padding: 20px;
        }

        #notificationSection {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
        }

        ul#notificationList {
            list-style-type: none;
            padding: 0;
        }

        .notification {
            background-color: #f9f9f9;
            border-bottom: 1px solid #ddd;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification.read {
            background-color: #e1f5e1;
        }

        .notification.unread {
            background-color: #fff;
        }

        .notification p {
            margin: 0;
        }

        .delete-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #ff1a1a;
        }
    </style>
</head>
<body>
    <header>
        <h1>Your Notifications</h1>
        <button onclick="deleteAllNotifications()">Delete All Notifications</button>
    </header>

    <main>
        <section id="notificationSection">
            <?php if ($result->num_rows > 0): ?>
                <ul id="notificationList">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li class="notification <?php echo $row['is_read'] ? 'read' : 'unread'; ?>" data-id="<?php echo $row['id']; ?>">
                            <p><?php echo "Shop name:". $row['shop_name']; ?></p>
                            <p><?php echo "Address:".$row['shop_address']; ?></p>
                            <p><?php echo "Phone Number".$row['shop_phone']; ?></p>
                            <p><?php echo "Message:".$row['message']; ?></p>
                            <button class="delete-btn" onclick="deleteNotification(<?php echo $row['id']; ?>)">Delete</button>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No notifications found.</p>
            <?php endif; ?>
        </section>
    </main>

    <script>
        // Function to delete a single notification
        function deleteNotification(id) {
    console.log("Deleting notification with ID: " + id);  // Log the ID
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "notification.php?action=delete&id=" + id, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log("Server response: " + xhr.responseText);  // Log server response
            if (xhr.responseText.trim() === 'success') {
                alert("Notification deleted!");
                const notification = document.querySelector(`li[data-id='${id}']`);
                notification.remove();
            } else {
                alert("Error deleting notification: " + xhr.responseText);
            }
        } else {
            alert("Error deleting notification");
        }
    };
    xhr.send();
}


        // Function to delete all notifications
        function deleteAllNotifications() {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "notification.php?action=delete_all", true);
            xhr.onload = function() {
                if (xhr.status === 200 && xhr.responseText === 'success') {
                    alert("All notifications deleted!");
                    document.getElementById('notificationList').innerHTML = '';
                } else {
                    alert("Error deleting notifications");
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>