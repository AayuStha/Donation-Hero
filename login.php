<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>