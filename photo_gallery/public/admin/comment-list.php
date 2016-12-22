<?php
require_once("../../inc/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
get_layout_template("admin-header");

if (isset($_GET['comment_id'])) {
    if (empty($_GET['comment_id'])) {
        $session->message("No comment id provided.");
        redirect_to("comment-list.php");
    }

    $comment = Comment::find_by_id($_GET['comment_id']);

    if ($comment && $comment->delete()) {
        $session->message("The comment was deleted.");
        redirect_to("comment-list.php");
    } else {
        $session->message("The comment could not be deleted.");
        redirect_to('comment-list.php');
    }
}else{
  $session->message("There are no comments.");
}


if (isset($_GET["id"])) {
    $photo = Photograph::find_by_id($_GET['id']);
    if (!$photo) {
        $session->message("The photo could not located. ");
        redirect_to('photo-list.php');
    }

    $comments = $photo->comments();
    if (!$comments) {
        $session->message("There is not comment for " . $photo->filename);
        redirect_to('comment-list.php');
    }
}


?>
<a href="photo-list.php">&laquo; Back</a> <br/>
<h2>Comments</h2>
<?php if (isset($message)) {
    echo output_message($message);
} else {
    echo "";
} ?>
<?php if (!empty($comments)): ?>
    <table border="1" style=" border-collapse: collapse;">
        <thead>
        <tr style="font-weight:bold;">
            <td width="150">Author</td>
            <td width="150">Body Text</td>
            <td width="150">Comment time</td>
            <td width="150">Actions</td>
        </tr>
        </thead>
        <tbody>
        <?php ?>
        <?php
        $output = "";

        foreach ($comments as $comment) {
            $output .= "<tr>";

            $output .= "<td>";
            $output .= $comment->author;
            $output .= "</td>";

            $output .= "<td>";
            $output .= $comment->body;
            $output .= "</td>";

            $output .= "<td>";
            $output .= $comment->created;
            $output .= "</td>";

            $output .= "<td>";
            $output .= "<a href=\"comment-list.php?comment_id={$comment->id}\">Delete</a>";
            $output .= "</td>";

            $output .= "</tr>";

        }

        echo $output;
        ?>
        </tbody>
    </table>
<?php endif; ?>
<br/>

<?php get_layout_template("admin-footer"); ?>
