<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zoo_management";

$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname); // create connection

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Common fields
    $email = $_POST['email']; // retrieve email from form
    $password_input = $_POST['password']; // retrieve password from form

    // Check if logging in as admin
    if (isset($_POST['admin'])) { // if the admin checkbox is checked
        // Admin Login
        $sql = "SELECT * FROM admin WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            if (password_verify($password_input, $admin['password'])) { // verify password
                $_SESSION['admin_id'] = $admin['admin_id']; // set session variable
                header('Location: ../dashboard/admin_dashboard.php'); // redirect to admin dashboard
                exit();
            }
        }
    } else {
        // User Login
        $sql = "SELECT * FROM users WHERE u_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password_input, $user['u_password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                header('Location: ../main/index.php'); // redirect to user dashboard
                exit();
            }
        }
    }

    // If we reach here, login failed
    $error_message = "Invalid credentials!"; // error message

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .register-link {
            text-align: center;
            margin-top: 1rem;
        }
        .register-link a {
            color: #4caf50;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .admin-checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        .admin-checkbox input {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (!empty($error_message)) { echo "<p class='error'>$error_message</p>"; } ?> 
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <!-- Form submission -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <div class="admin-checkbox">
                <input type="checkbox" id="admin" name="admin">
                <label for="admin">Login as Admin</label>
            </div>
            
            <input type="submit" value="Login">
        </form>
        <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p> <!-- Register link -->
    </div>
</body>
</html>