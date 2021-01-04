<?php
    require "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("src/head.php"); ?>
    <title>BeerPong</title>
</head>
<body style="background-color: #212121">
    <?php include("src/header.php"); ?>
    <section class="ThankYouForRegister">
        <div class="container">
            <div class="content">
                <?php if($_GET['key'] == "ChangePassword") : ?>
                    <p>
                        Вы успешно начали процесс восстановления пароля. <br><br>
                        Инструкция была отправлена на указанную вами почту.
                    </p>
                <?php endif; ?>
                <?php if($_GET['key'] == "RegisterUser") : ?>
                    <p>
                        Спасибо вам за регистрацию! <br><br>
                        Для подтверждения своей личности войдите на указанную вами почту и перейдите по ссылке, как сказано в инструкции.
                    </p>
                <?php endif; ?>
                <?php if($_GET['key'] == "VerificationUser") : ?>
                    <p>
                        Ваш аккаунт успешно активирован! <br><br>
                        Приятного времени припровождения на сайте и удачи в трудных играх!
                    </p>
                <?php endif; ?>
                <?php if($_GET['key'] == "AlreadyVerified") : ?>
                    <p>
                        Ваш аккаунт уже активирован!
                    </p>
                <?php endif; ?>
                <?php if($_GET['key'] == "CompliteChangePassword") : ?>
                    <p>
                        Поздравляем! <br><br>
                        Вы успешно изменили пароль.
                    </p>
                <?php endif; ?>
            </div>
        </div>    
    </section>
    <?php include("src/footer.php"); ?>
</body>
</html>