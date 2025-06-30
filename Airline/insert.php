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

// Get form data
$customerName = $_POST['customerName'];
$customerEmail = $_POST['customerEmail'];
$customerPhone = $_POST['customerPhone'];
$departureLocation = $_POST['departureLocation'];
$arrivalLocation = $_POST['arrivalLocation'];
$additionalOptions = isset($_POST['additionalOptions']) ? implode(", ", $_POST['additionalOptions']) : '';
$travelClass = $_POST['travelClass'];

// Calculate total fare
$totalFare = (int)$travelClass + array_sum(array_map('intval', explode(", ", $additionalOptions)));

// SQL to insert the booking
$sql = "INSERT INTO bookings (customer_name, customer_email, customer_phone, departure_location, arrival_location, additional_options, travel_class, total_fare) 
        VALUES ('$customerName', '$customerEmail', '$customerPhone', '$departureLocation', '$arrivalLocation', '$additionalOptions', '$travelClass', '$totalFare')";

if ($conn->query($sql) === TRUE) {
    echo "Booking created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
