<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>

<style>
	.errorBorder{
		border: 1px solid red;
	}
</style>



<div class="panel panel-default" >
    <div class="panel-heading">
        <b><?php echo $LANG_EDIT_PROFILE;?></b>
    </div>
<div class="panel-body">	
	<div class="box box-info">
		<form id="member_form" class="form-horizontal">
			<div class="box-body">
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_USERNAME;?></label>
					<div class="col-sm-9">
						<input type = "hidden" id = "admin_id" name = "admin_id" value = "<?php echo $admin -> getadmin_id();?>"/>
						<input type="text" class="form-control required" id="admin_username" name="admin_username" value = "<?php echo $admin -> getadmin_username();?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_EMAIL;?></label>
					<div class="col-sm-9">
						<input type = "text" class="form-control required" id="admin_email" name="admin_email" value = "<?php echo $admin -> getadmin_email();?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_NAME;?></label>
					<div class="col-sm-9">
						<input type="text" class="form-control required" id="admin_name" name="admin_name" value="<?php echo $admin -> getadmin_name();?>"/>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_PHONE;?></label>
					<div class="col-sm-9">
						<input type = "text" class = "form-control" id = "admin_phone" name = "admin_phone" value = "<?php echo $admin -> getadmin_phone();?>"/>
					</div>
				</div>
			</div>	
			<div class="bg-default content-box text-center pad20A mrg25T">
				<input type = "button" class="btn btn-primary" onclick="edit()" value = "<?php echo $LANG_SUBMIT;?>"/>
				<input type = "reset" class = "btn btn-default" onclick = "back()" value = "<?php echo $LANG_CANCEL;?>"/>
			</div>
		</form>	
	</div>
	</div>
</div>	


<script>
function edit() {
	if (confirm("<?php echo $LANG_CONFIRM ?>")) {
		var check = true;
		var error_msg = [];
		
		var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3,}))$/;

		$('#member_form input,select,textarea').removeClass('errorBorder');
		$('#member_form .required').each(function () {
			if ($.trim($(this).val()) == "")
			{
				$(this).addClass('errorBorder');
				check = false;
				error_msg.push("<?php echo $LANG_BLANK ?>");
			}
		});
		/*$('#member_form .alphanumeric').each(function () {
			if (/[^a-zA-Z0-9\u4E00-\u9FFF\u3400-\u4DFF\uF900-\uFAFF]/.test($.trim($(this).val()))) {
				$(this).addClass('errorBorder');
				check = false;
				error_msg.push("<?php echo $LANG_ALPHA ?>");
			}
		});
		$('#member_form .numeric').each(function () {
			if (/[^0-9]/.test($.trim($(this).val()))) {
				$(this).addClass('errorBorder');
				check = false;
				error_msg.push("<?php echo $LANG_NUMERIC ?>");
			}
		});*/

		if (check) {
			$.ajax({
				dataType: 'json',
				type: 'POST',
				url: '?f=edit_profile',
				data: $('#member_form').serialize(),
				// beforeSend: function () {
					// show_processing();
				// },
				success: function(data) {
					//hide_processing();
					if (data[0]) {
						alert(data[1]);
						location.reload(true);
					} else {
						alert(data[1]);
					}
				}
			});
		} else {
			alert(jQuery.unique(error_msg).join("\n"));
			$('.errorBorder:first').focus();
		}
	}
}

function back(){
	location.replace("?loc=dashboard");
}
</script>

