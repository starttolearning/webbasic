<?php

require_once("../inc/initialize.php");

if( empty( $_GET['id']) ){
  $session->message("No photograph id was provided. ");
  redirect_to('photos.php');
}

$photo = Photograph::find_by_id( $_GET['id'] );
if( ! $photo){
  $session->message("The photo could not located. ");
  redirect_to('photos.php');
}

get_layout_template("header");
?>
<a href="photos.php"> &laquo; Back </a>
<br/>
<div style="float: left; margin-left: 20px;" >
  <img  src="<?php echo $photo->image_path(); ?>"/>
</div>

<?php get_layout_template("footer"); ?>
