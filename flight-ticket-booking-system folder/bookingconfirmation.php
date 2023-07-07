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

// Get the flight details
$flightId = $_POST["flight-id"];

$selectQuery = "SELECT * FROM flights WHERE id = ?";
$selectStmt = $conn->prepare($selectQuery);
$selectStmt->bind_param("i", $flightId);
$selectStmt->execute();
$result = $selectStmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $seatsAvailable = $row["seats_available"];

   // Get the flight ID and username from the form submission
$flightId = $_POST["flight-id"];
$username = $_SESSION["username"];

// Update the seat availability in the database
$updateQuery = "UPDATE flights SET seats_available = seats_available - 1 WHERE id = ?";
$updateStmt = $conn->prepare($updateQuery);
$updateStmt->bind_param("i", $flightId);
$updateStmt->execute();

// Insert the booking into the bookings table
$insertQuery = "INSERT INTO bookings (flight_number, date, time, username) SELECT flight_number, date, time, ? FROM flights WHERE id = ?";
$insertStmt = $conn->prepare($insertQuery);
$insertStmt->bind_param("si", $username, $flightId);
$insertStmt->execute();
 else {
        echo '<p>Seats not available for this flight.</p>';
    }
} else {
    echo '<p>Invalid flight ID.</p>';
}

// Close the database connection
$conn->close();
 else {
echo '<p>Flight ID not provided.</p>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flight Ticket Booking System - Booking Confirmation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), url("img6.1.png");
     
      background-repeat: no-repeat;
      background-size: cover;
     
    }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="color:black"><b>Booking Confirmation</b></h2>
        <p><strong>Flight Details:</strong></p>
        <table>
            <tr>
                <th>Flight Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Seats Available</th>
            </tr>
            <tr>
                <td><?php echo $flight["flight_number"]; ?></td>
                <td><?php echo $flight["date"]; ?></td>
                <td><?php echo $flight["time"]; ?></td>
                <td><?php echo $flight["seats_available"]; ?></td>
            </tr>
        </table>
        <h3 style="color:black"><b>Payment Form</b></h3>
        <form action="payment.php" method="POST">
            <input type="hidden" name="flight-id" value="<?php echo $flightId; ?>">
            <label for="card-number"><b>Card Number:</b></label>
            <input type="text" id="card-number" name="card-number" required>

            <label for="card-holder"><b>Card Holder:</b></label>
            <input type="text" id="card-holder" name="card-holder" required>

            <label for="expiry-date"><b>Expiry Date:</b></label>
            <input type="text" id="expiry-date" name="expiry-date" required>

            <label for="cvv"><b>CVV:</b></label>
            <input type="text" id="cvv" name="cvv" required>

            <button type="submit" name="pay-btn">Pay</button>
        </form>
        <p><a href="search.php" class="btn-back">Back to Search</a></p>
    </div>
</body>
</html>
<?php

