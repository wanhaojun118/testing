<?php

$member_phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);
$member_password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

$stmt = $mysqli->prepare("SELECT member_id FROM member WHERE member_phone =?");
$stmt->bind_param("s", $member_phone);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 1) {
    $member_password_encrypted = md5($member_password);
    $stmt2 = $mysqli->prepare("SELECT member_id FROM member WHERE member_phone =? AND member_password=?");
    $stmt2->bind_param("ss", $member_phone, $member_password_encrypted);
    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($user_id);
    $stmt2->fetch();
    if ($stmt2->num_rows === 1) {
        $md5_id = md5($user_id);
        $auth = rand_string(25);

        $stmt3 = $mysqli->prepare("UPDATE member SET member_auth=?, member_auth_md5=?, member_last_login_datetime=now() WHERE member_id=?");
        $stmt3->bind_param("ssi", $auth, $md5_id, $user_id);
        $stmt3->execute();

		$arr = array ('success'=>'true','member_id'=>$user_id);
    } else {
        $arr = array ('success'=>'false','message'=>$LANG_LOGIN_PASSWORD_WRONG);
    }
} else {
    $arr = array ('success'=>'false','message'=>$LANG_LOGIN_MEMBER_NOT_EXISTS);
}
//print_r($output);
echo json_encode($arr);
?>