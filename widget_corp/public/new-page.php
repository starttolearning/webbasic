<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php include_once("../inc/layouts/header.php"); ?>

<?php find_current_subject_or_page(); ?>

<div id="main">
    <div id="navigation">
        <?php echo navigation($current_subject, $current_page); ?>
    </div><!--  navigation-->

    <div id="page">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo wc_form_errors($errors); ?>
        <h2>Create new page</h2>
        <form method="post" action="create-page.php?subject=<?php echo urlencode($current_subject["id"]); ?>">
            <p>Page name:
                <input type="text" name="menu_name" value=""/>
            </p>
            <p>Position:
                <select name="position">
                    <?php
                    $page_set = find_pages_for_subject( $current_subject["id"] );
                    $page_count = mysqli_num_rows($page_set) + 1;
                    for ($count = 1; $count <= $page_count; $count++) {
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
            <p>Content:<br/>
                <textarea name="content" cols="80" rows="10"></textarea>
            </p>
            <p>
                <input type="submit" name="submit" value="Create Page"/>
            </p>
        </form>
        <a href="manage-content.php?subject=<?php echo urlencode(  $current_subject["id"]); ?>">Cancel</a>
    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
