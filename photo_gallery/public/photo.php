<?php

require_once("../inc/initialize.php");

if( empty( $_GET['id']) ){
  $session->message("No photograph id was provided. ");
  redirect_to('photos.php');
}

$photo = Photograph::find_by_id( $_GET['id'] );
if( ! $photo){
  $session->message("The photo could not located. ");
  redirect_to('photos.php');
}

if( isset( $_POST['submit']) ){
  $author = trim( $_POST['author']);
  $body = trim( $_POST['body']);
  $new_comment = Comment:: make($photo->id, $author, $body);
  var_dump($new_comment);
  if( $new_comment && $new_comment->save() ){
    redirect_to("photo.php?id=".$photo->id );
  }else{
    $message = "There was an error that prevented the comment from being saved.";
  }

}else {
  $author = "";
  $body = "";
}

$comments = $photo->comments();

get_layout_template("header");
?>
<?php if (isset($message)) {
    echo output_message($message);
} else {
    echo "";
} ?>
<a href="photos.php"> &laquo; Back </a>
<br/><br/>
<div style="margin-left: 20px;" >
  <img  src="<?php echo $photo->image_path(); ?>"/>
</div>
<!-- List comment -->
<?php foreach ($comments as $comment) :?>
<div class="comment-list-item">
  <h4>Auhtor: <em><?php echo $comment->author; ?></em> </h4>
  <p><?php echo $comment->body; ?></p>
  <span><?php echo time_to_text($comment->created); ?></span>
</div>

<?php endforeach; ?>

<!-- List form -->
<div id="comment-form">
  <h3>New Comment</h3>
  <form acition="photo.php?id=<?php echo $photo->id; ?>" method="post">
    <table>
      <tr>
        <td>Your name:</td>
        <td><input type="text" name="author" value="<?php echo $author; ?>" /></td>
      </tr>
      <tr>
        <td>Your comment:</td>
        <td><textarea cols="40" rows="8" name="body" ><?php echo $body; ?></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" value="Submit comment" /></td>
      </tr>
    </table>
  </form>
</div>
<?php get_layout_template("footer"); ?>
