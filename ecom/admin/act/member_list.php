<?php
$member_id = filter_input(INPUT_POST,"member_id");
$stmt_member_list = $mysqli->prepare('select member_id,member_name,member_phone, member_parent_id, member_password,member_ic,member_email,member_bank_id,member_bank_acc_number,member_bank_acc_name FROM member WHERE member_id=?');
$stmt_member_list->bind_param('i',$member_id);
$stmt_member_list->execute();
$stmt_member_list->store_result();
$stmt_member_list->bind_result($member_id,$member_name,$member_phone, $member_parent_id, $member_password,$member_ic,$member_email,$member_bank_id,$member_bank_acc_number,$member_bank_acc_name );
$stmt_member_list->fetch();

?>
<form class="form-horizontal">  
	<div class="box-body">
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_MEMBER_PHONE; ?><span style='color:red;'>&nbsp;*</span></label>
			<div class="col-sm-9">
				<input class="form-control required" name="member_phone" placeholder="" value="<?php echo $member_phone; ?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_NAME; ?></label>
			<div class="col-sm-9">
				<input class="form-control" name="member_name" value="<?php echo $member_name; ?>" type="text" readonly>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_MEMBER_IC; ?><span style='color:red;'>&nbsp;*</span></label>
			<div class="col-sm-9">
				<input class="form-control required" name="member_ic" placeholder=""  value="<?php echo $member_ic; ?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_MEMBER_EMAIL; ?><span style='color:red;'>&nbsp;*</span></label>
			<div class="col-sm-9">
				<input class="form-control required alphanumeric" name="member_email" value="<?php echo $member_email; ?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_BANK_NAME ?><span style='color:red;'>&nbsp;*</span></label>
			<div class="col-sm-9">
				<input class="form-control required" name="member_bank"  value="<?php echo select_name($member_bank_id,"bank_id","bank_name","bank",$mysqli); ?>" readonly>
			</div>
		</div> 
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_BANK_ACC_NO ?><span style='color:red;'>&nbsp;*</span></label>
			<div class="col-sm-9">
				<input class="form-control required email" name="member_bank_acc_no" placeholder="" value="<?php echo $member_bank_acc_number; ?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label"><?php echo $LANG_BANK_ACC_NAME; ?><span style='color:red;'>&nbsp;*</span></label>
			<div class="col-sm-9">
				<input class="form-control required" name="member_bank_acc_name" value="<?php echo $member_bank_acc_name; ?>" readonly>
			</div>
		</div>
	</div>
</form>