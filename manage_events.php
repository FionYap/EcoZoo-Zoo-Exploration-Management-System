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
    if (isset($_POST['add'])) { // add new event
        $title = $_POST['title'];
        $description = $_POST['description'];
        $event_date = $_POST['event_date'];
        $image_url = $_POST['image_url'];

        $stmt = $conn->prepare("INSERT INTO Events (title, description, event_date, image_url) VALUES (?, ?, ?, ?)"); 
        $stmt->bind_param("ssss", $title, $description, $event_date, $image_url); 

        if ($stmt->execute()) {
            $message = "Event added successfully.";
        } else {
            $message = "Error adding event: " . $conn->error;
        }
        $stmt->close();
    } elseif (isset($_POST['update'])) { // update event
        $event_id = $_POST['event_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $event_date = $_POST['event_date'];
        $image_url = $_POST['image_url'];

        $stmt = $conn->prepare("UPDATE Events SET title = ?, description = ?, event_date = ?, image_url = ? WHERE event_id = ?");
        $stmt->bind_param("ssssi", $title, $description, $event_date, $image_url, $event_id);

        if ($stmt->execute()) {
            $message = "Event updated successfully.";
        } else {
            $message = "Error updating event: " . $conn->error;
        }
        $stmt->close();
    } elseif (isset($_POST['delete'])) { // delete event
        $event_id = $_POST['event_id'];

        $stmt = $conn->prepare("DELETE FROM Events WHERE event_id = ?");
        $stmt->bind_param("i", $event_id);

        if ($stmt->execute()) {
            $message = "Event deleted successfully.";
        } else {
            $message = "Error deleting event: " . $conn->error;
        }
        $stmt->close();
    }
}

// Fetch all events
$result = $conn->query("SELECT * FROM Events"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
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
                            <a class="nav-link active" href="manage_events.php">
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
                    <h1 class="h2">Manage Events</h1>
                </div>

                <?php if (!empty($message)): ?> 
                    <div class="alert alert-info"><?php echo $message; ?></div> //
                <?php endif; ?>

                <!-- Event Management Form -->
                <form method="post" class="mb-4">
                    <input type="hidden" name="event_id" id="event_id">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Event Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col-md-6">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date" class="form-control" id="event_date" name="event_date" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Image URL</label>
                        <input type="url" class="form-control" id="image_url" name="image_url" required>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Add Event</button>
                    <button type="submit" name="update" class="btn btn-warning" style="display:none;">Update Event</button>
                </form>

                <!-- Events Table -->
                <h2>Event List</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Image URL</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?> <!-- Display events in a table -->
                                <tr>
                                    <td><?php echo $row['event_id']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['event_date']; ?></td>
                                    <td><?php echo substr($row['description'], 0, 50) . '...'; ?></td>
                                    <td><?php echo substr($row['image_url'], 0, 30) . '...'; ?></td>
                                    <td>
                                        <button onclick="editEvent(<?php echo htmlspecialchars(json_encode($row)); ?>)" class="btn btn-primary btn-sm">Edit</button> <!-- create a button to edit the event -->
                                        <form id="deleteForm<?php echo $row['event_id']; ?>" method="POST" style="display: inline;"> <!-- create a form to delete the event -->
                                            <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>"> 
                                            <input type="hidden" name="delete" value="1"> 
                                            <button type="button" onclick="confirmDelete(<?php echo $row['event_id']; ?>)" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </main>

            <script>
                function editEvent(event) { // called when the edit button is clicked
                    document.getElementById('event_id').value = event.event_id;
                    document.getElementById('title').value = event.title;
                    document.getElementById('event_date').value = event.event_date;
                    document.getElementById('description').value = event.description;
                    document.getElementById('image_url').value = event.image_url;
                    document.querySelector('button[name="add"]').style.display = 'none';
                    document.querySelector('button[name="update"]').style.display = 'inline-block';
                }

                function confirmDelete(eventId) { // called when the delete button is clicked
                    if (confirm('Are you sure you want to delete this event?')) {
                        document.getElementById('deleteForm' + eventId).submit();
                    }
                }
            </script>
</body>

</html>