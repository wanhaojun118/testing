<?php

$folder = filter_input(INPUT_GET, "folder");

//upload file
$num_of_files = count($_FILES['file']['name']);
$file = $_FILES['file']['name'];
$timestamp = time();
$target_file = array();
$imageFileType = array();

if ($file) {
    if ($folder == "product_image") {
        $target_dir = "upload/product_image/";
    }
	
	for($i = 0; $i < $num_of_files; $i++){

		$uploadOk = 1;
		$imageFileType[$i] = pathinfo(basename($_FILES["file"]["name"][$i]), PATHINFO_EXTENSION);
		$target_file[$i] = $target_dir . $timestamp . "_" . substr(md5($timestamp), 0, 12) . $i . "." . $imageFileType[$i];

		// Check file size,not more than 3MB
		if ($_FILES["file"]["size"][$i] > 3145728) {
			$output[0] = false;
			$output[1] = $LANG_UPLOAD_MSG1;
			$uploadOk = 0;
		}

		// Allow certain file formats

		if ($imageFileType[$i] != "jpg" && $imageFileType[$i] != "png" && $imageFileType[$i] != "jpeg" && $imageFileType[$i] != "pdf" && $imageFileType[$i] != "gif") {
			$output[0] = false;
			$output[1] = $LANG_UPLOAD_MSG2;
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error

		if ($uploadOk != 0) {
			if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file[$i])) {
				$output[0] = true;
				$output[$i+1] = $target_file[$i];
			} else {
				$output[0] = false;
				$output[1] = $LANG_UPLOAD_MSG4;
			}
		}
	}
} else {
    //if no file upload
    $output[0] = true;
    $output[1] = "";
}

echo json_encode($output);

?>