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
            <td width="150">Comments</td>
            <td width="150">Actions</td>
        </tr>
        </thead>
        <tbody>
        <?php $photos = Photograph::find_all(); ?>
        <?php   foreach ($photos as $photo) : ?>
          <tr>
            <td><?php echo $photo->caption; ?></td>
            <td><?php echo $photo->type; ?></td>
            <td><?php echo $photo->size_as_text(); ?></td>
            <td><img width="145" src="../<?php echo $photo->image_path(); ?>" /></td>
            <?php
              $output = "";
              $counts = count( $photo->comments() );
              if($counts ==0 ){
                $output .= "No comments";
              }else {
                $output .="<a href=\"comment-list.php?id={$photo->id}\">";
                $output .= $counts;
                $output .="</a>";
              }
            ?>
            <td><?php echo $output; ?></td>
            <td><a href="photo-delete.php?id=<?php echo $photo->id; ?>" >Delete</a></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<br/>
<a href="photo-upload.php">Upload photo</a>

<?php get_layout_template("admin-footer"); ?>
