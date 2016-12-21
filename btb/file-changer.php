<?php
/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/19/2016
 * Time: 8:25 PM
 */

$owner_id = fileowner("file-permission.php");
$owner_array = posix_getpwuid($owner_id);

echo $owner_array["name"];

echo "<br/>";

chown("file-permission.php", 'wilton');

echo decoct(fileperms("file-permission.php"));
echo "<br/>";
echo chmod("file-permission.php",0777)? "yes": "no";
echo decoct(fileperms("file-permission.php"));