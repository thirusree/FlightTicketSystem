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

$flightRemoved = false;
$removeFlightError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flightId = $_POST["flight_id"];

    // Delete the flight from the flights table
    $deleteQuery = "DELETE FROM flights WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $flightId);

    if ($deleteStmt->execute()) {
        $flightRemoved = true;
    } else {
        $removeFlightError = "Failed to remove the flight. Please try again.";
    }
}

// Fetch all flights from the database
$query = "SELECT * FROM flights";
$result = $conn->query($query);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flight Ticket Booking System - Remove Flights</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), url("img11.png");
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
        <h2>Remove Flights</h2>
        <?php if ($flightRemoved): ?>
            <p class="success" style="color:#1e549f"><b>Flight removed successfully!</p>
        <?php endif; ?>

        <table class="flight-table">
    <tr>
        <th>Flight Number</th>
        <th>Flight Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Seats Available</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["flight_number"]; ?></td>
            <td><?php echo $row["flight_name"]; ?></td>
            <td><?php echo $row["date"]; ?></td>
            <td><?php echo $row["time"]; ?></td>
            <td><?php echo $row["seats_available"]; ?></td>
            <td>
                <form action="removeflights.php" method="POST">
                    <input type="hidden" name="flight_id" value="<?php echo $row["id"]; ?>">
                    <button type="submit" name="remove-flight-btn">Remove</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>


        <?php if (!empty($removeFlightError)): ?>
            <p class="error"><?php echo $removeFlightError; ?></p>
        <?php endif; ?>
<br>
        <button onclick="window.location.href='admin.php'" style="color: skyblue;">Back to Admin Page</button>
    </div>
</body>
</html>
