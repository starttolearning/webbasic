<?php
require_once("../../inc/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
get_layout_template("admin-header");
?>

<?php if (isset($message)) {
    echo output_message($message);
} else {
    echo "";
} ?>
    <h2>Photos</h2>
    <table border="1" style=" border-collapse: collapse;">
        <thead>
        <tr style="font-weight:bold;">
            <td width="150">File Name</td>
            <td width="150">Type</td>
            <td width="150">Size</td>
            <td width="150">Photo</td>
            <td width="150">Actions</td>
        </tr>
        </thead>
        <tbody>
        <?php $photos = Photograph::find_all(); ?>
        <?php
        $output = "";

        foreach ($photos as $photo) {
            $output .= "<tr>";
            $output .= "<td>";
            $output .= $photo->caption;
            $output .= "</td>";
            $output .= "<td>";
            $output .= $photo->type;
            $output .= "</td>";
            $output .= "<td>";
            $output .= $photo->size_as_text();
            $output .= "</td>";
            $output .= "<td>";
            $output .= "<img width=\"145\" src=\"../".$photo->image_path()." \">";
            $output .= "</td>";
            $output .= "<td>";
            $output .="<a href=\"photo-delete.php?id={$photo->id}\">Delete</a>";
            $output .= "</td>";
            $output .= "</tr>";

        }

        echo $output;
        ?>
        </tbody>
    </table>
<br/>
<a href="photo-upload.php">Upload photo</a>

<?php get_layout_template("admin-footer"); ?>
