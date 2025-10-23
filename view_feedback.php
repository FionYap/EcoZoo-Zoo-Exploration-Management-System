<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login/login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zoo_management";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch feedback from the database
$sql = "SELECT f.*, u.username FROM Feedback f LEFT JOIN Users u ON f.user_id = u.user_id ORDER BY f.feedback_id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --main-bg-color: #e9f7ef;
            --sidebar-bg-color: #27ae60;
            --sidebar-hover-color: #2ecc71;
            --text-color: #ffffff;
        }
        body {
            background-color: var(--main-bg-color);
        }
        #sidebar {
            height: 100vh;
            background-color: var(--sidebar-bg-color);
            color: var(--text-color);
        }
        #sidebar .nav-link {
            color: var(--text-color);
        }
        #sidebar .nav-link:hover {
            background-color: var(--sidebar-hover-color);
        }
        #content {
            padding: 20px;
        }
        .active {
            background-color: var(--sidebar-hover-color);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_dashboard.php">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_users.php">
                                Manage Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_events.php">
                                Manage Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_tickets.php">
                                Manage Tickets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="view_feedback.php">
                                View Feedback
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/login.php">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">View Feedback</h1>
                </div>

                <div id="content">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Submitted By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) { // check if there are any feedback
                                while($row = $result->fetch_assoc()) { // loop through each feedback
                                    echo "<tr>";
                                    echo "<td>" . $row["feedback_id"] . "</td>";
                                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["f_email"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["subject"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["message"]) . "</td>";
                                    echo "<td>" . (isset($row["username"]) ? htmlspecialchars($row["username"]) : "Guest") . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No feedback found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
