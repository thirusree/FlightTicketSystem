<!DOCTYPE html>
<html>
<head>
    <title>About Us - Flight Ticket Booking System</title>
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
    .image-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 20px;
    }
    .image-grid img {
        width: 100%;
        height: auto;
        opacity: 1;
        transition: opacity 0.3s ease-in-out;
    }
    .image-grid img:hover {
        opacity: 0.7;
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
        <h2>About Us</h2>
        <p><b>Welcome to Flight Ticket Booking System, your one-stop solution for booking flights conveniently. We aim to provide a seamless and user-friendly platform for users to book their desired flights with ease.</b></p>
        <p><b>At Flight Ticket Booking System, we understand the importance of efficient travel planning and strive to offer a wide range of flights from various airlines to cater to different travel needs. Whether you are traveling for business or leisure, our platform ensures a hassle-free booking experience.</b></p>
        <p><b>With our intuitive search feature, you can easily find flights based on your preferred dates, times, and destinations. We provide real-time information on flight availability and prices, allowing you to make informed decisions when booking your tickets.</b></p>
        <p><b>Our dedicated team is committed to providing excellent customer service and support throughout your booking journey. If you have any questions or need assistance, feel free to reach out to our friendly support team.</b></p>
        <p><b>Thank you for choosing Flight Ticket Booking System. We look forward to serving you and making your travel experience a memorable one.</b></p>
        
        <div class="image-grid">
    <img src="img9.jpeg" alt="Image 1" style="width: 300px; height: 200px;">
    <img src="img12.jpeg" alt="Image 2" style="width: 300px; height: 200px;">
    <img src="img6.jpeg" alt="Image 3" style="width: 300px; height: 200px;">
</div>

       
<!--<div style="text-align: center;">
         <img width="400" src="img3.jpeg">
      </div>-->



       
      <p><a href="index.php" class="btn-back">Back to Home</a></p>

    </div>
</body>
</html>
