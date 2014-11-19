<?php
  session_start();
$row = $_SESSION['user'];
$str = implode(" ", $row);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        body { background: url(assets/bglight.png); }
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }
    </style>
</head>
<body>
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand">PHP Signup + Bootstrap Example</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?><strong class="caret"></strong></a>
            <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
              <li><a href="myaccount.php">My Account</a></li>
              <li class=divider></li>
              <li><a href="logout.php">Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
 
</body>
</html>
