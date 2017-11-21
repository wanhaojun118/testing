<?php

$member_email = $_POST['member_email'];
$member_password = md5($_POST['member_password']);
//$remember_user = $_POST['remember_user'];

$stmt_select_member = $mysqli -> prepare("SELECT member_id, member_name, member_password FROM member WHERE member_email = ?");
$stmt_select_member -> bind_param('s', $member_email);
$stmt_select_member -> execute();
$stmt_select_member -> store_result();
$stmt_select_member -> bind_result($user_id, $member_name, $password);

if($stmt_select_member -> fetch()){
	if($member_password === $password){
		$md5_id = md5($user_id);
		$auth = rand_string(25);
		setcookie('360_id', $md5_id, 0, '/');
		setcookie('360_auth', $auth, 0, '/');
		$stmt_update_member = $mysqli -> prepare("UPDATE member SET member_auth = ?, member_auth_md5 = ?, member_last_login_datetime = now() WHERE member_id = ?");
		$stmt_update_member -> bind_param('ssi', $auth, $md5_id, $user_id);
		$stmt_update_member -> execute();
		$output[0] = true;
		$output[1] = $LANG_WELCOME . $member_name;
		// $style = rand(1, 4);
		// $length = strlen($password);
		// $pointer = 0;
		
		// if(style == 1){
			// $new_password[] = 1;
			// while($pointer <= 32){
				// $current_number = $password[$pointer];
				// if($pointer%2 == 0){
					// $new_password[] = $current_number;
					// $new_password[] = rand(1, 4);
					// $new_password[] = rand(1, 4);
				// }else{
					// $new_password[] = $current_number;
					// $new_password[] = rand(1, 4);
				// }
				// pointer++;
			// }
		// }else if(style == 2){
			// $new_password[] = 2;
			// while(pointer <= 32){
				// $current_number = $password[$pointer];
				// if($pointer % 4 == 0){
					// $new_password[] = $current_number;
					// $new_password[] = rand(1, 4);
				// }else if($pointer % 3 == 0){
					// $new_password[] = $current_number;
					// $new_password[] = rand(1, 4);
					// $new_password[] = rand(1, 4);
				// }else if($pointer % 2 == 0){
					// $new_password[] = $current_number;
					// $new_password[] = rand(1, 4);
					// $new_password[] = rand(1, 4);
				// }else{
					// $new_password[] = $current_number;
					// $new_password[] = rand(1, 4);
				// }
				// $pointer++;
			// }
		// }
		
	}else{
		$output[0] = false;
		$output[1] = $LANG_INCORRECT_PASSWORD;
	}
}else{
	$output[0] = false;
	$output[1] = $LANG_MEMBER_NOT_EXIST;
}

echo json_encode($output);
?>
