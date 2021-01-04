<?php
    require './phpmailer/PHPMailerAutoload.php';

    function SendingMessage(MessageForUser $Message){
        require_once("phpmailer/PHPMailerAutoload.php");
        $mail = new PHPMailer;
        $mail->CharSet = 'utf-8';
        //$mail->SMTPDebug = 3;

        $mail->isSMTP();   
        $mail->Host = 'smtp.mail.ru';  
        $mail->SMTPAuth = true; 
        $mail->Username = 'trofaes12@mail.ru';  // почта в которую надо войти, что бы отпраить сообщение
        $mail->Password = 'Fislin228';  // пароль от этой почты
        $mail->SMTPSecure = 'ssl';   
        $mail->Port = 465;              

        $mail->setFrom('trofaes12@mail.ru'); // почта отправителя
        $mail->addAddress($Message->email);   // почта получателя
        $mail->isHTML(true);                                 

        $mail->Subject = $Message->Subject;  // заголовок сообщения
        $mail->Body = $Message->Body; // Само сообщение

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }
