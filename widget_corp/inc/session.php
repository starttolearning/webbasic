<?php session_start(); ?>
<?php

function message()
{
    if (isset($_SESSION["message"])) {
        $output = "<div class=\"message\">";
        $output .= htmlentities($_SESSION["message"]);
        $output .= "</div>";
        // Clear the session
        $_SESSION["message"] = null;
        return $output;
    }
}

function errors()
{
    if (isset($_SESSION["errors"])) {
        $errors =$_SESSION["errors"] ;
        // Clear the session
        $_SESSION["errors"] = null;
        return $errors;
    }
}

?>