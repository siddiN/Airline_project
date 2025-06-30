<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
           
            background: url(air1.jpeg) no-repeat center center fixed;
            background-size: cover;

            padding-top: 50px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        h2, h3 {
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];
    $total_fare = $_POST['total_fare'];

    // Payment form processing
    if (isset($_POST['pay'])) {
        $card_name = $_POST['card_name'];
        $card_number = $_POST['card_number'];
        $exp_month = $_POST['exp_month'];
        $exp_year = $_POST['exp_year'];
        $cvv = $_POST['cvv'];
        $billing_address = $_POST['billing_address'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip_code'];
        $country = $_POST['country'];

        // Payment success message
        echo "<h2 class='text-success'>Payment for Booking ID: $booking_id</h2>";
        echo "<p>Total Fare Paid: $$total_fare</p>";
        echo "<p>Payment Method: Credit Card</p>";
        echo "<p>Cardholder Name: $card_name</p>";
        echo "<p>Billing Address: $billing_address, $city, $country</p>";
        echo "<p class='text-success'>Payment successful! Thank you for booking with us.</p>";

        // Update payment status in the database
        // $sql = "UPDATE bookings SET payment_status = 'Paid' WHERE id = $booking_id";
        // $conn->query($sql);
    } else {
        // Display the payment form
        ?>

        <h2>Payment for Booking ID: <?php echo $booking_id; ?></h2>
        <p>Total Fare to be Paid: $<?php echo $total_fare; ?></p>

        <form action="" method="post">
            <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
            <input type="hidden" name="total_fare" value="<?php echo $total_fare; ?>">
            
            <h3>Payment Details</h3>
            <div class="mb-3">
                <label for="card_name" class="form-label">Cardholder Name:</label>
                <input type="text" class="form-control" id="card_name" name="card_name" required>
            </div>

            <div class="mb-3">
                <label for="card_number" class="form-label">Card Number:</label>
                <input type="text" class="form-control" id="card_number" name="card_number" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exp_month" class="form-label">Expiration Month:</label>
                    <select class="form-control" id="exp_month" name="exp_month" required>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <!-- Add all months -->
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exp_year" class="form-label">Expiration Year:</label>
                    <select class="form-control" id="exp_year" name="exp_year" required>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <!-- Add more years -->
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="cvv" class="form-label">CVV:</label>
                <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>

            <h3>Billing Address</h3>
            <div class="mb-3">
                <label for="billing_address" class="form-label">Billing Address:</label>
                <input type="text" class="form-control" id="billing_address" name="billing_address" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>

            <div class="mb-3">
                <label for="zip_code" class="form-label">Zip Code:</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" required>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>

            <button type="submit" name="pay" class="btn btn-custom">Pay Now</button>
        </form>

        <?php
    }
}

$conn->close();
?>
</div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
