<?php
	$member_id = filter_input(INPUT_POST, 'member_id');
	$member_name = filter_input(INPUT_POST, 'member_name');
	$member_email = filter_input(INPUT_POST, 'member_email');
	$member_ic = filter_input(INPUT_POST, 'member_ic');
	$member_bank_id = filter_input(INPUT_POST, 'member_bank_name');
	$member_bank_acc_number = filter_input(INPUT_POST, 'member_bank_acc_number');
	$member_bank_acc_name = filter_input(INPUT_POST, 'member_bank_acc_name');
	
	$stmt_update_member = $mysqli -> prepare("UPDATE member SET member_name = ?, member_email = ?, member_ic = ?, member_bank_id = ?, member_bank_acc_number = ?, member_bank_acc_name = ? WHERE member_id = ?");
	$stmt_update_member -> bind_param('sssissi', $member_name, $member_email, $member_ic, $member_bank_id, $member_bank_acc_number, $member_bank_acc_name, $member_id);
	$stmt_select_member = $mysqli -> prepare("SELECT member_name, member_email, member_ic, member_bank_id, member_bank_acc_number, member_bank_acc_name, member_password FROM member WHERE member_id = ?");
	$stmt_select_member -> bind_param('i', $member_id);
	$stmt_select_member -> execute();
	$stmt_select_member -> store_result();
	$stmt_select_member -> bind_result($old_member_name, $old_member_email, $old_member_ic, $old_member_bank_name, $old_member_bank_acc_number, $old_member_bank_acc_name, $old_member_password);
	while($stmt_select_member -> fetch()){
		if($stmt_update_member -> execute()){
			$stmt_update_member_ae = $mysqli -> prepare("INSERT INTO member_audit_edit (member_ae_member_id, member_ae_name, member_ae_email, member_ae_ic, member_ae_bank_id, member_ae_bank_acc_number, member_ae_bank_acc_name, member_ae_password) VALUES (?,?,?,?,?,?,?,?)");
			$stmt_update_member_ae -> bind_param('isssisss', $member_id, $old_member_name, $old_member_email, $old_member_ic, $old_member_bank_name, $old_member_bank_acc_number, $old_member_bank_acc_name, $old_member_password);
			if($stmt_update_member_ae -> execute()){
				$output[0] = true;
				$output[1] = $LANG_UPDATE_SUCCEED;
			}else{
				$output[0] = false;
				$output[1] = $LANG_UPDATE_FAILED;
			}
		}
	}
	
	echo json_encode($output);
?>