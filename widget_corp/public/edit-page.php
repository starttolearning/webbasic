<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php include_once("../inc/validation-functions.php"); ?>
<?php find_current_subject_or_page(); ?>
<?php include_once("../inc/layouts/header.php"); ?>
<?php
if (!$current_page) {
    // Subject ID was missing  or invalid or
    // Subject cannot find in the database
    redirect_to("manage-content.php");
}
?>
<?php

if (isset($_POST['submit'])) {

    // Validation
    $required_fields = array("menu_name", "position", "visible","content");
    validate_presences($required_fields);
    $fields_with_max_lengths = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if (empty($errors)) {
        $id = $current_page["id"];
        $menu_name = mysqli_prep($_POST['menu_name']);
        $position = $_POST['position'];
        $visible = $_POST['visible'];
        $content = mysqli_prep($_POST["content"]);
        // Query string

        $query = "UPDATE pages SET ";
        $query .= "menu_name = '{$menu_name}', ";
        $query .= "position ={$position}, ";
        $query .= "visible = {$visible}, ";
        $query .= "content = '{$content}' ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";
        echo $query;
        $result = mysqli_query($connection, $query);
        if ($result && mysqli_affected_rows($connection) >= 0) {
            // Success
            $_SESSION["message"] = "Page update.";
            redirect_to("manage-content.php?subject=".urlencode( $current_page["subject_id"]));
        } else {
            // Failed
            $message = "Page update failed.";
        }
    }
} else {
//    redirect_to("new-subject.php");
}  // end: if (isset($_POST['submit']))

?>

<div id="main">
    <div id="navigation">
        <?php echo navigation($current_subject, $current_page); ?>
    </div><!--  navigation-->

    <div id="page">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo wc_form_errors($errors); ?>
        <h2>Create new page</h2>
        <form method="post" action="edit-page.php?page=<?php echo urlencode($current_page["id"]); ?>">
            <p>Page name:
                <input type="text" name="menu_name" value="<?php echo htmlentities( $current_page["menu_name"] ); ?>"/>
            </p>
            <p>Position:
                <select name="position">
                    <?php
                    $page_set = find_pages_for_subject( $current_page["subject_id"] );
                    $page_count = mysqli_num_rows($page_set);
                    for ($count = 1; $count <= $page_count; $count++) {
                        echo "<option value=\"{$count}\" ";
                        if( $current_page["id"] == $count ){
                            echo "selected";
                        }
                        echo ">{$count}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="0" <?php echo $current_page["visible"] ? "checked" : ""; ?>  /> No
                &nbsp;
                <input type="radio" name="visible" value="1"  <?php echo $current_page["visible"] ? "checked" : ""; ?> /> Yes
            </p>
            <p>Content:<br/>
                <textarea name="content" cols="80" rows="10"><?php echo htmlentities( $current_page["content"]); ?></textarea>
            </p>
            <p>
                <input type="submit" name="submit" value="Edit Page"/>
            </p>
        </form>
        <a href="manage-content.php?subject=<?php echo urlencode(  $current_page["subject_id"]); ?>">Cancel</a>
        &nbsp; &nbsp;
        <a href="delete-page.php?page=<?php echo urlencode(  $current_page["id"] ); ?>" onclick="return confirm('Are your sure?'); ">Delete</a>

    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
