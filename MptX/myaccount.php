<?php
/**
 * Created by PhpStorm.
 * User: Maria
 * Date: 12/6/2014
 * Time: 1:06 PM
 */

require("config.php");

    $to_user = $_SESSION['user']['username'];
    $query = "SELECT * FROM messages
                      Where to_user = '$to_user'";
    $messages = $db->query($query);

    $from_user = $_SESSION['user']['username'];
    $q = "SELECT * FROM messages
     Where from_user = '$from_user'";
    $messages_sent = $db->query($q);

$messageID = (isset($_GET['msgid']) ? $_GET['msgid'] : null);

$query = "DELETE FROM messages
WHERE id = '$messageID'";
$db->exec($query);



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
            <!--$("#myTab li:eq(0) a").tab('show');
            $('#myTab a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');

                $('#sectionC').click(function (index) {
                    $('#myTab').tabs('load', index);
                    location.reload(true);
                    $("#myTab li:eq(index) a").tab('show');
                }); -->

            $('#myTab a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });

            // store the currently selected tab in the hash value
            $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
                var id = $(e.target).attr("href").substr(1);
                window.location.hash = id;
            });

            // on load of the page: switch to the currently selected tab
            var hash = window.location.hash;
            $('#myTab a[href="' + hash + '"]').tab('show');

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
                    <span class="icon icon-home" style="font-size:30px; color:#3498db;"></span>
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

        <div class="col-lg-3">
            <div class="span4">
                <div class="thumbnail" style="background-color: Floralwhite;">
                    <img data-src="holder.js/300x200" alt="300x200" src="assets/img/account.png" style="height: 200px;background-color: Aliceblue;" class="img-circle">
                    <br/>
                    <div class="caption">
                        <label>Name:</label> <?php echo $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname']; ?>
                        <br/>
                        <label>Email:</label> <?php echo $_SESSION['user']['email']; ?>
                        <p><a href="games.php" class="btn btn-primary">Play Game</a></p>
                    </div>
                </div>
            </div>
        </div><!-- col-lg-6 -->

        <div class="col-lg-8">
            <div class="span8">
                <div class="thumbnail"  style="background-color: Floralwhite;">
                    <div class="caption">
                        <h3 style="text-align: center;">Messages</h3>
                        <div class="bs-example">
                            <ul class="nav nav-tabs" id="myTab">
                                <li><a data-toggle="tab" href="#sectionA">Send Message</a></li>
                                <li><a data-toggle="tab" href="#sectionB">Inbox</a></li>
                                <li><a data-toggle="tab" href="#sectionC" id="outbox"">Outbox</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="sectionA" class="tab-pane fade in active">

                                <form method="post">

                                    <?php
                                    if (isset($_POST['submit']))

                                    {
                                        $to_user = $_POST['to_user'];

                                        $from_user = $_POST['from_user'];

                                        $message = $_POST['message'];

                                        $query = "INSERT INTO messages
                                             (to_user, from_user, message)
                                          VALUES
                                             ('$to_user', '$from_user','$message')";
                                        $db->exec($query);
                                        //mysql_query("INSERT INTO messages (to_user, message, from_user) VALUES ('$to_user', '$message', '$from_user')")or die(mysql_error());

                                        echo "Message was successfully sent";
                                    }
                                    else
                                    {     // if the form has not been submitted, this will show the form

                                        ?>
                                    <?php

                                    }
                                    ?>
                                       <table border="0" id="sendBox">

                                            <tr><td colspan=2>&nbsp; </td></tr>

                                            <tr><td></td><td>
                                                    <input type="hidden" id="fromUser" name="from_user" maxlength="32" value = <?php echo $_SESSION['user']['username']; ?>>

                                                                    </td></tr>

                                                                    <tr><td>To User: </td><td>

                                                                            <input type="text" name="to_user" maxlength="32" value = "" id="toUser">

                                                                        </td></tr>

                                                                    <tr><td>Message: </td><td>

                                                                            <TEXTAREA NAME="message" COLS=50 ROWS=10 WRAP=SOFT id="message"></TEXTAREA>

                                                                        </td></tr>

                                                                    <tr><td colspan="2" align="right">

                                                                            <input type="submit" name="submit" value="Send Message">

                                                                    </td></tr>
                                            </table>
                                    </form>



                                </div>
                                <div id="sectionB" class="tab-pane fade">
                                            <table class="table">
                                               <thead>
                                               <tr>
                                                   <th>From</th>
                                                   <th>Message</th>
                                                   <th>Delete</th>
                                               </tr>
                                               </thead>
                                                <tbody>
                                                <?php foreach ($messages as $msg) : ?>
                                                    <input type="hidden"  name="msgid"  maxlength="32" value = <?php echo  $msg['id']; ?>>
                                                    <tr>
                                                        <td><?php echo $msg['from_user']; ?></td>
                                                        <td><?php echo $msg['message']; ?></td>
                                                        <td><a href="myaccount.php?msgid=<?php echo $msg['id']; ?>"><i class="icon-remove"></i></a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                </div>
                                <div id="sectionC" class="tab-pane fade" >
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>To</th>
                                            <th>Message</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($messages_sent as $m) : ?>
                                            <input type="hidden"  name="msgid"  maxlength="32" value = <?php echo  $m['id']; ?>>
                                            <tr>
                                                <td><?php echo $m['to_user']; ?></td>
                                                <td><?php echo $m['message']; ?></td>
                                                <td><a href="myaccount.php?msgid=<?php echo $m['id']; ?>"><i class="icon-remove"></i></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
<script>
    $(document).ready(function(){

    });

</script>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/retina.js"></script>
<script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="assets/js/jquery-func.js"></script>
</body>
</html>
