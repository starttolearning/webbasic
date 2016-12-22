<?php
require_once("../../inc/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}

if( empty( $_GET['id'] ) ){
  $session->message("No photograph id provided.");
  redirect_to("index.php");
}

$photo = Photograph::find_by_id( $_GET['id'] );

if( $photo && $photo->destroy()){
  $session->message("The photo was deleted.");
  redirect_to("photo-list.php");
}else {
  $session->message("The photo could not be deleted.");
  redirect_to('photo-list.php');
}

?>
