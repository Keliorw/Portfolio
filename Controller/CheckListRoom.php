<?php
    require "../db.php";

    echo CheckName();

    function CheckName(){
        $errors = array();
        if( R::count('listroom', "name = ?", array($_POST['Name'])) > 0 )
            $errors[] = "Такое имя уже занято";

        if ($_POST['Name'] == "") {
            $errors[] = "Введите имя";
        }
        
        if(empty($errors))
            return "success";
        else 
            return array_shift($errors);
    }