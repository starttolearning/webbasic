<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data and time</title>
</head>
<body>
<?php
$timestamp = time();

echo strftime("The data today is: %m/%d/%Y",$timestamp);
echo "<br/>";

function strip_zeros_from_date( $marked_string ="" ){
    // remove the marked zero
    $no_zeros = str_replace("*0","",$marked_string);

    $clear_string = str_replace("*", "", $no_zeros);

    return $clear_string;
}

echo strip_zeros_from_date( strftime("The data today is: *%m/*%d/%Y",$timestamp) );
echo "<br/>";

// format date and time from sql storing
$db = time();

$sql_dt = strftime("%Y-%m-%d %H:%M:%S", $db);

echo $sql_dt;


?>
</body>
</html>