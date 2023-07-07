<!DOCTYPE html>
<html>
<head>
    <title>Payment - Flight Ticket Booking System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), url("img15.1.jpg");
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
            <h1 style="color:black"><b>Payment</b></h1>
            <p><b>Enter your payment details:</b></p>
            <form action="process_payment.php" method="POST">
                <label for="card-number" style="color:black"><b>Card Number:</b></label>
                <input type="text" id="card-number" name="card-number" required><br><br>
                <label for="expiry-date"><b>Expiry Date:</b></label>
                <input type="text" id="expiry-date" name="expiry-date" required><br><br>
                <label for="cvv"><b>CVV:</b></label>
                <input type="text" id="cvv" name="cvv" required><br><br>
                <button type="submit" name="payment-btn">Make Payment</button>
                <a href="index.php" class="btn-back">Back to Home</a>
            </form>
        </div>
    </div>
</body>
</html>
