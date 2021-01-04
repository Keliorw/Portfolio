<?php
    require 'db.php';
    include('Controller/GenerateMessage.php');
    include('Controller/Verefication.php');

    $data = $_POST;
    if(isset($data['email'])){
        if(RestorePasswordEmail($data['email'])){
            $token = md5($data['email']).md5($securityKey);
            GenMessage($data['email'], $token, "Restore Password");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("src/head.php"); ?>
    <title>BeerPong - Восстановление пароля</title>
</head>
<body style="background-image: url(img/fon.png); background-color: #212121;">
    <?php include("src/header.php"); ?>
    <div class="container">
        <section class="mainBlock">
            <form action="" method="POST" class="formRestorePassword">
                <input type="text" name="email" placeholder="Введите E-mail" class="writeInfo" value="<?php echo @$data['email']; ?>" pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?">
                <button type="submit" class="SendButton" name="SendEmailForChangePassword">Восстановить</button>
            </form>
        </section>
    </div>
    <?php include("src/footer.php"); ?>
</body>
</html>