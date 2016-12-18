<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php include_once("../inc/layouts/header.php"); ?>

<?php find_current_subject_or_page(); ?>

<div id="main">
    <div id="navigation">
        <?php echo public_navigation($current_subject, $current_page); ?>
    </div><!--  navigation-->

    <div id="page">
        <?php echo message(); ?>
        <?php if ($current_subject) { ?>
            <h2>Current subject</h2>
            <b>Subject name: </b> <?php echo htmlentities($current_subject['menu_name']); ?><br/>
            Position: <?php echo $current_subject["position"] ?><br/>
            Visible: <?php echo $current_subject["visible"] ? "true" : "false"; ?><br/>
            <h2>Pages</h2>
            <?php $page_set = find_pages_for_subject($current_subject["id"]); ?>
            <ul>
                <?php
                $output = "";
                while ($pages = mysqli_fetch_assoc($page_set)) {
                    $output .= "<li ";
                    $output .= ">";
                    $output .= "<a href=\"index.php?page=" . urlencode($pages["id"]) . "\">" . htmlentities($pages["menu_name"]) . "</a></li>";

                }
                echo $output;
                ?>
            </ul>
        <?php } else if ($current_page) { ?>
            <h2><a href="index.php?subject=<?php echo urlencode( $current_page["subject_id"] ) ;?> "> <?php echo htmlentities($current_page["menu_name"]) ?> &raquo; </a>Current page</h2>
            <b>Page name:</b> <?php echo htmlentities($current_page['menu_name']); ?><br/>
            Position: <?php echo $current_page["position"] ?><br/>
            Visible: <?php echo $current_page["visible"] ? "true" : "false"; ?><br/>
            Content: <div class="page-content"><?php echo htmlentities($current_page['content']); ?></div>
        <?php } else { ?>
            <h2>Manage content</h2>
            Please select a subject or a page.
        <?php } ?>
    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
