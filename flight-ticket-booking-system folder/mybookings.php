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

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

// Get the username of the logged-in user
$username = $_SESSION["username"];

// Query bookings for the logged-in user
$query = "SELECT * FROM bookings WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings - Flight Ticket Booking System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), url("img14.jpg");
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
        <h1 style="color:black"><b>My Bookings</b></h1>

        <?php if ($result->num_rows > 0): ?>
            <table style="border-collapse: collapse; border: 1px solid black;">
    <tr>
        <th>Booking ID</th>
        <th>Flight Number</th>
        <th>Date</th>
        <th>Time</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td style="border: 1px solid black;"><?php echo $row["id"]; ?></td>
            <td style="border: 1px solid black;"><?php echo $row["flight_number"]; ?></td>
            <td style="border: 1px solid black;"><?php echo $row["date"]; ?></td>
            <td style="border: 1px solid black;"><?php echo $row["time"]; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>
        <p>
        <button type="button" onclick="goBack()" class="btn-pay">Back</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>

    <a href="payment.php" class="btn-pay">Make Payment</a>
</p>

   
    </div>
</body>
</html>

