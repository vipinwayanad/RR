// Initialize Swiper for Header Carousel
document.addEventListener('DOMContentLoaded', () => {
    var swiper = new Swiper('.hero-section', {
        loop: true, // Enable loop
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 5000, // Delay between transitions
        },
        effect: 'fade', // Fade effect for smooth transitions
    });

    // Smooth Scrolling for Navigation Links
    document.querySelectorAll('.sticky-nav a').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Log In button click
        document.querySelector('.auth-button[href="LoginPage.html"]').addEventListener('click', function(e) {
            e.preventDefault();
            // Show loading spinner
            document.getElementById('loadingSpinner').style.display = 'flex';
            
            // Redirect after a short delay to simulate loading
            setTimeout(function() {
                window.location.href = 'LoginPage.html';
            }, 500); // Adjust the delay as needed
        });

        // Handle Log Out button click
        document.querySelector('.auth-button[href="logout.php"]').addEventListener('click', function(e) {
            e.preventDefault();
            // Show loading spinner
            document.getElementById('loadingSpinner').style.display = 'flex';
            
            // Perform the logout action
            fetch('logout.php')
                .then(response => response.text())
                .then(data => {
                    // Redirect after logout
                    setTimeout(function() {
                        window.location.href = 'logout.php'; // Redirect to login page after logout
                    }, 500); // Adjust the delay as needed
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('loadingSpinner').style.display = 'none';
                });
        });
    });
    

    // Example of interactive feature: Changing header background on scroll
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
});
