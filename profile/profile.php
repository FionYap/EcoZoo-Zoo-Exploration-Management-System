<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
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

$user_id = $_SESSION['user_id'];
$user = null;
$message = '';

// Fetch user information
$sql = "SELECT * FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    $message = "User not found.";
}

// Fetch purchased tickets
$tickets = [];
$sql = "SELECT * FROM Tickets WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$tickets_result = $stmt->get_result();
while ($row = $tickets_result->fetch_assoc()) {
    $tickets[] = $row;
}

// Fetch feedback records
$feedbacks = [];
$sql = "SELECT * FROM Feedback WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$feedback_result = $stmt->get_result();
while ($row = $feedback_result->fetch_assoc()) {
    $feedbacks[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EcoZoo - User Profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../main/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../main/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../main/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../main/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../main/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
                <a href="../main/index.php" class="navbar-brand">
                    <img class="img-fluid" src="../main/img/logo.png" alt="Logo">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="../main/index.php" class="nav-item nav-link">Home</a>
                        <a href="../main/about.html" class="nav-item nav-link">About</a>
                        <a href="../main/service.html" class="nav-item nav-link">Services</a>
                        <a href="../main/event.php" class="nav-item nav-link">Events</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Details</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="../main/animal.html" class="dropdown-item">Animals</a>
                                <a href="../main/contact.php" class="dropdown-item">Contact</a>
                            </div>
                        </div>
                        <a href="../main/ticket.php" class="nav-item nav-link">Buy Ticket</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="../login/login.php" class="dropdown-item">Login</a>
                                <a href="../login/register.php" class="dropdown-item">Register</a>
                                <a href="profile.php" class="dropdown-item">Profile</a>
                            </div>
                        </div>
                        <a href="../login/login.php" class="nav-item nav-link">Logout</a>
                    </div>
                    <div class="border-start ps-4 d-none d-lg-block">
                        <button type="button" class="btn btn-sm p-0"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4 animated slideInDown">User Profile</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="../main/index.php">Home</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">User Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Profile Content -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="display-5 mb-4">Your Profile</h2>
                    <?php if ($message): ?>
                        <div class="alert alert-info"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <?php if ($user): ?>
                        <form method="POST" action="">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                        <label for="username">Username</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['u_email']); ?>" required>
                                        <label for="email">Email address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary py-3 px-5" type="submit">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    <?php else: ?>
                        <p>User information not available.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row g-5 mt-5">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="display-5 mb-4">Purchased Tickets</h2>
                    <?php if (count($tickets) > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ticket ID</th>
                                    <th>Ticket Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Purchase Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tickets as $ticket): ?>
                                    <tr>
                                        <td><?php echo $ticket['ticket_id']; ?></td>
                                        <td><?php echo htmlspecialchars($ticket['ticket_type']); ?></td>
                                        <td><?php echo $ticket['quantity']; ?></td>
                                        <td><?php echo $ticket['price']; ?></td>
                                        <td><?php echo $ticket['purchase_date']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No tickets purchased yet.</p>
                    <?php endif; ?>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="display-5 mb-4">Feedback Records</h2>
                    <?php if (count($feedbacks) > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Feedback ID</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($feedbacks as $feedback): ?>
                                    <tr>
                                        <td><?php echo $feedback['feedback_id']; ?></td>
                                        <td><?php echo htmlspecialchars($feedback['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($feedback['message']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No feedback submitted yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile Content End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary mb-4">Our Office</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>JALAN 3, TAMAN 123, JOHOR, MALAYSIA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+6012 345 6789</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>fion@raffles.com</p>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="#"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="../main/about.html">About Us</a>
                    <a class="btn btn-link" href="../main/contact.php">Contact Us</a>
                    <a class="btn btn-link" href="../main/service.html">Our Services</a>
                    <a class="btn btn-link" href="../main/event.php">Our Events</a>
                    <a class="btn btn-link" href="../main/ticket.php">Buy Ticket</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary mb-4">Business Hours</h4>
                    <p class="mb-1">Tuesday - Friday</p>
                    <h6 class="text-light">09:00 am - 17:00 pm</h6>
                    <p class="mb-1">Saturday - Sunday</p>
                    <h6 class="text-light">09:00 am - 22:00 pm</h6>
                    <p class="mb-1">Monday</p>
                    <h6 class="text-light">Closed</h6>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary mb-4">Account</h4>
                    <p>Sign up before purchases</p>
                    <div class="position-relative w-100">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <a href="../login/register.php" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../main/lib/wow/wow.min.js"></script>
    <script src="../main/lib/easing/easing.min.js"></script>
    <script src="../main/lib/waypoints/waypoints.min.js"></script>
    <script src="../main/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../main/js/main.js"></script>
</body>

</html>