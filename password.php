<?php
include "config.php";
$password="vipi@gmail.com";
$hashed_password=password_hash($password,PASSWORD_BCRYPT);
$stmt=$conn->prepare("UPDATE `customers` SET `password`='$hashed_password' WHERE email='vipi@gmail.com';");
if($stmt->execute()){
    echo "executed successfully";
}
?>