<?php
require("config.php");
if(!empty($_POST))
{
  // Ensure that the user fills out fields
  if(empty($_POST['firstname']))
  { die("Please enter your first name."); }
  if(empty($_POST['lastname']))
  { die("Please enter your last name."); }
  if(empty($_POST['username']))
  { die("Please enter a username."); }
  if(empty($_POST['password']))
  { die("Please enter a password."); }
  if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
  { die("Invalid E-Mail Address"); }

  // Check if the username is already taken
  $query = "
SELECT
1
FROM users
WHERE
username = :username
";
  $query_params = array (':username' => $_POST['username'] );
  try {
    $stmt = $db->prepare($query);
    $result = $stmt->execute($query_params);
  }
  catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
  $row = $stmt->fetch();
  if($row){ die("This username is already in use"); }
  $query = "
SELECT
1
FROM users
WHERE
email = :email
";
  $query_params = array(
    ':email' => $_POST['email']
  );
  try {
    $stmt = $db->prepare($query);
    $result  = $stmt->execute($query_params);
  }
  catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage());}
  $row = $stmt->fetch();
  if($row){ die("This email address is already registered"); }
  
  if ($_POST['password'] != $_POST['password_confirm']) { die ("The passwords do not match"); }
  

  // Add row to database
  $query = "
    INSERT INTO users (
      firstname,
      lastname,
      username,
      password,
      email
    ) VALUES (
      :firstname,
      :lastname,
      :username,
      :password,
      :email
    )
    ";

// Security measures
  $query_params = array(
    ':firstname' => $_POST['firstname'],
    ':lastname' => $_POST['lastname'],
    ':username' => $_POST['username'],
    ':password' => $_POST['password'],
    ':email' => $_POST['email']
  );
  try {
    $stmt = $db->prepare($query);
    $result = $stmt->execute($query_params);
  }
  catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
  header("Location: index.php");
  die("Redirecting to index.php");
  }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SHIELD - Free Bootstrap 3 Theme">
    <meta name="author" content="Carlos Alvarez - Alvarez.is - blacktie.co">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>MPT Gaming</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link href="assets/css/animate-custom.css" rel="stylesheet">



    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <script src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/modernizr.custom.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>


<div id="navbar-main">
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-shield" style="font-size:30px; color:#3498db;"></span>
                </button>
                <a class="navbar-brand hidden-xs hidden-sm" href="#home"><span class="icon icon-shield" style="font-size:18px; color:#3498db;"></span></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php" class="smoothScroll">Return Home</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="section-divider textdivider divider2">
    <div class="container">
        <h1>Register</h1>
        <form action="register.php" method="post" class="form-horizontal">
            <div class="control-group">
                <div class="controls">
                    <input type="text" name="firstname" value="" placeholder="First Name"/>
                 </div>
            </div>
            <br/>
            <div class="control-group">
                <div class="controls">
                    <input type="text" name="lastname" value="" placeholder="Last Name"/>
                </div>
            </div>
            <br/>
            <div class="control-group">
                <div class="controls">
                    <input type="text" name="username" value="" placeholder="Username"/>
                </div>
            </div>
            <br/>
            <div class="control-group">
                <div class="controls">
                    <input type="text" name="email" value="" placeholder="Email"/>
                </div>
            </div>
            <br/>
            <div class="control-group">
                <div class="controls">
                    <input type="password" name="password" value="" placeholder="Password"/>
                </div>
            </div>
            <br/>
            <div class="control-group">
                <div class="controls">
                    <input type="password" name="password_confirm" value="" placeholder="Confirm Password" />
                </div>
            </div>

            <br/>
            <br/>
            <input type="submit" class="btn btn-info" value="Register" />
        </form>
    </div><!-- container -->
</section>




<div id="footerwrap">
    <div class="container">
        <h4>Created by MPT Gaming - Copyright 2014</h4>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/retina.js"></script>
<script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="assets/js/jquery-func.js"></script>
</body>
</html>
