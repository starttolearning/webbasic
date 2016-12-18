<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php $contexual = "admin"; ?>
<?php include_once("../inc/layouts/header.php"); ?>

<?php find_current_subject_or_page(); ?>

<div id="main">
    <div id="navigation">
        <?php
        $options = array(
            "subject_array" => $current_subject,
            "page_array" => $current_page,
            "public" => false,
        );
        ?>
        <?php echo navigations($options); ?>
    </div><!--  navigation-->

    <div id="page">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo wc_form_errors($errors); ?>
        <h2>Create Subject</h2>
        <form method="post" action="create-subject.php">
            <p>Subject name:
                <input type="text" name="menu_name" value=""/>
            </p>
            <p>Position:
                <select name="position">
                    <?php
                    $subject_sets = find_all_subjects();
                    $subject_count = mysqli_num_rows($subject_sets) + 1;
                    for ($count = 1; $count <= $subject_count; $count++) {
                        echo "<option value=\"{$count}\">{$count}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="0"/> No
                &nbsp;
                <input type="radio" name="visible" value="1"/> Yes
            </p>
            <p>
                <input type="submit" name="submit" value="Create Subject"/>
            </p>
        </form>
        <br/>
        <a href="manage-content.php">Cancel</a>
    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
