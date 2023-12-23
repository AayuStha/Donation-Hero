<!DOCTYPE html>
<html>
<head>
    <title>DonationHero - Submit Donation</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <nav class="navbar">
        <!-- Your navigation bar here -->
    </nav>

    <?php
    include 'config.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type1 = isset($_POST['type1']) ? 1 : 0;
        $type2 = isset($_POST['type2']) ? 1 : 0;
        $type3 = isset($_POST['type3']) ? 1 : 0;
        $type4 = isset($_POST['type4']) ? 1 : 0;
        $donation_amount = $_POST['donation-amount'];

        $points = 0;
        if ($type1) {
            $points += 10;
        }
        else if ($type2) {
            $points += 5;
        }
        else if ($type3) {
            $points += 3;
        }
        else if ($type4) {
            $points += 2;
        }
        else {
            $points += 0;
        }

        $mysqli = new mysqli($_servername, $_username, $_password, $_database);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $stmt = $mysqli->prepare("INSERT INTO donations (type1, type2, type3, type4, donation_amount) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiii", $type1, $type2, $type3, $type4, $donation_amount);

        if ($stmt->execute()) {
            echo "Thank you for donating!";
        } else {
            echo "There was a problem with your donation.";
        }

        $stmt->close();
        $mysqli->close();
    }
    ?>
</body>
</html>