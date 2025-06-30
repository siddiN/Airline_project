<?php
// Database configuration
$servername = "localhost"; // Typically localhost
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "airplane_booking"; // Your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Collect and sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // Prepare the SQL query
    $sql = "INSERT INTO contact_form (name, email, phone, message) 
            VALUES ('$name', '$email', '$phone', '$message')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
