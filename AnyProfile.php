<?php
    require "db.php";

    $user = R::load('users', $_GET['id']);
    if (isset($_GET['roomid'])){
        $roomid = $_GET['roomid'];
        $player = R::getAll("SELECT * FROM $roomid WHERE loginplayer = ?", array($user->login));
    } else {
        $player = R::getAll("SELECT * FROM users WHERE login = ?", array($user->login));
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("src/head.php"); ?>
    <title>Профиль <?php $user = R::load('users', $_GET['id']); echo $user->login; ?></title>
</head>
<body style="background-image: url(img/fon-profile.png); background-color: #212121;">
    <?php include("src/header.php"); ?>
    <div class="container" style="padding-top:15px;">
        <section class="anyProfile">
            <div class="leftSection">
                <div class="avatar" style="background-image: url(avatars/<?=$user->avatar; ?>);"></div>
            </div>
            <div class="rightSection">
                <div class="HeaderText">
                    <p>
                        Профиль игрока <?=WriteNameAnyProfile(); ?>
                    </p>
                </div>
                <div class="StatsPLayerInAnyProfile">
                    <div class="MainText">
                        <p>
                            Статистика:
                        </p>
                    </div>
                    <div class="Stats">
                        <p>
                            Игр сыграно - <?=$player[0]['gameplay']; ?>
                        </p>
                        <p>
                            Побед - <?=$player[0]['win']; ?>
                        </p>
                        <p>
                            Поражений - <?=$player[0]['defeat']; ?>
                        </p>
                        <p>
                            Ничьих - <?=$player[0]['draws']; ?>
                        </p>
                        <?php if(empty($_GET['roomid'])) : ?>
                            <p>
                                Процент побед - <?=$player[0]['pirsentwin']; ?>%
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include("src/footer.php"); ?>
</body>
</html>