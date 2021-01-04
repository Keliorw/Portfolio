<?php
    require "db.php";
    include "Controller/RatingCouter.php";
    include "Controller/HistoryView.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("src/head.php"); ?>
    <script src="js/DropMenuTopThree.js"></script>
    <title>Рейтинг игроков</title>
</head>
<body style="background-color: #212121">
    <?php include("src/header.php"); ?>
    <div class="container">
        <div class="MainTextRating">
            <p>
                BeerPong
            </p>
        </div>
        <div class="MainBlock">
            <div class="RatingList">
                <div class="HeadingText">
                    <p>
                        Рейтинг игроков:
                    </p>
                    <img src="img/cup.png" alt="кубок">
                </div>
                <div class="RatingAllPeople">
                    <?php 
                        if(isset($_SESSION['logged_user']))
                            CounterRatinAll(); 
                        else 
                            echo "<p>В этой таблице ещё нету игроков</p>"
                    ?>
                </div>
            </div>
            <div class="Video">
                <video poster="img/BeerPongImage.png" controls="controls" loop="loop" style="width: 100%; height: 100%;">
                    <source src="video/BeerMan.mp4" type='video/mp4' style="position: relative; z-index: -1000;">
                </video>
            </div>
        </div>
        <div class="MainHistoryBlock">
            <div class="HeaderText">
                <img src="img/IconHistoryGame.png" alt="часы">
                <div class="Text">
                    <p>
                        История игр:
                    </p>
                </div>
            </div>
            <div class="ListHistory" id="HistoryScroll">
                <?=HistoryView(); ?>
            </div>
        </div>
    </div>
    <?php include("src/footer.php"); ?>
</body>
</html>