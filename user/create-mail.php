<?php
//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

// Fetch companies the user has applied to and been accepted by (status 2 usually means accepted/shortlisted)
// This logic is specific to composing a message to a company that has progressed the application.
$sql_companies = "SELECT c.id_company, c.companyname 
                  FROM apply_job_post ajp
                  INNER JOIN company c ON ajp.id_company = c.id_company 
                  WHERE ajp.id_user='$_SESSION[id_user]' AND ajp.status='2'"; // Assuming status '2' means accepted/eligible to message
$result_companies = $conn->query($sql_companies);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Job Portal - Compose Mail</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> <!-- Note: Still using v4 for tempusdominus in this template -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- TinyMCE -->
    <script src="../js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
        selector:'#description',
        height: 250, // Increased height for better usability
        plugins: 'autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        // Add skin if needed for dark mode compatibility or customize toolbar
        // skin: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
        // content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default')
     });
    </script>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Job Portal</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <!-- You might want to fetch user image dynamically if available -->
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['name']; ?></h6>
                        <span>User</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-address-card me-2"></i>My Applications</a>
                    <a href="edit-profile.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Edit Profile</a>
                    <a href="../jobs.php" class="nav-item nav-link"><i class="fa fa-list-ul me-2"></i>Jobs</a>
                    <!-- Set Mailbox as active -->
                    <a href="mailbox.php" class="nav-item nav-link active"><i class="fa fa-envelope me-2"></i>Mailbox</a>
                    <a href="settings.php" class="nav-item nav-link"><i class="fa fa-cog me-2"></i>Settings</a>
                    <a href="../logout.php" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                     <!-- Removed search bar and message dropdown for simplicity, add back if needed -->
                     <!--
                     <form class="d-none d-md-flex ms-4">
                        <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                    </form>
                    <div class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Messages</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        </div>
                    </div>
                    -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['name']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="edit-profile.php" class="dropdown-item">My Profile</a>
                            <a href="settings.php" class="dropdown-item">Settings</a>
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Compose Mail Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Compose New Message</h6>
                        <a href="mailbox.php" class="btn btn-danger"><i class="fas fa-times me-2"></i>Discard</a>
                    </div>

                    <!-- Compose Form -->
                    <form action="add-mail.php" method="post">
                       <div class="bg-dark rounded p-4">
                            <div class="mb-3">
                                <label for="to" class="form-label">To:</label>
                                <select name="to" id="to" class="form-select bg-dark text-light border-0" required>
                                    <option value="" selected disabled>Select Company</option>
                                    <?php
                                    if ($result_companies && $result_companies->num_rows > 0) {
                                        while ($row_company = $result_companies->fetch_assoc()) {
                                            echo '<option value="' . $row_company['id_company'] . '">' . htmlspecialchars($row_company['companyname']) . '</option>';
                                        }
                                    } else {
                                        echo '<option value="" disabled>No eligible companies found</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject:</label>
                                <input type="text" class="form-control bg-dark text-light border-0" id="subject" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Message:</label>
                                <!-- TinyMCE will replace this textarea -->
                                <textarea class="form-control bg-dark text-light border-0" id="description" name="description" placeholder="Your message here..." style="height: 250px"></textarea>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <!-- Changed Discard link to a button next to Send -->
                                <!-- <a href="mailbox.php" class="btn btn-secondary me-2"><i class="fa fa-times me-1"></i> Discard</a> -->
                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope me-2"></i>Send Message</button>
                            </div>
                       </div>
                    </form>
                    <!-- End Compose Form -->
                </div>
            </div>
            <!-- Compose Mail End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            © <a href="#">Job Portal</a>, All Rights Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script> <!-- Corresponds to CSS include -->

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- No DataTables needed for this page unless you add tables later -->
    <!-- <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> -->

</body>
</html>
<?php
// Close DB connection if necessary, though it's often handled implicitly at script end
if (isset($conn)) {
    $conn->close();
}
?>