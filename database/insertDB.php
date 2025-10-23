<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zoo_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert Admin
$sql = "INSERT INTO Admin (email, password) VALUES 
('admin@ecozoo.com', '".password_hash('admin123', PASSWORD_DEFAULT)."')";
$conn->query($sql);

// Insert Users
$sql = "INSERT INTO Users (username, u_email, u_password) VALUES 
('fion', 'fion@raffles.com', '".password_hash('fion', PASSWORD_DEFAULT)."'),
('eric', 'eric@email.com', '".password_hash('123', PASSWORD_DEFAULT)."')";
$conn->query($sql);

// Insert Events
$sql = "INSERT INTO Events (title, description, event_date, image_url) VALUES 
('Junior Zookeeper Experience', 'A special one-day program where kids can become “junior zookeepers” and help feed animals, clean enclosures (safely), and learn about animal care.', '2025-04-20', 'https://static.vinwonders.com/production/vinpearl-safari-phu-quoc-12.jpg'),
('Bird Watching Festival', 'Focused on our bird exhibits, this event includes guided bird-watching tours, educational sessions on bird species, and a special aviary show.', '2025-06-18', 'https://wtop.com/wp-content/uploads/2019/09/birds-in-flight-2.jpg'),
('Zoo Night Safari', 'Experience the zoo after dark with guided night tours, light displays, and animal behavior sessions showing how wildlife behaves at night, ending with a festive Halloween-themed show.', '2025-10-31', 'https://livingnomads.com/wp-content/uploads/2018/01/01/night-safari-singapore-review-singapore-night-safari-tips-night-safari-singapore-itinerary-3.jpg')";
$conn->query($sql);

// Insert Tickets
$sql = "INSERT INTO Tickets (user_id, ticket_type, price, purchase_date, t_name, t_email, quantity) VALUES 
(1, 'Single-Day Pass', 80.00, '2025-03-01', 'fion', 'fion@raffles.com', 2),
(2, 'Family Pass', 240.00, '2025-03-10', 'eric', 'eric@email.com', 4),
(1, 'Annual Membership', 260.00, '2025-03-15', 'fion', 'fion@raffles.com', 1)";
$conn->query($sql);

// Insert Feedback
$sql = "INSERT INTO Feedback (user_id, name, f_email, subject, message) VALUES 
(1, 'fion', 'fion@raffles.com', 'Great Experience', 'I had an amazing time at the zoo. The staff was friendly and the animals looked well cared for.'),
(2, 'eric', 'eric@email.com', 'Suggestion for Improvement', 'While I enjoyed my visit, I think it would be great to have more interactive exhibits for children.')";
$conn->query($sql);

echo "Sample data inserted successfully.";

$conn->close();
?>
