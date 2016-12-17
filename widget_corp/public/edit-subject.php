<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php include_once("../inc/validation-functions.php"); ?>
<?php find_current_subject_or_page(); ?>
<?php include_once("../inc/layouts/header.php"); ?>
<?php
if (!$current_subject) {
    // Subject ID was missing  or invalid or
    // Subject cannot find in the database
    redirect_to("manage-content.php");
}
?>
<?php

if (isset($_POST['submit'])) {


    // Validation
    $required_fields = array("menu_name", "position", "visible");
    validate_presences($required_fields);
    $fields_with_max_lengths = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if (empty($errors)) {
        $menu_name = mysqli_prep($_POST['menu_name']);
        $position = $_POST['position'];
        $visible = $_POST['visible'];
        $id = $current_subject["id"];
        // Query string

        $query = "UPDATE subjects SET ";
        $query .= "menu_name = '{$menu_name}', ";
        $query .= "position ={$position}, ";
        $query .= "visible = {$visible} ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";

        $result = mysqli_query($connection, $query);
        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
            $_SESSION["message"] = "Subject update.";
            redirect_to("manage-content.php");
        } else {
            // Failed
            $message = "Subject update failed.";
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
        <?php if (!empty($message)) {
            echo "<div class=\"message\"" . $message . "</div>";
        } ?>
        <?php echo wc_form_errors($errors); ?>
        <h2>Edit Subject: <em><?php echo $current_subject["menu_name"]; ?></em></h2>
        <form method="post" action="edit-subject.php?subject=<?php echo $current_subject["id"]; ?>">
            <p>Subject name:
                <input type="text" name="menu_name" value="<?php echo $current_subject["menu_name"]; ?>"/>
            </p>
            <p>Position:
                <select name="position">
                    <?php
                    $subject_sets = find_all_subjects();
                    $subject_count = mysqli_num_rows($subject_sets);
                    for ($count = 1; $count <= $subject_count; $count++) {
                        echo "<option value=\"{$count}\"";
                        if ($current_subject["position"] == $count) {
                            echo " selected";
                        }
                        echo ">{$count}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="0" <?php
                if ($current_subject["visible"] == 0) echo "checked";
                ?> /> No
                &nbsp;
                <input type="radio" name="visible" value="1" <?php
                if ($current_subject["visible"] == 1) echo "checked";
                ?> /> Yes
            </p>
            <p>
                <input type="submit" name="submit" value="Edit Subject"/>
            </p>
        </form>
        <br/>
        <a href="manage-content.php">Cancel</a>
        &nbsp; &nbsp;
        <a href="delete-subject.php?subject=<?php echo $current_subject["id"]; ?>" onclick="return confirm('Are your sure?'); ">Delete</a>
    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
