<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; // Modify with your database password
$dbname = "flight_booking";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$username = "";
$email = "";
$signupError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate input
    if (empty($username) || empty($email) || empty($password)) {
        $signupError = "Please fill in all the fields.";
    } else {
        // Check if the username or email already exists in the database
        $query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($query);
        
        if (!$stmt) {
            $signupError = "Error preparing statement: " . $conn->error;
        } else {
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $signupError = "Username or email already exists. Please choose a different username or email.";
            } else {
                // Insert the new user into the database
                $insertQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($insertQuery);
                
                if (!$stmt) {
                    $signupError = "Error preparing statement: " . $conn->error;
                } else {
                    $stmt->bind_param("sss", $username, $email, $password);
                    
                    if ($stmt->execute()) {
                        // Redirect to login page
                        header("Location: login.php");
                        exit();
                    } else {
                        $signupError = "Error creating user. Please try again.";
                    }
                }
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flight Ticket Booking System - Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), url("img13.png");
        background-repeat: no-repeat;
        background-size: cover;
    }
    button {
        background-color: black;
        color: skyblue;
    }
    </style>
</head>
<body>
<div class="container">
        <!-- Navigation Bar -->
        <div class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.html">Contact Us</a></li>
            </ul>
        </div>
    <div class="container">
        <h2 style="color:black"><b>Sign Up</b></h2>
        <form action="signup.php" method="POST">
            <label for="username"><b>Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>

            <label for="email"><b>Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

            <label for="password"><b>Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="signup-btn">Sign Up</button>
        </form>

        <?php if (!empty($signupError)): ?>
            <p class="error"><?php echo $signupError; ?></p>
        <?php endif; ?>

        <p >Already have an account? <a href="login.php" style="color:black">Login</p>

