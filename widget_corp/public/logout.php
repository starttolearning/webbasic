<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php

// v1. simple logout
// session_start();
$_SESSION["admin_id"] =null;
$_SESSION["username"] =null;
redirect_to("login.php");

?>

<?php
/*
// v2. destroy session
// assumes nothing else in the session to keep
session_start();
$_SESSION = array();
if( isset( $_COOKIE[session_name()]) ){
    setcookie(session_name(),null, time()-4200, '/');
}
session_destroy();
redirect_to("login.php");
*/
?>
