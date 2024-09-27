<?php
    // notification.php

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
            $deleteQuery = "DELETE FROM notifications WHERE id = $id";
            if ($conn->query($deleteQuery) === TRUE) {
                echo 'success';
            } else {
                echo 'error';
            }
        } elseif ($action === 'delete_all') {
            $deleteAllQuery = "DELETE FROM notifications WHERE user_id = 1"; // Assuming user_id = 1
            if ($conn->query($deleteAllQuery) === TRUE) {
                echo 'success';
            } else {
                echo 'error';
            }
        } elseif ($action === 'mark_all_read') {
            $markAllReadQuery = "UPDATE notifications SET is_read = 1 WHERE user_id = 1";
            if ($conn->query($markAllReadQuery) === TRUE) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
        exit;
    }

    // Fetch notifications from the database
    $query = "SELECT * FROM notifications WHERE user_id = 1"; // Assuming user_id = 1
    $result = $conn->query($query);
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
        <button onclick="markAllAsRead()">Mark All as Read</button>
        <button onclick="deleteAllNotifications()">Delete All Notifications</button>
    </header>

    <main>
        <section id="notificationSection">
            <?php if ($result->num_rows > 0): ?>
                <ul id="notificationList">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li class="notification <?php echo $row['is_read'] ? 'read' : 'unread'; ?>" data-id="<?php echo $row['id']; ?>">
                            <p><?php echo $row['message']; ?></p>
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
        // Inline JavaScript
        function deleteNotification(id) {
            if (confirm('Are you sure you want to delete this notification?')) {
                fetch(`notification.php?action=delete&id=${id}`, {
                    method: 'GET'
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        document.querySelector(`.notification[data-id="${id}"]`).remove();
                    } else {
                        alert('Error deleting notification');
                    }
                });
            }
        }

        function deleteAllNotifications() {
            if (confirm('Are you sure you want to delete all notifications?')) {
                fetch('notification.php?action=delete_all', {
                    method: 'GET'
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        document.getElementById('notificationList').innerHTML = '';
                    } else {
                        alert('Error deleting all notifications');
                    }
                });
            }
        }

        function markAllAsRead() {
            fetch('notification.php?action=mark_all_read', {
                method: 'GET'
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    document.querySelectorAll('.notification').forEach(notification => {
                        notification.classList.remove('unread');
                        notification.classList.add('read');
                    });
                } else {
                    alert('Error marking all as read');
                }
            });
        }
    </script>
</body>
</html>
