<?php
    require_once("include-functions.php");
    if( isset(   $_POST['submit'] )){

        $username = $_POST['username'];
        $password = $_POST['password'];

        if( $username == "wilton" && $password == "wiltonlee"){
            redirect_to("index.php");
        }else {
            $message ="Some errors happens!";
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
    echo $message;
?>
<form method="post" action="form-single.php">
    Username: <input type="text" name="username" value="<?php echo $username; ?>" /> <br/>
    Password: <input type="password" name="password"  value=" "/> <br/>
    <input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>
