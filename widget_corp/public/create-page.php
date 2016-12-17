<?php include_once("../inc/session.php"); ?>
<?php include_once("../inc/db-connection.php"); ?>
<?php include_once("../inc/functions.php"); ?>
<?php include_once("../inc/validation-functions.php"); ?>
<?php find_current_subject_or_page(); ?>
<?php

if( $_POST['submit']){
    $subject_id = $current_subject["id"];
    $menu_name = mysqli_prep($_POST['menu_name']) ;
    $position= $_POST['position'];
    $visible= $_POST['visible'];
    $content = mysqli_prep( $_POST["content"] );

    // Validation
    $required_fields = array("menu_name", "position", "visible", "content");
    validate_presences( $required_fields );
    $fields_with_max_lengths = array("menu_name"  => 30);
    validate_max_lengths($fields_with_max_lengths);

    if( ! empty( $errors ) ){
        $_SESSION["errors"] = $errors;
        redirect_to("new-page.php?subject=".urlencode( $current_subject["id"]));
    }
    // Query string

    $query = "INSERT INTO pages (  ";
    $query .= "subject_id, menu_name, position, visible, content ) ";
    $query .= "VALUES ({$subject_id},'{$menu_name}',{$position},{$visible},'{$content}') ";

    $result =  mysqli_query( $connection, $query );

    if( $result ){
        // Success
        $_SESSION["message"] = "Page created.";
        redirect_to("manage-content.php?subject=". urlencode( $current_subject["id"]));
    }else {
        // Failed
        $_SESSION["message"] = "Page creating failed.";
        redirect_to("new-page.php?subject=".urlencode( $current_subject["id"]));
    }

}else {
    redirect_to("new-page.php");
}

?>


<?php if(isset( $connection )){ mysqli_close($connection); } ?>