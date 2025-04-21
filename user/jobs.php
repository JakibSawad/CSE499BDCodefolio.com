<?php
// To Handle Session Variables on This Page
session_start();

// Including Database Connection From db.php file
require_once("db.php"); // Assumes db.php is in the same directory
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Job Portal - Available Jobs</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon"> <!-- Adjust path if needed -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="user/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> <!-- Use user/ or adjust path -->
    <link href="user/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> <!-- Use user/ or adjust path -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="user/css/bootstrap.min.css" rel="stylesheet"> <!-- Use user/ or adjust path -->

    <!-- Template Stylesheet -->
    <link href="user/css/style.css" rel="stylesheet"> <!-- Use user/ or adjust path -->

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        /* Optional: Style adjustments for DataTables */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: #adb5bd; /* Lighter text for better contrast on dark background */
        }
        .dataTables_wrapper .dataTables_length select {
            background-color: #6c757d; /* Darker background for select */
            color: white;
        }
        .dataTables_wrapper .dataTables_filter input {
            background-color: #6c757d; /* Darker background for search */
            color: white;
            border: 1px solid #888;
        }
         .page-item.disabled .page-link {
            background-color: #6c757d;
            border-color: #888;
            color: #aaa;
         }
         .page-item.active .page-link {
             background-color: #007bff; /* Primary color */
             border-color: #007bff;
         }
         .page-link {
            background-color: #6c757d;
            border-color: #888;
            color: white;
         }
         .page-link:hover {
            background-color: #5a6268;
            color: white;
         }
         /* Ensure table content is readable */
         #jobsTable tbody td {
            color: #fff; /* White text for table data */
         }
         #jobsTable thead th {
             color: #fff; /* White text for table headers */
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

        <?php if(isset($_SESSION['id_user'])) { ?>
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-tie me-2"></i>Job Portal</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <!-- You might want to add logic to display a user-specific profile picture -->
                        <img class="rounded-circle" src="user/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['name']; ?></h6>
                        <span>User</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <!-- User Specific Links -->
                    <a href="user/index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="user/edit-profile.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Edit Profile</a>
                    <a href="jobs.php" class="nav-item nav-link active"><i class="fa fa-list-ul me-2"></i>Jobs</a> <!-- Active Link -->
                    <a href="user/my-applications.php" class="nav-item nav-link"><i class="fa fa-briefcase me-2"></i>My Applications</a>
                    <a href="user/mailbox.php" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Mailbox</a>
                    <a href="user/settings.php" class="nav-item nav-link"><i class="fa fa-cog me-2"></i>Settings</a>
                    <a href="logout.php" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
        <?php } else { ?>
         <!-- Optional: Placeholder or alternative sidebar/navbar for non-logged-in users viewing jobs -->
         <!-- Or just have the content area take full width -->
         <style> .content { margin-left: 0 !important; } </style>
        <?php } ?>

        <!-- Content Start -->
        <div class="content <?php echo isset($_SESSION['id_user']) ? '' : 'w-100'; ?>"> <!-- Adjust class if no sidebar -->
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-tie"></i></h2>
                </a>
                 <?php if(isset($_SESSION['id_user'])) { ?>
                 <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                 <?php } ?>
                <!-- Optional Search Bar in Navbar -->
                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search Jobs">
                </form> -->
                <div class="navbar-nav align-items-center ms-auto">
                    <?php if(isset($_SESSION['id_user'])) { ?>
                    <!-- Logged In User Navbar Items -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                             <!-- User profile image -->
                             <img class="rounded-circle me-lg-2" src="user/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['name']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="user/edit-profile.php" class="dropdown-item">My Profile</a>
                            <a href="user/settings.php" class="dropdown-item">Settings</a>
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                    <?php } else { ?>
                    <!-- Links for Non-Logged In Users -->
                    <a href="login.php" class="nav-item nav-link">Login</a>
                    <a href="sign-up.php" class="nav-item nav-link">Sign Up</a>
                    <?php } ?>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Job Listings Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0 text-primary">Available Job Postings</h3>
                        <!-- Maybe add filter/sort options here later -->
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0" id="jobsTable">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Min Salary</th>
                                    <th scope="col">Max Salary</th>
                                    <th scope="col">Experience</th>
                                    <th scope="col">Posted On</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // SQL Query to fetch job posts and company names
                                // Fetch jobs that are ideally marked as 'active' if you have such a status column
                                // Example: SELECT job_post.*, company.companyname FROM job_post INNER JOIN company ON job_post.id_company = company.id_company WHERE job_post.active=1 ORDER BY job_post.createdat DESC
                                $sql = "SELECT job_post.*, company.companyname
                                        FROM job_post
                                        INNER JOIN company ON job_post.id_company = company.id_company
                                        ORDER BY job_post.createdat DESC"; // Order by most recent
                                $result = $conn->query($sql);

                                if ($result === false) {
                                    // Output error information
                                    echo "Error executing query: " . $conn->error;
                                } elseif ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['jobtitle']); ?></td>
                                            <td><?php echo htmlspecialchars($row['companyname']); ?></td>
                                            <td><?php echo htmlspecialchars($row['joblocation']); ?></td>
                                            <td><?php echo htmlspecialchars($row['minimumsalary']); ?></td>
                                            <td><?php echo htmlspecialchars($row['maximumsalary']); ?></td>
                                            <td><?php echo htmlspecialchars($row['experience']); ?> Years</td>
                                            <td><?php echo date("d-M-Y", strtotime($row['createdat'])); ?></td>
                                            <td>
                                                <!-- Link to a page showing job details (create this page) -->
                                                <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-sm btn-primary">View</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="8" class="text-center text-white">No job postings found.</td></tr>';
                                }
                                $conn->close(); // Close connection
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Job Listings End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            © <a href="#">Job Portal</a>, All Rights Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                             Designed By <a href="#">Team Heisenberg</a><br>
                             Distributed By <a href="#">NSU CSE</a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is loaded first -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="user/lib/chart/chart.min.js"></script> <!-- Adjust path -->
    <script src="user/lib/easing/easing.min.js"></script> <!-- Adjust path -->
    <script src="user/lib/waypoints/waypoints.min.js"></script> <!-- Adjust path -->
    <script src="user/lib/owlcarousel/owl.carousel.min.js"></script> <!-- Adjust path -->
    <script src="user/lib/tempusdominus/js/moment.min.js"></script> <!-- Adjust path -->
    <script src="user/lib/tempusdominus/js/moment-timezone.min.js"></script> <!-- Adjust path -->
    <script src="user/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script> <!-- Adjust path -->

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Template Javascript -->
    <script src="user/js/main.js"></script> <!-- Adjust path -->

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#jobsTable').DataTable({
                "paging": true,         // Enable pagination
                "lengthChange": true,   // Allow user to change number of rows shown
                "searching": true,      // Enable search box
                "ordering": true,       // Enable column sorting
                "info": true,           // Show 'Showing x to y of z entries'
                "autoWidth": false,     // Disable auto-width calculation
                "responsive": true      // Enable responsive design features (optional, might need responsive extension)
                // Add language options if needed for pagination/search text
            });
        });
    </script>
</body>

</html>
