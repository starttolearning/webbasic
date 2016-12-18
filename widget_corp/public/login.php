<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php $contexual = "admin"; ?>
<?php include_once("../inc/layouts/header.php"); ?>
<?php include_once("../inc/validation-functions.php"); ?>
<?php

$username = "";

if (isset($_POST['submit'])) {
    // Validation
    $required_fields = array("username", "password");
    validate_presences($required_fields);

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        redirect_to("login.php");
    } else {
        $username = mysqli_prep($_POST['username']);
        $password = mysqli_prep($_POST['password']);
        $found_admin = attempt_login($username, $password);

    if ($found_admin) {
        // Success
        // Mark user logged
        $_SESSION["admin_id"] = $found_admin["id"];
        $_SESSION["username"] = $found_admin["username"];
        redirect_to("admin.php");
    } else {
        // Failed
        $_SESSION["message"] = "Username/Password not found.";
    }
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
        <form method="post" action="login.php">
            <p>Username:
                <input type="text" name="username" value="<?php echo htmlentities( $username ); ?>"/>
            </p>
            <p>Password:
                <input type="password" name="password" value=""/>
            </p>
            <p>
                <input type="submit" name="submit" value="Log in"/>
            </p>
        </form>
    </div><!--    page-->

</div><!--main-->

<?php include_once("../inc/layouts/footer.php"); ?>
