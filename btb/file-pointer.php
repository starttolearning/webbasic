<?php

$file = "file-text.txt";

// fopen:
// good practice to close the file when it finish
if($handle =  fopen($file,"w")){
	fwrite($handle, "123\n456\n789");

	$pos = ftell($handle); // ftell() get the current positon of the file pointer
	fseek($handle, $pos - 6);
	fwrite($handle, "abcdefg");
	rewind($handle);  // rewind the file pointer to the begainning of file

	fwrite($handle, 'xyz');



    fclose($handle);
}else{
    echo "File cannot open";
}
