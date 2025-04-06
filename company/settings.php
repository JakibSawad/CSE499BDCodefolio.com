<?php
//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage.
//This is required if user tries to manually enter view-job-post.php in URL.
if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

// Include the database connection file (optional here, but good practice)
require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Job Portal - Company Settings</title>
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom CSS additions if needed -->
    <style>
        /* Add any custom styles specific to this page if necessary */
        .form-check-label {
            margin-left: 0.25rem; /* Align checkbox label nicely */
        }
        #passwordError {
             margin-top: 1rem; /* Add space above the error message */
        }
    </style>
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
                    <h3 class="text-primary"><i class="fa fa-user-tie me-2"></i>Job Portal</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <!-- Placeholder for company logo or generic image -->
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
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
                    <a href="create-job-post.php" class="nav-item nav-link"><i class="fa fa-plus-square me-2"></i>Create Job Post</a>
                    <a href="my-job-post.php" class="nav-item nav-link"><i class="fa fa-list-alt me-2"></i>My Job Posts</a>
                    <a href="job-applications.php" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Job Applications</a>
                    <a href="mailbox.php" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Mailbox</a>
                    <a href="settings.php" class="nav-item nav-link active"><i class="fa fa-cog me-2"></i>Settings</a>
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
                    <h2 class="text-primary mb-0"><i class="fa fa-user-tie"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <!-- Mailbox dropdown (can be customized further based on actual mailbox implementation) -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Messages</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="mailbox.php" class="dropdown-item text-center">See all messages</a>
                        </div>
                    </div>
                    <!-- Profile Dropdown -->
                    <div class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
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

            <!-- Settings Content Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded p-4">
                    <h2 class="mb-2"><i>Account Settings</i></h2>
                    <p class="mb-4">In this section you can change your company name and account password</p>
                    <div class="row g-4">
                        <!-- Change Password Section -->
                        <div class="col-md-6">
                            <h4 class="mb-3">Change Password</h4>
                            <form id="changePassword" action="change-password.php" method="post">
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="New Password" autocomplete="new-password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cpassword" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm New Password" autocomplete="new-password" required>
                                </div>
                                <div id="passwordError" class="alert alert-danger d-none" role="alert">
                                  Password Mismatch!
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Change Password</button>
                            </form>
                        </div>

                        <!-- Update Name & Deactivate Account Section -->
                        <div class="col-md-6">
                             <h4 class="mb-3">Update Company Name</h4>
                             <form action="update-name.php" method="post" class="mb-5">
                                <div class="mb-3">
                                  <label for="name" class="form-label">Company Name</label>
                                  <input class="form-control" id="name" name="name" type="text" placeholder="Enter New Company Name" value="<?php echo $_SESSION['name']; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Change Name</button>
                             </form>

                             <hr class="my-4"> <!-- Separator -->

                             <h4 class="mb-3">Deactivate Account</h4>
                             <p>Click the button below after checking the box if you wish to permanently deactivate your account.</p>
                            <form action="deactivate-account.php" method="post" class="mt-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="deactivateCheck" required>
                                    <label class="form-check-label" for="deactivateCheck">
                                        I want to deactivate my account.
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-danger">Deactivate My Account</button>
                            </form>
                        </div>
                    </div> <!-- End Row -->
                     <?php
                        // Display success/error messages if redirected back here
                        if(isset($_SESSION['passwordChanged'])) {
                          echo '<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">';
                          echo $_SESSION['passwordChanged'];
                          echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                          unset($_SESSION['passwordChanged']);
                        }
                        if(isset($_SESSION['passwordError'])) {
                          echo '<div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">';
                          echo $_SESSION['passwordError'];
                          echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                          unset($_SESSION['passwordError']);
                        }
                         if(isset($_SESSION['nameChanged'])) {
                          echo '<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">';
                          echo $_SESSION['nameChanged'];
                          echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                          unset($_SESSION['nameChanged']);
                        }
                         if(isset($_SESSION['nameError'])) {
                          echo '<div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">';
                          echo $_SESSION['nameError'];
                          echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                          unset($_SESSION['nameError']);
                        }
                        if(isset($_SESSION['accountDeactivated'])) {
                          echo '<div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">';
                          echo $_SESSION['accountDeactivated'];
                          echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                          unset($_SESSION['accountDeactivated']);
                        }
                     ?>
                </div>
            </div>
            <!-- Settings Content End -->

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
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Custom Script for Password Validation -->
    <script>
      $(document).ready(function() {
        $("#changePassword").on("submit", function(e) {
          var password = $('#password').val();
          var cpassword = $('#cpassword').val();
          if( password !== cpassword ) {
            e.preventDefault(); // Stop form submission
            $('#passwordError').removeClass('d-none'); // Show error message
          } else {
            $('#passwordError').addClass('d-none'); // Hide error message if previously shown
            // Form will submit normally if passwords match
             // $(this).unbind('submit').submit(); // No need to unbind with preventDefault logic
          }
        });

        // Optional: Hide error message when user starts typing again
        $('#password, #cpassword').on('input', function() {
             if ($('#password').val().length > 0 && $('#cpassword').val().length > 0) {
                if ($('#password').val() === $('#cpassword').val()) {
                    $('#passwordError').addClass('d-none');
                }
             } else {
                 $('#passwordError').addClass('d-none'); // Hide if fields are cleared
             }
        });
      });
    </script>
</body>

</html>