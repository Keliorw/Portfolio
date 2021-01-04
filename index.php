<?php
    require "db.php";
    include "Controller/TakeOffer.php";
    include "Controller/RatingCouter.php";
    include "Controller/ControllerRoom.php";
    include "Controller/Verefication.php";

    if(isset($_POST['Do_JoinRoom'])){
        CheckPasswordRoom($_POST['password']);
    }

    if(isset($_POST['Do_createRoom'])){
        CheckDataRoom($_POST['name'], $_POST['password'], $_POST['AgainPassword']);
    }

    if(isset($_POST['offer']) && isset($_POST['Do_offer'])){
        TakeOffer(WriteName(), $_POST['offer']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("src/head.php"); ?>
    <!-- <script src="/js/prototype.js"></script> -->
    <script src="js/LiveShowErrorCreateRoom.js"></script>
    <script src="js/JoinRoom.js"></script>
    <title>BeerPong</title>
</head>
<body style="background-color: #212121">
    <?php include("src/header.php"); ?>
    <div class="container">
        <div class="AllSection">
            <div class="MainLeftBlock">
                <div class="allRatingPeople">
                    <div class="leftBlock">
                        <div class="MainText">
                            <p>
                                Топ игроков:
                            </p>
                        </div>
                        <div class="StatsTopThree">
                            <?php 
                                if(isset($_SESSION['logged_user']))
                                    CounterIndexRating(); 
                                else
                                    echo "<p class='rating-text'>Войдите в аккаунт, чтобы увидеть рейтинг</p>";
                            ?>
                        </div>
                    </div>
                    <div class="rightBlock">
                        <div class="MoreDetailsButton">
                            <a href="Rating.php">Подробнее...</a>
                        </div>
                        <div class="Image">
                            <img src="img/HistoryPedestal.png">
                        </div>
                    </div>
                </div>
                <div class="OfferBlock">
                    <div class="MainText">
                        <p>
                            Что добавить?
                        </p>
                    </div>
                    <form method="POST" action="" class="formOffer">
                        <textarea type="text" name="offer" placeholder="..." class="textarea_behavior" id="comment_text" onkeyup="resizeArea('comment_text', 45, 450);"></textarea>
                        <div class="comment_text_hidden">
                            <div class="textarea_behavior" id="comment_text_hidden">
                            </div>
                        </div>
                        <div id="WriteOffer_div"></div>
                        <button type="submit" name="Do_offer" class="SendButton">
                            <img src="img/Vector.png">
                        </button>
                    </form>
                    <div class="descriptionText">
                        <p>
                            Кароч перцы, придумываем что бы<br>
                            вы хотеливидеть на сайте, а мы это<br>
                            делаем. Должно получиться прикольно))0)
                        </p>
                    </div>
                </div>
            </div>
            <div class="MainRightBlock">
                <div class="CreateRoomFon" id="CreateRoomMenu">
                    <div class="MainBlockCreateRoom">
                        <div class="CloseButton" id="CloseButton" onclick="CreateRoomMenu()">
                            <img src="img/Close_room.png" alt="закрыть">
                        </div>
                        <div class="descriptionText">
                            <p>
                                Добавить комнату
                            </p>
                        </div>
                        <div class="MenuCreateAndWriteInformation">
                            <form method="POST" action="" class="form">
                                <div class="WriteInformation">
                                    <input type="text" name="name" placeholder="Название комнаты..." class="InputCreateRoom" id="name" maxlength="20" onblur="CheckFormCreateRoom(this.value);">
                                    <p id="errorName">

                                    </p>
                                </div>
                                <div class="WriteInformation">
                                    <input type="password" name="password" placeholder="Введите пароль..." class="InputCreateRoom" id="password" onblur="CheckPassword(this.value, document.getElementById('AgainPassword').value)">
                                    <p id="errorPassword">
                            
                                    </p>
                                </div>
                                <div class="WriteInformation">
                                    <input type="password" name="AgainPassword" placeholder="Повторите пароль..." class="InputCreateRoom" id="AgainPassword" onblur="CheckAgainPassword(this.value, document.getElementById('password').value)">
                                    <p id="errorAgainPassword">
                                
                                    </p>
                                </div>
                                <button type="submit" name="Do_createRoom" class="ButtonCreateRoomSend">Создать</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="BlockShearchRoom">
                    <div class="CreateRoomAndMainText">
                        <p>
                            Комнаты:
                        </p>
                        <button class="buttonCreate" onclick="CreateRoomMenu();">
                            Создать игру
                        </button>
                    </div>
                    <div class="ListRoomAndShearch">
                        <form method="POST" action="" class="form">
                            <button class="SendRequest"><img src="img/icon_shearch.png" alt="поиск"></button>
                            <input type="text" name="request" class="TextRequest" placeholder="Найти комнату...">
                        </form>
                        <div class="BlockListRoom">
                            <?php if(CheckRoom()): ?>
                                <div class="ListRoom">
                                    <?=ListRoom(); ?>
                                </div>
                                <div class="JoinRoomFon" id="JoinRoom">
                                    <div class="MainBlockJoinRoom">
                                        <div class="CloseButton" id="ButtonClose" onclick="CloseMenuJoinRoom();">
                                            <img src="img/Close_room.png" alt="закрыть">
                                        </div>
                                        <div class="descriptionText">
                                            <p>
                                                Введите пароль<br> чтобы подключиться
                                            </p>
                                        </div>
                                        <div class="MenuJoinAndWriteInformation">
                                            <form method="POST" action="" class="form">
                                                <input type="password" name="password" placeholder="Введите пароль..." class="InputJoinRoom">
                                                <button type="submit" name="Do_JoinRoom" class="ButtonJoinRoomSend">Войти</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="ImageBeerGlass">
                                    <img src="img/Beer_glass.svg">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("src/footer.php"); ?>
</body>
</html>