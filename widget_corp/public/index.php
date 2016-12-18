<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php $contexual = "public"; ?>
<?php include_once("../inc/layouts/header.php"); ?>

<?php find_current_subject_or_page(true); ?>

<div id="main">
    <div id="navigation">
        <?php
        $options = array(
            "subject_array" => $current_subject,
            "page_array" => $current_page,
            "public" => true,
        );
        ?>
        <?php echo navigations($options); ?>
    </div><!--  navigation-->

    <div id="page">
        <?php echo message(); ?>
        <?php if ($current_page) { ?>
            <h2><?php echo htmlentities($current_page["menu_name"]); ?></h2>
            <p><?php echo nl2br( htmlentities( $current_page["content"] )); ?></p>
        <?php } else  { ?>
            <h2>Welcome</h2>
        <?php } ?>
    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
