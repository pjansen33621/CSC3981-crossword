<?php session_start() ?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <title>MPT Games: Crossword Generator | About Us</title>
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
      <a class="brand" href="index.php">MPT Games</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
        <?php if(isset($_SESSION['user'])) { ?>
          <li><a href="aboutus.php">About Us</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown"><?php echo $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname']; ?><strong class="caret"></strong></a>
            <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
              <li><a href="myaccount.php">My Account</a></li>
              <li class=divider></li>
              <li><a href="logout.php">Log Out</a></li>
            </ul>
          </li>
        <?php } else { ?>
          <li><a href="register.php">Register</a></li>
          <li><a href="about.php">About Us</a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In <strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
              <form action="index.php" method="post"> 
                    Username:<br /> 
                    <input type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
                    <br /><br /> 
                    Password:<br /> 
                    <input type="password" name="password" value="" /> 
                    <br /><br /> 
                    <input type="submit" class="btn btn-info" value="Login" /> 
                </form> 
            </div>
            </li>
        <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>
 
<div class="container hero-unit">
   <h2>About Us</h2>
   <p>MPT games is a company that develops puzzle games for the internet.</p>
   <p>IT consists of students Maria, Peter, and Tom.</p>
</div>
</body>
</html>
