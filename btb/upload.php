<?php 

$error_array = array(
	UPLOAD_ERR_OK 			=> "No error.",
	UPLOAD_ERR_INI_SIZE 	=> "Large than upload_max_filesize.",
	UPLOAD_ERR_FORM_SIZE	=> "Large than MAX_FILE_SIZE.",
	UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
	UPLOAD_ERR_NO_FILE		=> "No file.",
	UPLOAD_ERR_NO_TMP_DIR	=> "No temporary directory.",
	UPLOAD_ERR_CANT_WRITE 	=> "Can not write to disk.",
	UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension.",
	);

if(isset($_POST["submit"])){
	// process the form data
	$tmp_file = $_FILES['file_upload']['tmp_name'];  // here the actual file that store the /tmp folder of the server 
	$target_file = basename($_FILES['file_upload']['name']);

	$upload_dir = "uploads";

	if( move_uploaded_file($tmp_file, $upload_dir."/".$target_file) ){
		$message = "file upload successfully.";
	}else{
		$error =  $_FILES['file_upload']['error'];
		echo $error_array[$error];
	}
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Uploade</title>
</head>
<body>
<?php if( ! empty($message)){echo "<p>{$message}</p>"; } ?>

<form action="upload.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
	<input type="file" name="file_upload"><br/><br/>
	<input type="submit" name="submit" value="Upload">

</form>
</body>
</html>