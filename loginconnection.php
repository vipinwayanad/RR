<?php
// Include the database connection
include 'connection.php';

session_start(); // Start the session

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(trim($_POST['email']));  // Convert to lowercase and trim spaces
    $password = $_POST['password'];

    // Debug: Check the email being passed

    // Prepare and execute the statement to check the email and password
    $stmt = $conn->prepare("SELECT account_password, account_type FROM account_login WHERE email = ?");
    
    if (!$stmt) {
        die("Query preparation failed: " . $conn->error); // Check for query errors
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hashedPassword, $accountType);

    // Fetch the result and check if data is retrieved
    if ($stmt->fetch()) {
        // Close the current statement to free up resources
        $stmt->close();

        // Check if the password is verified
        if (password_verify($password, $hashedPassword)) {
            // Store user information in session variables
            $_SESSION['email'] = $email;
            $_SESSION['account_type'] = $accountType;

            // Redirect based on account type
            switch ($accountType) {
                case 'customer':
                    // Prepare a new statement to fetch customer ID
                    $stmt = $conn->prepare("SELECT customer_id,firstname FROM customer_detail WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->bind_result($customer_id,$firstname);
                    $stmt->fetch();
                    $_SESSION['name']=$firstname;
                    $_SESSION['customer_id'] = $customer_id;
                    $stmt->close(); // Close this statement too
                    header("Location: customer/index.php");
                    break;

                case 'shop':
                    // Prepare a new statement to fetch shop ID
                    $stmt = $conn->prepare("SELECT shop_id FROM shop_detail WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->bind_result($shop_id);
                    $stmt->fetch();
                    $_SESSION['shop_id'] = $shop_id;
                    $stmt->close(); // Close this statement as well
                    header("Location: shop/index.php");
                    break;
                case 'admin':
                    $stmt = $conn->prepare("SELECT admin_id FROM admin_detail WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->bind_result($admin_id);
                    $stmt->fetch();
                    $_SESSION['admin_id'] = $admin_id;
                    $stmt->close(); // Close this statement too
                    header("Location: admin/dashboard.php");
                    break;
                default:
                    echo "Invalid account type.";
                    exit();
            }
        } else {
            echo "Invalid email or password.";
        }
    } else {
        // Email does not exist
        echo "No user found with this email.";
    }

    // Ensure to close the statement at the end
    if ($stmt) {
        $stmt->close();
    }
}

$conn->close();
?>
