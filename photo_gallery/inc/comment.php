<?php
// If it's going to need the database , then it is
// probably smart to require it before we start
require_once(LIB_PATH . DS . "database.php");


class Comment extends DatabaseObject{
  protected static $table_name = "comments";
  protected static $db_fields = array("id", "photograph_id", "created", "author", "body");
  public $id;
  public $photograph_id;
  public $created;
  public $author;
  public $body;

  public static function make($photo_id, $author, $body){
    if( !empty($photo_id) && !empty($author) && ! !empty($body) ){
      $comment = new Comment();
      $comment->photograph_id = (int)$photo_id;
      $comment->author = $author;
      $comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
      $comment->body = $body;
      return $comment;
    }else {
      return false;
    }
  }

  public static function find_comments_on( $photo_id ){
    global $database;
    $sql = "SELECT * FROM " . self::$table_name;
    $sql .= " WHERE photograph_id= " . $database->escape_value($photo_id);
    $sql .= " ORDER BY created ASC";
    return parent::find_by_sql($sql);
  }
  
}
