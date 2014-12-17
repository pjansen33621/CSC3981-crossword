<?php
/**
 * Created by PhpStorm.
 * User: Maria
 * Date: 12/6/2014
 * Time: 1:06 PM
 */

require("config.php");
// select random word from table
//$rand = rand(1,30);

$queryEasy = "SELECT * FROM easy";
$wordsEasy = $db->query($queryEasy);
$wordsEasy = $wordsEasy -> fetchAll();

$queryMedium = "SELECT * FROM medium";
$wordsMedium = $db->query($queryMedium);
$wordsMedium = $wordsMedium -> fetchAll();

$queryHard = "SELECT * FROM hard";
$wordsHard = $db->query($queryHard);
$wordsHard = $wordsHard -> fetchAll();


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
    <script type="text/javascript" src="croises.js"></script>
    <link rel="stylesheet" type="text/css" href="crosswords.css" media="all" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <!--<script type="text/javascript">
        $(document).ready(function(){
            <!--$("#myTab li:eq(0) a").tab('show');
            $('#myTab a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');

                $('#sectionC').click(function (index) {
                    $('#myTab').tabs('load', index);
                    location.reload(true);
                    $("#myTab li:eq(index) a").tab('show');
                });

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



    </style> -->
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
        <!-- test php query -->
        <div style="padding-top:20px;">
            <select style="width:250px; height:30px; text-align:center; id='diff';">
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
            </select>
        </div>
        <br/>

        <input type="button" id="choose" value="Change Difficulty">

        <script>

            var idList = [];
            var wordList = [];
            var clueList = [];
            var data =[];

            <?php foreach ($wordsEasy as $a) :?>

            idList.push(<?php
                    echo "$a[id]"; ?>);
            wordList.push('<?php
                    echo "$a[words]"; ?>');
            clueList.push('<?php
                    echo "$a[clues]"; ?>');

            <?php endforeach ?>

            var changeCrossword = function (){

                var crosswordDiff = document.getElementById('diff');

                if(crosswordDiff.value == "Easy"){
                    document.getElementById('main').innerHTML = "";
                    <?php foreach ($wordsEasy as $a) :?>

                    idList.push(<?php
                    echo "$a[id]"; ?>);
                    wordList.push('<?php
                    echo "$a[words]"; ?>');
                    clueList.push('<?php
                    echo "$a[clues]"; ?>');

                    <?php endforeach ?>

                    for (var i = 0; i < wordList.length; i++)
                    {
                        data.push(
                            {
                                id: i+1 ,
                                word: wordList[i],
                                def: clueList[i]
                            });

                    }
                }

                else if (crosswordDiff.value == "Medium"){
                    document.getElementById('main').innerHTML = "";
                    <?php foreach ($wordsMedium as $a) :?>

                    idList.push(<?php
                    echo "$a[id]"; ?>);
                    wordList.push('<?php
                    echo "$a[words]"; ?>');
                    clueList.push('<?php
                    echo "$a[clues]"; ?>');

                    <?php endforeach ?>

                    for (var i = 0; i < wordList.length; i++)
                    {
                        data.push(
                            {
                                id: i+1 ,
                                word: wordList[i],
                                def: clueList[i]
                            });

                    }
                }

                else{
                    document.getElementById('main').innerHTML = "";
                    <?php foreach ($wordsHard as $a) :?>

                    idList.push(<?php
                    echo "$a[id]"; ?>);
                    wordList.push('<?php
                    echo "$a[words]"; ?>');
                    clueList.push('<?php
                    echo "$a[clues]"; ?>');

                    <?php endforeach ?>

                    for (var i = 0; i < wordList.length; i++)
                    {
                        data.push(
                            {
                                id: i+1 ,
                                word: wordList[i],
                                def: clueList[i]
                            });

                    }
                }

            };

            for (var i = 0; i < wordList.length; i++)
            {
                data.push(
                    {
                        id: i+1 ,
                        word: wordList[i],
                        def: clueList[i]
                    });

            }
            $(document).ready(function(){
                $("#main").data('crosswords', data)
                    .crosswordable() ;

                $("#submit").click(function(event){
                    console.log($("#main").crosswordable('serialize')) ;
                })
            });
            window.onload = function ()
            {
                $("#choose").onclick = changeCrossword();
            }
        </script>

        <div id="main"></div>

        <br />

        <input type="submit" id="submit" />

        <script>
           // var $ = function(id)
          //  {
            //    return document.getElementById(id);
           // };

            // create a var for option = get value from option
           //if option = "Easy"
           // do something
           //else if option ="Medium"
           // do something


            /*var randNum = Math.floor(Math.random()*wordList.length);

             var word = wordList[randNum];
             var finalList = [];
             finalList.push(word);
             var wordChar = word.split('');
             var nextWord = '';
             var nextWordChar = [];
             var check = false;

             for (var i = 1; i < wordList.length; i++){

             nextWord = wordList[Math.floor(Math.random()*wordList.length)];
             if (nextWord == word){
             nextWord = wordList[Math.floor(Math.random()*wordList.length) + 1];
             }
             else{
             nextWordChar = nextWord.split('');
             }

             var e = 0;
             if (wordChar.length > nextWordChar.length){
             for (var i = 0; i < nextWordChar.length; i++){
             for (var j = 0; j < wordChar.length; j++){
             if (nextWordChar[i] == wordChar[j]){
             check = true;
             word

             break;
             }
             }
             }
             }
             else{
             for (var i = 0; i < wordChar.length; i++){
             for (var j = 0; j < nextWordChar.length; j++){
             if (wordChar[i] == nextWordChar[j]){
             check = true;
             break
             }
             }
             }
             }


             } */



            /*var grid = function (){

             var gridDiv = document.getElementById('grid');
             var e = document.getElementById('size');
             var size = e.options[e.selectedIndex].value;
             //var count = 0;
             document.getElementById('grid').innerHTML = "";

             for (var i = 0; i < size; i++){
             for (var j = 0; j < size; j++){
             var newBox = document.createElement('input');
             newBox.style.backgroundColor = "white";
             newBox.id = "letter";
             gridDiv.appendChild(newBox);
             }
             var newLine = document.createElement('br');
             gridDiv.appendChild(newLine);
             //    count++;
             }
             };

             window.onload = function ()
             {
             $("gridCreate").onclick = grid;
             };*/
        </script>


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
