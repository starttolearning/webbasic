<?php
require_once("../../inc/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
get_layout_template("admin-header");
?>
<?php
$message = "";
if (isset($_POST["submit"])) {
    $photo = new Photograph();

    $photo->caption = $_POST["caption"];
    $photo->attach_file($_FILES["file_upload"]);

    if ($photo->save()) {
        // Success
        $message = "Photograph uploaded successfully";
        $session->message( $message );
        redirect_to('photo-list.php');
    } else {
        // Failed
        $message = join("<br/>", $photo->errors);
        $session->message( $message );
    }

}
?>
<a href="photo-list.php" >&laquo; Back</a><br/>
<?php if(isset($message)){ echo output_message($message) ;} else{ echo ""; } ?>
    <h2>Photo Upload</h2>
    <form action="photo-upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="file_upload"><br/><br/>
        <p>Caption: <input type="text" name="caption" value=""></p><br/><br/>
        <input type="submit" name="submit" value="Upload">

    </form>

<?php get_layout_template("admin-footer"); ?>
