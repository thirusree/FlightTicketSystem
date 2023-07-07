<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

// Get the flight ID from the URL parameter
if (!isset($_GET["flight-id"])) {
    header("Location: search.php");
    exit();
}

$flightId = $_GET["flight-id"];

// Retrieve the flight details from the database based on the flight ID
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

// Prepare and execute the query to retrieve flight details
$query = "SELECT * FROM flights WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $flightId);
$stmt->execute();
$result = $stmt->get_result();

// Check if the flight exists
if ($result->num_rows === 0) {
    header("Location: search.php");
    exit();
}

// Fetch the flight details
$flight = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flight Ticket Booking System - Booking Confirmation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Booking Confirmation</h2>
        <h3>Flight Details</h3>
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

        <h3>Passenger Information</h3>
        <form action="payment-processing.php" method="POST">
            <input type="hidden" name="flight-id" value="<?php echo $flightId; ?>">
            <input type="hidden" name="amount" value="100.00"> <!-- Modify the amount as needed -->

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>

            <button type="submit" name="confirm-btn">Confirm and Pay</button>
        </form>

        <p><a href="search.php">Back to Search</a></p>

        <form action="logout.php" method="POST">
            <button type="submit" name="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
