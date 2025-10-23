<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login/login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zoo_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) { // add new user
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO Users (username, u_email, u_password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $message = "User added successfully.";
        } else {
            $message = "Error adding user: " . $conn->error;
        }
        $stmt->close();
    } elseif (isset($_POST['update'])) { // update user
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("UPDATE Users SET username = ?, u_email = ? WHERE user_id = ?");
        $stmt->bind_param("ssi", $username, $email, $id);

        if ($stmt->execute()) {
            $message = "User updated successfully.";
        } else {
            $message = "Error updating user: " . $conn->error;
        }
        $stmt->close();
    } elseif (isset($_POST['delete'])) { // delete user
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM Users WHERE user_id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $message = "User deleted successfully.";
        } else {
            $message = "Error deleting user: " . $conn->error;
        }
        $stmt->close();
    }
}

// Fetch all users
$result = $conn->query("SELECT * FROM Users");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
                            <a class="nav-link active" href="manage_users.php">
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
                    <h1 class="h2">Manage Users</h1>
                </div>

                <div id="content">
                    <?php if ($message): ?>
                        <div class="alert alert-info"><?php echo $message; ?></div>
                    <?php endif; ?>

                    <!-- Add User Form -->
                    <h3>Add New User</h3> <!-- create a form to add a new user -->
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" name="add" class="btn btn-primary">Add User</button>
                    </form>

                    <!-- User List -->
                    <h3 class="mt-4">User List</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['user_id']; ?></td> <!-- fetch all users from the database and display them in a table -->
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['u_email']); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['user_id']; ?>">
                                            Edit
                                        </button>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>">
                                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $row['user_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel<?php echo $row['user_id']; ?>">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST">
                                                    <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($row['u_email']); ?>" required>
                                                    </div>
                                                    <button type="submit" name="update" class="btn btn-primary">Update User</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>