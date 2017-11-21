<div class="panel panel-default" >
    <div class="panel-heading">
        <?php echo $LANG_CONTACT_US; ?>
    </div>
    <div class="panel-body" id="contact_us">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" id="">
                <thead>
                    <tr class="pluginth">
                        <th style=""><span><?php echo $LANG_NO ?></span></th>   
                        <th style=""><span><?php echo $LANG_NAME ?></span></th>
                        <th style=""><span><?php echo $LANG_DATETIME ?></span></th>
                        <th style=""><span><?php echo $LANG_TITLE ?></span></th>
						<th style=""><span><?php echo $LANG_MESSAGE ?></span></th>
						<th style=""><span><?php print $LANG_IMAGE_1; ?></span></th>						              
                        <th style=""><span><?php print $LANG_IMAGE_2; ?></span></th>						              
                        <th style=""><span><?php print $LANG_IMAGE_3; ?></span></th>						              
                        <th style=""><span><?php print $LANG_REPLY_MSG; ?></span></th>						              
                        <th style=""><span><?php print $LANG_REPLY_MSG_DATETIME; ?></span></th>				
						<th style="width:100px;"><span><?php echo $LANG_ACTION ?></span></th>  
                    </tr>
                </thead>
                <tbody>
					<?php
                    $i = 1;
                    $stmt_contact_us = $mysqli->prepare('select contact_us_id,contact_us_member_id,contact_us_title, contact_us_message, contact_us_image,contact_us_reply_msg,contact_us_reply_by_admin_id from contact_us order by contact_us_id desc');
                    $stmt_contact_us->execute();
                    $stmt_contact_us->store_result();
                    $stmt_contact_us->bind_result($contact_us_id,$contact_us_member_id,$contact_us_title, $contact_us_message, $contact_us_image,$contact_us_reply_msg,$contact_us_reply_by_admin_id);
                    while ($stmt_contact_us->fetch()) {
						$contact_us_image = explode(',',$contact_us_image);
						$contact_us_image_1 = $contact_us_image[0];
						$contact_us_image_2 = $contact_us_image[1];
						$contact_us_image_3 = $contact_us_image[2];
                        ?>
                        <tr class="plugintr">
                            <td ><?php print $i++; ?></td>
                            <td ><?php print select_name($contact_us_member_id,"member_id","member_name","member",$mysqli); ?></td>
                            <td>
							<?php 
								$stmt_select_cua = $mysqli->prepare("SELECT contact_ua_dt FROM contact_us_audit WHERE contact_ua_contact_us_id=? and contact_ua_action=1");
								$stmt_select_cua ->bind_param("i",$contact_us_id);
								$stmt_select_cua ->execute();
								$stmt_select_cua ->store_result();
								$stmt_select_cua ->bind_result($contact_ua_dt);
								$stmt_select_cua ->fetch();
								if($stmt_select_cua ->num_rows >0){
									print $contact_ua_dt;
								}else{
									print "-";
								}
							?>
							</td>
                            <td ><?php print $contact_us_title; ?></td>
							<td ><?php print $contact_us_message; ?></td>
							<td>
							<?php
								if($contact_us_image_1 !=""){
									echo '<a href="http://fruitskingdom.vip/'.$contact_us_image_1.'" target="_blank">'.$LANG_VIEW.'</a>'; 
								}else{
									echo '-';
								}
							?>
							</td>
							<td>
							<?php
								if($contact_us_image_2 !=""){
									echo '<a href="http://icre8tech.com/gwg/'.$contact_us_image_2.'" target="_blank">'.$LANG_VIEW.'</a>'; 
								}else{
									echo '-';
								}
							?>
							</td>
							<td>
							<?php
								if($contact_us_image_3 !=""){
									echo '<a href="http://icre8tech.com/gwg/'.$contact_us_image_3.'" target="_blank">'.$LANG_VIEW.'</a>'; 
								}else{
									echo '-';
								}
							?>
							</td>
							
                            <td>
							<?php 
								if($contact_us_reply_msg!=""){
									print $contact_us_reply_msg; 
								}else{
									print "-";
								}
							?>
							</td>
							<td>
							<?php 
								$stmt_select_cua = $mysqli->prepare("SELECT contact_ua_dt FROM contact_us_audit WHERE contact_ua_contact_us_id=? and contact_ua_action=2");
								$stmt_select_cua ->bind_param("i",$contact_us_id);
								$stmt_select_cua ->execute();
								$stmt_select_cua ->store_result();
								$stmt_select_cua ->bind_result($contact_ua_dt);
								$stmt_select_cua ->fetch();
								if($stmt_select_cua ->num_rows >0){
									print $contact_ua_dt;
								}else{
									print "-";
								}
							?>
							</td>
							<td>
							<?php 
								if($contact_us_reply_msg == ""){
									print "<button onclick='show_info(".$contact_us_id.");'>".$LANG_REPLY."</button>";
								}else{
									print "-";
								}
							?>
							</td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- page script -->

<!-- Modal -->
<div class="modal fade bs-example-modal-sm" id="contact_us_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
        <div class="modal-content"> 
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $LANG_REPLY_MSG; ?></h4>
			</div>
			<div class="modal-body" id="contact_us_content" style=" height: 440px;">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $LANG_CANCEL; ?></button>
				<button type="button" class="btn btn-primary" onclick="update_contact_us();"><?php echo $LANG_SUBMIT; ?></button>
			</div>
		</div>
		<!-- /.modal-content -->
		
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- Modal End -->

<script>
function show_info(contact_us_id){
	$.ajax({
		type:'POST',
		url:'?f=<?php echo $_GET['loc'] ?>',
		data:{
			type:'detail',
			contact_us_id:contact_us_id
		},
		beforeSend:function(){
			show_processing();
		},
		success:function(data){
			hide_processing();
			$('#contact_us_content').html(data);
			$('#contact_us_modal').modal('show');
		}
	});
}

function update_contact_us(){
	var error_msg = [];
	var check = true;
	if(confirm('<?php echo $LANG_CONFIRM;?>')){
		var error_msg = [];
		 $('#reply_msg_form .required').each(function () {
			if ($.trim($(this).val()) == "")
			{
				$(this).addClass('errorBorder');
				check = false;
				error_msg.push("<?php echo $LANG_BLANK ?>");
			}
		});

		if(check){
			$.ajax({
				dataType:'json',
				type: 'POST',
				url: '?f=<?php echo $_GET['loc'] ?>',
				data: $("#reply_msg_form").serialize(),
				beforeSend:function(){
					show_processing();
				},
				success: function (data) {
					hide_processing();
					if (data[0]) {
						alert(data[1]);
						window.location.href = '?loc=<?php echo $_GET['loc'] ?>';
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
</script>
