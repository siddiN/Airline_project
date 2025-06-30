<?php
// Start the session
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airplane_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = trim($_POST['password']); // Don't escape the password as it should not be stored in the DB.

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user's data
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variables for logged-in user
            $_SESSION['username'] = $row['username'];
            
            // Redirect to form.html
            header("Location: form.html");
            exit();
        } else {
            // Invalid password
            echo "Invalid username or password.";
        }
    } else {
        // No user found
        echo "Invalid username or password.";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
