document.addEventListener("DOMContentLoaded", function () {
    // 1. Handle tab switching
    $('.tab-button').on('click', function() {
        var tabId = $(this).data('tab');
        $('.tab-button').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').removeClass('active');
        $('#' + tabId).addClass('active');
    });

    // 2. Username field validation
    $('#signupUsername, #signinUsername').on('keypress', preventInvalidCharacters);

    $('#signupUsername, #signinUsername').on('paste', function(e) {
        e.preventDefault();
        var pastedData = e.originalEvent.clipboardData.getData('text');
        var sanitizedData = pastedData.replace(/[\s\0]/g, ''); // Remove spaces and null characters
        $(this).val(sanitizedData); // Replace content with sanitized data
    });

    $('#signinForm, #signupForm').on('submit', function(e) {
        var username = $(this).find('#signinUsername, #signupUsername').val();
        if (/\s|\0/.test(username)) {
            e.preventDefault();
            alert('Spaces and null characters are not allowed in the username.');
        }
    });

    // 3. Password field and password strength indicator
    $('#signupPassword').on('input', function() {
        var strength = checkPasswordStrength($(this).val());
        $('#passwordStrength').text(strength.message).css('color', strength.color);
        $('#passwordStrengthBox').css('width', strength.width);
    });

    function checkPasswordStrength(password) {
        var strength = { message: 'Weak', color: 'red', width: '25%' };
        var criteria = [
            /.{8,}/.test(password),
            /[A-Z]/.test(password),
            /[a-z]/.test(password),
            /[0-9]/.test(password),
            /[!@#$%^&*(),.?":{}|<>]/.test(password)
        ];

        var score = criteria.reduce((acc, cur) => acc + cur, 0);

        if (score === 5) {
            strength = { message: 'Strong', color: 'green', width: '100%' };
        } else if (score >= 3) {
            strength = { message: 'Medium', color: 'orange', width: '60%' };
        } else if (score >= 1) {
            strength = { message: 'Weak', color: 'red', width: '30%' };
        }

        return strength;
    }

    // 4. Email and phone number validation
    $('#signupEmail').on('input', function() {
        const email = $(this).val();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            $('#emailFeedback').text('Invalid email format').css('color', 'red');
        } else {
            $('#emailFeedback').text('');
        }
    });

    $('#signupPhone').on('input', function() {
        const phone = $(this).val();
        const phoneRegex = /^[6-9]\d{9}$/;

        if (!phoneRegex.test(phone)) {
            $('#phoneFeedback').text('Invalid phone number').css('color', 'red');
        } else {
            $('#phoneFeedback').text('');
        }
    });

    // 5. Password match validation
    $('#confirmPassword').on('input', function() {
        const password = $('#signupPassword').val();
        const confirmPassword = $(this).val();

        if (password !== confirmPassword) {
            $('#passwordMatchFeedback').text('Passwords do not match').css('color', 'red');
        } else {
            $('#passwordMatchFeedback').text('Passwords match').css('color', 'green');
        }
    });

    // 6. UserType selection logic for auto-filling username
    $('#userType').change(function() {
        const userType = $(this).val();
        let prefix = '';
        if (userType === 'shop_owner') {
            prefix = 'SHOP__';
        } else if (userType === 'customer') {
            prefix = 'CUS__';
        }

        const usernameField = $('#signupUsername');
        usernameField.off('input keydown paste').val(prefix).prop('readonly', false).focus();

        usernameField.on('input', function() {
            const currentValue = $(this).val();
            if (!currentValue.startsWith(prefix)) {
                $(this).val(prefix);
            } else {
                $(this).val(currentValue.slice(0, prefix.length) + currentValue.slice(prefix.length).replace(/[\s\0]/g, ''));
            }
        }).on('keydown', function(e) {
            const cursorPos = this.selectionStart;
            if (cursorPos < prefix.length && ['Backspace', 'Delete'].includes(e.key)) {
                e.preventDefault();
            }
        }).on('paste', function(e) {
            e.preventDefault();
        });
    });

    // 7. Forgot password redirect
    $('.forgot-link').click(function(e) {
        e.preventDefault();
        $('.tab-button').removeClass('active');
        $('.tab-content').removeClass('active');
        $('.tab-button[data-tab="forgot"]').addClass('active');
        $('#forgot').addClass('active');
    });

    // 8. Prevent copy/paste in sensitive fields
    $('#signupUsername, #signupPassword, #forgotEmail, #signupEmail').on('copy paste', function(e) {
        e.preventDefault();
        alert('Copying and pasting is not allowed in this field.');
    });

    // 9. Toggle password visibility
    window.togglePasswordVisibility = function(passwordFieldId) {
        var passwordField = document.getElementById(passwordFieldId);
        var fieldType = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = fieldType;
    
        // Update icon based on password field type
        var eyeIcon = document.querySelector(`#${passwordFieldId} + .toggle-password`);
        if (eyeIcon) {
            eyeIcon.textContent = fieldType === 'password' ? '👁️' : '🙈'; // Change icon when toggled
        }
    };    
    // 10. Prevent null characters
    function preventInvalidCharacters(event) {
        if ([' ', '\0'].includes(event.key)) {
            event.preventDefault();
        }
    }

    $('#signupUsername, #signupPassword, #signupEmail, #signupPhone').on('keypress', preventNullCharacters);

    function preventNullCharacters(event) {
        if (event.key === '\0') {
            event.preventDefault();
        }
    }

    // 11. Username availability check
    $('#signupUsername').on('blur', function() {
        var username = $(this).val();
        var userType = $('#userType').val();

        if (username === '' || userType === '') {
            $('#usernameFeedback').text('');
            return;
        }

        $.ajax({
            url: 'checkusername.php',
            type: 'POST',
            data: { username: username, userType: userType },
            success: function(response) {
                if (response.valid) {
                    $('#usernameFeedback').text(response.message).css('color', 'green');
                } else {
                    $('#usernameFeedback').text(response.message).css('color', 'red');
                }
            },
            error: function() {
                $('#usernameFeedback').text('Error checking username').css('color', 'red');
            },
            dataType: 'json'
        });
    });

    // 13. Dynamic email suggestions
    $('#signupEmail').on('input', function() {
        var email = $(this).val();
        if (email.indexOf('@') === -1) {
            $('#emailSuggestions').html('<p>@gmail.com</p><p>@yahoo.com</p><p>@outlook.com</p>').show();
        } else {
            $('#emailSuggestions').hide();
        }
    });

    $('#emailSuggestions p').on('click', function() {
        var email = $('#signupEmail').val();
        $('#signupEmail').val(email + $(this).text());
        $('#emailSuggestions').hide();
    });

    // 14. Theme switcher
    $('#themeSwitcher').click(function() {
        $('body').toggleClass('dark-theme');
    });
});
