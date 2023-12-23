<!DOCTYPE html>
<html>
<head>
    <title>DonationHero - Submit Donation</title>
    <link rel="stylesheet" href="/styles.css">
    <style>
        h2{
            text-align: center;
            margin: 20px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>
<body>

    <?php
    // Database connection details
    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        $stmt = $conn->prepare("INSERT INTO donations (money , clothes, food, others, donation_amount, points) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiii", $money, $clothes, $food, $others, $donation_amount, $points);

        if ($stmt->execute()) {
            echo "<h2>Thank you for donating!</h2>";
        } else {
            echo "<h2>There was a problem with your donation.</h2>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>

</body>
</html>