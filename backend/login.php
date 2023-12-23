<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
        
            $mysqli = new mysqli("localhost", "root", "", "signup");
        
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }
        
            $stmt = $mysqli->prepare("SELECT * FROM Users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
        
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
        
            if ($user && password_verify($password, $user['password'])) {
                // Password is correct, so start a new session
                session_start();
                
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user["id"];
                $_SESSION["email"] = $email;                            
                
                // Redirect user to welcome page
                header("location: welcome.php");
            } else {
                // Display an error message if password is not valid
                echo "The password you entered was not valid.";
            }
        
            $stmt->close();
            $mysqli->close();
        } 
        ?>
</body>
</html>