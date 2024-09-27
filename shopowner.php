<?php
session_start();

// Fetch some dynamic data like total products, recent orders, etc. (dummy data for now)
$total_products = 50;  // You should fetch this from your database
$recent_orders = [
    ['id' => 1001, 'customer' => 'John Doe', 'amount' => '₹500', 'status' => 'Delivered'],
    ['id' => 1002, 'customer' => 'Jane Smith', 'amount' => '₹1200', 'status' => 'Processing'],
    // Add more orders dynamically
];
$sales_summary = '₹10,000';  // For instance, today's total sales, fetched from DB

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

        /* Recent Orders Table */
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="#dashboard">Dashboard</a>
        <a href="#products">Manage Products</a>
        <a href="shopnotification.php">Notification</a>
        <a href="#homepage.php">Logout</a>
    </div>

    <!-- Container -->
    <div class="container">
        
        <!-- Shop Statistics -->
        <div class="stats-card">
            <h2>Shop Overview</h2>
            <p>Total Products Listed: <strong><?php echo $total_products; ?></strong></p>
            <p>Today's Sales Summary: <strong><?php echo $sales_summary; ?></strong></p>
        </div>

        <!-- Recent Orders Section -->
        <div class="stats-card">
            <h2>Recent Orders</h2>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($recent_orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo htmlspecialchars($order['customer']); ?></td>
                    <td><?php echo $order['amount']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Product Management Section -->
        <div class="stats-card">
            <h2>Manage Products</h2>
            <form method="POST" action="add_product.php">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" required>

                <label for="price">Price (₹):</label>
                <input type="text" id="price" name="price" required>

                <input type="submit" value="Add Product" style="margin-top: 10px; background-color: #4CAF50; color: white; padding: 10px 20px; border: none;">
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Shop Owner Dashboard</p>
    </div>

</body>
</html>
