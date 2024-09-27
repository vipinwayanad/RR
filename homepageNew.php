<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="aboutcompany.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="hero-section">
                <div class="hero-text">
                    <h1>Welcome to Our Platform</h1>
                    <p>Your one-stop solution for customers, shop owners, and admins.</p>
                    <a href="#services" class="cta-button">Get Started</a>
                </div>
            </div>
           
            <div class="auth-buttons">
                <a href="LoginPage.php" class="auth-button"><i class="fas fa-user"></i> Log In / Sign Up</a>
                <!-- Removed Log Out button -->
            </div>
        </div>
        <div class="dynamic-box">
            <nav class="sticky-nav">
                <ul>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#photos">Photos</a></li>
                    <li><a href="#business-ideas">Business Ideas</a></li>
                    <li><a href="#management-overview">Management Overview</a></li>
                    <li><a href="#video">Video</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    

    <main>
        <section id="services" class="section">
            <h2>Our Services</h2>
            <div class="service-card" data-aos="fade-up">
                <h3>For Customers</h3>
                <p>Find the best rates for your daily purchases with ease.</p>
            </div>
            <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <h3>For Shop Owners</h3>
                <p>Sell your products and reach a larger audience.</p>
            </div>
            <div class="service-card" data-aos="fade-up" data-aos-delay="400">
                <h3>For Admins</h3>
                <p>Monitor and manage all activities effectively.</p>
            </div>
        </section>

        <section id="photos" class="section">
            <h2>Gallery</h2>
            <div class="gallery">
                <img src="homepage1.jpg" alt="Photo 1" data-aos="zoom-in">
                <img src="homepage2.jpg" alt="Photo 2" data-aos="zoom-in" data-aos-delay="200">
                <img src="homepage3.jpg" alt="Photo 3" data-aos="zoom-in" data-aos-delay="400">
                <img src="homepage3.jpg" alt="Photo 3" data-aos="zoom-in" data-aos-delay="400">
            </div>
        </section>

        <section id="business-ideas" class="section">
            <h2>Business Ideas</h2>
            <p>Explore innovative ideas to improve your business operations and strategies.</p>
        </section>

        <section id="management-overview" class="section">
            <h2>Management Overview</h2>
            <div class="management-images" data-aos="fade-left">
                <div class="management-image">
                    <img src="Anandhu.jpg" alt="Management 1">
                    <p>Anandhu T R - CEO: 10 years in business management, expert in strategic planning.</p>
                </div>
                <div class="management-image">
                    <img src="vipin.png" alt="Management 2">
                    <p>Vipindas - COO: 8 years in operations, skilled in process optimization.</p>
                </div>
            </div>
        </section>

        <section id="video" class="section">
            <h2>Company</h2>
            <div class="video-container">
                <iframe src="buildingvideo.mp4" frameborder="0" allowfullscreen></iframe>
            </div>
        </section>
    </main>
    
    <footer>
        <div class="footer-content">
            <div class="footer-column awards">
                <h2>Awards & Recognitions</h2>
                <ul>
                    <li>Best Business Platform 2023 - Business Awards</li>
                    <li>Top Innovator - Tech Innovations</li>
                    <li>Excellence in Customer Service - Service Excellence Awards</li>
                </ul>
            </div>
            
            <div class="footer-column about-us">
                <h2>About Us</h2>
                <p>We are a leading platform offering comprehensive solutions for customers, shop owners, and admins. Our mission is to deliver exceptional service and innovative solutions to help our clients succeed.</p>
            </div>
            
            <div class="footer-column contact-social">
                <div class="contact-info">
                    <h2>Contact Us</h2>
                    <p>Email: <a href="mailto:info@yourcompany.com">info@yourcompany.com</a></p>
                    <p>Phone: +1-800-123-4567</p>
                    <p>Address: 123 Business Rd, City, Country</p>
                </div>
            </div>    
                <div class="social-media">
                    <h2>Follow Us</h2>
                    <a href="https://www.facebook.com/yourcompany" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/yourcompany" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/company/yourcompany" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.instagram.com/yourcompany" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
                
                <div class="newsletter">
                    <h2>Stay Updated</h2>
                    <form action="#" method="post">
                        <input type="email" placeholder="Your email address" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            
        </div>
        <div class="footer-extra">
            <p>"Innovating for a Better Tomorrow"</p>
            <p>For more information, visit our <a href="/terms">Terms of Service</a> and <a href="/privacy">Privacy Policy</a>.</p>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </div>
    </footer>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
     <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="homepage.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>