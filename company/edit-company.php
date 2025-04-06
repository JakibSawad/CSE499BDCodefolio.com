<?php
//To Handle Session Variables on This Page
session_start();

//If company Not logged in then redirect them back to homepage. 
// *** LOGIC CHANGE: Check for 'id_company' instead of 'id_user' ***
if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

// *** Kept from original logic ***
require_once("../db.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- *** Title changed to reflect company context *** -->
    <title>Job Portal - Edit Company Profile</title> 
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon"> <!-- Assuming template assets are available -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Assuming template assets are available -->

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet"> <!-- Assuming template assets are available -->
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
                    <!-- *** Title changed slightly *** -->
                    <h3 class="text-primary"><i class="fa fa-building me-2"></i>Job Portal</h3> 
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <!-- Optional: Use a default company image or fetch logo if available -->
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;"> 
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <!-- *** Displaying company name from session *** -->
                        <h6 class="mb-0"><?php echo $_SESSION['name']; ?></h6>
                        <span>Company</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <!-- *** Sidebar links updated for Company context *** -->
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="edit-company.php" class="nav-item nav-link active"><i class="fa fa-building me-2"></i>My Company</a>
                    <a href="create-job-post.php" class="nav-item nav-link"><i class="fa fa-plus-square me-2"></i>Create Job Post</a>
                    <a href="my-job-post.php" class="nav-item nav-link"><i class="fa fa-list me-2"></i>My Job Posts</a>
                    <a href="job-applications.php" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Job Applications</a>
                    <a href="mailbox.php" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Mailbox</a>
                    <a href="settings.php" class="nav-item nav-link"><i class="fa fa-cog me-2"></i>Settings</a>
                    <a href="resume-database.php" class="nav-item nav-link"><i class="fa fa-search me-2"></i>Resume Database</a>
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
                    <h2 class="text-primary mb-0"><i class="fa fa-building"></i></h2> <!-- Icon changed -->
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Messages</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <!-- Add message items here if needed -->
                            <a href="mailbox.php" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Go to Mailbox</h6>
                            </a>
                           <!-- Example:
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                           -->
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <!-- Optional: Use default image or fetch logo -->
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;"> 
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['name']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <!-- *** Dropdown links adjusted *** -->
                            <a href="edit-company.php" class="dropdown-item">My Company</a>
                            <a href="settings.php" class="dropdown-item">Settings</a>
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Edit Company Profile Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded p-4">
                    <!-- *** Title and description updated *** -->
                    <h2 class="mb-4"><i class="fa fa-building me-2"></i>Edit Company Profile</h2>
                    <p class="mb-4">In this section you can change your company details.</p> 
                    
                    <!-- *** Form action updated, enctype added *** -->
                    <form action="update-company.php" method="post" enctype="multipart/form-data"> 
                    <?php
                    // *** SQL query updated for company table and id_company ***
                    $sql = "SELECT * FROM company WHERE id_company='$_SESSION[id_company]'";
                    $result = $conn->query($sql);

                    //If company exists then show details.
                    if($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                    ?>
                        <!-- *** Using Bootstrap 5 grid (g-4) from the first template *** -->
                        <div class="row g-4"> 
                            <div class="col-md-6">
                                <!-- *** Fields adapted from second file's logic, using first file's Bootstrap 5 structure *** -->
                                <div class="mb-3">
                                    <label for="companyname" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name" value="<?php echo $row['companyname']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="text" class="form-control" id="website" name="website" placeholder="Website" value="<?php echo $row['website']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $row['email']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="aboutme" class="form-label">About Company</label> <!-- Label changed slightly -->
                                    <textarea id="aboutme" name="aboutme" class="form-control" rows="5" placeholder="Descripe your company"><?php echo $row['aboutme']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contactno" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact Number" value="<?php echo $row['contactno']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $row['city']; ?>" placeholder="City">
                                </div>
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="State" value="<?php echo $row['state']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Change Company Logo</label>
                                    <!-- *** File input name changed to 'image' *** -->
                                    <input type="file" name="image" id="image" class="form-control bg-dark">
                                     <!-- *** Display existing logo logic kept *** -->
                                    <?php if($row['logo'] != "") { ?>
                                    <img src="../uploads/logo/<?php echo $row['logo']; ?>" class="img-fluid mt-3" style="max-height: 150px; max-width: 150px;"> <!-- Using img-fluid and adjusted style -->
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <!-- *** Button text updated *** -->
                                <button type="submit" class="btn btn-primary">Update Company Profile</button> 
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>   
                    </form>
                    
                    <!-- *** Error message display structure kept, session variable check kept *** -->
                    <?php if(isset($_SESSION['uploadError'])) { ?>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php 
                                  echo $_SESSION['uploadError']; 
                                  unset($_SESSION['uploadError']); // Unset after displaying
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Edit Company Profile End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            © <a href="#">Job Portal</a>, All Rights Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                           <!-- You can keep or change these credits -->
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
    <!-- *** Kept JS libraries from the first template *** -->
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
    <script src="js/main.js"></script> <!-- Assuming template assets are available -->
</body>

</html>