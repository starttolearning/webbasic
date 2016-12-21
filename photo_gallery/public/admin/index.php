<?php
require_once("../../inc/initialize.php");
if (!$session->is_logged_in()) { redirect_to("login.php"); }
get_layout_template("admin-header");
?>

    <h2>Menu</h2>

</div>
<?php get_layout_template("admin-footer"); ?>

