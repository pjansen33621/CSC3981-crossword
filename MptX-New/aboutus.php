<?php session_start() ?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <title>MPT Games: Crossword Construction Set</title>
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
    <h1>There's secret content to be had within!</h1>
    <p>But you can't access it just yet! You'll need to log in first. Use Bootstrap's nifty navbar dropdown to access the form.</p>
    <h2>There are 2 ways you can log in:</h2>
    <ul>
        <li>Try out your own user + password with the <strong>Register</strong> button in the navbar.</li>
        <li>Use the default credentials to save time:<br />
            <strong>user:</strong> admin<br />
            <strong>pass:</strong> password<br /></li>
    </ul>
</div>
</body>
</html>
