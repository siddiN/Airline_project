CREATE airplane_booking;
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(15) NOT NULL,
    departure_location VARCHAR(100) NOT NULL,
    arrival_location VARCHAR(100) NOT NULL,
    additional_options TEXT,
    travel_class VARCHAR(50) NOT NULL,
    total_fare DECIMAL(10, 2) NOT NULL
);
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each user
    username VARCHAR(50) NOT NULL,      -- Username with a maximum length of 50 characters
    email VARCHAR(100) NOT NULL UNIQUE,  -- Email address with a maximum length of 100 characters (must be unique)
    password VARCHAR(255) NOT NULL,      -- Hashed password with a maximum length of 255 characters
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp for when the record was created
);
CREATE TABLE IF NOT EXISTS contact_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
