document.addEventListener('DOMContentLoaded', function () {
    function openTab(evt, tabName) {
        var i, tabContent, tabLinks;
        tabContent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabContent.length; i++) {
            tabContent[i].style.display = "none";
            tabContent[i].classList.remove("active");
        }
        tabLinks = document.getElementsByClassName("tab-button");
        for (i = 0; i < tabLinks.length; i++) {
            tabLinks[i].classList.remove("active");
        }
        document.getElementById(tabName).style.display = "block";
        document.getElementById(tabName).classList.add("active");
        evt.currentTarget.classList.add("active");
    }

    function checkPasswordStrength(password) {
        let strength = document.getElementById('passwordStrength');
        let strengthValue = 0;
        if (password.length >= 6) {
            strengthValue++;
        }
        if (password.match(/[a-z]+/)) {
            strengthValue++;
        }
        if (password.match(/[A-Z]+/)) {
            strengthValue++;
        }
        if (password.match(/[0-9]+/)) {
            strengthValue++;
        }
        if (password.match(/[$@#&!]+/)) {
            strengthValue++;
        }
        switch (strengthValue) {
            case 0:
            case 1:
            case 2:
                strength.textContent = 'Weak';
                strength.className = 'feedback weak';
                break;
            case 3:
            case 4:
                strength.textContent = 'Medium';
                strength.className = 'feedback medium';
                break;
            case 5:
                strength.textContent = 'Strong';
                strength.className = 'feedback strong';
                break;
        }
    }

    function checkUsernameAvailability(username) {
        $.ajax({
            type: "POST",
            url: "check_username.php",
            data: { username: username },
            success: function (response) {
                let feedback = document.getElementById('usernameFeedback');
                response = JSON.parse(response);
                if (response.status === "taken") {
                    feedback.textContent = "Username is taken";
                    feedback.className = 'feedback taken';
                } else {
                    feedback.textContent = "Username is available";
                    feedback.className = 'feedback available';
                }
            }
        });
    }

    document.getElementById('signupPassword').addEventListener('input', function () {
        checkPasswordStrength(this.value);
    });

    document.getElementById('signupUsername').addEventListener('input', function () {
        checkUsernameAvailability(this.value);
    });

    document.querySelectorAll('.tab-button').forEach(tab => {
        tab.addEventListener('click', function (event) {
            openTab(event, this.textContent.toLowerCase());
        });
    });
});
