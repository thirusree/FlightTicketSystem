<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; // 
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

// Handle flight search
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Query flights based on date and time
    $query = "SELECT * FROM flights WHERE date = ? AND time = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute();
    $result = $stmt->get_result();
    echo '<script>';
echo 'function bookFlight(flightId) {';
echo 'var xhr = new XMLHttpRequest();';
echo 'xhr.open("POST", "updatebooking.php", true);';
echo 'xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");';
echo 'xhr.onreadystatechange = function() {';
echo 'if (xhr.readyState === 4 && xhr.status === 200) {';
echo 'var button = document.getElementById("book-btn-" + flightId);';
echo 'button.innerHTML = "Booked";';
echo 'button.disabled = true;';
echo '}';
echo '};';
echo 'xhr.send("flight-id=" + flightId);';
echo '}';
echo '</script>';


    // Check if any flights are available
    if ($result->num_rows > 0) {
        // Flights are available, display them
        echo '<h1 style="text-align: center; margin-top: 0; position: absolute; top: 0; left: 50%; transform: translateX(-50%);">Available Flights</h1>';
    
        echo '<table style="border-collapse: collapse; border: 1px solid black;">';
        echo '<tr><th>Flight Number</th><th>Flight Name</th><th>Date</th><th>Time</th><th>Seats Available</th><th>Action</th></tr>';
    
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td style="border: 1px solid black;">' . $row["flight_number"] . '</td>';
            echo '<td style="border: 1px solid black;">' . $row["flight_name"] . '</td>';
            echo '<td style="border: 1px solid black;">' . $row["date"] . '</td>';
            echo '<td style="border: 1px solid black;">' . $row["time"] . '</td>';
            echo '<td style="border: 1px solid black;">' . $row["seats_available"] . '</td>';
            echo '<td style="border: 1px solid black;">';
    
            if ($row["seats_available"] > 0) {
                echo '<form action="search.php" method="POST">';
                echo '<input type="hidden" name="flight-id" value="' . $row["id"] . '">';
                echo '<button id="book-btn-' . $row["id"] . '" type="button" onclick="bookFlight(' . $row["id"] . ')">BOOK</button>';


                echo '</form>';
    
                if (isset($_POST["book-btn"]) && $_POST["flight-id"] == $row["id"]) {
                    // Update seats_available in the database and display success message
                    $updatedSeats = $row["seats_available"] - 1;
                    $updateQuery = "UPDATE flights SET seats_available = ? WHERE id = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param("ii", $updatedSeats, $row["id"]);
                    $updateStmt->execute();
    
                    echo '<p>Booked successfully!</p>';
                }
            } else {
                echo '<p>Not available</p>';
            }
    
            echo '</td>';
            echo '</tr>';
        }
    
        echo '</table>';
        
    } else {
        // No flights available
        echo "<p>No flights available at the specified date and time.</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Flight Ticket Booking System - Search Flights</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    body {
        background: linear-gradient(rgba(0,0, 0, 0.5), rgba(0, 0, 0, 0.3)), url("img6.1.png");
        background-repeat: no-repeat;
        background-size: cover;
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
    <h1 style="color:black"><b>Welcome <?php echo $_SESSION["username"]; ?>!</b></h1>

        <h2>Search Flights</h2>
        <form action="search.php" method="POST">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>
            <button type="submit" name="search-btn">Search</button>
            <button type="submit" name="booking-btn" onclick="window.location.href = 'mybookings.php';">My Bookings</button>
        </form>
        <form action="logout.php" method="POST">
            <button type="submit" name="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
<script>
    function bookFlight(flightId) {
        // Prompt the user to enter the number of seats
        var seats = prompt("Enter the number of seats:");
        if (seats === null || seats === "") {
            return; // Exit the function if the user cancels or leaves the input empty
        }

        // Make an AJAX request to update the seat count and display the booked status
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "updatebooking.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the button text and disable it
                var button = document.getElementById("book-btn-" + flightId);
                if (button) {
                    button.innerHTML = "Booked";
                    button.disabled = true;
                }
                // Display the alert message
                alert("Booking successful!");
            }
        };
        xhr.send("flight-id=" + flightId + "&seats=" + seats);
    }
</script>



