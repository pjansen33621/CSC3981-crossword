<?php
/**
 * Created by PhpStorm.
 * User: Maria
 * Date: 12/6/2014
 * Time: 1:06 PM
 */

require("config.php");
// select random word from table
$rand = rand(1,30);
$query = "SELECT * FROM wordsclues
                          WHERE id = '$rand'";

$words = $db->query($query);


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

        #letter {
            height: 40px;
            width: 40px;
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
            </div>
        </div>
    </div>
</div>


<!-- ==== ABOUT ==== -->
<div class="container">
    <div class="row white">
        <br>
        <h1 class="centered">My Games</h1>
        <hr>

        <h3>Create Puzzle: </h3>
        <strong>Size: </strong>
        <select id="size" style="height:27px;">
            <option value = "10">10x10</option>
            <option value = "12">12x12</option>
            <option value = "14">14x14</option>
            <option value = "16">16x16</option>
            <option value = "18">18x18</option>
            <option value = "20">20x20</option>
        </select>

        <input type="button" id="gridCreate" value="Create">

        <div class="container hero-unit">

            <div id="grid"></div>
            <script>
                var $ = function(id)
                {
                    return document.getElementById(id);
                }

                var grid = function (){

                    var gridDiv = document.getElementById('grid');
                    var e = document.getElementById('size');
                    var size = e.options[e.selectedIndex].value;
                    var count = 0;
                    document.getElementById('grid').innerHTML = "";

                    for (var i = 0; i < size; i++){
                        for (var j = 0; j < size; j++){
                            var newBox = document.createElement('input');
                            if ((count%2==0)||(count==0)) {
                                newBox.style.backgroundColor = "white";
                                newBox.id = "letter";
                                gridDiv.appendChild(newBox);
                            }
                            else{
                                newBox.style.backgroundColor = "black";
                                newBox.id = "letter";
                                newBox.disabled = true;
                                gridDiv.appendChild(newBox);

                            }
                            count++;
                        }
                        var newLine = document.createElement('br');
                        gridDiv.appendChild(newLine);
                        count++;
                    }
                }

                window.onload = function ()
                {
                    $("gridCreate").onclick = grid;
                }
            </script>

        </div>


        <!-- test php query -->
        <div style="padding-top:20px;">
            <select  style="width:250px; height:30px; text-align:center;">
                <?php foreach ($words as $word) :?>
                    <?php
                    echo "<option>$word[words]</option>"; ?>
                <?php endforeach ?>
            </select>
        </div>

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


<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/retina.js"></script>
<script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="assets/js/jquery-func.js"></script>
</body>
</html>
