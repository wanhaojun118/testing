<?php
$member_atu_id = filter_input(INPUT_POST,"id");
$reject_reason = filter_input(INPUT_POST,"reject_reason");
$act = filter_input(INPUT_POST,"act");

if($act == 1){
	$stmt_select_topup = $mysqli->prepare("SELECT member_atu_member_id,member_atu_amount FROM member_audit_top_up JOIN member_audit_top_up_result WHERE member_atur_member_atu_id=member_atu_id AND member_atu_id=? AND member_atur_result=0");
	$stmt_select_topup ->bind_param('i',$member_atu_id);
	$stmt_select_topup ->execute();
	$stmt_select_topup ->store_result();
	$stmt_select_topup ->bind_result($member_atu_member_id,$member_atu_amount);
	$stmt_select_topup ->fetch();
	
	$stmt_update_topup_result = $mysqli->prepare("UPDATE member_audit_top_up_result SET member_atur_result=1,member_atur_admin_id=? WHERE member_atur_member_atu_id=?");
	$stmt_update_topup_result ->bind_param('ii',$admin->getAdmin_id(),$member_atu_id);
	if($stmt_update_topup_result ->execute()){
		$stmt_select_ms = $mysqli->prepare("SELECT member_ms_c_wallet FROM member_monetary_status WHERE member_ms_member_id=?");
		$stmt_select_ms ->bind_param('i',$member_atu_member_id);
		$stmt_select_ms ->execute();
		$stmt_select_ms ->store_result();
		$stmt_select_ms ->bind_result($member_ms_c_wallet);
		$stmt_select_ms ->fetch();
		
		$new_member_ms_c_wallet = $member_ms_c_wallet + $member_atu_amount;
		
		$stmt_update_ms = $mysqli->prepare("UPDATE member_monetary_status SET member_ms_c_wallet=? WHERE member_ms_member_id=?");
		$stmt_update_ms ->bind_param('di',$new_member_ms_c_wallet,$member_atu_member_id);
		$stmt_update_ms ->execute();
		
		$output[0] = true;
		$output[1] = $LANG_SAVE_SUCCESSFUL;
	}else{
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
}else{
	$stmt_update_topup_result = $mysqli->prepare("UPDATE member_audit_top_up_result SET member_atur_result=2,member_atur_admin_id=?,member_atur_reason=? WHERE member_atur_member_atu_id=?");
	$stmt_update_topup_result ->bind_param('isi',$admin->getAdmin_id(),$reject_reason,$member_atu_id);
	if($stmt_update_topup_result ->execute()){
		
		$output[0] = true;
		$output[1] = $LANG_SAVE_SUCCESSFUL;
	}else{
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
}
echo json_encode($output);
?>