<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sessions</title>
</head>
<body>
<?php
    $_SESSION['first_name'] ="Wilton";
    $name = $_SESSION['first_name'];

    echo $name;
?>
</body>
</html>