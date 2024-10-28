<?php
session_start();

if(isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) { 
  header("Location: index.php");
  exit();
}

require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Job Portal || Create Company Profile</title>

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

    <!-- Registration Form Section -->
    <section class="mt-6">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h1 class="display-3 lh-sm mb-5">Create Company Profile</h1>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card rounded-3 p-4">
              <div class="card-body">
                <form method="post" id="registerCompanies" action="addcompany.php" enctype="multipart/form-data">
                  <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <input class="form-control form-control-lg" type="text" name="name" placeholder="Full Name *" required>
                      </div>
                      <div class="form-group mb-3">
                        <input class="form-control form-control-lg" type="text" name="companyname" placeholder="Company Name *" required>
                      </div>
                      <div class="form-group mb-3">
                        <input class="form-control form-control-lg" type="text" name="website" placeholder="Website">
                      </div>
                      <div class="form-group mb-3">
                        <input class="form-control form-control-lg" type="text" name="email" placeholder="Email *" required>
                      </div>
                      <div class="form-group mb-3">
                        <textarea class="form-control form-control-lg" rows="4" name="aboutme" placeholder="Brief info about your company *" required></textarea>
                      </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <input class="form-control form-control-lg" type="password" name="password" id="password" placeholder="Password *" required>
                      </div>
                      <div class="form-group mb-3">
                        <input class="form-control form-control-lg" type="password" name="cpassword" id="cpassword" placeholder="Confirm Password *" required>
                      </div>
                      <div id="passwordError" class="alert alert-danger d-none">
                        Password Mismatch!!
                      </div>
                      <div class="form-group mb-3">
                        <input class="form-control form-control-lg" type="text" name="contactno" placeholder="Phone Number *" minlength="10" maxlength="10" onkeypress="return validatePhone(event);" required>
                      </div>
                      <div class="form-group mb-3">
                        <select class="form-control form-control-lg" id="country" name="country" required>
                          <option selected="" value="">Select Country *</option>
                          <?php
                            $sql="SELECT * FROM countries";
                            $result=$conn->query($sql);

                            if($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['name']."' data-id='".$row['id']."'>".$row['name']."</option>";
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div id="stateDiv" class="form-group mb-3" style="display: none;">
                        <select class="form-control form-control-lg" id="state" name="state" required>
                          <option value="" selected="">Select State *</option>
                        </select>
                      </div>
                      <div id="cityDiv" class="form-group mb-3" style="display: none;">
                        <select class="form-control form-control-lg" id="city" name="city" required>
                          <option selected="">Select City *</option>
                        </select>
                      </div>
                      <div class="form-group mb-3">
                        <label class="form-label">Company Logo *</label>
                        <input type="file" name="image" class="form-control form-control-lg" required>
                      </div>
                    </div>

                    <!-- Footer Elements -->
                    <div class="col-12">
                      <div class="form-group mb-3">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" required>
                          <label class="form-check-label">
                            I accept terms & conditions
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">Register Company</button>
                      </div>

                      <?php if(isset($_SESSION['registerError'])) { ?>
                        <div class="alert alert-danger mt-3">
                          Email Already Exists! Choose A Different Email!
                        </div>
                      <?php unset($_SESSION['registerError']); } ?>

                      <?php if(isset($_SESSION['uploadError'])) { ?>
                        <div class="alert alert-danger mt-3">
                          <?php echo $_SESSION['uploadError']; ?>
                        </div>
                      <?php unset($_SESSION['uploadError']); } ?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <section class="bg-secondary mt-6">
      <div class="container">
        <div class="row py-4">
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
  <script src="js/adminlte.min.js"></script>

  <!-- Custom Scripts -->
  <script>
    function validatePhone(event) {
      var key = window.event ? event.keyCode : event.which;
      if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
        return true;
      } else if(key < 48 || key > 57) {
        return false;
      }
      return true;
    }

    $("#country").on("change", function() {
      var id = $(this).find(':selected').attr("data-id");
      $("#state").find('option:not(:first)').remove();
      if(id != '') {
        $.post("state.php", {id: id}).done(function(data) {
          $("#state").append(data);
        });
        $('#stateDiv').show();
      } else {
        $('#stateDiv').hide();
        $('#cityDiv').hide();
      }
    });

    $("#state").on("change", function() {
      var id = $(this).find(':selected').attr("data-id");
      $("#city").find('option:not(:first)').remove();
      if(id != '') {
        $.post("city.php", {id: id}).done(function(data) {
          $("#city").append(data);
        });
        $('#cityDiv').show();
      } else {
        $('#cityDiv').hide();
      }
    });

    $("#registerCompanies").on("submit", function(e) {
      e.preventDefault();
      if($('#password').val() != $('#cpassword').val()) {
        $('#passwordError').removeClass('d-none');
      } else {
        $(this).unbind('submit').submit();
      }
    });
  </script>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400&display=swap" rel="stylesheet">
</body>
</html>
