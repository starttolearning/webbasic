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
	fwrite($handle, 'abc'); // returns number of bytes or fiald
	fwrite($handle, "string");
    $content = "123\n456";
    fwrite($handle, $content);

    fclose($handle);
}else{
    echo "File cannot open";
}

$file = "filetext.txt";
$content = "111\n222\n333";
if( $size = file_put_contents($file, $content)){
	echo "A file of {$size} bytes was created";
}