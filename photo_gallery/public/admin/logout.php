<?php
require_once("../../inc/initialize.php");
$session->logout();
redirect_to('login.php');
?>
