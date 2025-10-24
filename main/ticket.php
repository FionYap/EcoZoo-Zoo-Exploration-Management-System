<?php
session_start(); // Start the session

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

$successMessage = '';
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        $errorMessage = "Connection failed: " . $conn->connect_error;
    } else {
        // Get form data
        $t_name = $_POST['name'];
        $t_email = $_POST['email'];
        $ticket_type = $_POST['ticketType'];
        $quantity = $_POST['quantity'];

        // Check if the email exists in the database
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE u_email = ?");
        $stmt->bind_param("s", $t_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email exists, proceed with ticket purchase
            $user = $result->fetch_assoc();
            $user_id = $user['user_id'];

            // Calculate price based on ticket type and quantity        
            switch ($ticket_type) {
                case 'standard_adult':
                    $unit_price = 80;
                    break;
                case 'standard_child':
                    $unit_price = 50;
                    break;
                case 'family':
                    $unit_price = 240;
                    break;
                case 'annual':
                    $unit_price = 260;
                    break;
                default:
                    $unit_price = 0;
            }
            $price = $unit_price * $quantity;

            // Insert ticket purchase
            $stmt = $conn->prepare("INSERT INTO tickets (user_id, t_name, t_email, ticket_type, purchase_date, quantity, price) VALUES (?, ?, ?, ?, CURDATE(), ?, ?)");
            $stmt->bind_param("isssid", $user_id, $t_name, $t_email, $ticket_type, $quantity, $price);

            if ($stmt->execute()) {
                $successMessage = "Ticket purchased successfully!";
            } else {
                $errorMessage = "Error: " . $stmt->error;
            }
        } else {
            // Email doesn't exist
            $errorMessage = "Error: The provided email is not registered in our system. Please use the email associated with your account.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EcoZoo - Explore the Safari Today!</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
                <a href="index.php" class="navbar-brand">
                    <img class="img-fluid" src="img/logo.png" alt="Logo">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Services</a>
                        <a href="event.php" class="nav-item nav-link">Events</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Details</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="animal.html" class="dropdown-item">Animals</a>
                                <a href="contact.php" class="dropdown-item">Contact</a>
                            </div>
                        </div>
                        <a href="ticket.php" class="nav-item nav-link">Buy Ticket</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="../login/login.php" class="dropdown-item">Login</a>
                                <a href="../login/register.php" class="dropdown-item">Register</a>
                                <a href="../profile/profile.php" class="dropdown-item">Profile</a>
                            </div>
                        </div>
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
            <h1 class="display-2 text-dark mb-4 animated slideInDown">Buy Ticket</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Buy Ticket</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Ticket Start -->
    <div class="container-fluid testimonial py-5 my-5">
        <div class="container py-5">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-white">Ticket Plans</p>
                <h1 class="display-6">Grab your tickets now</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.5s">
                <div class="testimonial-item p-4 p-lg-5">
                    <p class="mb-4">Full-day access to all animal exhibits and public areas of the zoo.</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid flex-shrink-0" src="img/testimonial-1.jpg" alt="">
                        <div class="text-start ms-3">
                            <h5>Standard Entry Pass</h5>
                            <p class="mb-4">Price: RM 80 (Adults) / RM 50 (Children)</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item p-4 p-lg-5">
                    <p class="mb-4">Full-day zoo entry, free guide service, and a 10% discount voucher for zoo shopping
                        and food stalls.</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid flex-shrink-0" src="img/testimonial-2.jpg" alt="">
                        <div class="text-start ms-3">
                            <h5>Family Combo Package</h5>
                            <p class="mb-4">Price: RM 240 (2 Adults + 2 Children)</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item p-4 p-lg-5">
                    <p class="mb-4">Unlimited visits throughout the year, exclusive invites to special events, 15%
                        discount on food, beverages, and zoo shopping, plus free access to selected workshops.</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid flex-shrink-0" src="img/testimonial-3.jpg" alt="">
                        <div class="text-start ms-3">
                            <h5>Annual Membership Pass</h5>
                            <p class="mb-4">Price: RM 260 per person (Valid for 1 Year)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ticket End -->

    <!-- Ticket Purchase Form Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-6 mb-5">Buy Your Tickets</h1>
                    <?php
                    if ($successMessage) {
                        echo '<div class="alert alert-success">' . $successMessage . '</div>';
                    }
                    if ($errorMessage) {
                        echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
                    }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select" id="ticketType" name="ticketType" required>
                                        <option value="standard_adult">Standard Entry Pass - Adult (RM 80)</option>
                                        <option value="standard_child">Standard Entry Pass - Child (RM 50)</option>
                                        <option value="family">Family Combo Package - RM 240 (2 Adults + 2 Children)</option>
                                        <option value="annual">Annual Membership Pass - RM 260 per person (Valid for 1 Year)</option>
                                    </select>
                                    <label for="ticketType">Select Ticket Type</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        placeholder="Quantity" required>
                                    <label for="quantity">Quantity</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Purchase Ticket</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Ticket Purchase Form End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary mb-4">Our Office</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>JALAN 3, TAMAN 123, JOHOR,
                        MALAYSIA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+6012 345 6789</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>fion@raffles.com</p>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="about.html">About Us</a>
                    <a class="btn btn-link" href="contact.php">Contact Us</a>
                    <a class="btn btn-link" href="service.html">Our Services</a>
                    <a class="btn btn-link" href="event.php">Our Events</a>
                    <a class="btn btn-link" href="ticket.php">Buy Ticket</a>
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
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <a href="../login/register.php" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="fw-medium" href="#">EcoZoo</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a class="fw-medium" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        class="fw-medium" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>