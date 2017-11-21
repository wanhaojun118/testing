<?php
$member_name = $_POST['member_name'];
$member_email = $_POST['member_email'];
$member_birthday = $_POST['member_birthday'];
$member_gender = $_POST['member_gender'];
$member_address = $_POST['member_address'];
$member_postcode = $_POST['member_postcode'];
$member_city = $_POST['member_city'];
$member_province = $_POST['member_province'];
$member_country = $_POST['member_country'];
$member_phone = $_POST['member_phone'];

$stmt_select_member = $mysqli -> prepare("SELECT member_id, member_name, member_birthday, member_email, member_gender, member_address, member_postcode, member_city, member_province, member_country, member_phone FROM member WHERE member_id = ?");
$stmt_select_member -> bind_param('i', $member->getMember_id());
$stmt_select_member -> execute();
$stmt_select_member -> store_result();
$stmt_select_member -> bind_result($member_id, $old_member_name, $old_member_birthday, $old_member_email, $old_member_gender, $old_member_address, $old_member_postcode, $old_member_city, $old_member_province, $old_member_country, $old_member_phone);
$stmt_select_member -> fetch();

$stmt_update_member = $mysqli -> prepare("UPDATE member SET member_name = ?, member_email = ?, member_birthday = ?, member_gender = ?, member_address = ?, member_postcode = ?, member_city = ?, member_province = ?, member_country = ?, member_phone = ? WHERE member_id = ?");
$stmt_update_member -> bind_param('sssssissssi', $member_name, $member_email, $member_birthday, $member_gender, $member_address, $member_postcode, $member_city, $member_province, $member_country, $member_phone, $member -> getMember_id());
if($stmt_update_member -> execute()){
	$stmt_insert_member_ae = $mysqli -> prepare("INSERT INTO member_audit_edit (member_ae_member_id, member_ae_member_name, member_ae_member_email, member_ae_member_birthday, member_ae_member_gender, member_ae_member_address, member_ae_member_postcode, member_ae_member_city, member_ae_member_province, member_ae_member_country, member_ae_member_phone) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
	$stmt_insert_member_ae -> bind_param('isssssissss', $member_id, $old_member_name, $old_member_email, $old_member_birthday, $old_member_gender, $old_member_address, $old_member_postcode, $old_member_city, $old_member_province, $old_member_country, $old_member_phone);
	$stmt_insert_member_ae -> execute();
	$output[0] = true;
	$output[1] = $LANG_UPDATE_SUCCEED;
}else{
	$output[0] = false;
	$output[1] = $LANG_UPDATE_FAILED;
}

echo json_encode($output);
?>


