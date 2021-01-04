<?php
    require_once "../db.php";

    if(isset($_FILES['Avatar'])){
        $file_name = $_FILES['Avatar']['name'];
        $file_size = $_FILES['Avatar']['size'];
        $file_tmp = $_FILES['Avatar']['tmp_name'];
        $file_type = $_FILES['Avatar']['type'];
        $file_type_text = substr($file_name, strripos( $file_name, "." , $offset= -1 ), strlen($file_name));
        $file_name = substr($file_name, 0 ,strripos( $file_name, "." , $offset= -1 ));
        $file_name = md5(microtime() . rand(0, 9999));
        $errors = array();
        $expensions = array("image/jpeg","image/jpg","image/png");

        for($i=0; $i<=count($expensions)-1; $i++){
            if($file_type == $expensions[$i]){
                break;
            } else {
                if($i == count($expensions)-1){
                    $errors[] = "Файл не подходящего типа!";
                }
            }
        }

        if(empty($errors)){
            move_uploaded_file($file_tmp, "../avatars/".$file_name.$file_type_text);
            $user = R::load('users', $_SESSION['logged_user']->id);
            $user->avatar = $file_name.$file_type_text;
            R::store($user);
            echo "Success";
            echo $file_name.$file_type_text;
        }else{
            echo array_shift($errors);
        }
    }

    if(isset($_POST['NowAvatarChange'])){
        $user = R::load('users', $_SESSION['logged_user']->id);
        $user->avatar = $_POST['NowAvatarChange'];
        R::store($user);
        echo $_POST['NowAvatarChange'];
    }
?>