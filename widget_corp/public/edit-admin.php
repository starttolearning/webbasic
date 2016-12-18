<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php confirm_logged_in();  ?>
<?php $contexual = "admin"; ?>
<?php include_once("../inc/layouts/header.php"); ?>
<?php include_once("../inc/validation-functions.php"); ?>
<?php

if (isset($_GET["admin"])) {
    $admin_id = $_GET["admin"];
    $current_admin = find_admin_by_id($admin_id);
    if (!$current_admin) {
        // Subject ID was missing  or invalid or
        // Subject cannot find in the database
        redirect_to("manage-admins.php");
    }
}
?>

<?php

if (isset($_POST['submit'])) {
    // Validation
    $required_fields = array("username", "password");
    validate_presences($required_fields);
    $fields_with_max_lengths = array("username" => 20, "password" => 16);
    validate_max_lengths($fields_with_max_lengths);

    if (empty($errors)) {
        $username = mysqli_prep($_POST['username']);
        $password = mysqli_prep($_POST['password']);
        $hashed_password = password_encrypt($password);
        $admin_id = $current_admin["id"];
        // Query string

        $query = "UPDATE admins SET ";
        $query .= "username = '{$username}', ";
        $query .= "password ={$hashed_password}, ";
        $query .= "WHERE id = {$admin_id} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);
        if ($result && mysqli_affected_rows($connection) >= 0) {
            // Success
            $_SESSION["message"] = "User update.";
            redirect_to("manage-admins.php");
        } else {
            // Failed
            $message = "User update failed.";
        }
    }
} else {
//    redirect_to("new-subject.php");
}  // end: if (isset($_POST['submit']))

?>


<div id="main">
    <div id="navigation">

    </div><!--  navigation-->
    <div id="page">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo wc_form_errors($errors); ?>
        <h2>Create new admin</h2>
        <form method="post" action="new-admin.php">
            <p>Username:
                <input type="text" name="username" value="<?php echo $current_admin["username"] ?>"/>
            </p>
            <p>Password:
                <input type="password" name="password" value=""/>
            </p>
            <p>
                <input type="submit" name="submit" value="Edit User"/>
            </p>
        </form>
        <a href="manage-admins.php">Cancel</a> &nbsp; &nbsp; <a href="manage-admins.php?admin=<?php echo $current_admin["id"]; ?>" onclick="return confirm('Are you sure'); " >Delete</a>
    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
