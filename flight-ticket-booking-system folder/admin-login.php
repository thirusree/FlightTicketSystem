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

$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate user credentials against the database
    $query = "SELECT * FROM users WHERE username = ? AND password = ? AND type = 'admin'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION["username"] = $username;
        $_SESSION["type"] = "admin";
        header("Location: admin.php");
        exit();
    } else {
        $loginError = "Invalid username or password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flight Ticket Booking System - Admin Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form action="admin-login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login-btn">Login</button>
        </form>

        <?php if (!empty($loginError)): ?>
            <p class="error"><?php echo $loginError; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
