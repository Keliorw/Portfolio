<?php

    function SortPeopleWinRating($Table, $nameColum1){ 
        $user = R::getAll("SELECT * FROM $Table");
        $rating;
        $tmp = 0;
        foreach ($user as $key => $value) {
            foreach ($value as $key1 => $value2) {
                if($Table != 'users')
                    if($key1 == "loginplayer")
                        $rating[][$key1] = $value2;
                if ($key1 == $nameColum1){
                    $rating[$tmp][$key1] = $value2;
                }    
                if ($key1 == "win"){
                    $rating[$tmp][$key1] = $value2;
                    $tmp++;
                } 
            }
        }
        for ($i=0; $i < count($rating); $i++) { 
            foreach ($rating[$i] as $key1 => $value1) {
                if ($key1 == "win"){
                    for ($j=count($rating)-1; $j > $i; $j--) { 
                        if ($rating[$j-1][$key1] < $rating[$j][$key1]){
                            $mass_tmp = $rating[$j-1][$key1];
                            $rating[$j-1][$key1] = $rating[$j][$key1];
                            $rating[$j][$key1] = $mass_tmp;
                            $mass_tmp = $rating[$j-1][$nameColum1];
                            $rating[$j-1][$nameColum1] = $rating[$j][$nameColum1];
                            $rating[$j][$nameColum1] = $mass_tmp;
                            if($Table != 'users'){
                                $mass_tmp = $rating[$j-1]["loginplayer"];
                                $rating[$j-1]["loginplayer"] = $rating[$j]["loginplayer"];
                                $rating[$j]["loginplayer"] = $mass_tmp;
                            }
                        }
                    }
                }  
            }
        }
        return $rating;
    }

    function CounterIndexRating(){
        $rating = SortPeopleWinRating('users', 'login');
        foreach ($rating as $key => $value) {
                $tmp1 = $value['login'];
                $user = R::getAll('SELECT * FROM users WHERE login = ?', array("$tmp1"));
                if($user[0]['name'] != "")
                    $str = " ".$user[0]['name']." - ".$user[0]['win'];
                else
                    $str = " ".$user[0]['login']." - ".$user[0]['win'];                         
            if($key < 3){
                if ($key > 0){
                    $tmp = $key+1;
                    echo '<div style="margin-top: 8px;"><a href="AnyProfile.php?id='.$user[0]["id"].'&flag=1" class="rating-text">'.$tmp.'. '.$str.'</a></div>';    
                } else {
                    $tmp = $key+1;
                    echo '<div><a href="AnyProfile.php?id='.$user[0]["id"].'&flag=1" class="rating-text">'.$tmp.'. '.$str.'</a></div>';    
                }
            }
        }
    }

    function CounterRatinAll(){
        $rating = SortPeopleWinRating('users', 'login');
        foreach ($rating as $key => $value) {
            $tmp1 = $value['login'];
            $user = R::getAll('SELECT * FROM users WHERE login = ?', array("$tmp1"));
            if($user[0]['name'] != "")
                $str = " ".$user[0]['name']." - ".$user[0]['win'];
            else
                $str = " ".$user[0]['login']." - ".$user[0]['win'];                         
            if ($key > 0){
                $tmp = $key+1;
                echo '<div style="margin-top: 19px;"><a href="AnyProfile.php?id='.$user[0]["id"].'&flag=1" class="rating-text">'.$tmp.'. '.$str.'</a></div>';    
            } else {
                $tmp = $key+1;
                echo '<div><img src="img/star.png" style="height: 27px; width: 25px; margin-right: 12px;"><a href="AnyProfile.php?id='.$user[0]["id"].'&flag=1" class="rating-text">'.$str.'</a></div>';    
            }
        }
    }