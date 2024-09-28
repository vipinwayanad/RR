<?php
session_start();
include 'config.php'; // Ensure this file path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginCredential = $_POST['loginCredential'];
    $password = $_POST['password'];
    $loginAs = $_POST['loginAs'];




    // Debugging - Output values for verification
    error_log("Login Attempt: Credential - $loginCredential, Role - $loginAs");

    if ($loginAs == 'customer' || $loginAs == 'shop_owner') {
        $table = ($loginAs == 'customer') ? 'customers' : 'shop_owners';
        $query = $conn->prepare("SELECT * FROM $table WHERE username = ? OR email = ? OR phone = ?");
        $query->bind_param('sss', $loginCredential, $loginCredential, $loginCredential);
        $query->execute();
        $result = $query->get_result();
    
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Using password_verify for secure password comparison
            if (password_verify($password, $user['password'])) {
                // Store user details in session for tracking
                if($loginAs=='customer'){
                    $_SESSION['customer_id'] = $user['customer_id']; // Store the user's id
                }
                else{
                    $_SESSION['shop_owner_id'] = $user['shop_owner_id']; // Store the user's id 
                }
                $_SESSION['user'] = $user['username'];
                $_SESSION['role'] = $loginAs;
    
                // Redirect based on role
                if ($loginAs == 'customer') {
                    header("Location: Customer/customerpage.php");
                } else {
                    header("Location: Shop/shopowner.php");
                }
                exit();
            } else {
                echo "<script>alert('Invalid credentials!');</script>";
                echo "<script>window.location.href='LoginPage.php';</script>"; // Redirect to the same page
            }
        } else {
            echo "<script>alert('User not found!');</script>";
            echo "<script>window.location.href='LoginPage.php';</script>"; // Redirect to the same page
        }
    }
    

    if ($loginAs == 'admin') {
        $query = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $query->bind_param('s', $loginCredential);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows == 1) {
            $admin = $result->fetch_assoc();

            // Using password_verify for admin as well (assuming password is hashed)
            if (password_verify($password, $admin['password'])) {
                // Store admin details in session for tracking
                $_SESSION['admin_id'] = $admin['id']; // Store admin's id
                $_SESSION['user'] = $admin['username'];
                $_SESSION['role'] = 'admin';
                header("Location: Adminpage2.php");
                exit();
            } else {
                echo "<script>alert('Invalid admin credentials!');</script>";
            }
        } else {
            echo "<script>alert('Admin not found!');</script>";
        }
    }
}

$conn->close();
exit(); // Exit after processing to prevent further HTML from being rendered
?>
