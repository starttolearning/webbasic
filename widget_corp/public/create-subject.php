<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php include_once("../inc/validation-functions.php"); ?>

<?php

if( $_POST['submit']){
    $menu_name = mysqli_prep($_POST['menu_name']) ;
    $position= $_POST['position'];
    $visible= $_POST['visible'];

    // Validation
    $required_fields = array("menu_name", "position", "visible");
    validate_presences( $required_fields );
    $fields_with_max_lengths = array("menu_name"  => 30);
    validate_max_lengths($fields_with_max_lengths);

    if( ! empty( $errors ) ){
        $_SESSION["errors"] = $errors;
        redirect_to("new-subject.php");
    }
    // Query string

    $query = "INSERT INTO subjects ( menu_name, position, visible ) ";
    $query .= "VALUES ('{$menu_name}',{$position},{$visible}) ";

    $result =  mysqli_query( $connection, $query );

    if( $result ){
        // Success
        $_SESSION["message"] = "Subject created.";
        redirect_to("manage-content.php");
    }else {
        // Failed
        $_SESSION["message"] = "Subject creating failed.";
        redirect_to("new-subject.php");
    }

}else {
    redirect_to("new-subject.php");
}

?>


<?php if(isset( $connection )){ mysqli_close($connection); } ?>