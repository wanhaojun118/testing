<?php
	$admin_id = filter_input(INPUT_POST, 'admin_id');
	$admin_username = filter_input(INPUT_POST, 'admin_username');
	$admin_name = filter_input(INPUT_POST, 'admin_name');
	$admin_email = filter_input(INPUT_POST, 'admin_email');
	$admin_phone = filter_input(INPUT_POST, 'admin_phone');

	$stmt_select_admin = $mysqli -> prepare("SELECT admin_username, admin_name, admin_email, admin_phone FROM admin WHERE admin_id = ?");
	$stmt_select_admin -> bind_param('i', $admin_id);
	$stmt_select_admin -> execute();
	$stmt_select_admin -> store_result();
	$stmt_select_admin -> bind_result($old_username, $old_name, $old_email, $old_phone);
	$stmt_select_admin -> fetch();
	
	$stmt_update_admin = $mysqli -> prepare("UPDATE admin SET admin_username = ?, admin_name = ?, admin_email = ?, admin_phone = ? WHERE admin_id = ?");
	$stmt_update_admin -> bind_param('ssssi', $admin_username, $admin_name, $admin_email, $admin_phone, $admin_id);
	if($stmt_update_admin -> execute()){
		$stmt_insert_admin_ae = $mysqli -> prepare("INSERT INTO admin_audit_edit (admin_ae_admin_id, admin_ae_old_username, admin_ae_new_username, admin_ae_old_name, admin_ae_new_name, admin_ae_old_email, admin_ae_new_email, admin_ae_old_phone, admin_ae_new_phone) VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt_insert_admin_ae -> bind_param('issssssss', $admin_id, $old_username, $admin_username, $old_name, $admin_name, $old_email, $admin_email, $old_phone, $admin_phone);
		if($stmt_insert_admin_ae -> execute()){
			$output[0] = true;
			$output[1] = $LANG_UPDATE_SUCCEED;
		}else{
			$output[0] = false;
			$output[1] = $LANG_UPDATE_FAILED;
		}
	}

echo json_encode($output);
?>