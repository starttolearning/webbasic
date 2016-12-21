<?php
require_once("../../inc/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
get_layout_template("admin-header");

if (isset($_GET["clear"]) && $_GET["clear"] == "true") {
    file_put_contents(LOG_FILE_PATH,"");
    // add the first log entry
    log_action("Logs cleared","by User ID {$session->user_id}");
    redirect_to("logfile.php");
}

?>
<p><a href="login.php">&laquo; Back</a></p>
<br/>
<h2>Log file list</h2>
<pre>
<?php
if ( file_exists(LOG_FILE_PATH) && is_readable(LOG_FILE_PATH) && $handle = fopen(LOG_FILE_PATH, 'r')) {
    $is_empty = filesize(LOG_FILE_PATH);
    echo "<ul class=\"log-entries\">";

    while (!feof($handle)) {
        $entry = fgets($handle);
        if( trim($entry )){
            echo "<li>{$entry}</li>";
        }
    }
    echo "</ul>";
    fclose($handle);
} else {
    $message = "File cannot read from".LOG_FILE_PATH;
}
?>
</pre>
<?php

if( isset( $is_empty ) && $is_empty != null ){
    echo "<a href=\"logfile.php?clear=true\">Clear Logs</a>";
}
?>
<?php if (isset($message)) {
    echo output_message($message);
} else {
    echo "";
} ?>
</div>
<?php get_layout_template("admin-footer"); ?>

