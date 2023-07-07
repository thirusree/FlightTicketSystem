<?php
session_start();
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "flight_booking";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$flightAdded = false;
$addFlightError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flightNumber = $_POST["flight_number"];
    $flightName = $_POST["flight_name"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $seatsAvailable = $_POST["seats_available"];

   
    $query = "INSERT INTO flights (flight_number, flight_name, date, time, seats_available) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $flightNumber, $flightName, $date, $time, $seatsAvailable);

    if ($stmt->execute()) {
        $flightAdded = true;
    } else {
        $addFlightError = "Failed to add the flight. Please try again.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flight Ticket Booking System - Add Flights</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), url("img16.png");
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
        <h1 style="color:black">Add Flights</h1>
        <?php if ($flightAdded): ?>
            <p class="success" style="color:#1e549f">Flight added successfully!</p>
        <?php endif; ?>

        <form action="addflight.php" method="POST">
            <label for="flight_number">Flight Number:</label>
            <input type="text" id="flight_number" name="flight_number" required>

            <label for="flight_name">Flight Name:</label>
            <input type="text" id="flight_name" name="flight_name" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>

            <label for="seats_available">Seats Available:</label>
            <input type="number" id="seats_available" name="seats_available" required><br><br>

            <button type="submit" name="add-flight-btn">Add Flight</button>
        </form>

        <?php if (!empty($addFlightError)): ?>
            <p class="error"><?php echo $addFlightError; ?></p>
        <?php endif; ?>

        <button onclick="window.location.href='admin.php'" style="color: skyblue;">Back to Admin Page</button>

    </div>
</body>
</html>
