<?php

//require_once 'plugin/securimage/securimage.php';
//$captchaId = filter_input(INPUT_POST, "captchaId", FILTER_SANITIZE_STRING);
//$captcha_code = filter_input(INPUT_POST, "verification_captcha_code", FILTER_SANITIZE_STRING);
$input_username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$input_password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

	//if (Securimage::checkByCaptchaId($captchaId, $captcha_code) == true) {
	$stmt = $mysqli->prepare("SELECT admin_id FROM admin WHERE admin_username =?");
	$stmt->bind_param("s", $input_username);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows === 1) 
	{

			$pwd = md5($input_password);		
			$stmt2 = $mysqli->prepare("SELECT admin_id FROM admin WHERE admin_username =? AND admin_password=?");
			$stmt2->bind_param("ss", $input_username, $pwd);
			$stmt2->execute();
			$stmt2->store_result();
			$stmt2->bind_result($user_id);
			$stmt2->fetch();
			if ($stmt2->num_rows === 1) {
				$md5_id = md5($user_id);
				$auth = rand_string(25);
				setcookie('admin_360_id', $md5_id, 0, '/');
				setcookie('admin_360_auth', $auth, 0, '/');
				$stmt3 = $mysqli->prepare("UPDATE admin SET admin_auth=?, admin_auth_md5=?, admin_last_login_datetime=now() WHERE admin_id=?");

				$stmt3->bind_param("ssi", $auth, $md5_id, $user_id);
				$stmt3->execute();
				$output[0] = true;
			}
			else 
			{
				$output[0] = false;
				$output[1] = urlencode($LANG_LOGIN_PASSWORD_WRONG);
				
			}
		
	}
	else 
	{
		$output[0] = false; 
		$output[1] = urlencode($LANG_LOGIN_MEMBER_NOT_EXISTS);
	}
	/*
}else {
    // input was invalid for supplied captcha id
	$output[] = false;
	$output[] = urlencode($LANG_LOGIN_VERIFICATION_WRONG);
// }
	
	 *
	 */
	 echo urldecode(json_encode($output));
	
?>