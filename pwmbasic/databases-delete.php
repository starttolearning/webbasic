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
    $id = 5;
    // 2. Perform database query
    $query = "DELETE FROM subjects ";
    $query .= "WHERE id = '{$id}' ";
    $query .= "LIMIT 1";


    $result =  mysqli_query( $connection, $query );
    // Test if there was a query error
    if(  $result && mysqli_affected_rows($connection) == 1){
        // Success
        // redirect_to("somepage.php");
        echo "Success!";

    }else {
        die( "Data query failed ".mysqli_error($connection) );
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