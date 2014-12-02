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
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MPT Games: Crossword Generator | Registration</title>
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
      <a class="brand">MPT Games</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li><a href="index.php">Return Home</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container hero-unit">
    <h1>Register</h1>
    <form action="register.php" method="post" style="padding: 100px; padding-bottom: 0px;">    <label>First Name:</label>
    <input type="text" name="firstname" value="" />
    <label>Last Name:</label>
    <input type="text" name="lastname" value="" /> 
    <label>Username:</label> 
    <input type="text" name="username" value="" /> 
    <label>Email:</label> 
    <input type="text" name="email" value="" /> 
    <label>Password:</label> 
    <input type="password" name="password" value="" />
    <label>Confirm Password:</label>
    <input type="password" name="password_confirm" value="" /> <br /><br />
    <input type="submit" class="btn btn-info" value="Register" /> 
</form>
</div>
</body>
</html>

