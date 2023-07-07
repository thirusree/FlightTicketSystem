<?php
session_start();

// Check if the user is logged in and is an admin


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

// Fetch all bookings from the database
$query = "SELECT * FROM bookings";
$result = $conn->query($query);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flight Ticket Booking System - View Bookings</title>
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Bookings</h2>

        <table>
            <tr>
                <th>Booking ID</th>
                <th>Flight Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>User</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["flight_number"]; ?></td>
                    <td><?php echo $row["date"]; ?></td>
                    <td><?php echo $row["time"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <button onclick="window.location.href='admin.php'" style="color: skyblue;">Back to Admin Page</button>
    </div>
</body>
</html>
