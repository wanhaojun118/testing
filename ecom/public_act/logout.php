<?php 
	setcookie('360_id', '', 0, '/');
	setcookie('360_auth', '', 0, '/');
	$member_id = filter_input(INPUT_POST, 'member_id');
	$stmt_update_member = $mysqli -> prepare("UPDATE member SET member_auth='', member_auth_md5='', member_last_logout_datetime = now() WHERE member_id = ?");
	$stmt_update_member -> bind_param('i', $member_id);
	$stmt_update_member -> execute();
	
echo json_encode(true);
?>