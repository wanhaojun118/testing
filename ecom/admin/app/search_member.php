<div class="box box-default" id="creation">
    <div class="box-body">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div id="heading">
                    <?php echo ucwords($LANG_SEARCH_MEMBER); ?>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
					<div class="form-group col-md-12" style="margin-top:15px">
						<label for="" class="col-md-3 control-label"><?php echo $LANG_MEMBER_USERNAME; ?><span style='color:red;'>&nbsp;*</span></label>
						<div class="col-md-5" style="margin-bottom:15px">
							<input class="form-control required" id="member_username" name="member_username" placeholder="" >
						</div>
					</div>

				<div class="form-group col-md-12" style="text-align:center">
					<a href="#" class="btn btn-primary" onclick="search_member()" id="create_button">
						<?php echo $LANG_SEARCH; ?>
					</a>
					<a href="#" class="btn btn-default" onclick="cancel()">
						<?php echo $LANG_CANCEL; ?>
					</a>
				</div>
			</div>
        </div><!-- /.panel-body -->
    </div><!-- /.box-body -->
</div><!-- /.box -->

<div class="box box-default" id="display">
	<div class="box-body">
		<div class="panel panel-default" >
			<div class="panel-heading">
                <div id="heading">
                    <?php echo ucwords($LANG_RESULT); ?>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" id="content">
				
			</div>
		</div>
	</div>
</div>

<script>
function search_member(){
	var member_username=$.trim($("#member_username").val());
	if(member_username==""){
		alert("<?php echo $LANG_BLANK?>");
	}else{
		$('#content').html("");
        $.ajax({
            type: 'POST',
            url: '?f=<?php echo $_GET['loc'] ?>',
            data: {
                member_username: member_username
            },
            beforeSend: function () {
                show_processing();
            },
            success: function (data) {
                hide_processing();
                $('#content').html(data);
            }
        });
	}
}

function auto_login(member_username, password) {
	if (confirm("<?php echo $LANG_CONFIRM; ?>")) {
		$.ajax({
			url: '?f=auto_login',
			type: "POST",
			dataType: 'json',
			data: {
				member_username: member_username,
				password: password,
			},
			beforeSend: function () {
				show_processing();
			},
			success: function (data) {
				hide_processing();
				if (data[0]) {
					window.open("http://fruitskingdom.vip/?loc=dashboard", "_blank");
				} else {
					alert(data[1]);
					window.location.reload();
				}
			}
		});
	}
}

// function reset_second_password(member_id){
	// if(confirm("<?php echo $LANG_CONFIRM;?>")){
		// $.ajax({
            // type: 'POST',
            // url: '?f=reset_second_password',
            // data: {
                // member_id: member_id,
				// type:2
            // },
            // beforeSend: function () {
                // show_processing();
            // },
            // success: function (data) {
                // hide_processing();
				// if(data[0]){
					// alert(data[1]);
					// location.reload();
				// }else{
					// alert(data[1]);
				// }
            // }
        // });
	// }
// }
</script>