<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply Sent Successfully</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        h1 {
            color: #4CAF50;
            margin-bottom: 15px;
        }

        p {
            color: #555;
            margin-bottom: 20px;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #45a049;
        }

        .success-icon {
            font-size: 50px;
            color: #4CAF50;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="success-icon">✔️</div>
        <h1>Success!</h1>
        <p>Your reply has been sent successfully.</p>
        <a href="shopowner.php" class="button">Go Back to Dashboard</a>
    </div>

    <script>
        // Optional: Auto redirect after a few seconds
        setTimeout(() => {
            window.location.href = "shopowner.php"; // Redirect to the dashboard or another page
        }, 3000); // Redirects after 5 seconds
    </script>

</body>
</html>
