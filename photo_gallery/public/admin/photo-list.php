<?php
require_once("../../inc/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
get_layout_template("admin-header");

// Pagination process
// 1. the current page number ($current_page)
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// 2. records per page ( $per_page)
$per_page = 2;

// 3. total count of records ( $total_count)
$total_count = Photograph:: count_all();

$pagination = new Pagination($current_page, $per_page, $total_count);

// Instead of finding all records, just find the records for this page

$sql = "SELECT * FROM photographs ";
$sql .= "LIMIT {$per_page} ";
$sql .="OFFSET {$pagination->offset()}";


$photos = Photograph::find_by_sql($sql);

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
<a href="photo-upload.php">Upload photo</a> &nbsp; &nbsp;

<!-- pagination links -->
<?php if( $pagination->total_page() >1) : ?>
  <?php if( $pagination->has_previous_page() ) : ?>
  <a href="photo-list.php?page=<?php echo $pagination->previous_page(); ?>">&laquo;Previous</a> &nbsp;
  <?php endif; ?>
  <?php for( $i=1; $i <= $pagination->total_page() ; $i++ ): ?>
    <?php if( $current_page == $i): ?>
      <?php echo $i; ?>
    <?php else: ?>
      <a href="photo-list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a> &nbsp;
    <?php endif; ?>
  <?php endfor; ?>
  <?php if( $pagination->has_next_page() ) : ?>
  <a href="photo-list.php?page=<?php echo $pagination->next_page(); ?>">Next &raquo;</a>
  <?php endif; ?>
<?php endif; ?>
<?php get_layout_template("admin-footer"); ?>
