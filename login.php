<?php 

session_start();

if(isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) { 
  header("Location: index.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Job Portal || Login</title>

  <!-- Favicons -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.png">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <link href="assets/css/theme.css" rel="stylesheet" />
  <link href="vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
</head>

<body>
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

    <!-- Login Section -->
    <section class="mt-6">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h1 class="display-3 lh-sm mb-5">Login</h1>
          </div>
        </div>
        <div class="row justify-content-center">
          <!-- Candidate Login Card -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 rounded-3 p-4 bg-primary">
              <div class="card-body text-center">
                <h3 class="text-white mb-4">Candidate Login</h3>
                <p class="text-white-50 mb-4">Access your account to find and apply for jobs</p>
                <a href="login-candidates.php" class="btn btn-light btn-lg">
                  Login as Candidate <i class="fas fa-arrow-right ms-2"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <!-- Company Login Card -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 rounded-3 p-4 bg-secondary">
              <div class="card-body text-center">
                <h3 class="text-white mb-4">Company Login</h3>
                <p class="text-white-50 mb-4">Access your account to post jobs and find candidates</p>
                <a href="login-company.php" class="btn btn-light btn-lg">
                  Login as Company <i class="fas fa-arrow-right ms-2"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

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


  <!-- JavaScripts -->
  <script src="vendors/@popperjs/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="vendors/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/theme.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/adminlte.min.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400&display=swap" rel="stylesheet">
</body>
</html>
