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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userType = $_POST["user-type"];

    // Validate user credentials against the database
    $query = "SELECT * FROM users WHERE username = ? AND password = ? AND type = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $password, $userType);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION["username"] = $username;
        $_SESSION["user-type"] = $userType;

        if ($userType == "admin") {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: search.php");
            exit();
        }
    } else {
        $loginError = "Invalid username or password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flight Ticket Booking System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), url("img7.1.png");
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

        <!-- Login and Sign Up Form -->
        <h2 style="color:black">WELCOME TO FLIGHT TICKET BOOKING!!</h2>
        <form action="index.php" method="POST" class="login-form">
    <div class="container">
        <h1>Login</h1>
    </div>

    <div class="form-group">
        <label for="username"><b>Username:</b></label>
        <input type="text" id="username" name="username" required>
    </div>

    <div class="form-group">
        <label for="password"><b>Password:</b></label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="form-group">
        <label for="user-type"><b>Login as:</b></label>
        <select id="user-type" name="user-type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="container">
        <button type="submit" name="login-btn">Login</button>
    </div>
</form>



        <p style="color:black">Don't have an account? <a href="signup.php" style="color:black;">Sign Up</a></</p>

<?php if (isset($loginError)): ?>
    <p><?php echo $loginError; ?></p>
<?php endif; ?>

</div>
</body>
</html>
