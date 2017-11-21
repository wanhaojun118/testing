<?php 
$action = filter_input(INPUT_POST,"type");
$contact_us_id = filter_input(INPUT_POST,"contact_us_id");
$reply_msg = filter_input(INPUT_POST,"reply_msg");

if($action=='detail'){
	$stmt_contact_us = $mysqli->prepare("select contact_us_id,contact_us_member_id,contact_us_title, contact_us_message, contact_us_image,contact_us_reply_msg,contact_us_reply_by_admin_id from contact_us where contact_us_id=?");
	$stmt_contact_us ->bind_param('i',$contact_us_id);
	$stmt_contact_us ->execute();
	$stmt_contact_us ->store_result();
	$stmt_contact_us ->bind_result($contact_us_id,$contact_us_member_id,$contact_us_title, $contact_us_message, $contact_us_image,$contact_us_reply_msg,$contact_us_reply_by_admin_id);
	$stmt_contact_us ->fetch();
?>	
	<form id="reply_msg_form">
	<input type="hidden" class="form-control" id="contact_us_id" name="contact_us_id" value="<?php echo $contact_us_id;?>">
	<input type="hidden" class="form-control" id="type" name="type" value="edit">
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_NAME; ?><span style='color:red;'>&nbsp;*</span></label>
			<div class="col-sm-9"  style="margin-bottom:15px;">
				<input type="text" class="form-control" value="<?php print select_name($contact_us_member_id,"member_id","member_name","member",$mysqli);?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_TITLE; ?><span style='color:red;'>&nbsp;*</span></label>
			<div class="col-sm-9"  style="margin-bottom:15px;">
				<input type="text" class="form-control" value="<?php echo $contact_us_title;?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_MESSAGE; ?><span style='color:red;'>&nbsp;*</span></label>
			<div class="col-sm-9"  style="margin-bottom:15px;">
				<textarea class="form-control" readonly style="height:120px;"><?php echo $contact_us_message;?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_REPLY_MSG; ?><span style='color:red;'>&nbsp;*</span></label>
			<div class="col-sm-9"  style="margin-bottom:15px;">
				<textarea class="form-control required" name="reply_msg" style="height:120px;"></textarea>
			</div>
		</div>
	</form>	
	
	
<?php 	
}else if($action=='edit'){
	$stmt_update_contact_us = $mysqli->prepare("UPDATE contact_us set contact_us_reply_msg=?, contact_us_reply_by_admin_id=? WHERE contact_us_id=?");
	$stmt_update_contact_us->bind_param('sii',$reply_msg,$admin->getadmin_id(),$contact_us_id);
	if($stmt_update_contact_us->execute()){
		$stmt_insert_contact_us_audit = $mysqli->prepare("INSERT into contact_us_audit (contact_ua_contact_us_id,contact_ua_action) VALUES (?,2)");
		$stmt_insert_contact_us_audit ->bind_param('i',$contact_us_id);
		$stmt_insert_contact_us_audit ->execute();
		
		$data[0]= true;
		$data[1]= $LANG_SAVE_SUCCESSFUL;
	}else{
		$data[0]= false;
		$data[1]= $LANG_ERROR_ALERT;
	}
	echo json_encode($data);
}


?>