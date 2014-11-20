<?php 
    require("config.php"); 
    $submitted_username = ''; 
    if(!empty($_POST)){ 
        $query = " 
            SELECT 
                id,
                firstname,
                lastname, 
                username, 
                password, 
                email 
            FROM users 
            WHERE 
                username = :username 
        "; 
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
          
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $login_ok = false; 
        $row = $stmt->fetch(); 
        if($row){ 
            $check_password = $_POST['password']; 
            if($check_password === $row['password']){
                $login_ok = true;
            } 
        } 
 
        if($login_ok){ 
            unset($row['password']); 
            session_start();
            $_SESSION['user'] = $row;  
            header("Location: index.php"); 
            die("Redirecting to: index.php"); 
        } 
        else{ 
            print("Login Failed."); 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
?> 
<?php session_start() ?>
<!doctype html>

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
      <a class="brand">MPT Games</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
        <?php if (isset($_SESSION['user'])) { ?>
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
          <li><a href="aboutus.php">About Us</a></li>
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
    <img src="assets/mpttest.png" alt="mpt logo" height="360" width="640">
    <h2>Welcome to MTP Games' Crossword Construction Set</h1>
    <p>To get started, if you haven't already, register as a user, and sign in.</p>
    <p>Random crossword craziness awaits those who desire to join in on the fun</p>
</div>
</body>
</html>
