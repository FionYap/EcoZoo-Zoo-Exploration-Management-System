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
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Services</a>
                        <a href="event.php" class="nav-item nav-link">Events</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Details</a>
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

    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <h1 class="display-1 mb-4 animated zoomIn">Explore the safari</h1>
                                    <a href="about.html" class="btn btn-light rounded-pill py-3 px-5 animated zoomIn">Explore
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <h1 class="display-1 mb-4 animated zoomIn">Interact with your favourite animals</h1>
                                    <a href="about.html" class="btn btn-light rounded-pill py-3 px-5 animated zoomIn">Explore
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid bg-white w-100 mb-3 wow fadeIn" data-wow-delay="0.1s"
                                src="img/about-1.jpg" alt="">
                            <img class="img-fluid bg-white w-50 wow fadeIn" data-wow-delay="0.2s" src="img/about-3.jpg"
                                alt="">
                        </div>
                        <div class="col-6">
                            <img class="img-fluid bg-white w-50 mb-3 wow fadeIn" data-wow-delay="0.3s"
                                src="img/about-4.jpg" alt="">
                            <img class="img-fluid bg-white w-100 wow fadeIn" data-wow-delay="0.4s" src="img/about-2.jpg"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="section-title">
                        <p class="fs-5 fw-medium fst-italic text-primary">About Us</p>
                        <h1 class="display-6">Welcome to EcoZoo – Home of Wildlife Wonders!</h1>
                    </div>
                    <div class="row g-3 mb-4">

                        <div class="col-sm-13">
                            <h5>Founded in 2025, EcoZoo is a sanctuary dedicated to protecting and showcasing the beauty
                                of wildlife from around the world.</h5>
                            <p class="mb-0">Our mission is to provide a safe, educational, and fun environment for both
                                animals and visitors. At EcoZoo, we believe in the importance of wildlife conservation,
                                environmental awareness, and creating meaningful connections between people and nature.
                            </p>
                        </div>
                    </div>
                    <div class="border-top mb-4"></div>
                    <div class="row g-3">
                        <div class="col-sm-13">
                            <h5>Join us in celebrating the wonders of nature and be part of a greener, more
                                compassionate world!</h5>
                            <p class="mb-0">From majestic elephants to adorable pandas, our zoo is home to a diverse
                                collection of species. We aim to educate the public about animal care, their habitats,
                                and conservation efforts through engaging exhibits, special events, and interactive
                                programs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-fluid product py-5 my-5">
        <div class="container py-5">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Our Services</p>
                <h1 class="display-8">Ensure your whole journey are fun and enjoy.</h1>
            </div>
            <div class="owl-carousel product-carousel wow fadeInUp" data-wow-delay="0.5s">
                <a href="" class="d-block product-item rounded">
                    <img src="img/product-1.jpg" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="text-primary">Food & Beverages</h4>
                        <span class="text-body">Visitors can enjoy fresh meals, snacks, and drinks at various
                            eco-friendly food stalls and cafes throughout the zoo.</span>
                    </div>
                </a>
                <a href="" class="d-block product-item rounded">
                    <img src="img/product-2.jpg" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="text-primary">Zoo Shopping</h4>
                        <span class="text-body">Our gift shop offers animal-themed souvenirs, toys, and eco-friendly
                            products for visitors to take home.</span>
                    </div>
                </a>
                <a href="" class="d-block product-item rounded">
                    <img src="img/product-3.jpg" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="text-primary">Rest House</h4>
                        <span class="text-body">Comfortable rest areas with seating and facilities are available for
                            visitors to relax during their visit.</span>
                    </div>
                </a>
                <a href="" class="d-block product-item rounded">
                    <img src="img/product-4.jpg" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="text-primary">Guide Services</h4>
                        <span class="text-body">Professional guides provide educational tours to help visitors learn
                            more about animals and conservation.</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- OT Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid" src="img/article.jpg" alt="">
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="section-title">
                        <h1 class="display-6">Operation Time</h1>
                    </div>
                    <p class="mb-6"><b>
                            Monday -
                            Closed<br>
                            Tuesday -
                            9:00AM ~ 6:00PM<br>
                            Wednesday -
                            9:00AM ~ 6:00PM<br>
                            Thursday -
                            9:00AM ~ 6:00PM<br>
                            Friday -
                            9:00AM ~ 6:00PM<br>
                            Saturday -
                            9:00AM ~ 21:00PM<br>
                            Sunday -
                            9:00AM ~ 21:00PM</b>
                    </p>
                    <a href="contact.php" class="btn btn-primary rounded-pill py-3 px-5">Have Question?</a>
                </div>
            </div>
        </div>
    </div>
    <!-- OT End -->

    <!-- Event Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Interesting Events</p>
                <h1 class="display-6">Come and join us!</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="store-item position-relative text-center">
                        <img class="img-fluid" src="img/store-product-1.jpg" alt="">
                        <div class="p-4">
                            <h4 class="mb-3">Junior Zookeeper Experience</h4>
                            <p>A special one-day program where kids can become “junior zookeepers” and help feed
                                animals, clean enclosures (safely), and learn about animal care.</p>
                            <h4 class="text-primary">20th April 2025</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="store-item position-relative text-center">
                        <img class="img-fluid" src="img/store-product-2.jpg" alt="">
                        <div class="p-4">
                            <h4 class="mb-3">Bird Watching Festival</h4>
                            <p>Focused on our bird exhibits, this event includes guided bird-watching tours, educational
                                sessions on bird species, and a special aviary show.</p>
                            <h4 class="text-primary">18th June 2025</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="store-item position-relative text-center">
                        <img class="img-fluid" src="img/store-product-3.jpg" alt="">
                        <div class="p-4">
                            <h4 class="mb-3">Zoo Night Safari</h4>
                            <p>Experience the zoo after dark with guided night tours, light displays, and animal
                                behavior sessions showing how wildlife behaves at night, ending with a festive
                                Halloween-themed show.
                            </p>
                            <h4 class="text-primary">31st October 2025<br>(Halloween Special)</h4>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <a href="event.php" class="btn btn-primary rounded-pill py-3 px-5">View More Events</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Event End -->


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
                            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                <a href="ticket.php" class="btn btn-primary rounded-pill py-3 px-5">Buy Now</a>
                            </div>
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
                            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                <a href="ticket.php" class="btn btn-primary rounded-pill py-3 px-5">Buy Now</a>
                            </div>
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
                            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                <a href="ticket.php" class="btn btn-primary rounded-pill py-3 px-5">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ticket End -->


    <!-- Contact Start -->
    <div class="container-xxl contact py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Contact Us</p>
                <h1 class="display-6">Your Contact & Feedback will be important to us</h1>
            </div>
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                    <p class="text-center mb-5">Have any questions, suggestions, or need assistance? We’re here to help!
                        Feel free to reach out to us for more information about our zoo, ticket plans, upcoming events,
                        or services.
                        Our team will respond to your inquiries as soon as possible.</p>
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <a href="contact.php" class="btn btn-primary rounded-pill py-3 px-5">Fill the form now</a>
                    </div><br><br>
                    <div class="row g-5">
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-envelope fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">fion@raffles.com</p>
                            <p class="mb-0">john@example.com</p>
                        </div>
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.4s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-phone fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">+6012 345 6789</p>
                            <p class="mb-0">+6016 768 3823</p>
                        </div>
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-map-marker-alt fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">JALAN 3, TAMAN 123</p>
                            <p class="mb-0">JOHOR, MALAYSIA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


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