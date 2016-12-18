<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php confirm_logged_in();  ?>
<?php find_current_subject_or_page(); ?>
<?php
if (!$current_page) {
    // Subject ID was missing  or invalid or
    // Subject cannot find in the database
    redirect_to("manage-content.php");
}

$id = $current_page["id"];

$query = "DELETE FROM pages WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Page deleted.";
    redirect_to("manage-content.php");
} else {
    // Failed
    $_SESSION["message"] = "Page delete failed.";
    redirect_to("manage-content.php?subject=".urlencode($current_page["subject_id"]));
}

?>
