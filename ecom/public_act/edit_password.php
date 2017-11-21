<?php 
	$member_password = md5($_POST['new_password']);
	
	$stmt_select_member_password = $mysqli -> prepare("SELECT member_password FROM member WHERE member_id = ?");
	$stmt_select_member_password -> bind_param('i', $member->getMember_id());
	$stmt_select_member_password -> execute();
	$stmt_select_member_password -> store_result();
	$stmt_select_member_password -> bind_result($old_member_password);
	$stmt_select_member_password -> fetch();
	
	$stmt_update_password = $mysqli -> prepare("UPDATE member SET member_password = ? WHERE member_id = ?");
	$stmt_update_password -> bind_param('si', $member_password, $member->getMember_id());
	if($stmt_update_password -> execute()){
		$stmt_insert_member_acp = $mysqli -> prepare("INSERT INTO member_audit_change_password (member_acp_member_id, member_acp_member_old_password, member_acp_member_new_password) VALUES (?,?,?)");
		$stmt_insert_member_acp -> bind_param('iss', $member->getMember_id(), $old_member_password, $member_password);
		$stmt_insert_member_acp -> execute();
		$output[0] = true;
		$output[1] = $LANG_UPDATE_SUCCEED;
	}else{
		$output[0] = false;
		$output[1] = $LANG_UPDATE_FAILED;
	}

echo json_encode($output);
?>