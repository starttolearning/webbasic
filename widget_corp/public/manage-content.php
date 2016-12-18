<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php confirm_logged_in();  ?>
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
        <br/>
        <a href="new-subject.php">+Add a subject</a>
    </div><!--  navigation-->

    <div id="page">
        <?php echo message(); ?>
        <?php if ($current_subject) { ?>
            <h2>Manage subject</h2>
            <b>Subject name: </b> <?php echo htmlentities($current_subject['menu_name']); ?><br/>
            Position: <?php echo $current_subject["position"] ?><br/>
            Visible: <?php echo $current_subject["visible"] ? "true" : "false"; ?><br/>
            <a href="edit-subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>">Edit subject</a>
            <h2>Manage Pages</h2>
            <?php $page_set = find_pages_for_subject($current_subject["id"]); ?>
            <ul>
                <?php
                $output = "";
                while ($pages = mysqli_fetch_assoc($page_set)) {
                    $output .= "<li ";
                    $output .= ">";
                    $output .= "<a href=\"manage-content.php?page=" . urlencode($pages["id"]) . "\">" . htmlentities($pages["menu_name"]) . "</a></li>";

                }
                echo $output;
                ?>
            </ul>
            <a href="new-page.php?subject=<?php echo $current_subject["id"]; ?>">+Create new page</a>
        <?php } else if ($current_page) { ?>
            <h2>Manage Page</h2>
            <b>Page name:</b> <?php echo htmlentities($current_page['menu_name']); ?><br/>
            Position: <?php echo $current_page["position"] ?><br/>
            Visible: <?php echo $current_page["visible"] ? "true" : "false"; ?><br/>
            Content:
            <div class="page-content"><?php echo htmlentities($current_page['content']); ?></div>
            <br/>
            <a href="edit-page.php?page=<?php echo urlencode($current_page["id"]); ?>">Edit</a>

        <?php } else { ?>
            <h2>Manage content</h2>
            Please select a subject or a page.
        <?php } ?>
    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
