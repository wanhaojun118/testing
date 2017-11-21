<?php


$member_name = $_POST['member_name'];
$member_birthday = $_POST['member_birthday'];
$member_email = $_POST['member_email'];
$member_password = md5($_POST['member_password']);
$member_gender = $_POST['member_gender'];
$member_address = $_POST['member_address'];
$member_postcode = $_POST['member_postcode'];
$member_city = $_POST['member_city'];
$member_province = $_POST['member_province'];
$member_country = $_POST['member_country'];
$member_phone = $_POST['member_phone'];

$stmt_select_email = $mysqli -> prepare("SELECT member_email FROM member WHERE member_email = ?");
$stmt_select_email -> bind_param('s', $member_email);
$stmt_select_email -> execute();
$stmt_select_email -> store_result();
$stmt_select_email -> bind_result($email);
if($stmt_select_email -> fetch()){
	$output[0] = false;
	$output[1] = $LANG_EMAIL_HAS_BEEN_USED;
}else{
	$stmt_insert_member = $mysqli -> prepare("INSERT INTO member(member_name, member_birthday, member_email, member_password, member_gender, member_address, member_postcode, member_city, member_province, member_country, member_phone) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
	$stmt_insert_member -> bind_param('ssssssissss', $member_name, $member_birthday, $member_email, $member_password, $member_gender, $member_address, $member_postcode, $member_city, $member_province, $member_country, $member_phone);
	if($stmt_insert_member -> execute()){
		$stmt_select_member = $mysqli -> prepare("SELECT member_id FROM member WHERE member_name = ?");
		$stmt_select_member -> bind_param('s', $member_name);
		$stmt_select_member -> execute();
		$stmt_select_member -> store_result();
		$stmt_select_member -> bind_result($member_id);
		$stmt_select_member -> fetch();
		$stmt_insert_member_ac = $mysqli -> prepare("INSERT INTO member_audit_creation(member_ac_member_id, member_ac_member_name) VALUES(?,?)");
		$stmt_insert_member_ac -> bind_param('is', $member_id, $member_name);
		if($stmt_insert_member_ac -> execute()){
			$output[0] = true;
			$output[1] = $LANG_SAVE_SUCCESSFUL;
		}else{
			$output[0] = false;
			$output[1] = $LANG_ERROR_ALERT;
		}
	}
}


echo json_encode($output);

?>