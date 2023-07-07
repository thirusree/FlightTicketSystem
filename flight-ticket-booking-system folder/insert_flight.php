<?php
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

// Prepare the insert query
$query = "INSERT INTO flights (flight_number, date, time, seats_available) VALUES (?, ?, ?, ?)";

// Sample flight details
$flightNumber = "ABC123";
$date = "2023-07-10";
$time = "10:00:00";
$seatsAvailable = 100;

// Prepare the statement
$stmt = $conn->prepare($query);
$stmt->bind_param("sssi", $flightNumber, $date, $time, $seatsAvailable);

// Execute the statement
$stmt->execute();

echo "Flight details inserted successfully.";

$stmt->close();
$conn->close();
?>
