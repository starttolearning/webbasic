<?php

function get_db_con() {
    $mysqli = new mysqli('localhost', 'webbasic', 'webbasic', 'webbasic');
    if ($mysqli->connect_errno) {
        printf("Connect faild:%s\n", $mysqli->connect_error);
        exit();
    }
    return $mysqli;
    
}

?>

