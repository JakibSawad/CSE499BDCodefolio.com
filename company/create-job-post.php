<?php
//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage.
if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Job Portal - Create Job Post</title>
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
    <link href="../user/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> <!-- Adjusted path assuming CSS is relative to file location -->
    <link href="../user/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> <!-- Adjusted path -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../user/css/bootstrap.min.css" rel="stylesheet"> <!-- Adjusted path -->

    <!-- Template Stylesheet -->
    <link href="../user/css/style.css" rel="stylesheet"> <!-- Adjusted path -->

    <!-- TinyMCE -->
    <script src="../js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
        selector:'#description',
        height: 300,
        plugins: 'autolink lists link image charmap print preview hr anchor pagebreak', // Added plugins like first example
        toolbar_mode: 'floating', // Added toolbar mode like first example
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
                    <h3 class="text-primary"><i class="fa fa-building me-2"></i>Job Portal</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../user/img/user.jpg" alt="" style="width: 40px; height: 40px;"> <!-- Default image, consider fetching company logo -->
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['name']; ?></h6>
                        <span>Company</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="edit-company.php" class="nav-item nav-link"><i class="fa fa-building me-2"></i>My Company</a>
                    <a href="create-job-post.php" class="nav-item nav-link active"><i class="fa fa-plus-square me-2"></i>Create Job Post</a>
                    <a href="my-job-post.php" class="nav-item nav-link"><i class="fa fa-list me-2"></i>My Job Posts</a>
                    <a href="job-applications.php" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Job Applications</a>
                    <a href="mailbox.php" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Mailbox</a>
                    <a href="settings.php" class="nav-item nav-link"><i class="fa fa-cog me-2"></i>Settings</a>
                    <a href="resume-database.php" class="nav-item nav-link"><i class="fa fa-database me-2"></i>Resume Database</a>
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
                    <h2 class="text-primary mb-0"><i class="fa fa-building"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../user/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['name']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="edit-company.php" class="dropdown-item">My Company</a>
                            <a href="settings.php" class="dropdown-item">Settings</a>
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Create Job Post Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4">Create New Job Post</h6>

                    <form method="post" action="addpost.php">
                       <div class="bg-dark rounded p-4">
                            <div class="mb-3">
                                <label for="jobtitle" class="form-label">Job Title</label>
                                <input type="text" class="form-control bg-dark text-light border-0" id="jobtitle" name="jobtitle" placeholder="Job Title" required>
                            </div>
                             <div class="mb-3">
                                <label for="description" class="form-label">Job Description</label>
                                <textarea class="form-control bg-dark text-light border-0" id="description" name="description" placeholder="Job Description"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="minimumsalary" class="form-label">Minimum Salary</label>
                                    <input type="number" class="form-control bg-dark text-light border-0" id="minimumsalary" min="1000" autocomplete="off" name="minimumsalary" placeholder="e.g., 50000" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                     <label for="maximumsalary" class="form-label">Maximum Salary</label>
                                     <input type="number" class="form-control bg-dark text-light border-0" id="maximumsalary" name="maximumsalary" placeholder="e.g., 80000" required>
                                </div>
                            </div>
                             <div class="mb-3">
                                <label for="experience" class="form-label">Experience Required (Years)</label>
                                <input type="number" class="form-control bg-dark text-light border-0" id="experience" autocomplete="off" name="experience" placeholder="e.g., 2" required>
                            </div>
                            <div class="mb-3">
                                <label for="qualification" class="form-label">Qualification Required</label>
                                <input type="text" class="form-control bg-dark text-light border-0" id="qualification" name="qualification" placeholder="e.g., Bachelor's Degree in CS" required>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane me-2"></i>Create Job Post</button>
                            </div>
                       </div>
                    </form>
                </div>
            </div>
            <!-- Create Job Post Form End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            © <a href="#">Job Portal</a>, All Rights Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="#">Hisenberg group</a>
                            <br>Distributed By: <a href="#">NSU CSE</a>
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
    <script src="../user/lib/chart/chart.min.js"></script> <!-- Adjusted path -->
    <script src="../user/lib/easing/easing.min.js"></script> <!-- Adjusted path -->
    <script src="../user/lib/waypoints/waypoints.min.js"></script> <!-- Adjusted path -->
    <script src="../user/lib/owlcarousel/owl.carousel.min.js"></script> <!-- Adjusted path -->
    <script src="../user/lib/tempusdominus/js/moment.min.js"></script> <!-- Adjusted path -->
    <script src="../user/lib/tempusdominus/js/moment-timezone.min.js"></script> <!-- Adjusted path -->
    <script src="../user/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script> <!-- Adjusted path -->

    <!-- Template Javascript -->
    <script src="../user/js/main.js"></script> <!-- Adjusted path -->

</body>
</html>
<?php
if (isset($conn)) {
    $conn->close();
}
?>
