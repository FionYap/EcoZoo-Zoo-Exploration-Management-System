<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zoo_management";

$error_message = "";
$success_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $u_email = $_POST['u_email'];
    $u_password = $_POST['u_password']; 
    $confirm_password = $_POST['confirm_password']; 

    // Validate input
    if ($u_password !== $confirm_password) { // check if passwords match
        $error_message = "Passwords do not match!";
    } else {
        // Check if email already exists
        $check_sql = "SELECT * FROM users WHERE u_email = ?"; // query to check if email exists
        $check_stmt = $conn->prepare($check_sql); 
        $check_stmt->bind_param("s", $u_email); 
        $check_stmt->execute(); 
        $check_result = $check_stmt->get_result(); 

        if ($check_result->num_rows > 0) { 
            $error_message = "Email already exists!"; 
        } else {
            // Insert new user
            $hashed_password = password_hash($u_password, PASSWORD_DEFAULT); // hash password
            $insert_sql = "INSERT INTO users (username, u_email, u_password) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("sss", $username, $u_email, $hashed_password);

            if ($insert_stmt->execute()) {
                $success_message = "Registration successful! You can now login."; 
            } else {
                $error_message = "Error: " . $insert_stmt->error;
            }

            $insert_stmt->close();
        }

        $check_stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 0.5rem;
            color: #4caf50;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #4caf50;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: #f44336;
            text-align: center;
            margin-bottom: 1rem;
        }
        .success {
            color: #4caf50;
            text-align: center;
            margin-bottom: 1rem;
        }
        .login-link {
            text-align: center;
            margin-top: 1rem;
        }
        .login-link a {
            color: #4caf50;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php 
        if (!empty($error_message)) { 
            echo "<p class='error'>$error_message</p>"; 
        }
        if (!empty($success_message)) { 
            echo "<p class='success'>$success_message</p>"; 
        }
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="u_email">Email:</label>
            <input type="email" id="u_email" name="u_email" required>
            
            <label for="u_password">Password:</label>
            <input type="password" id="u_password" name="u_password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <input type="submit" value="Register">
        </form>
        <p class="login-link">Already have an account? <a href="login.php">Login here</a></p> <!-- Login link -->
    </div>
</body>
</html>