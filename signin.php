<?php
    require "db.php";
    include("Controller/Verefication.php");

    $data = $_POST;
    if(isset($data['name']) && isset($data['password'])){
        //Создание объекта входящего пользователя
        $loginUser = new LoginUser();
        // Логин или Email
        $loginUser->LoginOrEmail = $data['name'];
        // Пароль
        $loginUser->password = $data['password'];

        //Функция проверки правильно ли введены данные пользователем
        verificationUser($loginUser);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include("src/head.php");
    ?>
    <title>Регистрация</title>
</head>
<body style="background-image: url(img/fon.png); background-color: #212121;">
    <?php
        include("src/header.php");
    ?>
    <div class="container">
        <div class="mainBlock">
            <div class="headText">
                <p>Давай входи cашка!</p>
            </div>
            <form action="" method="POST" class="formAuthorization">
                <div class="BlockFormInput">
                    <input type="text" name="name" placeholder="Логин или E-mail" class="writeInfo" value="<?php echo @$data['name']; ?>">
                </div>
                <div class="BlockFormInput">
                    <input type="password" name="password" placeholder="Пароль" class="writeInfo">
                </div>
                <button type="submit" class="SendButton">Войти</button>
                <a href="RestorePassword.php" class="restorePassword">Забыли пароль?</a>
            </form>
        </div>
    </div>
    <?php
        include("src/footer.php");
    ?>
</body>
</html>