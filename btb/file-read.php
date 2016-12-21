<?php
/**
 * User: wilton
 * Date: 12/19/2016
 * Time: 9:24 PM
 */
$file = "file-text.txt";

// fopen:
// good practice to close the file when it finish
if($handle =  fopen($file,"r")){
	$content =  fread($handle, 6); // each character 
    fclose($handle);
}else{
    echo "File cannot open";
}
echo $content;
echo "<br/>";

echo nl2br($content);
echo "<br/>";

echo "<hr/>";

if($handle =  fopen($file,"r")){
	$content =  fread($handle, filesize($file)); // each character 
    fclose($handle);
}else{
    echo "File cannot open";
}

echo nl2br($content);
echo "<br/>";
echo "<hr/>";

// file_get_content() : shortcut for fopen/read/fclose
// companion to shortcut file_put_content()

$content = file_get_contents($file);
echo nl2br($content);
echo "<hr/>";

// incremental reading
if($handle = fopen($file, "r")){
	$content ="";
	while (! feof($handle)) {  // test if end of file
		$content .= fgets($handle); // read a line
	}

	fclose($handle);
}

echo $content;