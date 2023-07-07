<!DOCTYPE html>
<html>
<head>
    <title>Flight Ticket Booking System - Admin Page</title>
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
   
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), url("img11.png");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        
        h2 {
            text-align: center;
            color: #333;
            
        }
        
        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }
        
    
        li {
            margin-bottom: 10px;
        }
        
        li a {
            display: block;
            padding: 10px 20px;
           
            border-radius: 5px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        li a:hover {
            background-color: #ccc;
        }
        
        button {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #333;
           
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #555;
        }
  
    </style>
</head>
<body>
<div class="container">
        <!-- Navigation Bar -->
      
        <div class="navbar" style="background-color: #323643 !important;">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.html">Contact Us</a></li>
            </ul>
        </div>
    <div class="container">
        <h2>Welcome Admin!</h2>
        <ul>
            <li><a href="addflight.php">Add Flights</a></li>
            <li><a href="removeflights.php">Remove Flights</a></li>
            <li><a href="viewbookings.php">View Bookings</a></li>
        </ul>
        <form action="logout.php" method="POST">
        <button type="submit" name="logout-btn" style="display: block; margin: 0 auto;">Logout</button>

        </form>
    </div>
</body>
</html>
