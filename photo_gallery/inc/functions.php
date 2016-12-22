<?php
/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/19/2016
 * Time: 3:31 PM
 */
function strip_zeros_from_date($marked_string = "")
{
    // remove the marked zero
    $no_zeros = str_replace("*0", "", $marked_string);

    $clear_string = str_replace("*", "", $no_zeros);

    return $clear_string;
}

/**
 * Redirect function
 * @param $location
 */
function redirect_to($location = NULL)
{
    if ($location != null) {
        header("Location: {$location}");
        exit;
    }
}

function output_message($message = "")
{
    if (!empty($message)) {
        return "<p class=\"message\">{$message}</p>";
    } else {
        return false;
    }
}


function __autoload($class_name)
{
    $class_name = strtolower($class_name);
    $path = "../inc/{$class_name}.php";
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found!");
    }

}

function get_layout_template($template = "")
{
    include_once(SITE_ROOT . DS . "public" . DS . "layouts" . DS . $template . ".php");
}

function log_action($action, $message = "")
{
    $new = file_exists(LOG_FILE_PATH) ? false :true;
    if ($handle = fopen(LOG_FILE_PATH, 'a')) {
        $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
        $content = "{$timestamp} | {$action} {$message}\n";
        fwrite($handle, $content);

        fclose($handle);
    } else {
         echo "Could not open log file for writing.";
    }
}

function time_to_text($times_string){
  $timestamp = strtotime($times_string);
  return strftime( "%B %d, %Y at %I:%M %p", $timestamp );
}
