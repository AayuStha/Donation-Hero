<!DOCTYPE html>
<html>
<head>
    <title>DonationHero - Submit Donation</title>
    <link rel="stylesheet" href="./styles.css">
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
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
// Database connection details
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donor_name = $_POST['donor-name'];
    $donor_email = $_POST['donor-email'];
    $money = isset($_POST['money']) ? 1 : 0;
    $clothes = isset($_POST['clothes']) ? 1 : 0;
    $food = isset($_POST['food']) ? 1 : 0;
    $others = isset($_POST['others']) ? 1 : 0;
    $donation_amount = $_POST['donation-amount'];

    $points = 0;
    if ($money) {
        $points = 10;
    } 
    elseif ($clothes) { 
        $points = 5;
    }
    elseif ($food) {
        $points = 3;
    }
    elseif ($others) {
        $points = 1;
    }
    else{

    }

    // Create connection
    $conn = new mysqli($_servername, $_username, $_password, $_database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if a record with the same email already exists
    $stmt = $conn->prepare("SELECT * FROM donations WHERE donor_email = ?");
    $stmt->bind_param("s", $donor_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If a record exists, update it
        $stmt = $conn->prepare("UPDATE donations SET donation_amount = donation_amount + ?, points = points + ? WHERE donor_email = ?");
        $stmt->bind_param("iis", $donation_amount, $points, $donor_email);
    } else {
        // If no record exists, insert a new one
        $stmt = $conn->prepare("INSERT INTO donations (donor_name, donor_email, money, clothes, food, others, donation_amount, points) VALUES (?, ?, ?, ?,?,?,?,?)");
        $stmt->bind_param("ssiiiiii", $donor_name, $donor_email, $money, $clothes, $food,$others,$donation_amount, $points);
    }

    if ($stmt->execute()) {
            echo "<p style='color: green; text-align:center; font-size: 80px; color: #f44336;margin: 100px; font-weight: bold;'>Thank you for donating!</p>";
        } else {
            echo "<p style='color: red; font-size: 20px; font-weight: bold;'>There was a problem with your donation.</p>";
        }

    $stmt->close();
    $conn->close();
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