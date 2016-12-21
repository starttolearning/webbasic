<?php
/**
 * User: wilton
 * Date: 12/19/2016
 * Time: 9:24 PM
 */
$file = "file-text.txt";

// fopen:
// good practice to close the file when it finish
if($handle =  fopen($file,"w")){
    fclose($handle);
}else{
    echo "File cannot open";
}
