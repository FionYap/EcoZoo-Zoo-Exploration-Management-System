<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                            <a class="nav-link active" href="admin_dashboard.php">
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
                            <a class="nav-link" href="view_feedback.php">
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
                    <h1 class="h2">Admin Dashboard</h1>
                </div>

                <div id="content">
                    <!-- Dashboard content goes here -->
                    <h2>Welcome to the Admin Dashboard</h2>
                    <p>Use the navigation menu on the left to manage various aspects of the zoo management system.</p>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>