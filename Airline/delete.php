<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            background: url(air1.jpeg) no-repeat center center fixed;
            background-size: cover;
          
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
            background-color: #dc3545;
            color: white;
        }
        .btn-custom:hover {
            background-color: #c82333;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Delete Booking</h2>
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
            $id = intval($_GET['id']); // Make sure the ID is an integer

            // SQL to delete the booking
            $sql = "DELETE FROM bookings WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Booking deleted successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">ID not set!</div>';
        }

        $conn->close();
        ?>
        
        <a href="read.php" class="btn btn-custom">Back to Booking List</a>
    </div>
</div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
