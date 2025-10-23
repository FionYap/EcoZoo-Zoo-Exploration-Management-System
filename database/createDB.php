<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Database
$sql = "CREATE DATABASE IF NOT EXISTS zoo_management";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully.<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Use the database
$conn->select_db("zoo_management");

// Create Admin Table
$sql = "CREATE TABLE IF NOT EXISTS Admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Admin table created successfully.<br>";
} else {
    echo "Error creating Admin table: " . $conn->error;
}

// Create Users Table
$sql = "CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    u_email VARCHAR(100) NOT NULL,
    u_password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Users table created successfully.<br>";
} else {
    echo "Error creating Users table: " . $conn->error;
}

// Create Events Table
$sql = "CREATE TABLE IF NOT EXISTS Events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    event_date DATE,
    image_url VARCHAR(255)
)";
if ($conn->query($sql) === TRUE) {
    echo "Events table created successfully.<br>";
} else {
    echo "Error creating Events table: " . $conn->error;
}

// Create Feedback Table
$sql = "CREATE TABLE IF NOT EXISTS Feedback (
    feedback_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100),
    f_email VARCHAR(100),
    subject VARCHAR(200),
    message TEXT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
)";
if ($conn->query($sql) === TRUE) {
    echo "Feedback table created successfully.<br>";
} else {
    echo "Error creating Feedback table: " . $conn->error;
}

// Create Tickets Table
$sql = "CREATE TABLE IF NOT EXISTS Tickets (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    ticket_type VARCHAR(100),
    price FLOAT,
    purchase_date DATE,
    t_name VARCHAR(100),
    t_email VARCHAR(100),
    quantity INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
)";
if ($conn->query($sql) === TRUE) {
    echo "Tickets table created successfully.<br>";
} else {
    echo "Error creating Tickets table: " . $conn->error;
}

$conn->close();
?>
