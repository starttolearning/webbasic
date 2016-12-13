<?php

// Include the db connection file
require_once 'db.php';

/**
 * class HelpText
 */
class HelpText{
    public $key;
    public $text;
}


/**
 * Function to get the help text
 * @param type $key
 * @return string
 */
function get_help_text_by_key($key) {
    $mysqli = get_db_con();
    $help_text = new HelpText();
    $help_text->key;
    $sql_string = 'SELECT HelpText FROM wb_help_text WHERE HelpTextKey = "' . $key . '"';

    if ($result = $mysqli->query($sql_string)) {
        while ($obj = $result->fetch_object()) {
            $help_text->text = filter_var($obj->HelpText, FILTER_SANITIZE_STRING);
        }
        $result->close();
    } else {
        $help_text = "<p>I can't read any HelpText.</p>";
    }
    return $help_text;
}

$help_text_key = isset( $_REQUEST['HelpTextKey'] ) ?$_REQUEST['HelpTextKey'] : '' ;


$json_string = json_encode(get_help_text_by_key($help_text_key));
echo $json_string;

?>
