<?php
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "recommendr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = ['message' => '', 'valid' => false];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = str_replace("\0", '', $_POST['username']); // Remove null characters
    $username = trim($username); // Remove spaces from the beginning and end
    $username = $conn->real_escape_string($username);

    // Check if username contains invalid characters
    if (preg_match('/\s/', $username)) {
        $response['message'] = "Can't register with this type of username. You have to remove spaces to successfully register.";
    } else {
        $userType = $_POST['userType'];
        $table = '';

        if ($userType == 'customer') {
            $table = 'customers';
        } elseif ($userType == 'shop_owner') {
            $table = 'shop_owners';
        } else {
            $response['message'] = 'Invalid user type.';
            echo json_encode($response);
            exit;
        }

        // Check if the username is already registered with any user type
        $sql = "SELECT * FROM customers WHERE username='$username'
                UNION
                SELECT * FROM shop_owners WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Username is taken, check if it matches the current user type
            $sql = "SELECT * FROM $table WHERE username='$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $response['message'] = 'Username available.';
                $response['valid'] = true;
            } else {
                $response['message'] = 'You are registered with this credential with another user type.';
            }
        } else {
            $response['message'] = 'Username available.';
            $response['valid'] = true;
        }
    }
}

$conn->close();
echo json_encode($response);
?>
