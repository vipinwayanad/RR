<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recommendr";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alert_id = $_POST['alert_id'];
    $response_message = $_POST['response_message'];

    // Validate inputs
    if (!empty($alert_id) && !empty($response_message)) {
        // Insert response into database
        $sql = "INSERT INTO responses (alert_id, response_message) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $alert_id, $response_message);

        if ($stmt->execute()) {
            echo "Response sent successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}

$conn->close();
?>
