<?php
$file_name = "";
$folder = filter_input(INPUT_GET, "folder");
//upload file
for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
	$file = $_FILES['file']['name'][$i];
	$timestamp = time().$i;
	if ($file) {
		if ($folder == "product_image") {
			$target_dir = "upload/product_image/";
		} 
	
		$uploadOk = 1;
		$imageFileType = pathinfo(basename($_FILES["file"]["name"][$i]), PATHINFO_EXTENSION);
		$target_file = $target_dir . $timestamp . "_" . substr(md5($timestamp), 0, 12) . "." . $imageFileType;
		// // Check file size,not more than 3MB
		// if ($_FILES["file"]["size"] > 3145728) {
			// $output[0] = false;
			// $output[1] = $LANG_UPLOAD_MSG1;
			// $uploadOk = 0;
		// }
		// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "gif") {
			$output[0] = false;
			$output[1] = $LANG_UPLOAD_MSG2;
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk != 0) {
			if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file)) {
				if($i == 0){
					$file_name .= $target_file;
				}else{
					$file_name .= ",".$target_file;
				}
				
			} else {
				$output[0] = false;
				$output[1] = $LANG_UPLOAD_MSG4;
			}
		}
	} else {
		//if no file upload
		$output[0] = true;
		$output[1] = "";
	}
}
$output[0] = true;
$output[1] = $file_name;
echo json_encode($output);
?>


