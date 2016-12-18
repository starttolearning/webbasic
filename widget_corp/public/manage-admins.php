<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php $contexual = "admin"; ?>
<?php include_once("../inc/layouts/header.php"); ?>
<?php
if (isset($_GET["admin"])) {


    $current_admin = find_admin_by_id($_GET["admin"]);
    if (!$current_admin) {
        // Subject ID was missing  or invalid or
        // Subject cannot find in the database
        $_SESSION["message"] = "User doesn't existed!.";
        redirect_to("manage-admins.php");
    }

    $id = $current_admin["id"];
    $query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
        // Success
        $_SESSION["message"] = "Admin deleted.";
        redirect_to("manage-admins.php");
    } else {
        // Failed
        $_SESSION["message"] = "Admin delete failed.";
        redirect_to("manage-admins.php");
    }
}
?>

    <div id="main">
        <div id="navigation">
        </div><!--  navigation-->

        <div id="page">
            <?php echo message(); ?>
            <h2>Manage Admins</h2>
            <table border="0" style=" border-collapse: collapse;">
                <thead>
                <tr style="font-weight:bold;">
                    <td width="150">Name</td>
                    <td width="150">Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php $admin_set = find_all_admins(); ?>
                <?php
                $output = "";
                while ($admins = mysqli_fetch_assoc($admin_set)) {
                    $output .= "<tr ";
                    $output .= ">";
                    $output .= "<td>";
                    $output .= htmlentities($admins["username"]);
                    $output .= "</td>";
                    $output .= "<td>";
                    $output .= "<a href=\"edit-admin.php?admin=" . urlencode($admins["id"]) . "\">Edit</a>";
                    $output .= "&nbsp;|&nbsp;<a href=\"manage-admins.php?admin=" . urlencode($admins["id"]) . "\">Delete</a></td>";
                    $output .= "</tr>";
                }
                echo $output;
                ?>
                </tbody>
            </table>
            <br/><br/>
            <a href="new-admin.php">+Create new user</a>
        </div><!--    page-->

    </div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>