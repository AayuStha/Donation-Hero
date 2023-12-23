<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav class="navbar">
        <a href="/index.html" class="logo">
            <img src="/photos/logo.jpeg" alt="Logo">
        </a>
        <ul class="nav-items">
            <li><a href="/index.html">Home</a></li>
            <li><a href="https://localhost/donationhero/leaderboard.php">Leaderboard</a></li>
            <li><a href="/about.html">About</a></li>
            <li><a href="/events.html">Events</a></li>
            <li><a href="/contact.html">Contact</a></li>
            <li><a href="/login.html">Login</a></li>
            <li><a href="/signup.html">Sign Up</a></li>
        </ul>
    </nav>
    <?php
    include 'config.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $email = $_POST["email"];
            $password = $_POST["password"];
        
            $mysqli = new mysqli($_servername, $_username, $_password, $_database);
        
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }
        
            $stmt = $mysqli->prepare("SELECT id,password FROM Users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $num_rows = $stmt->num_rows;

            if ($num_rows > 0) {

                $stmt->bind_result($id,$hashed_password_from_database);
                $stmt->fetch();
        
                if (password_verify($password, $hashed_password_from_database)) {

                    // Password is correct, so start a new session
                    // $result = $stmt->get_result();
                    // $user = $result->fetch_assoc();
                    session_start();
                    
                    // // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["user"] = $id;                         
                    
                    // Redirect user to welcome page
                    header("location: welcome.php");
                } else {
                    // Display an error message if password is not valid
                    echo "Invalid username and password combination.";
                }

            }
            else {
                // Display an error message if password is not valid
                echo "Invalid username and password combination.";
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
                    <li><a href="/about.html">About Us</a></li>
                    <li><a href="/contact.html">Contact Us</a></li>
                    <li><a href="/terms.html">Terms & Condition</a></li>
                    <li><a href="/privacy.html">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <img src="/photos/logo.jpeg" alt="Logo">
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