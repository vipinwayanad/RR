<!-- Profile Section -->
<section id="profile" class="content-section">
    <h2>Update Your Profile</h2>
    <form id="profileForm" method="POST" action="update_profile.php" novalidate>
        <!-- Profile Picture Upload -->
        <div class="form-group">
            <label for="profilePic">Profile Picture:</label>
            <input type="file" id="profilePic" name="profilePic" accept="image/*">
        </div>

        <!-- Name Input -->
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
        </div>

        <!-- Email Input -->
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <!-- Phone Number Input -->
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" pattern="[0-9]{10}" required>
            <small>Format: 1234567890</small>
        </div>

        <!-- Address Input -->
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" placeholder="Enter your address" rows="3"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn-primary">Update Profile</button>
        </div>

        <!-- Feedback Message -->
        <div id="feedbackMessage" class="feedback-message"></div>
    </form>
</section>

<!-- CSS for Professional Look -->
<style>
    .content-section {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        max-width: 600px;
        margin: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }

    input[type="file"] {
        padding: 5px;
    }

    .btn-primary {
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #218838;
    }

    .feedback-message {
        margin-top: 15px;
        font-size: 0.9rem;
        color: #28a745;
    }
</style>

<!-- JavaScript for Real-time Feedback -->
<script>
    document.getElementById('profileForm').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            event.preventDefault();
            document.getElementById('feedbackMessage').textContent = "Passwords do not match!";
            document.getElementById('feedbackMessage').style.color = "red";
        }
    });
</script>