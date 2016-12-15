<?php

// Include the db connection file
require_once 'db.php';


$json = isset(  $_POST['employee'] ) ?  $_POST['employee'] : '' ;
$action = $_POST['action'];

if( $action == 'insert_employee'){
    insert_employee($json);
}

if( $action == 'get_all_employees' ){
    
    get_all_employess();
}


/**
 * Function Get All Employees From database
 * @return string
 */
function get_all_employess() {
    $mysqli = get_db_con();
    $output = array();
    $sql_string = "SELECT * FROM `wb_employee` WHERE 1";
    
    if ($result = $mysqli->query($sql_string)) {
        while ($obj = $result->fetch_object()) {
            $output[] = array(
                'id'    => $obj->id,
                'name'  => filter_var($obj->Name, FILTER_SANITIZE_STRING),
                'gender'=> filter_var($obj->Gender, FILTER_SANITIZE_STRING),
                'salary'=> $obj->salary,
            );
        }
        $result->close();
    }
    echo json_encode(  $output );
}

function insert_employee($json) {
    $mysqli = get_db_con();

    $obj = json_decode($json);

    $sql_string = "INSERT INTO `wb_employee` (`id`, `Name`, `Gender`, `salary`) VALUES (NULL, '$obj->name', '$obj->gender', '$obj->salary')";
    $mysqli->query($sql_string);
    
}

?>
