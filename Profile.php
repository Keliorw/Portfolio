<?php
    require "db.php";
    include "Controller/Verefication.php";
    include_once "Controller/ChangeSettingUser.php";

    //Высчитывание процента побед перед отрисокой страницы
    $user = R::load('users', $_SESSION['logged_user']->id);
    if($user->win > 0){
        $user->pirsentwin = round(($user->win / $user->gameplay)*100, 1);
        R::store($user);
    }
    //Присваивание данных юзера к переменной
    $stats = R::load('users', $_SESSION['logged_user']->id);

    //Смена никнейма на сайте
    if(isset($_POST['DoChange']) && isset($_POST['name']))
        CheckNameUser($_POST['name']);

    //Сохранение аватарки
    if(isset($_POST['save']) && isset($_POST['SaveAvatar']))
        ChangeAvatarUser();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("src/head.php"); ?>
    <title>BeerPong - Профиль</title>
</head>
<body style="background-image: url(img/fon-profile.png); background-color: #212121;">
    <?php include("src/header.php"); ?>    
    <div class="container" style="padding-top:15px;">
        <div class="ProfileFon">
            <div class="leftSection">
                <div onclick="OpenMenuUploadAvatar()" class="AvatarProfile" style="background-image: url(avatars/<?=$_SESSION['logged_user']->avatar ?>)">
                    <p>
                        Изменить<br>
                        фото
                    </p>
                </div>
                <div class="ButtonChangeName">
                    <button class="ChangeName" onclick="ChangeNameBlockView()">
                        Изменить имя
                    </button>
                    <?php $info = R::load('users', $_SESSION['logged_user']->id); if ($info->name == "") : ?>
                        <div class="information">
                            
                            <p>
                                <img src="img/informacion.png" alt="нотация">
                                Имя введённое при изменение, будет использоваться на всём сайте, но логин останется не изменным!
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="rightSection">
                <div class="headerTextProfile">
                    <p>
                        Профиль игрока <?=WriteName() ?>
                    </p>
                </div>
                <div class="StatsPlayerInProfile" id="StatsPlayerInProfile">
                    <h1>
                        Статистика:
                    </h1>
                    <div class="Stats">
                        <p>
                            Игр сыграно - <?=$stats->gameplay ?>
                        </p>
                        <p>
                            Побед - <?=$stats->win ?>
                        </p>
                        <p>
                            Поражений - <?=$stats->defeat ?>
                        </p>
                        <p>
                            Ничьих - <?=$stats->draw ?>
                        </p>
                        <p>
                            Процент побед - <?=$stats->pirsentwin ?>%
                        </p>
                    </div>
                </div>
                <div class="ChengeNameUserForm" id="ChengeNameUserForm">
                    <form method="POST" action="" class="form">
                        <input type="text" name="name" placeholder="Новое имя..." class="ChangeNameInput">
                        <button type="submit" name="DoChange" class="SaveButton">Сохранить</button>
                    </form>
                    <button class="BackChangeName" onclick="ChangeNameBlockView()">
                        Отмена
                    </button>
                </div>
            </div>
            <div id="MyModal" class="fonUploadsAvatar">
                <div class="windowUploadsAvatar">
                    <div class="sectionOne">
                        <p>
                            Загрузить фотокарточку
                        </p>
                    </div>
                    <div class="sectionTwoSendAvatar" id="SendAvatar">
                        <div class="MainText">
                            <p>
                                Пикай формат JPG или PNG модник
                            </p>
                        </div>
                        <div class="AvatarChange">
                            <img src="img/image-upload-file.png">
                        </div>
                        <div class="buttonSendAvatar">
                            <form method="POST" action="" enctype="multipart/form-data"> 
                                <div>
                                    <input type="file" name="avatar" id="file" onchange="UploadFile(this.files, '<?php $user = R::load('users', $_SESSION['logged_user']->id); echo $user->avatar ?>')" class="ButtonUploadAvatar">
                                    <label for="avatar">Выбрать файл</label>
                                    <button type="submit" id="btn"></button>
                                </div>                        
                            </form>
                        </div>
                    </div>
                    <div class="sectionTwoSaveAvatar" id="SaveAvatar">
                        <div class="MainText">
                            <p>
                                Норм чи не?
                            </p>
                        </div>
                        <div class="ViewAvatar" id="ViewAvatar"></div>
                        <div class="buttonSaveAndBack">
                            <div class="buttonSave">
                                <form method="POST" action="">
                                    <input type="text" value="save" name="save" style="display: none;">
                                    <button type="submit" name="SaveAvatar" class="Save">
                                        Сохранить и продолжить
                                    </button>
                                </form>
                            </div>
                            <div class="buttonBack">
                                <button type="submit" name="DontSave" class="DontSave" onclick="Back()">
                                    Вернуться назад
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="sectionThree" id="sectionThree">
                        <p id="TextError">
                            Если не грузит пикай файл поменьше петушок
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("src/footer.php"); ?>
</body>
</html>