<!DOCTYPE html>
<html>
<head>
    <title>DonationHero - Submit Donation</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>

    <?php
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
            $points += 10;
        } 
        elseif ($clothes) { 
            $points += 5;
        }
        elseif ($food) {
            $points += 3;
        }
        elseif ($others) {
            $points += 1;
        }
        else{}

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
            $stmt = $conn->prepare("INSERT INTO donations (donor_name, donor_email, donation_amount, points) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssii", $donor_name, $donor_email, $donation_amount, $points);
        }

        if ($stmt->execute()) {
            echo "<p style='color: green; font-size: 20px; font-weight: bold;'>Thank you for donating!</p>";
        } else {
            echo "<p style='color: red; font-size: 20px; font-weight: bold;'>There was a problem with your donation.</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>

</body>
</html>