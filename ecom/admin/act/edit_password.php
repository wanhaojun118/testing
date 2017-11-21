<?php 
$admin_password = md5($_POST['new_password']);

$stmt_select_admin = $mysqli -> prepare("SELECT admin_password FROM admin WHERE admin_id = ?");
$stmt_select_admin -> bind_param('i', $admin->getadmin_id());
$stmt_select_admin -> execute();
$stmt_select_admin -> store_result();
$stmt_select_admin -> bind_result($old_admin_password);
$stmt_select_admin -> fetch();

$stmt_edit_password = $mysqli -> prepare("UPDATE admin SET admin_password = ? WHERE admin_id = ?");
$stmt_edit_password -> bind_param('si', $admin_password, $admin->getadmin_id());
if($stmt_edit_password -> execute()){
	$stmt_insert_audit = $mysqli -> prepare("INSERT INTO admin_audit_change_password (admin_acp_admin_id, admin_acp_old_password, admin_acp_new_password) VALUES (?,?,?)");
	$stmt_insert_audit -> bind_param('iss', $admin->getadmin_id(), $old_admin_password, $admin_password);
	if($stmt_insert_audit -> execute()){
		$output[0] = true;
		$output[1] = $LANG_UPDATE_SUCCEED; 
	}else{
		$output[0] = false;
		$output[1] = $LANG_ERROE_ALERT;
	}
	
}
echo json_encode($output);
?>