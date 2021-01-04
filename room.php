<?php
    require "db.php";
    include "Controller/ControllerRoom.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("src/head.php"); ?>
    <script src="js/FunctionInRoom.js"></script>
    <title>Комнаты</title>
</head>
<body style="background-color: #212121;">
    <?php include("src/header.php"); ?>
    <section class="ContanteRoom">
        <div class="container">
            <?php if(CheckJoinRoom()) : ?>
                <div class="HeaderTextRoom">
                    <p>
                        Комнаты
                    </p>
                </div>
                <div class="FirstSectionContanteRoom">
                    <div class="LeftSection">
                        <div class="InfoBlock">
                            <div class="NameRoom">
                                <p>
                                    <?=WriteInformationRoom('NameRoom') ?>
                                </p>
                            </div>
                            <div class="AmountPlayerRoom">
                                <p>
                                    <?=WriteInformationRoom('AmountPlayer')  ?> - игрок(ов)
                                </p>
                            </div>
                        </div>
                        <div class="DateBlock">
                            <div class="Imagekitchen">
                                <img src="img/kitchen.png" alt="питух">
                            </div>
                            <div class="date">
                                <p>
                                    <?=WriteInformationRoom('date')  ?>
                                </p>
                            </div>
                        </div>
                        <div class="Image">
                            <img src="img/icon-room.png" alt="бирпонг">
                        </div>
                    </div>
                    <div class="rightSection">
                        <button class="ButtonLeaveRoom">
                            <img src="img/Close_room.png" alt="выйти">
                        </button>
                        <div class="ListPlayersRoom" id="ListPlayersRoom">
                            <div class="FirstColumn">
                                <?=ListPlayersFirstColumn(); ?>
                            </div>
                            <div class="SecondColumn">
                                <?=ListPlayersSecondColumn(); ?>
                            </div>
                        </div>
                        <div class="Image">
                            <img src="img/piedistal_room.png" alt="пьедистал">
                        </div>
                    </div>
                </div>
                <div class="SecondSectionContanteRoom">
                    <div class="HeaderText">
                        <img src="img/IconHistoryGame.png" alt="история игр">
                        <p>
                            История:
                        </p>
                    </div>
                    <div class="ListFightToDay" id="ListFightToDay">
                        <?=WriteListFight(); ?>
                    </div>
                </div>
            <?php else: ?>

            <?php endif; ?>
        </div>
    </section>
    <?php include("src/footer.php"); ?>
</body>
</html>