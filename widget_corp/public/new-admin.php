<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php $contexual = "admin"; ?>
<?php include_once("../inc/layouts/header.php"); ?>
<?php include_once("../inc/validation-functions.php"); ?>
<?php
// perform creating user
if (isset($_POST['submit'])) {



    // Validation
    $required_fields = array("username", "password");
    validate_presences($required_fields);
    $fields_with_max_lengths = array("username" => 20, "password" => 16);
    validate_max_lengths($fields_with_max_lengths);

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        redirect_to("new-admin.php");
    }
    // Query string
    $username = mysqli_prep($_POST['username']);
    $password = mysqli_prep($_POST['password']);

    $hashed_password = password_encrypt($password);

    $query = "INSERT INTO admins ( ";
    $query .= "username, hashed_password ) ";
    $query .= "VALUES ('{$username}','{$hashed_password}') ";
    $result = mysqli_query($connection, $query);
    if ($result) {
        // Success
        $_SESSION["message"] = "Admin created.";
        redirect_to("manage-admins.php");
    } else {
        // Failed
        $_SESSION["message"] = "Admin creating failed.";
        redirect_to("new-admin.php");
    }
}

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
                <input type="text" name="username" value=""/>
            </p>
            <p>Password:
                <input type="password" name="password" value=""/>
            </p>
            <p>
                <input type="submit" name="submit" value="Create User"/>
            </p>
        </form>
        <a href="manage-admins.php">Cancel</a>
    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
