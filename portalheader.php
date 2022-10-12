<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>IT Professionals</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  
<style type="text/css">
.nav-link{ color:white;}
.nav-link:hover{
	color:grey;
}
</style>


</head>

<body>

    <?php 
        // start session
        session_start();

        if (!isset($_SESSION['mylogger']) && $_SESSION['mylogger']!='OT_BestIR01') {
          // redirect to login
          //$msg = "<script>alert('You need to login to access this page!')</script>";
          $msg = "You need to login to access this page!";
          
          header("Location: login.php?m=$msg");
          exit();
        }

        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";

        // sanitize function
        function sanitizeInput($data){
          $data = trim($data);
          $data = htmlspecialchars($data);
          $data = addslashes($data);

          return $data;
        }
    ?>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg  fixed-top header-footer-bg" >
    <div class="container">
      <a class="navbar-brand" href="index.html"><img src="images/logo2.png" width='100'></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.html">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sales.php">Sales Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listclubs.php">View Clubs</a>
          </li>
		      <li class="nav-item">
            <a class="nav-link" href="admin.html">View All Members</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="report.html">Payment Report</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Hello 
            <?php 
                if (isset($_SESSION['firstname'])) {
                   echo $_SESSION['firstname']." ".$_SESSION['lastname'];
                }
            ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="profile.html">Edit Profile</a>
              <a class="dropdown-item" href="payments.html">My Payments</a>
              <a class="dropdown-item" href="shop.html">Shop</a>
            </div>
          </li>
           
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
         
        </ul>
		   
      </div>
    </div>
  </nav>