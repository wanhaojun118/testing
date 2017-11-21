<?php
$member_username = filter_input(INPUT_POST,"member_username");
$password = filter_input(INPUT_POST,"password");

	$stmt2 = $mysqli->prepare("SELECT member_id FROM member WHERE member_username =? AND member_password=?");
    $stmt2->bind_param("ss", $member_username, $password);
    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($user_id);
    $stmt2->fetch();
    if ($stmt2->num_rows === 1) {
		if (isset($_COOKIE['bm360_id']) && isset($_COOKIE['bm360_auth'])){
			setcookie('360_id', '', 0, '/');
			setcookie('360_auth', '', 0, '/');
		}
        $md5_id = md5($user_id);
        $auth = rand_string(25);
        setcookie('360_id', $md5_id, 0, '/');
        setcookie('360_auth', $auth, 0, '/');
        $stmt3 = $mysqli->prepare("UPDATE member SET member_auth=?, member_auth_md5=?, member_last_login_datetime=now() WHERE member_id=?");
        $stmt3->bind_param("ssi", $auth, $md5_id, $user_id);
        $stmt3->execute();
        $output[0] = true;
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (30 * 60); 
    } else {
            $output[0] = false;
            $output[1] = urlencode($LANG_LOGIN_PASSWORD_WRONG);
    }
	echo json_encode($output);
?>