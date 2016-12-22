<?php

require_once("../inc/initialize.php");

get_layout_template("header");

?>

<h2>Photos</h2>
<?php $photos = Photograph::find_all(); ?>
<?php foreach ($photos as $photo): ?>
<div style="float: left; margin-left: 20px;" >
  <a  href="photo.php?id=<?php echo $photo->id;  ?>">
    <img width="200" src="<?php echo $photo->image_path(); ?>"/>
  </a>
  <p> <?php echo $photo->caption; ?></p>
</div>
<?php endforeach; ?>
<?php get_layout_template("footer"); ?>
