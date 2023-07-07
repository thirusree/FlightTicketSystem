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
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

// Get the flight ID and selected number of seats from the AJAX request
$flightId = $_POST["flight-id"];
$seats = $_POST["seats"];

// Update the seat count for the selected flight
$updateQuery = "UPDATE flights SET seats_available = seats_available - ? WHERE id = ?";
$updateStmt = $conn->prepare($updateQuery);
$updateStmt->bind_param("ii", $seats, $flightId);
$updateStmt->execute();

$conn->close();
?>
