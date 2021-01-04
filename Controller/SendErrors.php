<?php 
    function SendErrors($errors){
        echo '<div style="background-color: #8f0404; color: white; height: 30px; font-family: Montserrat, sans-serif; text-align: center; padding-top: 10px;">'.array_shift($errors).'</div>';
    }
?>