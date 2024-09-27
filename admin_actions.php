<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "recommendr";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['type' => 'error', 'message' => "Connection failed: " . $conn->connect_error]);
    exit();
}

$response = ['type' => 'info', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_username = $_POST['username'] ?? '';
    $user_email = $_POST['email'] ?? '';
    $user_role = $_POST['role'] ?? '';
    $action = $_POST['action'] ?? '';

    if ($action === 'add_user') {
        if ($user_role === 'shop_owner') {
            $sql = "INSERT INTO shop_owners (username, email, password) VALUES ('$user_username', '$user_email', 'defaultpassword')";
        } else {
            $sql = "INSERT INTO customers (username, email, password) VALUES ('$user_username', '$user_email', 'defaultpassword')";
        }

        if ($conn->query($sql) === TRUE) {
            $response = ['type' => 'success', 'message' => 'New user added successfully'];
        } else {
            $response = ['type' => 'error', 'message' => 'Error: ' . $conn->error];
        }
    } elseif ($action === 'delete_user') {
        $sql = "DELETE FROM shop_owners WHERE username='$user_username'";
        if ($conn->query($sql) === TRUE) {
            $response = ['type' => 'success', 'message' => 'User deleted from shop_owners'];
        } else {
            $response = ['type' => 'error', 'message' => 'Error: ' . $conn->error];
        }

        $sql = "DELETE FROM customers WHERE username='$user_username'";
        if ($conn->query($sql) === TRUE) {
            $response = ['type' => 'success', 'message' => 'User deleted from customers'];
        } else {
            $response = ['type' => 'error', 'message' => 'Error: ' . $conn->error];
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'view_counts') {
    $sql_customers = "SELECT COUNT(*) AS total_customers FROM customers";
    $sql_shop_owners = "SELECT COUNT(*) AS total_shop_owners FROM shop_owners";

    $result_customers = $conn->query($sql_customers);
    $result_shop_owners = $conn->query($sql_shop_owners);

    $total_customers = $result_customers->fetch_assoc()['total_customers'];
    $total_shop_owners = $result_shop_owners->fetch_assoc()['total_shop_owners'];

    $response = [
        'total_customers' => $total_customers,
        'total_shop_owners' => $total_shop_owners
    ];
}

$conn->close();
echo json_encode($response);
?>
