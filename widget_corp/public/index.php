<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php include_once("../inc/layouts/header.php"); ?>

<?php find_current_subject_or_page(); ?>

<div id="main">
    <div id="navigation">
        <?php echo public_navigation($current_subject, $current_page); ?>
        <br/>
        <a href="new-subject.php">+Add a subject</a>
    </div><!--  navigation-->

    <div id="page">
        <?php if ($current_subject) { ?>
            <h2>Manage subject</h2>
            <b>Subject name: </b> <?php echo htmlentities($current_subject['menu_name']); ?><br/>

            <a href="edit-subject.php?subject=<?php echo urlencode( $current_subject["id"] ); ?>">Edit subject</a>
        <?php } else if ($current_page) { ?>
            <h2>Manage Page</h2>
            <b>Page name:</b> <?php echo htmlentities($current_page['menu_name']); ?><br/>

            <p class="page-content"><?php echo htmlentities( $current_page['content'] ); ?></p>

        <?php } else { ?>
            <h2>Manage content</h2>
            Please select a subject or a page.
        <?php } ?>
    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
