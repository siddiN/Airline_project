<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f0f2f5;
            background: url(air1.jpeg) no-repeat center center fixed;
            background-size: cover;

            padding-top: 50px;
            
        }
        .container {
            margin-top: 50px;
        }
        .card {
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .form-check-label {
            margin-left: 10px;
        }
        h3 {
            margin-top: 20px;
            font-size: 1.25rem;
        }
        h2 {
            margin-bottom: 30px;
            color: #343a40;
        }
        a {
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center">Update Booking</h2>

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

        // Check if ID is set
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Fetch the booking to update
            $sql = "SELECT * FROM bookings WHERE id = $id";
            $result = $conn->query($sql);
            $booking = $result->fetch_assoc();
        } else {
            header('Location: read.php');
            exit;
        }
        ?>

        <form action="update_process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
            
            <div class="form-group">
                <label for="customerName">Full Name:</label>
                <input type="text" class="form-control" id="customerName" name="customerName" value="<?php echo $booking['customer_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="customerEmail">Email Address:</label>
                <input type="email" class="form-control" id="customerEmail" name="customerEmail" value="<?php echo $booking['customer_email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="customerPhone">Contact Number:</label>
                <input type="text" class="form-control" id="customerPhone" name="customerPhone" value="<?php echo $booking['customer_phone']; ?>" required>
            </div>

            <div class="form-group">
                <label for="departureLocation">Departure Location:</label>
                <input type="text" class="form-control" id="departureLocation" name="departureLocation" value="<?php echo $booking['departure_location']; ?>" required>
            </div>

            <div class="form-group">
                <label for="arrivalLocation">Arrival Location:</label>
                <input type="text" class="form-control" id="arrivalLocation" name="arrivalLocation" value="<?php echo $booking['arrival_location']; ?>" required>
            </div>

            <h3>Additional Options</h3>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="additionalOptions[]" value="10" <?php echo (strpos($booking['additional_options'], '10') !== false) ? 'checked' : ''; ?>>
                <label class="form-check-label">Extra Baggage ($10)</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="additionalOptions[]" value="20" <?php echo (strpos($booking['additional_options'], '20') !== false) ? 'checked' : ''; ?>>
                <label class="form-check-label">In-Flight Meal ($20)</label>
            </div>
            <!-- Add more options with Bootstrap styling as needed -->

            <h3>Select Travel Class</h3>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="travelClass" value="50" <?php echo ($booking['travel_class'] == '50') ? 'checked' : ''; ?>>
                <label class="form-check-label">Economy Class ($50)</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="travelClass" value="100" <?php echo ($booking['travel_class'] == '100') ? 'checked' : ''; ?>>
                <label class="form-check-label">Business Class ($100)</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="travelClass" value="200" <?php echo ($booking['travel_class'] == '200') ? 'checked' : ''; ?>>
                <label class="form-check-label">First Class ($200)</label>
            </div>

            <button type="submit" class="btn btn-custom btn-block mt-4">Update Booking</button>
        </form>

        <a href="read.php" class="btn btn-secondary btn-block">Back to Booking List</a>
    </div>
</div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
