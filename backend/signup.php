<!DOCTYPE html>
<html>
<head>
    <title>DonationHero</title>
    <link rel="stylesheet" href="/DonationHero/frontend/styles.css">
</head>
<body>
    <nav class="navbar">
        <a href="/DonationHero/frontend/index.html" class="logo">
            <img src="/DonationHero/frontend/photos/logo.jpeg" alt="Logo">
        </a>
        <ul class="nav-items">
            <li><a href="/DonationHero/frontend/index.html">Home</a></li>
            <li><a href="/DonationHero/frontend/about.html">About</a></li>
            <li><a href="/DonationHero/frontend/events.html">Events</a></li>
            <li><a href="/DonationHero/frontend/leaderboard.html">Leaderboard</a></li>
            <li><a href="/DonationHero/frontend/contact.html">Contact</a></li>
            <li><a href="/DonationHero/frontend/login.html">Login</a></li>
            <li><a href="/DonationHero/frontend/signup.html">Sign Up</a></li>
        </ul>
    </nav>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $number = $_POST["number"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if ($password != $confirm_password) {
            echo "<h2>Passwords do not match</h2>";
            exit;
        }

        $mysqli = new mysqli("localhost", "root", "", "signup");

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $stmt = $mysqli->prepare("INSERT INTO Users (firstname, lastname, email, number, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $number, $password);


        if ($stmt->execute()) {
            echo "<h2>Account creation successfully</h2>";
        } else {
            echo "<h2>Error: " . $stmt->error;
        }


        $stmt->close();
        $mysqli->close();
    }
    ?>
<footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="https://www.facebook.com/" target="_blank">Facebook </a></li>
                    <li><a href="https://www.twitter.com/" target="_blank">Twitter</a></li>
                    <li><a href="https://www.instagram.com/" target="_blank">Instagram</a></li>
                    <li><a href="https://www.linkedin.com/" target="_blank">LinkedIn</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="/DonationHero/frontend/about.html">About Us</a></li>
                    <li><a href="/DonationHero/frontend/contact.html">Contact Us</a></li>
                    <li><a href="/DonationHero/frontend/termshtml">Terms & Condition</a></li>
                    <li><a href="/DonationHero/frontend/faq.html">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <img src="/DonationHero/frontend/photos/logo.jpeg" alt="Logo">
            </div>
            <div class="footer-column">
                <h3>Newsletter</h3>
                <form>
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 DonationHero. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
