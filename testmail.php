```php
<?php
$to = "dudewayanad320@gmail.com";
$subject = "Test Email";
$message = "This is a test email";
$headers = "From: vipin2slce390@gmail.com";

if (mail($to, $subject, $message, $headers)) {
    echo 'Test email sent successfully.';
} else {
    echo 'Test email failed.';
}

?>
```
