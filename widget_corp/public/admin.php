<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php confirm_logged_in();  ?>
<?php $contexual = "admin"; ?>
<?php include_once("../inc/layouts/header.php"); ?>
    <div id="main">
        <div id="navigation">
        </div>
        <div id="page">
            <h2>Admin Menu</h2>
            <p>Welcome to the admin area, <?php if( isset($_SESSION["username"] )) echo htmlentities( $_SESSION["username"] ); ?></p>
            <ul class="admin-navigation">
                <li><a href="manage-content.php">Manage Website Content</a> </li>
                <li><a href="manage-admins.php">Manage Admin Users</a> </li>
                <li><a href="logout.php">Logout</a> </li>
            </ul>
        </div>
    </div>
<?php include_once("../inc/layouts/footer.php"); ?>
