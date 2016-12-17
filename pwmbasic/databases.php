<?php
    // 1. Create a database connection
    $dbost = "localhost";
    $dbuser = "widget";
    $dbpass = "widget";
    $dbname = "widget_corp";

    $connection = mysqli_connect($dbost, $dbuser, $dbpass, $dbname);


/**
$stmt = mysqli_prepare($connection,$query);
mysqli_stmt_bind_param( $stmt, 'i', $visible );

mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $id, $menu_id, $position, $visible);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
 */
    // Test if connection occurred
    if( mysqli_connect_errno() ){
        die("Database connection failed".
            mysqli_connect_error() .
            "(".mysqli_connect_errno() .")"
        );
    }

    // 2. Perform database query
    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE visible =1 ";
    $query .= "ORDER BY position DESC";
    $result =  mysqli_query( $connection, $query );
    // Test if there was a query error
    if( ! $result ){
        die("Data query failed");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Databases</title>
</head>
<body>
<ul>
<?php
    //3. Use returned data (if any)
    while ( $subject = mysqli_fetch_assoc( $result ) ){
        // Output data from each row
        echo "<li>". $subject["menu_name"]."(". $subject["id"] .")</li>";
    }

?>
</ul>
<?php
    // 4. Release returned data
    mysqli_free_result($result);
?>

</body>
</html>

<?php
    // 5. Close database connection
    mysqli_close($connection);
?>