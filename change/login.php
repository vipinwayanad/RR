<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommendr - Login/Register</title>
    <link rel="stylesheet" type="text/css" href="Loginpage.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="images/homepage1.jpg" alt="Welcome Image">
        </div>
        <div class="right">
            <div class="tabs">
                <button class="tab-button active" data-tab="signin">Sign In</button>
                <button class="tab-button" data-tab="signup">Sign Up</button>
                <button class="tab-button" data-tab="forgot">Forgot Password</button>
            </div>
            <!-- Sign In Form -->
            <div id="signin" class="tab-content active">
                <form id="signinForm" action="login.php" method="POST" class="form-container">
                    <h2>Sign In</h2>
                    <div class="input-box">
                        <input type="email" name="email" id="signinEmail" required>
                        <label for="signinEmail">Email</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" id="signinPassword" required>
                        <label for="signinPassword">Password</label>
                        <span class="toggle-password" onclick="togglePasswordVisibility('signinPassword')">👁️</span>
                    </div>
                    
                    <div class="remember-forgot">
                        <label>
                            <input type="checkbox" name="rememberMe" id="rememberMe"> Remember Me
                        </label>
                        <a href="#" class="forgot-link" data-tab="forgot">Forgot Password?</a>
                    </div>
                    <button type="submit" id="submit">Sign In</button>
                </form>
            </div>

            <!-- Sign Up Form -->
            <div id="signup" class="tab-content">
                <form id="signupForm" action="register.php" method="POST" class="form-container">
                    <h2>Sign Up</h2>
                    <div class="input-box">
                        <select name="userType" id="userType" required>
                            <option value="" disabled selected>Select User Type</option>
                            <option value="customer">Customer</option>
                            <option value="shop_owner">Shop Owner</option>
                        </select>
                        <label for="userType">User Type</label>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" id="signupEmail" required>
                        <label for="signupEmail">Email</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" id="signupPassword" required>
                        <label for="signupPassword">Password</label>
                        <span class="toggle-password" onclick="togglePasswordVisibility('signupPassword')">👁️</span>
                    </div>
                    <div class="input-box">
                        <input type="password" name="confirmPassword" id="confirmPassword" required>
                        <label for="confirmPassword">Confirm Password</label>
                        <span class="toggle-password" onclick="togglePasswordVisibility('confirmPassword')">👁️</span>
                    </div>
                    <button type="submit">Sign Up</button>
                </form>
            </div>

            <!-- Forgot Password Form -->
            <div id="forgot" class="tab-content">
                <form id="forgotForm" action="fetchEmail.php" method="POST" class="form-container">
                    <h2>Forgot Password</h2>
                    <div class="input-box">
                        <input type="email" name="email" id="forgotEmail" required>
                        <label for="forgotEmail">Email</label>
                    </div>
                    <button type="submit" name="reset-request-submit">Send Reset Link</button>
                </form>
            </div>
        </div>
    </div>
    <script src="loginpage.js"></script>
</body>
</html>
