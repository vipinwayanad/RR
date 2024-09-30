<?php
// Include the database connection
include 'connection.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists in the account_login table
    $stmt = $conn->prepare("SELECT email FROM account_login WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate a unique token and expiration time (1-hour validity)
        $token = bin2hex(random_bytes(50));
        $tokenExpiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Update the account_login table with the token and expiration
        $updateStmt = $conn->prepare("UPDATE account_login SET reset_token = ?, token_expiry = ? WHERE email = ?");
        $updateStmt->bind_param("sss", $token, $tokenExpiry, $email);
        if ($updateStmt->execute()) {
            // Send the password reset link to the user's email
            $resetLink = "http://yourdomain.com/reset_password.php?token=" . $token;

            // Replace this with PHPMailer for more robust email sending
            $subject = "Password Reset Request";
            $message = "Click the following link to reset your password: " . $resetLink;
            $headers = "From: no-reply@yourdomain.com";

            if (mail($email, $subject, $message, $headers)) {
                echo "A password reset link has been sent to your email.";
            } else {
                echo "Failed to send reset link. Please try again later.";
            }
        } else {
            echo "Error updating token.";
        }

        $updateStmt->close();
    } else {
        echo "No account found with this email address.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- HTML Form to request a password reset -->
<form action="forgot_password.php" method="post">
    <label for="email">Enter your email address:</label>
    <input type="email" name="email" id="email" required>
    <button type="submit">Send Reset Link</button>
</form>
