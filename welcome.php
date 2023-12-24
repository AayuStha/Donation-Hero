<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Donation Site</title>
    <link rel="stylesheet" href="./styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .welcome-section {
            padding: 30px;
            text-align: center;
            background-color: #e0e0e0;
            color: #333;
            border-radius: 8px;
            margin-top: 50px;
        }

        .welcome-section h1 {
            font-size: 2.5em;
        }

        .welcome-section p {
            font-size: 1.2em;
        }

        .donate-button {
            display: inline-block;
            color: #fff;
            background-color: #333;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .donate-button:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
<nav class="navbar">
        <a href="./index.html" class="logo">
            <img src="./photos/logo.jpeg" alt="Logo">
        </a>
        <ul class="nav-items">
            <li><a href="./index.html">Home</a></li>
            <li><a href="./leaderboard.php">Leaderboard</a></li>
            <li><a href="./about.html">About</a></li>
            <li><a href="./events.html">Events</a></li>
            <li><a href="./contact.html">Contact</a></li>
            <li><a href="./login.html">Login</a></li>
            <li><a href="./signup.html">Sign Up</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="welcome-section">
            <h1>Welcome to Our Donation Site</h1>
            <p>Your contributions can make a difference. Start donating today!</p>
            <a href="./events.html" class="donate-button">Donate Now</a>
        </div>
    </div>
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
                    <li><a href="./about.html">About Us</a></li>
                    <li><a href="./contact.html">Contact Us</a></li>
                    <li><a href="./terms.html">Terms & Condition</a></li>
                    <li><a href="./privacy.html">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <img src="./photos/logo.jpeg" alt="Logo">
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