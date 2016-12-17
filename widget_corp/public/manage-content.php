<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php include_once("../inc/layouts/header.php"); ?>
<?php
if (isset($_GET["subject"])) {
    $selected_subject_id = $_GET["subject"];
    $selected_page_id = null;
} else if (isset($_GET["page"])) {
    $selected_page_id = $_GET["page"];
    $selected_subject_id = null;
} else {
    $selected_page_id = null;
    $selected_subject_id = null;
}
?>

<div id="main">
    <div id="navigation">
        <?php echo navigation($selected_subject_id, $selected_page_id); ?>

    </div><!--   navigation-->

    <div id="page">
        <h2>Manage Content</h2>
        <?php if ($selected_subject_id) { ?>
            <?php $current_subject = get_subject_name_by_id($selected_subject_id); ?>
            <b>Subject name:</b> <?php echo $current_subject['menu_name']; ?>
        <?php } else if ($selected_page_id) { ?>

            <?php $current_page = get_page_by_id($selected_page_id); ?>
            <b>Page name:</b> <?php echo $current_page['menu_name']; ?>
            <p><?php echo $current_page['content']; ?></p>
        <?php } else { ?>
            Please select a subject or a page.
        <?php } ?>


    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
