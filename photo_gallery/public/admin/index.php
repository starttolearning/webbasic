<?php
require_once("../../inc/initialize.php");
if (!$session->is_logged_in()) { redirect_to("login.php"); }
get_layout_template("admin-header")
?>
<?php if (isset($message)) {
    echo output_message($message);
} else {
    echo "";
} ?>

    <h2>Menu</h2>
    <ul>
      <li><a href="logfile.php" >Log File</a></li>
      <li><a href="photo-list.php" >Photos list</a></li>
      <li><a href="photo-upload.php" >Photo upload</a></li>
      <li><a href="logout.php" >Log out</a></li>
    </ul>

</div>
<?php get_layout_template("admin-footer"); ?>
