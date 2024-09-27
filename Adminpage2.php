<?php
if(!isset($_SESSION['admin_id'])){
    Header("Location:LoginPage.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            color: #333;
        }

        nav {
            background: #4a90e2;
            color: #fff;
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 20px;
            transition: background 0.3s ease;
        }

        nav ul li a:hover {
            background: #357ABD;
        }

        section {
            padding: 20px;
            max-width: 800px;
            margin: 80px auto 20px auto; /* Adjusted top margin for fixed navbar */
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-out;
        }

        h2 {
            margin-top: 0;
            color: #4a90e2;
            font-size: 2em;
        }

        h3 {
            margin-top: 0;
            color: #666;
            font-size: 1.5em;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        input[type="text"], input[type="email"], select {
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: calc(100% - 24px);
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="email"]:focus, select:focus {
            border-color: #4a90e2;
            outline: none;
        }

        button {
            padding: 12px;
            background: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background: #357ABD;
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
            font-size: 16px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="#manage">Manage Users</a></li>
            <li><a href="#counts">View Counts</a></li>
        </ul>
    </nav>

    <section id="manage">
        <h2>Manage Shop Owners & Customers</h2>

        <form id="addUserForm">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <select name="role" required>
                <option value="shop_owner">Shop Owner</option>
                <option value="customer">Customer</option>
            </select>
            <button type="submit" name="action" value="add_user">Add User</button>
        </form>

        <h3>Delete User</h3>
        <form id="deleteUserForm">
            <input type="text" name="username" placeholder="Username" required>
            <button type="submit" name="action" value="delete_user">Delete</button>
        </form>

        <div id="message" class="alert"></div>
    </section>

    <section id="counts">
        <h2>View Total Users</h2>
        <button id="viewCountsBtn">View Counts</button>
        <div id="countsDisplay"></div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addUserForm = document.getElementById('addUserForm');
            const deleteUserForm = document.getElementById('deleteUserForm');
            const viewCountsBtn = document.getElementById('viewCountsBtn');
            const messageDiv = document.getElementById('message');
            const countsDisplay = document.getElementById('countsDisplay');

            addUserForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(addUserForm);

                fetch('admin_actions.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    messageDiv.className = `alert ${data.type}`;
                    messageDiv.textContent = data.message;
                });
            });

            deleteUserForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(deleteUserForm);

                fetch('admin_actions.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    messageDiv.className = `alert ${data.type}`;
                    messageDiv.textContent = data.message;
                });
            });

            viewCountsBtn.addEventListener('click', function() {
                fetch('admin_actions.php?action=view_counts')
                .then(response => response.json())
                .then(data => {
                    countsDisplay.innerHTML = `
                        <div class="alert info">Total Customers: ${data.total_customers}</div>
                        <div class="alert info">Total Shop Owners: ${data.total_shop_owners}</div>
                    `;
                });
            });
        });
    </script>
</body>
</html>
