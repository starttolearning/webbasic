<?php
    // Include function to work with
    require_once("include-functions.php");
    require_once('validation-functions.php');

    // Initial variable
    $message ="";
    $errors = array();

    if( isset( $_POST['submit'] )){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $filed_required = array('username','password');

        foreach ( $filed_required as $filed ){
            $value = trim($_POST[$filed]);
            if( ! has_presence( $value ) ){
                $errors[$filed] = ucfirst( $value )  ." Cannot be blank.";
            }
        }

        $fields_with_max_lengths = array('username' => 30, 'password' =>8);
        validate_max_lengths($fields_with_max_lengths);

        if( empty( $errors )){
            if( $username == "wilton" && $password == "wiltonlee"){
                redirect_to("index.php");
            }else {
                $message ="Some errors happens!";
            }
        }
    }else {
        $username = "";
        $message = "Please log in";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
</head>
<body>
<?php
    echo form_errors($errors);
    echo $message;
?>
<form method="post" action="form-with-validation.php">
    Username: <input type="text" name="username" value="<?php echo $username; ?>" /> <br/>
    Password: <input type="password" name="password"  value=" "/> <br/>
    <input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>
