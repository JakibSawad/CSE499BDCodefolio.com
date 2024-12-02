<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>BDcodefolio home</title>


  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.png">


  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
   <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" crossorigin="anonymous"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==">
  <link href="assets/css/theme.css" rel="stylesheet" />

  <link href="vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
</head>


<body>

  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">

    <!-- Navigation -->
    <nav class="navbar navbar-light sticky-top" data-navbar-darken-on-scroll="900">
      <div class="container pt-2">
        <a class="navbar-brand" href="index.php">
          <img src="assets/img/logo.png" alt="logo" />
        </a>
        <div class="navbar-nav ms-auto">
          <div class="row">
            <div class="col">
              <a href="jobs.php" class="btn btn-primary" role="button">Jobs</a>
            </div>
            <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
            <div class="col">
              <a href="login.php" class="btn btn-secondary" role="button">Login</a>
            </div>
            <div class="col">
              <a href="sign-up.php" class="btn btn-secondary" role="button">SignUp</a>
            </div>
            <?php } else { 
              if(isset($_SESSION['id_user'])) { ?>
            <div class="col">
              <a href="user/index.php" class="btn btn-secondary" role="button">Dashboard</a>
            </div>
            <?php } else if(isset($_SESSION['id_company'])) { ?> 
            <div class="col">
              <a href="company/index.php" class="btn btn-secondary" role="button">Dashboard</a>
            </div>
            <?php } ?>
            <div class="col">
              <a href="logout.php" class="btn btn-secondary" role="button">Logout</a>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </nav>


     <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="mt-6">
  
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-9 col-lg-8 col-xl-5">
          <h1 class="display-3 lh-sm">Welcome to Our Job and Portfolio Platform</h1>
        </div>
        <div class="col-md-9 col-xl-5">
          <p class="fs-2">Discover job opportunities posted by top companies, and easily apply with a single click. Our platform is accessible on all devices and browsers for your convenience.</p>
          <button class="btn btn-primary mt-3">Browse Jobs</button>
        </div>
      </div>
    </div>
    <!-- end of .container-->
  
  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->





    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section>

      <div class="container"><img class="img-fluid" src="assets/img/gallery/dashboard.png" alt="Dashboard" />
      </div>
      <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section>

      <div class="container">
        <div class="row mx-md-5 px-md-5 d-flex justify-content-evenly">
          <div class="col-4 col-lg-auto mt-5 mt-lg-0"><img src="assets/img/gallery/brands/google.png" alt="Google"
              style="height:30px;" /></div>
          <div class="col-4 col-lg-auto mt-5 mt-lg-0"><img src="assets/img/gallery/brands/slack.png" alt="Slack"
              style="height:30px;" /></div>
          <div class="col-4 col-lg-auto mt-5 mt-lg-0"><img src="assets/img/gallery/brands/amazon.png" alt="Amazon"
              style="height:30px;" /></div>
          <div class="col-4 col-lg-auto mt-5 mt-lg-0"><img src="assets/img/gallery/brands/zoom.png" alt="Zoom"
              style="height:30px;" /></div>
          <div class="col-4 col-lg-auto mt-5 mt-lg-0"><img src="assets/img/gallery/brands/netflix.png" alt="Netflix"
              style="height:30px;" /></div>
        </div>
        <div class="px-xl-8 px-md-7">
          <hr class="mt-7 text-1000" />
        </div>
      </div>
      <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->




   <!-- ============================================-->
<!-- <section> begin ============================-->
<section>

  <div class="container">
    <h1 class="display-6 fw-semi-bold"> Features</h1>
    <p class="fs-2">Explore the key features that make job searching and application management easy and efficient.</p>
    
    <div class="row mb-4 mt-6">
      <div class="col-md-6">
        <div class="border rounded-1 border-700 h-100 features-items">
          <div class="p-5"><img src="assets/img/gallery/dashboardicon.png" alt="Dashboard"
              style="width:48px;height:48px;" />
            <h3 class="pt-3 lh-base">Company Dashboard</h3>
            <p class="mb-0">A comprehensive dashboard where companies can post jobs, manage applications, and view candidate profiles.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="border rounded-1 border-700 h-100 features-items">
          <div class="p-5"><img src="assets/img/gallery/comment.png" alt="Comment"
              style="width:48px;height:48px;" />
            <h3 class="pt-3 lh-base">Application Feedback</h3>
            <p class="mb-0">An interactive area for companies to provide feedback and comments on applications, helping candidates improve.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-6">
        <div class="border rounded-1 border-700 h-100 features-items">
          <div class="p-5"><img src="assets/img/gallery/trilored.png" alt="Tailored"
              style="width:48px;height:48px;" />
            <h3 class="pt-3 lh-base">Personalized Job Matches</h3>
            <p class="mb-0">Receive tailored job recommendations based on your profile and preferences to streamline your job search.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="border rounded-1 border-700 h-100 features-items">
          <div class="p-5"><img src="assets/img/gallery/statistics.png" alt="Statistic"
              style="width:48px;height:48px;" />
            <h3 class="pt-3 lh-base">Application Statistics</h3>
            <p class="mb-0">Access insights and statistics on your application status, interview invitations, and more.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="border rounded-1 border-700 h-100 features-items">
          <div class="p-5"><img src="assets/img/gallery/profile.png" alt="Profiles"
              style="width:48px;height:48px;" />
            <h3 class="pt-3 lh-base">User Profiles</h3>
            <p class="mb-0">Create a detailed profile to showcase your skills, experience, and qualifications to prospective employers.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="border rounded-1 border-700 h-100 features-items">
          <div class="p-5"><img src="assets/img/gallery/folder.png" alt="Folders" style="width:48px;height:48px;" />
            <h3 class="pt-3 lh-base">Application Management</h3>
            <p class="mb-0">Organize and track your job applications in one place, making it easier to manage multiple applications.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->




<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="mt-5">

  <div class="container">
    <div class="text-center">
      <div class="p-5 bg-primary rounded-3">
        <div class="py-3">
          <h4 class="opacity-50 ls-2 lh-base fw-medium">READY TO START YOUR JOB SEARCH?</h4>
          <h2 class="mt-3 fs-4 fs-sm-7 latter-sp-3 lh-base fw-semi-bold">Create Your Free Profile Today</h2>
        </div>
        <div class="flex-center d-flex">
          <button class="btn btn-info">Get Started <span class="fas fa-arrow-right"></span></button>
        </div>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->





   <!-- ============================================-->
<!-- <section> begin ============================-->
<section class="mt-5">

  <div class="container">
    <div class="text-center">
      <p class="fs-2 ls-2">SAFLOW</p>
      <h1 class="display-6 fw-semi-bold">How Does It Work?</h1>
    </div>

    <!-- Step 1: Create a Profile -->
    <div class="row mt-6 flex-center justify-content-xl-evenly px-xl-5">
      <div class="col-md-7 col-lg-6 order-md-1">
        <img class="w-100" src="assets/img/gallery/comment1.png" alt="Profile Setup" />
      </div>
      <div class="col-md-5 col-lg-4">
        <h3 class="fs-xl-7 fs-lg-4 fs-md-3 mt-5 mt-md-0">Step 1: Create Your Profile</h3>
        <p class="fs-xl-1 ls-3 pe-xl-2">Sign up and create a profile to showcase your skills, experience, and career interests to potential employers.</p>
      </div>
    </div>

    <!-- Step 2: Browse Job Listings -->
    <div class="row mt-6 flex-center justify-content-xl-evenly px-xl-5">
      <div class="col-md-7 col-lg-6">
        <img class="w-100" src="assets/img/gallery/comment2.png" alt="Browse Jobs" />
      </div>
      <div class="col-md-5 col-lg-4">
        <h3 class="fs-xl-7 fs-lg-4 fs-md-3 mt-5 mt-md-0">Step 2: Browse Job Listings</h3>
        <p class="fs-xl-1 ls-3 pe-xl-2">Explore job openings posted by top companies and find positions that match your skills and career goals.</p>
      </div>
    </div>

    <!-- Step 3: Apply and Track Applications -->
    <div class="row mt-6 flex-center justify-content-xl-evenly px-xl-5">
      <div class="col-md-7 col-lg-6 order-md-1">
        <img class="w-100" src="assets/img/gallery/comment3.png" alt="Apply and Track" />
      </div>
      <div class="col-md-5 col-lg-4">
        <h3 class="fs-xl-7 fs-lg-4 fs-md-3 mt-5 mt-md-0">Step 3: Apply and Track Applications</h3>
        <p class="fs-xl-1 ls-3 pe-xl-2">Submit your applications with ease and track the status of each one, from submission to interview.</p>
      </div>
    </div>

  </div>
  <!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->


            

    <!-- ============================================-->
<!-- <section> begin ============================-->
<section>

  <div class="container-lg">
    <div class="text-center">
      <p class="fs-2 ls-2">SAFLOW</p>
      <h1 class="display-6 fw-semi-bold">Pricing Plans for Companies</h1>
    </div>
    <div class="row flex-center">
      
      <!-- Free Plan -->
      <div class="col-sm-9 col-md-4 mt-3">
        <div class="py-5 px-4 px-md-3 px-lg-4 rounded-1 bg-800 plans-cards mt-md-9">
          <p class="fs-2 ls-2">FREE</p>
          <h1 class="display-4 ls-3"><span class="text-600">$</span>0</h1>
          <hr class="hr mt-6 text-1000" />
          <ul class="mt-5 ps-0">
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>1 Job Posting</li>
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>Basic Candidate Search</li>
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>Email Support</li>
          </ul>
          <button class="btn btn-gray mt-4">Get Started <span class="fas fa-arrow-right"></span></button>
        </div>
      </div>
      
      <!-- Basic Plan -->
      <div class="col-sm-9 col-md-4 mt-3">
        <div class="py-5 px-4 px-md-3 px-lg-4 rounded-1 bg-800 plans-cards mt-0">
          <p class="fs-2 ls-2">BASIC</p>
          <h1 class="display-4 ls-3"><span class="text-600">$</span>23</h1>
          <hr class="hr mt-6 text-1000" />
          <ul class="mt-5 ps-0">
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>Up to 5 Job Postings</li>
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>Enhanced Candidate Search</li>
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>Priority Email Support</li>
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>Applicant Tracking</li>
          </ul>
          <button class="btn btn-gray mt-4">Get Started <span class="fas fa-arrow-right"></span></button>
        </div>
      </div>
      
      <!-- Premium Plan -->
      <div class="col-sm-9 col-md-4 mt-3">
        <div class="py-5 px-4 px-md-3 px-lg-4 rounded-1 bg-800 plans-cards mt-md-9">
          <p class="fs-2 ls-2">PREMIUM</p>
          <h1 class="display-4 ls-3"><span class="text-600">$</span>59</h1>
          <hr class="hr mt-6 text-1000" />
          <ul class="mt-5 ps-0">
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>Unlimited Job Postings</li>
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>Advanced Candidate Search</li>
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>24/7 Dedicated Support</li>
            <li class="pricing-lists"><i class="fas fa-check-circle fa-lg me-2 text-600"></i>Applicant Tracking & Analytics</li>
          </ul>
          <button class="btn btn-gray mt-4">Get Started <span class="fas fa-arrow-right"></span></button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->



<!-- ============================================-->
<!-- <section> begin ============================-->
<section>

  <div class="container">
    <div class="text-center text-xl-start">
      <div class="p-5 bg-primary rounded-3 d-flex flex-column justify-content-xl-between flex-xl-row">
        <div class="py-3">
          <h4 class="opacity-50 ls-2 lh-base fw-medium">JOIN US TODAY</h4>
          <h2 class="mt-3 fs-4 fs-sm-7 latter-sp-3 lh-base fw-semi-bold">Create a Company Profile and Post Your First Job</h2>
        </div>
        <div class="flex-center d-flex">
          <button class="btn btn-info">Sign Up Now <span class="fas fa-arrow-right"></span></button>
        </div>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->





        <!-- Footer -->
    <section class="bg-secondary mt-6">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 text-center text-xl-start">
            <a href="#!"><img class="footer-img me-xl-5 me-3" src="assets/img/gallery/facebook-line1.svg" alt="fb" style="width:20px;height:20px;" /></a>
            <a href="#!"><img class="footer-img me-xl-5 me-3" src="assets/img/gallery/linkedin-line1.svg" alt="in" style="width:20px;height:20px;" /></a>
            <a href="#!"><img class="footer-img me-xl-5 me-3" src="assets/img/gallery/twitter-line1.svg" alt="twitter" style="width:20px;height:20px;" /></a>
            <a href="#!"><img class="footer-img me-xl-5 me-3" src="assets/img/gallery/instagram-line1.svg" alt="instagram" style="width:20px;height:20px;" /></a>
          </div>
          <div class="col-xl-4 pt-2 pt-xl-0">
            <p class="mb-0 text-center text-xl-end">
              <a class="text-300 text-decoration-none footer-link" href="#!">Terms &amp; Conditions</a>
              <a class="text-300 text-decoration-none footer-link ps-4" href="#!">Privacy Policy</a>
            </p>
          </div>
          <div class="col-xl-5 pt-2 pt-xl-0 text-center text-xl-end">
            <p class="mb-0">&copy; 2024 Job Portal. All rights reserved.</p>
          </div>
        </div>
      </div>
    </section>
  </main>


  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->




  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="vendors/@popperjs/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="vendors/swiper/swiper-bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100;200;300;400;500;600;700;800&amp;display=swap"
    rel="stylesheet">
  <script src="assets/js/theme.js"></script>
  <!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>

  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400&amp;display=swap"
    rel="stylesheet">
</body>

</html>
