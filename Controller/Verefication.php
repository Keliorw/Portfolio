<?php
    require_once "db.php";
    include("SendErrors.php");
    include("CreateRoom.php");
    include_once("GenerateMessage.php");
    include_once("NewUser.php");
    include_once("LoginUser.php");
    include_once("ChangeSettingUser.php");
    include_once("JoinRoom.php");

    function CheckNameUser($name){
        $errors = array();

        if( !preg_match("/^[0-9\w\d\s]/iu",$name) )
            $errors[] = "Введены недопустимые символы";
        
        if( $_SESSION['logged_user']->name == $name)
            $errors[] = "У вас уже установлено такое имя";

        if( strlen($name) <= 2)
            $errors[] = "Имя слишком короткое";

        if( strlen($name) > 16)
            $errors[] = "Имя слишком длинное";
        
        if(empty($errors)){
            ChangeNameUser($name);
        } else {
            SendErrors($errors);
        }
    }

    //Проверка данных на правильность введения при регистрации
    function verificationRegister(User $NewUser){
        $errors = array();
        
        if(empty(trim($NewUser->login))){
            $errors[] = "Введите ваше имя";
        }
        if(empty($NewUser->password)){
            $errors[] = "Введите пароль";
        }
        if(empty($NewUser->email)){
            $errors[] = "Введите ваш E-mail";
        }
        if (empty($NewUser->AgainPassword)){
            $errors[] = "Повторите пароль";
        }
        if ($NewUser->password != $NewUser->AgainPassword){
            $errors[] = "Ваши пароли не совпадают";
        }
        if (strlen($NewUser->password) < 4){
            $errors[] = "Ваш пароль слишком короткий";
        }
        if( R::count('users', "login = ?", array($NewUser->login)) > 0 ){
            $errors[] = "Такой логин уже занят";
        }
        if( R::count('users', "email = ?", array($NewUser->email)) > 0 ){
            $errors[] = "Такая почта уже занята";
        }

        if (empty($errors)){
            GenMessage($NewUser->email, $NewUser->token, "Register User");
            RegisterUser($NewUser);
        } else {
            SendErrors($errors);
        }
    }

    //Проверка данных на правильность при входе на сайт
    function verificationUser(LoginUser $loginUser){
        // Объявление массива для ошибок
        $errors = array();

        // Проверка логинов в бд нет ли сходства
        $user = R::findOne('users', 'login = ?', array($loginUser->LoginOrEmail));
        if (empty($user)){
            // Если логин не найден, то проверяем по E-mail
            $user = R::findOne('users', 'email = ?', array($loginUser->LoginOrEmail));
        }
        if ($user){
            //Логин существует
            if(password_verify($loginUser->password, $user->password)){
                LoginUser($user);
            } else {
                $errors[] = 'Вы неверно ввели пароль';
            }
        } else {
            $errors[] = 'Вы неверно ввели логин или Email';
        }
        if(isset($errors)){
            SendErrors($errors);   
        }
    }

    // Проверка существует ли такой Email в БД при запросе на восстановление пароля
    function RestorePasswordEmail($email){
        $errors = array();

        //Ввёл ли пользователь хоть какой-то текст
        if(empty($email)){
            $errors[] = 'Введите свой E-mail';
        }
        // Есть ли пользователь с таким Email
        if ( R::count('users', "email = ?", array($email)) == 0){
            $errors[] = "Такой почты не существует";
        }

        if (empty($errors)){
            return true;
        } else {
            SendErrors($errors);
            return false;
        }
    }

    //Проверка по правилам ли введён пароль + проверка не устарела ли ссылка на изменения пароля
    function RestorePasswordCheck($Password, $id){
        $errors = array();

        if(empty($Password['password'])){
            $errors[] = "Введите пароль";
        }

        if (empty($Password['AgainPassword'])){
            $errors[] = "Повторите пароль";
        }

        if ($Password['password'] != $Password['AgainPassword']){
            $errors[] = "Ваши пароли не совпадают";
        }

        if (strlen($Password['password']) < 4){
            $errors[] = "Ваш пароль слишком короткий";
        }

        //Проверка присутствует ли токен в БД у пользователя
        $user = R::findOne('users', 'id = ?', array($id));
        if($user->token == NULL || $user->token == ""){
            $errors[] = 'Ссылка для восстановления пароля устарела';
        }

        if (empty($errors)){
            return true;
        } else {
            SendErrors($errors);
            return false;
        }
    }

    function CheckDataRoom($name, $password, $AgainPassword){
        $errors = array();
        $user = R::load('users', $_SESSION['logged_user']->id);

        if( R::count('listroom', "name = ?", array($name)) > 0 )
            $errors[] = "Такое имя уже занято";

        if ($name == "") {
            $errors[] = "Введите имя комнаты";
        }

        if(empty($password)){
            $errors[] = "Введите пароль";
        }

        if (empty($AgainPassword)){
            $errors[] = "Повторите пароль";
        }

        if ($password != $AgainPassword){
            $errors[] = "Ваши пароли не совпадают";
        }

        if (strlen($password) < 4){
            $errors[] = "Ваш пароль слишком короткий";
        }
        if($user->roomactive != ""){
            $errors[] = "Вы уже находитесь в комнате";
        }

        if($user->security <= 1){
            $errors[] = "У вас недостаточно прав для создания комнаты";
        }

        if(empty($errors))
            CreateRoom($name, $password);
        else 
            SendErrors($errors);
    }

    function CheckPasswordRoom($password){
        if(isset($_SESSION['logged_user'])){
            $room = R::getAll("SELECT * FROM listroom WHERE roomid = ?", array($_GET['roomid']));
            $user = R::load('users', $_SESSION['logged_user']->id);
            if(password_verify($password, $room[0]['password'])){
                if($user->roomactive == ""){
                    if($user->security < 1){
                        $errors[] = "Верефецируйте аккаунт";
                        SendErrors($errors);
                    } else {
                        JoinRoom($room[0]['id']);
                    }
                } else { 
                    $errors[] = "Вы уже находитесь в комнате";
                    SendErrors($errors);
                }
            } else {
                $errors[] = "Введён не верный пароль";
                SendErrors($errors);
            }
        } else {
            $errors[] = "Войдите в аккаунт, что бы войти в комнату";
            SendErrors($errors);
        }
    }