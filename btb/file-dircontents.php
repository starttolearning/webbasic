<?php

// Like fopen/fread/fclose
// opendir()
// readdir()
// closedir()
// rewinddir()


$dir =".";

if( is_dir($dir) ){
	if($dir_handle = opendir($dir)){
		while ($filename = readdir($dir_handle)) {
			echo $filename."<br/>";
		}
		closedir($dir_handle);
	}
}


if( is_dir($dir) ){
	$dir_array = scandir($dir);
	foreach ($dir_array as $dirname) {
		if( stripos($dirname, '.') > 0 ){
			echo "Filename: " .$dirname ."<br/>";
		}
	}
}