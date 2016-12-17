<?php
$name = "test";
$value = "hello";
$expire = time() + (60*60*24*7);

//setcookie($name,$value,$expire);

// Unset a cookie
setcookie($name,null);
setcookie($name,$value,time()-3600);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookies</title>
</head>
<body>
<?php
    $test = isset($_COOKIE['test']) ?$_COOKIE['test'] :"";

    echo $test;
?>
</body>
</html>