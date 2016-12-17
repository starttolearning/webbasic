<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>

<?php
$current_subject = get_subject_name_by_id($_GET["subject"]);
if (!$current_subject) {
    // Subject ID was missing  or invalid or
    // Subject cannot find in the database
    redirect_to("manage-content.php");
}

$id = $current_subject["id"];
$page_set = find_pages_for_subject($id);

if( mysqli_num_rows( $page_set ) > 0){
    $_SESSION["message"] = "Can not delete a subject with pages.";
    redirect_to("manage-content.php?subject=".$id );
}

$query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Subject deleted.";
    redirect_to("manage-content.php");
} else {
    // Failed
    $_SESSION["message"] = "Subject delete failed.";
    redirect_to("manage-content.php?subject={$id}");
}

?>
