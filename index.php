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

  <!-- Document Title-->
  <title>Portfolio Website Home</title>

  <!-- Favicons-->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.png">

  <!-- Stylesheets-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/custom.css">
</head>

<body>
  <!-- Main Content-->
  <main class="main" id="top">

    <!-- Navigation -->
    <nav class="navbar navbar-light sticky-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="assets/img/logo.png" alt="logo" />
        </a>
        <div class="navbar-nav ms-auto">
          <div class="row">
            <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
            <div class="col">
              <a href="login.php" class="btn btn-secondary">Login</a>
            </div>
            <div class="col">
              <a href="sign-up.php" class="btn btn-secondary">Sign Up</a>
            </div>
            <?php } else { 
              if(isset($_SESSION['id_user'])) { ?>
            <div class="col">
              <a href="user/dashboard.php" class="btn btn-secondary">User Dashboard</a>
            </div>
            <?php } else if(isset($_SESSION['id_company'])) { ?> 
            <div class="col">
              <a href="company/dashboard.php" class="btn btn-secondary">Company Dashboard</a>
            </div>
            <?php } ?>
            <div class="col">
              <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </nav>

    <!-- About Section-->
    <section class="mt-6">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h1 class="display-4">Welcome to Our Portfolio Platform</h1>
            <p class="fs-3">Showcase your company's achievements, connect with top talents, and build your network.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section-->
    <section>
      <div class="container">
        <h1 class="display-6">Key Features</h1>
        <div class="row mt-4">
          <div class="col-md-6">
            <div class="feature-box">
              <h3>User Profiles</h3>
              <p>Users can create and showcase their portfolios, skills, and experiences.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="feature-box">
              <h3>Company Portfolios</h3>
              <p>Companies can build profiles, share milestones, and list job openings.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- How it Works Section-->
    <section class="mt-6">
      <div class="container">
        <div class="text-center">
          <h1>How Does It Work?</h1>
        </div>
        <div class="row mt-4">
          <div class="col-md-6">
            <h3>For Users</h3>
            <p>Create a profile, upload your projects, and connect with companies.</p>
          </div>
          <div class="col-md-6">
            <h3>For Companies</h3>
            <p>Build a portfolio, showcase your achievements, and find talent.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing Section-->
    <section class="mt-6">
      <div class="container">
        <h1>Pricing Plans</h1>
        <div class="row">
          <div class="col-md-4">
            <div class="pricing-box">
              <h3>Basic</h3>
              <p>Free access for individuals</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="pricing-box">
              <h3>Pro</h3>
              <p>$30/month for companies</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section-->
    <section class="mt-6">
      <div class="container text-center">
        <h2>Ready to Start?</h2>
        <button class="btn btn-primary">Join Now</button>
      </div>
    </section>
    
  </main>

</body>
</html>



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
