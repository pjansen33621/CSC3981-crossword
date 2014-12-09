<?php
/**
 * Created by PhpStorm.
 * User: Maria
 * Date: 12/6/2014
 * Time: 1:06 PM
 */
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

    <script type="text/javascript">
        $(document).ready(function(){
            $("#myTab li:eq(1) a").tab('show');
        });
    </script>
    <style type="text/css">
        .bs-example{
            margin: 20px;
        }
    </style>
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
                    <li><a href="index.php" class="smoothScroll">Home</a></li>
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


<!-- ==== ABOUT ==== -->
<div class="container" id="about" name="about">
    <div class="row white">
        <br>
        <h1 class="centered">My Account</h1>
        <hr>

        <div class="col-lg-4">
            <div class="span4">
                <div class="thumbnail">
                    <img data-src="holder.js/300x200" alt="300x200" src="" style="width: 300px; height: 200px;">
                    <div class="caption">
                        <h3><?php echo $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname']; ?></h3>
                        <p>Email : <?php echo $_SESSION['user']['email']; ?></p>
                        <p><a href="#" class="btn btn-primary">Action</a></p>
                    </div>
                </div>
            </div>
        </div><!-- col-lg-6 -->

        <div class="col-lg-8">
            <div class="span8">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>Crosswords</h3>
                        <div class="bs-example">
                            <ul class="nav nav-tabs" id="myTab">
                                <li><a data-toggle="tab" href="#sectionA">Messages</a></li>
                                <li><a data-toggle="tab" href="#sectionB">Games</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="sectionA" class="tab-pane fade in active">
                                    <h3>Section A</h3>
                                    <?php
                                    if (isset($_POST['submit']))

                                    {

// if the form has been submitted, this inserts it into the Database

                                        $to_user = $_POST['to_user'];

                                        $from_user = $_POST['from_user'];

                                        $message = $_POST['message'];

                                        $query = "INSERT INTO messages
                                             (to_user, from_user, message)
                                          VALUES
                                             ('$to_user', '$from_user','$message')";
                                        $db->exec($query);

                                       //mysql_query("INSERT INTO messages (to_user, message, from_user) VALUES ('$to_user', '$message', '$from_user')")or die(mysql_error());

                                        echo "PM succesfully sent!";

                                    }

                                    else

                                    {

                                        // if the form has not been submitted, this will show the form

                                        ?>

                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

                                            <table border="0">

                                                <tr><td colspan=2><h3>Send PM:</h3></td></tr>

                                                <tr><td></td><td>

                                                        <input type="hidden" name="from_user" maxlength="32" value = <?php echo $_SESSION['user']['username']; ?>>

                                                    </td></tr>

                                                <tr><td>To User: </td><td>

                                                        <input type="text" name="to_user" maxlength="32" value = "">

                                                    </td></tr>

                                                <tr><td>Message: </td><td>

                                                        <TEXTAREA NAME="message" COLS=50 ROWS=10 WRAP=SOFT></TEXTAREA>

                                                    </td></tr>

                                                <tr><td colspan="2" align="right">

                                                        <input type="submit" name="submit" value="Send Message">

                                                    </td></tr>

                                            </table>

                                        </form>

                                    <?php

                                    }

                                    ?>

                                </div>
                                <div id="sectionB" class="tab-pane fade">
                                    <h3>Section B</h3>
                                    <p>Vestibulum nec erat eu nulla rhoncus fringilla ut non neque. Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam porttitor condimentum nisi, eu viverra ipsum porta ut. Nam hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc facilisis leo at faucibus adipiscing.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- col-lg-6 -->
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
