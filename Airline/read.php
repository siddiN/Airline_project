<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            background: url(air1.jpeg) no-repeat center center fixed;
            background-size: cover;

            padding-top: 50px;
           
        }
        .container {
            margin-top: 50px;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        h2 {
            margin-bottom: 20px;
            color: #343a40;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .link-button {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .link-button:hover {
            text-decoration: underline;
        }
        .total-fare {
            font-size: 1.25rem;
            font-weight: bold;
            color: #28a745;
        }
        .footer-link {
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root"; // Your database username
        $password = ""; // Your database password
        $dbname = "airplane_booking";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to get the last submitted record
        $sql = "SELECT * FROM bookings ORDER BY id DESC LIMIT 1"; // Change here to get the last record
        $result = $conn->query($sql);

        // Check if we have a result
        if ($result->num_rows > 0) {
            // Output data of the last record
            $booking = $result->fetch_assoc();
            ?>

            <h2>Last Booking Submitted</h2>
            <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($booking['customer_name']); ?></p>
            <p><strong>Customer Email:</strong> <?php echo htmlspecialchars($booking['customer_email']); ?></p>
            <p><strong>Customer Phone:</strong> <?php echo htmlspecialchars($booking['customer_phone']); ?></p>
            <p><strong>Departure Location:</strong> <?php echo htmlspecialchars($booking['departure_location']); ?></p>
            <p><strong>Arrival Location:</strong> <?php echo htmlspecialchars($booking['arrival_location']); ?></p>
            <p><strong>Additional Options:</strong> <?php echo htmlspecialchars($booking['additional_options']); ?></p>
            <p><strong>Travel Class:</strong> <?php echo htmlspecialchars($booking['travel_class']); ?></p>
            <p class="total-fare"><strong>Total Fare:</strong> $<?php echo htmlspecialchars($booking['total_fare']); ?></p>

            <br>
            <a href="update.php?id=<?php echo $booking['id']; ?>" class="link-button">Update Booking</a> 
            <a href="delete.php?id=<?php echo $booking['id']; ?>" class="link-button">Delete Booking</a>

            <!-- Payment Button -->
            <br><br>
            <form action="payment.php" method="post">
                <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                <input type="hidden" name="total_fare" value="<?php echo $booking['total_fare']; ?>">
                <button type="submit" class="btn btn-custom">Proceed to Payment</button>
            </form>

            <?php
        } else {
            echo "<p>No bookings found!</p>";
        }

        $conn->close();
        ?>
        
        <a href="form.html" class="footer-link">Add New Booking</a>
    </div>
</div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
