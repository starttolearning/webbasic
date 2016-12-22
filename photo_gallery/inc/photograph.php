<?php
// If it's going to need the database , then it is
// probably smart to require it before we start
require_once(LIB_PATH . DS . "database.php");


class Photograph extends DatabaseObject
{

    protected static $table_name = "photographs";
    protected static $db_fields = array("id", "filename", "type", "size", "caption");
    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;

    private $tmp_path;
    protected $upload_dir = "images";
    public $errors = array();

    protected $error_array = array(
        UPLOAD_ERR_OK => "No error.",
        UPLOAD_ERR_INI_SIZE => "Large than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "Large than MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL => "Partial upload.",
        UPLOAD_ERR_NO_FILE => "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can not write to disk.",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension.",
    );

    public function attach_file($file)
    {
        // Perform error checking on the form parameters
        if (!$file || empty($file) || !is_array($file)) {
            // error: nothing upload or wrong argument usage
            $this->errors[] = "No file was upload.";
            return false;
        } elseif ($file["error"] != 0) {
            $this->errors[] = $this->error_array[$file["error"]];
            return false;
        } else {
            // set object attribute to the form parameters
            $this->filename = basename($file["name"]);
            $this->tmp_path = $file["tmp_name"];
            $this->type = $file["type"];
            $this->size = $file["size"];
            // don't worry about saving anything to the database yet
            return true;
        }

    }

    public function save()
    {
        if (isset($this->id)) {
            // really just update the caption
            $this->update();
        } else {
            // make sure there are not error
            if (!empty($this->errors)) {
                return false;
            }

            // make sure the caption are not too long for the db
            if (strlen($this->caption) > 255) {
                $this->errors[] = "The caption can only be 255 characters long.";
                return false;
            }

            // can't save without the filename and tmp_name
            if (empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "The file location are not available. ";
                return false;
            }

            // determine the target_path
            $target_path = SITE_ROOT . DS . "public" . DS . $this->upload_dir . DS . $this->filename;

            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists. ";
                return false;
            }
            // attempt to move the file
            if (move_uploaded_file($this->tmp_path, $target_path)) {
                // Success
                // save a corresponding entry to the database
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "The file upload failed, possibly due to incorrect permission on the upload folder";
                return false;
            }

        }
    }

    public function destroy(){
      // First remove the database entrys
      if( self::delete() ){
        // then remove the file
        $target_path = SITE_ROOT . DS . "public" . DS . $this->image_path();
        return unlink($target_path) ? true : false;
      }else{
        // detabase delete failed
        return false;
      }
    }

    public function image_path()
    {
        return $this->upload_dir . DS . $this->filename;
    }

    public function size_as_text()
    {
        if ($this->size < 1024) {
            return "{$this->size} bytes";
        } elseif ($this->size < 1048576) {
            $size_kb = round($this->size / 1024, 1);
            return "{$size_kb} KB";
        } else {
            $size_mb = round($this->size / 1048576, 1);
            return "{$size_mb} MB";
        }
    }

    public function comments(){
      return Comment::find_comments_on($this->id);
    }
}
