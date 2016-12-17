<?php
    // 1. Create a database connection
    $dbost = "localhost";
    $dbuser = "widget";
    $dbpass = "widget";
    $dbname = "widget_corp";

    $connection = mysqli_connect($dbost, $dbuser, $dbpass, $dbname);

    // Test if connection occurred
    if( mysqli_connect_errno() ){
        die("Database connection failed".
            mysqli_connect_error() .
            "(".mysqli_connect_errno() .")"
        );
    }

    // Often these are form values in $_POST
    $menu_name = "Today's Widget Trivia";
    $position = 5;
    $visible =1;
    //Escape all strings
    $menu_name = mysqli_real_escape_string($connection, $menu_name);

    // 2. Perform database query
    $query = "INSERT INTO subjects(menu_name, position, visible) ";
    $query .= "VALUES ('{$menu_name}',{$position},{$visible}) ";
    $result =  mysqli_query( $connection, $query );
    // Test if there was a query error
    if( ! $result ){
        die( "Data query failed ".mysqli_error($connection) );
    }else {
        // Success
        // redirect_to("somepage.php");
        echo "Success!";
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Databases</title>
</head>
<body>


</body>
</html>

<?php
    // 5. Close database connection
    mysqli_close($connection);
?>