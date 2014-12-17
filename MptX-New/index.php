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

  <body data-spy="scroll" data-offset="0" data-target="#navbar-main">
  
  
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
                <li><a href="#home" class="smoothScroll">Home</a></li>
                <li> <a href="#about" class="smoothScroll"> About</a></li>
                <li> <a href="#team" class="smoothScroll"> MPT Team</a></li>
                <?php if (isset($_SESSION['user'])) { ?>
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
          <!--<ul class="nav navbar-nav">
            <li><a href="#home" class="smoothScroll">Home</a></li>
			<li> <a href="#about" class="smoothScroll"> About</a></li>
              <li> <a href="#contact" class="smoothScroll"> Contact</a></li>
			<li> <a href="#team" class="smoothScroll"> Login</a></li>
			<li> <a href="#portfolio" class="smoothScroll"> Register</a></li>
			</ul> -->
        </div><!--/.nav-collapse -->
      </div>
    </div>
    </div>

  
  
		<!-- ==== HEADERWRAP ==== -->
	    <div id="headerwrap" id="home" name="home">
			<header class="clearfix">
	  		 		<h1>MPT Gaming</h1>
	  		 		<p>Exclusive Games</p>
	  		</header>	    
	    </div><!-- /headerwrap -->


		
		<!-- ==== ABOUT ==== -->
		<div class="container" id="about" name="about">
			<div class="row white">
			<br>
				<h1 class="centered">A LITTLE ABOUT MPT Gaming</h1>
				<hr>
				
				<div class="col-lg-6">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis, libero et consequat laoreet, nibh tellus pharetra felis, sed dignissim velit quam a dolor. Curabitur tincidunt, nisi sit amet tincidunt ultrices, sem sapien porttitor lacus, non elementum leo purus eget orci. Ut eu felis nisi. Morbi sodales tortor purus, in pretium ante sollicitudin sed. Donec tempus urna libero, sed euismod risus lobortis quis. Donec et ornare metus. Phasellus vel commodo est, eu condimentum tortor. Aenean blandit lorem ac arcu eleifend interdum. Fusce maximus nisi rutrum diam imperdiet, at commodo magna finibus. Suspendisse placerat nibh vel eros mollis, sit amet suscipit neque tristique. Proin condimentum gravida nunc, quis feugiat lacus congue eu. Mauris sem felis, lacinia ac orci ac, suscipit mollis ipsum. Aliquam sed lectus euismod, ullamcorper nibh sed, tincidunt magna. Phasellus ut neque ligula. Integer volutpat venenatis arcu, ac sagittis magna volutpat sed. Donec nec elit et diam sodales dictum et id est.</p>
				</div><!-- col-lg-6 -->
				
				<div class="col-lg-6">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis, libero et consequat laoreet, nibh tellus pharetra felis, sed dignissim velit quam a dolor. Curabitur tincidunt, nisi sit amet tincidunt ultrices, sem sapien porttitor lacus, non elementum leo purus eget orci. Ut eu felis nisi. Morbi sodales tortor purus, in pretium ante sollicitudin sed. Donec tempus urna libero, sed euismod risus lobortis quis. Donec et ornare metus. Phasellus vel commodo est, eu condimentum tortor. Aenean blandit lorem ac arcu eleifend interdum. Fusce maximus nisi rutrum diam imperdiet, at commodo magna finibus. Suspendisse placerat nibh vel eros mollis, sit amet suscipit neque tristique. Proin condimentum gravida nunc, quis feugiat lacus congue eu. Mauris sem felis, lacinia ac orci ac, suscipit mollis ipsum. Aliquam sed lectus euismod, ullamcorper nibh sed, tincidunt magna. Phasellus ut neque ligula. Integer volutpat venenatis arcu, ac sagittis magna volutpat sed. Donec nec elit et diam sodales dictum et id est.</p>
				</div><!-- col-lg-6 -->
			</div><!-- row -->
		</div><!-- container -->
		


		<!-- ==== SECTION DIVIDER2 -->
		<section class="section-divider textdivider divider2">
			<div class="container">
				<h1>Are you ready?</h1>
				<hr>
				<p>To get started, if you haven't already, register as a user, and sign in.</p>
                <p>Random crossword craziness awaits those who desire to join in on the fun.</p>
			</div><!-- container -->
		</section><!-- section -->

		<!-- ==== TEAM MEMBERS ==== -->
		<div class="container" id="team" name="team">
		<br>
			<div class="row white centered">
				<h1 class="centered">MEET OUR AWESOME TEAM</h1>
				<hr>
				<br>
				<br>
				<div class="col-lg-4 centered">
					<img class="img img-circle" src="assets/img/team/m.jpg" height="120px" width="120px" alt="">
					<br>
					<h4><b>Maria Karakasheva</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<a href="#" class="icon icon-flickr"></a>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis, libero et consequat laoreet, nibh tellus pharetra felis, sed dignissim velit quam a dolor. Curabitur tincidunt, nisi sit amet tincidunt ultrices, sem sapien porttitor lacus, non elementum leo purus eget orci. Ut eu felis nisi.</p>
				</div><!-- col-lg-3 -->
				
				<div class="col-lg-4 centered">
					<img class="img img-circle" src="assets/img/team/ty.jpg" height="120px" width="120px" alt="">
					<br>
					<h4><b>Ty Matchett</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<a href="#" class="icon icon-flickr"></a>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis, libero et consequat laoreet, nibh tellus pharetra felis, sed dignissim velit quam a dolor. Curabitur tincidunt, nisi sit amet tincidunt ultrices, sem sapien porttitor lacus, non elementum leo purus eget orci. Ut eu felis nisi. </p>
				</div><!-- col-lg-3 -->
				
				<div class="col-lg-4 centered">
					<img class="img img-circle" src="assets/img/team/peter.jpg" height="120px" width="120px" alt="">
					<br>
					<h4><b>Peter Jansen</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<a href="#" class="icon icon-flickr"></a>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis, libero et consequat laoreet, nibh tellus pharetra felis, sed dignissim velit quam a dolor. Curabitur tincidunt, nisi sit amet tincidunt ultrices, sem sapien porttitor lacus, non elementum leo purus eget orci. Ut eu felis nisi. </p>
				</div><!-- col-lg-3 -->
			</div><!-- row -->
		</div><!-- container -->


		


		<!-- ==== SECTION DIVIDER6 ==== -->
		<section class="section-divider textdivider divider6">
			<div class="container">
				<h1>Contact Us</h1>
				<hr>
				<p>Some Address 987,</p>
				<p>534 9884 4893</p>
				<p><a class="icon icon-twitter" href="#"></a> | <a class="icon icon-facebook" href="#"></a></p>
			</div><!-- container -->
		</section><!-- section -->
		


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
