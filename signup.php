<?php
    require "db.php";
    include("Controller/NewUser.php");
    include("Controller/Verefication.php");

    $data = $_POST;
    if (isset($data['do_signup'])){
        $token = md5($data['login']).md5($securityKey);
        $NewUser = new User();
        $NewUser->login = $data['login'];
        $NewUser->token = $token;
        $NewUser->email = $data['email'];
        $NewUser->password = $data['password'];
        $NewUser->AgainPassword = $data['AgainPassword'];
        
        //Вызываю функцию анализа данных на верность введения
        verificationRegister($NewUser);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include("src/head.php");
    ?>
    <script src="js/LiveShowErrorRegistration.js?v<?=$js ?>"></script>
    <title>Регистрация</title>

</head>
<body style="background-image: url(img/fon.png); background-color: #212121;">
    <?php
        include("src/header.php");
    ?>
    <div class="container">
        <div class="mainBlock">
            <div class="headText">
                <p>Давай регайся cашка!</p>
            </div>
            <form action="" method="POST" class="formAuthorization">
                <div class="BlockFormInput">
                    <input type="text" name="login" placeholder="Логин" id="login" class="writeInfo" onblur="CheckFormRegistration(this.value, 'CheckLogin')" value="<?php echo @$data['name']; ?>" autofocus>
                    <p id="errorLogin">
                        
                    </p>
                </div>
                <div class="BlockFormInput">
                    <input type="text" name="email" placeholder="E-mail" class="writeInfo" id="email" onblur="CheckFormRegistration(this.value, 'CheckEmail')" value="<?php echo @$data['email']; ?>">
                    <p id="errorEmail">
                        
                    </p>
                </div>
                <div class="BlockFormInput">
                    <input type="password" name="password" placeholder="Пароль" class="writeInfo" id="password" onblur="CheckPassword(this.value, document.getElementById('AgainPassword').value)">
                    <p id="errorPassword">
                        
                    </p>
                </div class="BlockFormInput">
                <div class="BlockFormInput">
                    <input type="password" name="AgainPassword" placeholder="Повторите пароль" class="writeInfo" id="AgainPassword" onblur="CheckAgainPassword(this.value, document.getElementById('password').value)">
                    <p id="errorAgainPassword">
                        
                    </p>
                </div>
                <div>
                    <button type="submit" class="SendButton" name="do_signup">Зарегистрироваться</button>
                </div>                
            </form>
        </div>
    </div>
    <?php
        include("src/footer.php");
    ?>
</body>
</html>