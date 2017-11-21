<?php
$member_id = filter_input(INPUT_POST,"member_id");
$type = filter_input(INPUT_POST,"type");

$default_password = "111111";
$default_second_password = "222222";

$member_password = md5($default_password);
$member_second_password = md5($default_second_password);


$stmt_select_member_password = $mysqli->prepare("SELECT member_password,member_second_password FROM member where member_id=?");
$stmt_select_member_password->bind_param('i', $member_id);
$stmt_select_member_password->execute();
$stmt_select_member_password->store_result();
$stmt_select_member_password->bind_result($old_member_password,$old_member_second_password);
$stmt_select_member_password->fetch();

if($type == 1){
	$stmt_update_member = $mysqli->prepare("UPDATE member SET member_password=? WHERE member_id=?");
	$stmt_update_member ->bind_param('si',$member_password,$member_id);
	if($stmt_update_member ->execute()){
		$stmt_insert_audit = $mysqli->prepare("INSERT into admin_audit_member_reset_password (admin_amrp_member_id,admin_amrp_old_password,admin_amrp_type) VALUES (?,?,1)");
		$stmt_insert_audit->bind_param('is', $member_id, $old_member_password);
		$stmt_insert_audit->execute();
		
		$output[0] = true;
		$output[1] = $LANG_SAVE_SUCCESSFUL;
	}else{
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
}
else if($type == 2){

	$stmt_update_member = $mysqli->prepare("UPDATE member SET member_second_password=? WHERE member_id=?");
	$stmt_update_member ->bind_param('si',$member_second_password,$member_id);
	if($stmt_update_member ->execute()){
		$stmt_insert_audit = $mysqli->prepare("INSERT into admin_audit_member_reset_password (admin_amrp_member_id,admin_amrp_old_password,admin_amrp_type) VALUES (?,?,2)");
		$stmt_insert_audit->bind_param('is', $member_id, $old_member_second_password);
		$stmt_insert_audit->execute();
		
		$output[0] = true;
		$output[1] = $LANG_SAVE_SUCCESSFUL;
	}else{
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
	
}
echo json_encode($output);

?>