<?php
    require "db.php";
    include('Controller/ChangeSettingUser.php');
    include('Controller/Verefication.php');

    $data = $_POST;
    if(isset($data['password']) && isset($data['AgainPassword'])){
        if(RestorePasswordCheck($data, $_GET['id']))
        {
            ChangePasswordUser($data, $_GET['id']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("src/head.php"); ?>
    <title>BeerPong</title>
</head>
<body style="background-image: url(img/fon.png); background-color: #212121;">
    <?php include("src/header.php"); ?>
    <div class="container">
        <section class="mainBlock">
            <?php $user = R::load('users', $_GET['id']); if ($user->token != "") : ?>
                <form action="" method="POST" class="formRestorePassword">
                    <input type="password" name="password" placeholder="Пароль" class="writeInfo" >
                    <input type="password" name="AgainPassword" placeholder="Повторите пароль" class="writeInfo" >
                    <button type="submit" class="SendButton">Изменить пароль</button>
                </form>
            <?php else : ?>
                <p class="DeleteLinkChangePasswordText">
                    Ссылка устарела
                </p>
            <?php endif; ?>
        </section>
    </div>
    <?php include("src/footer.php"); ?>
</body>
</html>