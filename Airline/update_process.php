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

// Get updated form data
$id = $_POST['id'];
$customerName = $_POST['customerName'];
$customerEmail = $_POST['customerEmail'];
$customerPhone = $_POST['customerPhone'];
$departureLocation = $_POST['departureLocation'];
$arrivalLocation = $_POST['arrivalLocation'];
$additionalOptions = isset($_POST['additionalOptions']) ? implode(", ", $_POST['additionalOptions']) : '';
$travelClass = $_POST['travelClass'];

// Calculate total fare
$totalFare = (int)$travelClass + array_sum(array_map('intval', explode(", ", $additionalOptions)));

// SQL to update the booking
$sql = "UPDATE bookings SET customer_name='$customerName', customer_email='$customerEmail', customer_phone='$customerPhone', departure_location='$departureLocation', arrival_location='$arrivalLocation', additional_options='$additionalOptions', travel_class='$travelClass', total_fare='$totalFare' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Booking updated successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<a href="read.php">Back to Booking List</a>
