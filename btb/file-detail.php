<?php
/**
 * User: wilton
 * Date: 12/19/2016
 * Time: 9:24 PM
 */
$file = "file-text.txt";

echo filesize($file)."<br/>";

// filemtime: last modified (change content)
// filectime: last changed (change content or metadata)
// fileatime:last accessed (any read/ change);

echo strftime("%m/%d/%y %H:%M:%S",filemtime($file))."<br/>";
echo strftime("%m/%d/%y %H:%M:%S",filectime($file))."<br/>";
echo strftime("%m/%d/%y %H:%M:%S",fileatime($file))."<br/>";

$path_array = pathinfo($file);

echo $path_array["dirname"];
echo $path_array["basename"];

