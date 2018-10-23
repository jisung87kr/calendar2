<?php
    $mysqli = new mysqli("localhost", "calendar2", "111111", "calendar2");
    if($mysqli->connect_errno){
        echo $mysqli->connect_errno;
        exit;
    }

    $board = new board('schedule');
 ?>
