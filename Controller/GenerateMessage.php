<?php
    include('SendEmail.php');

    class MessageForUser
    {
        public $Subject;
        public $Body;
        public $email;  
    }
    function GenMessage($email, $token, $keyMessage){
        //Верификация пользователя при регистрации
        if($keyMessage == "Register User"){
            $MailForUser = new MessageForUser();
            $MailForUser->Subject = "BeerPong.com Подтверждение аккаунта. Спасибо за регистрацию";
            $MailForUser->Body = '<div><p>Спасибо за регистрацию на нашем сайте!</p><br><a href="http://newspool.com/verification.php?token='.$token.'">Нажмите что бы активировать аккаунт</a></div> ';
            $MailForUser->email = $email; 
            SendingMessage($MailForUser);
        }
        //Проверка владения аккаунтом при восстановление пароля
        if($keyMessage == "Restore Password"){
            $user = R::findOne('users', 'email = ?', array($email));
            $UserToken = R::load('users', $user['id']);
            $UserToken->token = $token;
            R::store($UserToken);
            $MailForUser = new MessageForUser();
            $MailForUser->Subject = "BeerPong.com Восстановление пароля";
            $MailForUser->Body = '<div><p>Для восстановления пароля перейдите по ссылке</p><br><a href="http://newspool.com/ChangePassword.php?token='.$token.'&id='.$user['id'].'">Нажмите что бы изменить пароль</a></div> ';
            $MailForUser->email = $email; 
            SendingMessage($MailForUser);
            header("Location:/SentEmail.php?key=ChangePassword");
        }
    }