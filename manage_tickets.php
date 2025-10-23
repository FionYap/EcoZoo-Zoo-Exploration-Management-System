<?php
session_start();
$current_user_id = $_SESSION['admin_id'];

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

function getUserIdByEmail($conn, $email)
{
    $stmt = $conn->prepare("SELECT user_id FROM Users WHERE u_email = ?"); 
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['user_id'];
    }
    return null; // user not found
}

// Handle form submissions 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {  // add new ticket
        $ticket_type = $_POST['ticket_type'];
        $price = $_POST['price'];
        $purchase_date = $_POST['purchase_date'];
        $t_name = $_POST['t_name'];
        $t_email = $_POST['t_email'];
        $quantity = $_POST['quantity'];

        // Get user_id based on the email
        $user_id = getUserIdByEmail($conn, $t_email);

        if ($user_id !== null) { // user found
            $stmt = $conn->prepare("INSERT INTO Tickets (user_id, ticket_type, price, purchase_date, t_name, t_email, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isdsssi", $user_id, $ticket_type, $price, $purchase_date, $t_name, $t_email, $quantity);

            if ($stmt->execute()) {
                $message = "Ticket added successfully.";
            } else {
                $message = "Error adding ticket: " . $conn->error;
            }
            $stmt->close();
        } else {
            $message = "Error: User with email " . $t_email . " not found.";
        }
    } elseif (isset($_POST['update'])) { // update ticket
        $ticket_id = $_POST['ticket_id'];
        $ticket_type = $_POST['ticket_type'];
        $price = $_POST['price'];
        $t_name = $_POST['t_name'];
        $t_email = $_POST['t_email'];
        $quantity = $_POST['quantity'];

        $stmt = $conn->prepare("UPDATE Tickets SET ticket_type = ?, price = ?, t_name = ?, t_email = ?, quantity = ? WHERE ticket_id = ?");
        $stmt->bind_param("sdssii", $ticket_type, $price, $t_name, $t_email, $quantity, $ticket_id);

        if ($stmt->execute()) {
            $message = "Ticket updated successfully.";
        } else {
            $message = "Error updating ticket: " . $conn->error;
        }
        $stmt->close();
    } elseif (isset($_POST['delete'])) { // delete ticket
        $ticket_id = $_POST['ticket_id'];

        $stmt = $conn->prepare("DELETE FROM Tickets WHERE ticket_id = ?");
        $stmt->bind_param("i", $ticket_id);

        if ($stmt->execute()) {
            $message = "Ticket deleted successfully.";
        } else {
            $message = "Error deleting ticket: " . $conn->error;
        }
        $stmt->close();
    }
}

// Fetch all tickets
$result = $conn->query("SELECT t.*, u.username, u.u_email FROM Tickets t LEFT JOIN Users u ON t.user_id = u.user_id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --main-bg-color: #e9f7ef;
            --sidebar-bg-color: #27ae60;
            --sidebar-hover-color: #2ecc71;
            --text-color: #ffffff;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background-color: var(--main-bg-color);
        }

        #sidebar {
            background-color: var(--sidebar-bg-color);
            color: var(--text-color);
        }

        #sidebar .nav-link {
            color: var(--text-color);
            padding: 12px 16px;
        }

        #sidebar .nav-link:hover {
            background-color: var(--sidebar-hover-color);
        }

        .active {
            background-color: var(--sidebar-hover-color);
        }

        #content {
            background-color: var(--main-bg-color);
        }
    </style>
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column">
        <div class="row flex-grow-1">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse d-flex flex-column p-0">
                <div class="position-sticky flex-grow-1 d-flex flex-column">
                    <ul class="nav flex-column flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_users.php">Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_events.php">Manage Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="manage_tickets.php">Manage Tickets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_feedback.php">View Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/login.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manage Tickets</h1>
                </div>

                <div id="content">
                    <?php if ($message): ?> <!-- if message is not empty -->
                        <div class="alert alert-info"><?php echo $message; ?></div>
                    <?php endif; ?>

                    <!-- Add Ticket Form -->
                    <h3>Add New Ticket</h3>
                    <form method="POST">
                        <div class="col-md-6">
                            <label for="ticket_type" class="form-label">Ticket Type</label>
                            <input type="text" class="form-control" id="ticket_type" name="ticket_type" required>
                        </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="col-md-6">
                        <label for="purchase_date" class="form-label">Purchase Date</label>
                        <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="t_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="t_name" name="t_name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="t_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="t_email" name="t_email" required>
                    </div>
                    <div class="col-md-4">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                </div>
                <button type="submit" name="add" class="btn btn-primary">Add Ticket</button>
                </form>

                <!-- Manage Tickets Table -->
                <h3 class="mt-4">Ticket List</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Purchased By</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Purchase Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['ticket_id']; ?></td>
                                <td><?php echo $row['username'] . ' (' . $row['u_email'] . ')'; ?></td>
                                <td><?php echo $row['ticket_type']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['purchase_date']; ?></td>
                                <td><?php echo $row['t_name']; ?></td>
                                <td><?php echo $row['t_email']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['ticket_id']; ?>">
                                        Edit
                                    </button> <!-- Edit button -->
                                    <form method="POST" style="display: inline;"> <!-- Delete form & button -->
                                        <input type="hidden" name="ticket_id" value="<?php echo $row['ticket_id']; ?>">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?php echo $row['ticket_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $row['ticket_id']; ?>" aria-hidden="true">
                                <div class="modal-dialog"> <!-- create modal to edit ticket -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?php echo $row['ticket_id']; ?>">Edit Ticket</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST">
                                                <input type="hidden" name="ticket_id" value="<?php echo $row['ticket_id']; ?>">
                                                <div class="mb-3">
                                                    <label for="ticket_type<?php echo $row['ticket_id']; ?>" class="form-label">Ticket Type</label>
                                                    <input type="text" class="form-control" id="ticket_type<?php echo $row['ticket_id']; ?>" name="ticket_type" value="<?php echo $row['ticket_type']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price<?php echo $row['ticket_id']; ?>" class="form-label">Price</label>
                                                    <input type="number" step="0.01" class="form-control" id="price<?php echo $row['ticket_id']; ?>" name="price" value="<?php echo $row['price']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="t_name<?php echo $row['ticket_id']; ?>" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="t_name<?php echo $row['ticket_id']; ?>" name="t_name" value="<?php echo $row['t_name']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="t_email<?php echo $row['ticket_id']; ?>" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="t_email<?php echo $row['ticket_id']; ?>" name="t_email" value="<?php echo $row['t_email']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="quantity<?php echo $row['ticket_id']; ?>" class="form-label">Quantity</label>
                                                    <input type="number" class="form-control" id="quantity<?php echo $row['ticket_id']; ?>" name="quantity" value="<?php echo $row['quantity']; ?>" required>
                                                </div>
                                                <button type="submit" name="update" class="btn btn-primary">Update Ticket</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>