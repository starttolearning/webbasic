<?php
/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/16/2016
 * Time: 10:09 AM
 */

if( $_POST['submit']){
    $username = $_POST['username'];
    $password = $_POST['password'];
}

echo $username . ' : '.$password;