<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommendr - Login/Register</title>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* General Reset */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.89), rgba(0, 0, 0, 0.5));
        }

        /* Container Styles */
        .container {
            display: flex;
            width: 80%;
            height: 80%;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(0, 0, 0, 0.9));
            animation: fadeIn 1s ease-in-out;
            backdrop-filter: blur(10px);
        }

        /* Left Panel */
        .left {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: slideIn 0.7s ease-in-out;
            overflow: hidden;
            position: relative;
        }

        .left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        .left:hover img {
            transform: scale(1.05);
            filter: brightness(0.9);
        }

        .left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .left:hover::before {
            opacity: 1;
        }

        /* Right Panel */
        .right {
            flex: 1;
            padding: 2rem;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            animation: slideIn 0.7s ease-in-out 0.2s;
        }

        /* Tabs */
        .tabs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .tab-button {
            background: grey;
            border: 2px solid #d1d1d1;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease, color 0.3s ease;
            position: relative;
        }

        .tab-button:hover {
            background: #e0e0e0;
        }

        .tab-button.active {
            background: #4caf50;
            color: white;
            border: 2px solid transparent;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(135deg, #ffeb3b, #ff9800);
            border-radius: 5px;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Form Container */
        .form-container {
            display: flex;
            flex-direction: column;
        }

        /* Input Boxes */
        .input-box {
            position: relative;
            width:80%;
            margin-bottom: 1rem;
        }

        .input-box input,
        .input-box select {
            width: 100%;
            padding: 0.5rem;
            padding-right: 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .input-box input:focus,
        .input-box select:focus {
            border-color: #4caf50;
        }

        .input-box label {
            position: absolute;
            top: 0.5rem;
            left: 0.75rem;
            color: #999;
            transition: 0.3s ease;
            pointer-events: none;
        }

        .input-box input:focus + label,
        .input-box input:not(:placeholder-shown) + label,
        .input-box select:not(:placeholder-shown) + label {
            top: -0.75rem;
            left: 0.75rem;
            color: #4caf50;
            font-size: 0.75rem;
        }

        /* Buttons */
        button {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background: linear-gradient(135deg, #45a049, #1b5e20);
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        /* Toggle Password Visibility */
        .input-box {
            position: relative;
        }

        .toggle-password {
            cursor: pointer;
            font-size: 1.2em;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Error Message */
        .error {
            color: red;
            font-size: 0.85rem;
            margin-top: -0.5rem;
            margin-bottom: 0.75rem;
            display: none;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(20px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
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
                <form id="signinForm" action="loginconnection.php" method="POST" class="form-container">
                    <h2>Sign In</h2>
                    <p style="color:green">
                    <?php
                        if(isset($_GET['message'])){
                            echo $_GET['message'];
                        }
                    ?>
                    </p>
                    <div class="input-box">
                        <input type="email" name="email" id="signinEmail" required>
                        <label for="signinEmail">Email</label>
                        <div class="error" id="signinEmailError">Invalid email address.</div>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" id="signinPassword" required minlength="6">
                        <label for="signinPassword">Password</label>
                        <span class="toggle-password" onclick="togglePasswordVisibility('signinPassword')">👁️</span>
                        <div class="error" id="signinPasswordError">Password must be at least 6 characters.</div>
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

                <h2>Sign Up</h2>
                <div class="input-box">
                    <select id="usertype" name="usertype" onchange="showFields()" required>
                        <option value="">--Select--</option>
                        <option value="customer">Customer</option>
                        <option value="shop">Shop</option>
                    </select>
                    <label for="usertype">User Type</label>
                </div>

                <div class="error" id="usertypeError" style="display:none;">Please select user type.</div>

                <!-- Customer Registration Form -->
                <form id="customerSignupForm" action="customerregister.php" method="POST" class="form-container">
                    <div id="customerFields" style="display:none;">
                        <div class="input-box">
                            <input type="text" name="firstname" id="firstname" required>
                            <label for="firstname">First Name</label>
                        </div>
                        <div class="input-box">
                            <input type="text" name="lastname" id="lastname" required>
                            <label for="lastname">Last Name</label>
                        </div>
                        <div class="input-box">
                            <input type="email" name="email" id="customerEmail" required>
                            <label for="customerEmail">Email</label>
                        </div>
                        <div class="input-box">
                            <input type="password" name="password" id="customerPassword" required minlength="6">
                            <label for="customerPassword">Password</label>
                            <span class="toggle-password" onclick="togglePasswordVisibility('customerPassword')">👁️</span>
                        </div>
                        <div class="input-box">
                            <input type="password" name="confirmPassword" id="customerConfirmPassword" required minlength="6">
                            <label for="customerConfirmPassword">Confirm Password</label>
                            <span class="toggle-password" onclick="togglePasswordVisibility('customerConfirmPassword')">👁️</span>
                            <div class="error" id="customerConfirmPasswordError">Passwords do not match.</div>
                        </div>
                        <div class="input-box">
                            <input type="tel" name="phone" id="customerPhone" required pattern="[0-9]{10}">
                            <label for="customerPhone">Phone Number</label>
                        </div>
                        <div class="input-box">
                            <input type="text" name="address" id="customerAddress" required>
                            <label for="customerAddress">Address</label>
                        </div>
                        <button type="submit" id="submitCustomer">Sign Up as Customer</button>
                    </div>
                </form>

                <!-- Shop Registration Form -->
                <form id="shopSignupForm" action="shopregister.php" method="POST" class="form-container">
                    <div id="companyFields" style="display:none;">
                        <div class="input-box">
                            <input type="text" name="shopname" id="shopname" required>
                            <label for="shopname">Shop Name</label>
                        </div>
                        <div class="input-box">
                            <input type="text" name="ownername" id="ownername" required>
                            <label for="ownername">Owner Name</label>
                        </div>
                        
                        <div class="input-box">
                            <input type="email" name="email" id="shopEmail" required>
                            <label for="shopEmail">Email</label>
                        </div>
                        <div class="input-box">
                            <input type="password" name="password" id="shopPassword" required minlength="6">
                            <label for="shopPassword">Password</label>
                            <span class="toggle-password" onclick="togglePasswordVisibility('shopPassword')">👁️</span>
                        </div>
                        <div class="input-box">
                            <input type="password" name="confirmPassword" id="shopConfirmPassword" required minlength="6">
                            <label for="shopConfirmPassword">Confirm Password</label>
                            <span class="toggle-password" onclick="togglePasswordVisibility('shopConfirmPassword')">👁️</span>
                            <div class="error" id="shopConfirmPasswordError">Passwords do not match.</div>
                        </div>
                        <div class="input-box">
                            <input type="tel" name="phone" id="shopPhone" required pattern="[0-9]{10}">
                            <label for="shopPhone">Phone Number</label>
                        </div>
                        <div class="input-box">
                            <input type="text" name="address" id="shopAddress" required>
                            <label for="shopAddress">Address</label>
                        </div>
                        <button type="submit" id="submitShop">Sign Up as Shop</button>
                    </div>
                </form>
            </div>

            <!-- Forgot Password Form -->
            <div id="forgot" class="tab-content">
                <form id="forgotForm" action="forgotpassword.php" method="POST" class="form-container">
                    <h2>Forgot Password</h2>
                    <div class="input-box">
                        <input type="email" name="email" id="forgotEmail" required>
                        <label for="forgotEmail">Email</label>
                        <div class="error" id="forgotEmailError">Invalid email address.</div>
                    </div>
                    <button type="submit" id="submitForgot">Reset Password</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle tab content
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));

                this.classList.add('active');
                document.getElementById(this.getAttribute('data-tab')).classList.add('active');
            });
        });

        // Toggle password visibility
        function togglePasswordVisibility(id) {
            var passwordInput = document.getElementById(id);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

        // Show/hide fields based on user type selection
        function showFields() {
            var userType = document.getElementById("usertype").value;
            var customerFields = document.getElementById("customerFields");
            var companyFields = document.getElementById("companyFields");

            if (userType === "customer") {
                customerFields.style.display = "block";
                companyFields.style.display = "none";
            } else if (userType === "shop") {
                companyFields.style.display = "block";
                customerFields.style.display = "none";
            } else {
                customerFields.style.display = "none";
                companyFields.style.display = "none";
            }
        }

        // Form validation on submit
        document.getElementById('signinForm').addEventListener('submit', function(event) {
            var email = document.getElementById('signinEmail');
            var password = document.getElementById('signinPassword');
            var emailError = document.getElementById('signinEmailError');
            var passwordError = document.getElementById('signinPasswordError');

            emailError.style.display = 'none';
            passwordError.style.display = 'none';

            if (!validateEmail(email.value)) {
                emailError.style.display = 'block';
                event.preventDefault();
            }

            if (password.value.length < 6) {
                passwordError.style.display = 'block';
                event.preventDefault();
            }
        });

        // Check confirm password match
        document.getElementById('customerSignupForm').addEventListener('submit', function(event) {
            var password = document.getElementById('customerPassword');
            var confirmPassword = document.getElementById('customerConfirmPassword');
            var confirmPasswordError = document.getElementById('customerConfirmPasswordError');

            confirmPasswordError.style.display = 'none';

            if (password.value !== confirmPassword.value) {
                confirmPasswordError.style.display = 'block';
                event.preventDefault();
            }
        });

        document.getElementById('shopSignupForm').addEventListener('submit', function(event) {
            var password = document.getElementById('shopPassword');
            var confirmPassword = document.getElementById('shopConfirmPassword');
            var confirmPasswordError = document.getElementById('shopConfirmPasswordError');

            confirmPasswordError.style.display = 'none';

            if (password.value !== confirmPassword.value) {
                confirmPasswordError.style.display = 'block';
                event.preventDefault();
            }
        });

        // Helper function to validate email
        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    </script>
</body>
</html>
