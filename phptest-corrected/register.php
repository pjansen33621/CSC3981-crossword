<?php
require("config.php");
if(!empty($_POST))
{
  // Ensure that the user fills out fields
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

  // Add row to database
  $query = "
INSERT INTO users (
username,
password,
salt,
email
) VALUES (
:username,
:password,
:salt,
:email
)
";

// Security measures
  $salt = dechex(mt_rand(0, 2147843647)) . dechex(mt_rand(0, 2147483647));
  $password = hash('sha256', $_POST['password'] . $salt);
  for($round = 0; $round < 65536; $round++){ $passowrd = hash('sha256', $passowrd. $salt); }
  $query_params = array(
    ':username' => $_POST['username'],
    ':password' => $password,
    ':salt' => $salt,
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
          <li><a href="register.php">Register</a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In <strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                <form action="secret.php" method="post"> 
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
        </ul>
      </div>
    </div>
  </div>
</div>
 
<form action="register.php" method="post" style="padding: 100px; padding-bottom: 0px;"> 
    <h1>Register</h1>
    <label>Username:</label> 
    <input type="text" name="username" value="" /> 
    <label>Email:</label> 
    <input type="text" name="email" value="" /> 
    <label>Password:</label> 
    <input type="password" name="password" value="" /> <br /><br />
    <input type="submit" class="btn btn-info" value="Register" /> 
</form>
<div class="container hero-unit">
</div>
</body>
</html>

