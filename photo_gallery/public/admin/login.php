<?php
require_once("../../inc/initialize.php");

if($session->is_logged_in()) {
    redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check database to see if username/password exist.
    $found_user = User::authenticate($username, $password);

    if ($found_user) {
        $session->login($found_user);
        log_action("Login", $found_user->username. "log in");
        redirect_to("index.php");
    } else {
        // username/password combo was not found in the database
        $message = "Username/password combination incorrect.";
    }

} else { // Form has not been submitted.
    $username = "";
    $password = "";
}

?>
<?php get_layout_template("admin-header"); ?>

    <h2>Staff Login</h2>
    <?php if(isset($message)){ echo output_message($message) ;} else{ echo ""; } ?>

    <form action="login.php" method="post">
        <table>
            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Login" />
                </td>
            </tr>
        </table>
    </form>
<?php get_layout_template("admin-footer"); ?>
