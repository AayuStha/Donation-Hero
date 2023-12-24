<!DOCTYPE html>
<html>
<head>
    <title>DonationHero</title>
    <link rel="stylesheet" href="./styles.css">
    <style>
        h2{
            text-align: center;
            margin: 20px;
            font-size: 40px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        table {
            width: 100%;
            margin: 70px;
            border-collapse: separate;
            border-spacing: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 0 auto;
            max-width: 800px;
            border: 1px solid #000;
        }

        th {
            padding: 15px;
            text-align: center;
            border: 1px solid #000;
            background-color: #4CAF50;
            color: white;
        }

        td {
            padding: 15px;
            text-align: center;
            border: 1px solid #000;
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
    
    <h2>Leaderboard</h2>
    <table>
    <tr>
        <th>Rank</th>
        <th>User Name</th>
        <th>Points</th>
    </tr>
        <?php
        // Database connection details
        include 'config.php';

        // Create connection
        $conn = new mysqli($_servername, $_username, $_password, $_database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Select users and their points from the leaderboard table
        $result = $conn->query("SELECT donor_name, points FROM donations ORDER BY points DESC");

        // Display the results in a table
        $rank = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $rank++ . "</td><td>" . $row['donor_name'] . "</td><td>" . $row['points'] . "</td></tr>";
    }

        $conn->close();
        ?>
    </table>
    
    <br>
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