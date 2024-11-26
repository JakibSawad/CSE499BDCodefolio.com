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

  <title>Job Portal</title>

  <!-- Favicons -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.png">

  <!-- Stylesheets -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Custom Theme Styles -->
  <link href="assets/css/theme.css" rel="stylesheet" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100;200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
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

    <!-- Content Wrapper -->
    <section class="content-header mt-6">
      <div class="container">
        <div class="row">
          <div class="col-md-12 latest-job margin-top-50 margin-bottom-20">
            <h1 class="text-center display-6 fw-semi-bold">Latest Jobs</h1>  
            <div class="input-group input-group-lg">
              <input type="text" id="searchBar" class="form-control" placeholder="Search job">
              <span class="input-group-btn">
                <button id="searchBtn" type="button" class="btn btn-primary btn-flat">Search</button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="candidates" class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Filters</h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked tree" data-widget="tree">
                  <li class="treeview menu-open">
                    <a href="#"><i class="fa fa-plane text-red"></i> City <span class="pull-right"><i class="fa fa-angle-down pull-right"></i></span></a>
                    <ul class="treeview-menu">
                      <li><a href=""  class="citySearch" data-target="Delhi"><i class="fa fa-circle-o text-yellow"></i> Delhi</a></li>
                      <li><a href="" class="citySearch" data-target="Kouba"><i class="fa fa-circle-o text-yellow"></i> Kouba</a></li>
                    </ul>
                  </li>
                  <li class="treeview menu-open">
                    <a href="#"><i class="fa fa-plane text-red"></i> Experience <span class="pull-right"><i class="fa fa-angle-down pull-right"></i></span></a>
                    <ul class="treeview-menu">
                      <li><a href="" class="experienceSearch" data-target='1'><i class="fa fa-circle-o text-yellow"></i> > 1 Years</a></li>
                      <li><a href="" class="experienceSearch" data-target='2'><i class="fa fa-circle-o text-yellow"></i> > 2 Years</a></li>
                      <li><a href="" class="experienceSearch" data-target='3'><i class="fa fa-circle-o text-yellow"></i> > 3 Years</a></li>
                      <li><a href="" class="experienceSearch" data-target='4'><i class="fa fa-circle-o text-yellow"></i> > 4 Years</a></li>
                      <li><a href="" class="experienceSearch" data-target='5'><i class="fa fa-circle-o text-yellow"></i> > 5 Years</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <?php
            $limit = 4;

            $sql = "SELECT COUNT(id_jobpost) AS id FROM job_post";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
              $row = $result->fetch_assoc();
              $total_records = $row['id'];
              $total_pages = ceil($total_records / $limit);
            } else {
              $total_pages = 1;
            }
            ?>
            
            <div id="target-content" >
              
            </div>
            <div class="text-center" >
              <ul class="pagination text-center" id="pagination"></ul>
            </div> 
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <section class="bg-secondary">
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
            <a class="text-300 text-decoration-none footer-link" href="#">Terms &amp; condition</a>
            <a class="text-300 text-decoration-none footer-link ps-4" href="#">Privacy Policy</a>
          </p>
        </div>
        <div class="col-xl-5 pt-2 pt-xl-0 text-center text-xl-end">
          <p class="mb-0">&copy; This template is made with by <a class="text-300" href="https://themewagon.com/" target="_blank">ThemeWagon</a></p>
        </div>
      </div>
    </div>
  </section>

  <!-- JavaScripts -->
  <script src="vendors/@popperjs/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="assets/js/theme.js"></script>

  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="js/adminlte.min.js"></script>
  <script src="js/jquery.twbsPagination.min.js"></script>

  <script>
  function Pagination() {
    $("#pagination").twbsPagination({
      totalPages: <?php echo $total_pages; ?>,
      visible: 5,
      onPageClick: function (e, page) {
        e.preventDefault();
        $("#target-content").html("loading....");
        $("#target-content").load("jobpagination.php?page="+page);
      }
    });
  }

  $(function () {
    Pagination();
  });

  $("#searchBtn").on("click", function(e) {
    e.preventDefault();
    var searchResult = $("#searchBar").val();
    var filter = "searchBar";
    if(searchResult != "") {
      $("#pagination").twbsPagination('destroy');
      Search(searchResult, filter);
    } else {
      $("#pagination").twbsPagination('destroy');
      Pagination();
    }
  });

  $(".experienceSearch").on("click", function(e) {
    e.preventDefault();
    var searchResult = $(this).data("target");
    var filter = "experience";
    if(searchResult != "") {
      $("#pagination").twbsPagination('destroy');
      Search(searchResult, filter);
    } else {
      $("#pagination").twbsPagination('destroy');
      Pagination();
    }
  });

  $(".citySearch").on("click", function(e) {
    e.preventDefault();
    var searchResult = $(this).data("target");
    var filter = "city";
    if(searchResult != "") {
      $("#pagination").twbsPagination('destroy');
      Search(searchResult, filter);
    } else {
      $("#pagination").twbsPagination('destroy');
      Pagination();
    }
  });

  function Search(val, filter) {
    $("#pagination").twbsPagination({
      totalPages: <?php echo $total_pages; ?>,
      visible: 5,
      onPageClick: function (e, page) {
        e.preventDefault();
        val = encodeURIComponent(val);
        $("#target-content").html("loading....");
        $("#target-content").load("search.php?page="+page+"&search="+val+"&filter="+filter);
      }
    });
  }
  </script>
</body>
</html>
