<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yfgr_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Youth For * Girls Rights</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
          .event-item {
              cursor: pointer;
              padding: 10px;
              margin-bottom: 10px;
              border-radius: 5px;
          }
          .event-item:hover {
              background-color: #f8f9fa;
          }
          .gallery-item {
              position: relative;
              margin-bottom: 20px;
          }
          .gallery-item img {
              width: 100%;
              height: 200px; /* Fixed height */
              object-fit: cover; /* Ensure uniform display */
              display: block;
          }
          .gallery-item-info {
              text-align: center;
              padding: 10px;
              background-color: #f4f4f4;
          }
          /* Hover overlay for view/download icons */
          .gallery-overlay {
              position: absolute;
              top: 0;
              left: 0;
              right: 0;
              bottom: 0;
              background: rgba(0, 0, 0, 0.5);
              color: #fff;
              display: flex;
              justify-content: center;
              align-items: center;
              opacity: 0;
              transition: opacity 0.3s ease;
          }
          .gallery-item:hover .gallery-overlay {
              opacity: 1;
          }
          .gallery-overlay a {
              color: #fff;
              margin: 0 10px;
              font-size: 24px;
          }

    </style>
    </head>

    <body>

        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid topbar px-0 px-lg-4 bg-dark py-2 d-none d-lg-block">
            <div class="container">
                <div class="row gx-0 align-items-center">
                    <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                        <div class="d-flex flex-wrap">
                            <div class="border-end border-primary pe-3">
                                <a href="#" class="text-muted small"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                            </div>
                            <div class="ps-3">
                                <a href="mailto:example@gmail.com" class="text-muted small"><i class="fas fa-envelope text-primary me-2"></i>example@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end">
                        <div class="d-flex justify-content-end">
                            <div class="d-flex border-end border-primary pe-3">
                                <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="btn p-0 text-primary me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-black">
                    <a href="#" class="navbar-brand p-0">
                        <h1 class="text-primary mb-0">
                          <img src="img/Logo.jpg" alt="" height="75px" width="80px">
                        </h1>
                        <!-- <img src="img/logo.png" alt="Logo"> -->
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-0 mx-lg-auto">
                            <a href="index.html" class="nav-item nav-link active">Home</a>
                            <a href="about.html" class="nav-item nav-link">About</a>
                            <a href="service.html" class="nav-item nav-link">Service</a>
                            <a href="blog.html" class="nav-item nav-link">Blog</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                    <span class="dropdown-toggle">More</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="events.php" class="dropdown-item">Events</a>
                                    <a href="gallery.php" class="dropdown-item">Gallery</a>
                                    <a href="feature.html" class="dropdown-item">News</a>
                                    <a href="team.html" class="dropdown-item">Our team</a>
                                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                    </div>
                    <div class="d-none d-xl-flex flex-shrink-0 ps-4">
                        <div class="d-flex flex-column ms-3">
                            <span>Call to Our Experts</span>
                            <a href="tel:+ 0123 456 7890"><span class="text-dark">Free: + 0123 456 7890</span></a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

<div class="container">
    <h1 class="text-center my-4">Photo Gallery Template</h1>

    <!-- Gallery Filters -->
    <div class="text-center mb-4 p-3">
        <button class="btn btn-outline-primary active" data-filter="all">All</button>
        <button class="btn btn-outline-primary" data-filter="Event Image">Events</button>
        <button class="btn btn-outline-primary" data-filter="News Image">News</button>
        <button class="btn btn-outline-primary" data-filter="Post Image">Post Image</button>
    </div>

    <!-- Gallery Grid -->
    <div class="row">
        <?php
        // Fetch the uploaded files from the database
        $sql = "SELECT * FROM file_uploads";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $filePath = 'backendfiles/gallery/' . $row['file_path'];
                $type = $row['types']; // Get the image type for filtering
                echo '<div class="col-lg-4 col-sm-4 col-6 gallery-item p-3" data-category="' . $type . '">';
                echo '<img src="' . $filePath . '" alt="' . $row['title'] . '" data-toggle="modal" data-target="#imageModal-' . $row['id'] . '">';
                echo '<div class="gallery-overlay">';
                echo '<a href="' . $filePath . '" target="_blank" data-toggle="modal" data-target="#imageModal-' . $row['id'] . '"><i class="fas fa-eye"></i></a>';
                echo '<a href="' . $filePath . '" download><i class="fas fa-download"></i></a>';
                echo '</div>';
                echo '</div>';

                // Modal for viewing image
                echo '<div class="modal fade" id="imageModal-' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel-' . $row['id'] . '" aria-hidden="true">';
                echo '<div class="modal-dialog modal-lg" role="document">';
                echo '<div class="modal-content">';
                echo '<div class="modal-body text-center">';
                echo '<img src="' . $filePath . '" alt="' . $row['title'] . '" height="500px" width="770px">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p class='text-center'>No images found.</p>";
        }
        ?>
    </div>
</div>

<!-- Optional: Include Bootstrap JS and dependencies (jQuery, Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>


<!-- Template Javascript -->
<script src="js/main.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.btn-outline-primary');
        const galleryItems = document.querySelectorAll('.gallery-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.getAttribute('data-filter');

                // Toggle active class on buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // Show/hide items based on the selected filter
                galleryItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');

                    // If "all" is selected, display all items
                    if (filter === 'all' || itemCategory === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

<?php
$conn->close();
?>
