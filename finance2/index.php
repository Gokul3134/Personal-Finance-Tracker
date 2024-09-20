<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Landing Page</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="left-side">
            <img src="img/logo1.png" alt="Logo" class="logo" height="60px" width="60px">
            <h1> Finance Tracker</h1>
        </div>
        <div class="middle">
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
        <div class="right-side">
            <a href="login.php" class="login-link">Login</a>
        </div>
    </header>

    <!-- Image Slider Section -->
    <div class="slider">
            <img class="slides" src="img/slide1.jpg" alt="Slide 1">
            <img class="slides" src="img/slide2.jpg" alt="Slide 2">
            <img class="slides" src="img/slide3.jpg" alt="Slide 3">
            <div class="overlay-text">
                <h2>Welcome to Our Finance Tracker</h2>
                <p>Join us for the best services in the market</p>
                <a href="login.php" class="login-btn">Login</a>
            </div>
    </div>

    <!-- About Us Section -->
    <section id="about" class="about-section">
        <div class="about-left">
            <h2>About Us</h2>
            <p>Our Finance Tracker is an essential tool for managing personal finances efficiently. It allows users to monitor income, categorize expenses, and create customized budgets. With features like financial goal setting and monthly reports, it helps users track their progress toward savings and investment objectives. By providing insights into spending patterns and financial health, the tracker aids in making informed decisions and adjusting financial plans as needed. Whether saving for a major purchase or managing day-to-day expenses, it simplifies financial management and promotes better financial habits.</p>
            <a href="#about" class="login-btn">View More</a>
        </div>
        <div class="about-right">
            <img src="img/slide4.jpg" alt="About Us">
        </div>
    </section>

    <!-- Services Section -->
    <h2 style="text-align: center;" id="services">Services</h2>
    <section  class="services-section">
    <!-- <h2>Service</h2> -->
        <div class="service-card">
            <img src="img/expense.jpg" alt="Service 1">
            <h3>Expense Categorization</h3>
            <p>Easily organize and track your spending by grouping expenses into categories like groceries, entertainment, and utilities to better understand and manage your finances.</p>
            <a href="dashboard.php" class="click-here">Click Here</a>
        </div>
        <div class="service-card">
            <img src="img/budget.jpg" alt="Service 2">
            <h3>Budget Planning</h3>
            <p>Create personalized monthly budgets to allocate your income toward expenses, savings, and investments, helping you manage your finances effectively and avoid overspending.</p>
            <a href="set_budget.php" class="click-here">Click Here</a>
        </div>
        <div class="service-card">
            <img src="img/report.jpg" alt="Service 3">
            <h3>Monthly Reports</h3>
            <p>Generate detailed monthly reports that summarize your income, expenses, and savings, allowing you to analyze spending patterns and make informed financial decisions for the future.</p>
            <a href="dashboard.php" class="click-here">Click Here</a>
        </div>
        <div class="service-card">
            <img src="img/goals.jpg" alt="Service 3">
            <h3>Financial Goal Setting</h3>
            <p>Set clear financial goals, such as saving for a purchase or paying off debt. Track progress, adjust plans, and stay motivated to achieve short- and long-term financial objectives.</p>
            <a href="dashboard.php" class="click-here">Click Here</a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="contact-left">
        <h2>Contact Us</h2>
        <!-- <hr class="new3"> -->
            <form id="contactForm" action="contact.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="contact-right">
            <h3>Office Address:</h3>
            <hr>
            <p>ANO 717, Astra Towers, Action Area IIC, <br>Newtown, New Town, West Bengal 700135</p>
            <h3>Contact Info:</h3>
            <hr>
            <!-- <h5>Call Us:</h5> -->
            <p>+91 9648571234</p>
            <!-- <h5>E-mail Us:</h5> -->
            <p>finance.tracker@gmail.com</p>
            <h3>Office Location:</h3>
            <hr>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1094.923259271096!2d88.46469283000823!3d22.621397370167617!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89f308e3e063d%3A0x4cb8ec196b283f75!2sAstra%20Tower!5e0!3m2!1sen!2sin!4v1722242783399!5m2!1sen!2sin" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
        </div>
    </section>

<footer>
    <div class="foot">
        <div class="address">
                <h3>Quick Access:</h3>
                <a href="#home">Home</a> <br>
                <a href="#about">About</a> <br>
                <a href="#services">Services</a> <br>
                <a href="#contact">Contact</a>
            </div>
            <div class="contact_info">
                <h3>Contact Info:</h3>
                <h5>Call Us:</h5>
                <p>+91 9648571234</p>
                <p>+91 9875642317</p>
                <h5>E-mail Us:</h5>
                <p>finance.tracker@gmail.com</p>
                <p>contact@gmail.com</p>
            </div>
            <div class="follow">
                <h3>Follow Us:</h3>
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-linkedin"></a> <br>
                <a href="#" class="fa fa-youtube"></a>
                <a href="#" class="fa fa-instagram"></a>
                <p>© 'Finance Tracker', 2024. All Rights Reserved.</p>
            </div>
    </div>
</footer>


    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.querySelectorAll('.slides');
            slides.forEach((slide) => slide.style.display = 'none');
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}
            slides[slideIndex-1].style.display = 'block';
            setTimeout(showSlides, 3000); // Change slide every 3 seconds
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- <script src="script.js"></script> -->

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Perform form validation and submission using AJAX (if needed)
            var form = event.target;
            var formData = new FormData(form);

            // Example AJAX request (replace with your actual AJAX call)
            fetch(form.action, {
                method: form.method,
                body: formData
            }).then(response => response.json())
            .then(data => {
                // Assuming the server returns a success message in JSON format
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Your message has been sent successfully!',
                    });
                    form.reset(); // Reset the form after successful submission
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error sending your message. Please try again later.',
                    });
                }
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error sending your message. Please try again later.',
                });
            });
        });
    </script>
</body>
</html>
