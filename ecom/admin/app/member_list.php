<div class  = "panel panel-default">
	<div class = "panel-heading">
		<?php echo $LANG_MEMBER_LIST;?>
	</div>
	<div class = "panel-body">
		<div class = "dataTable_wrapper table-responsive">
			<table class = "table table-striped table-bordered table-hover dataTables" id = "">
				<thead>
					<tr class = "pluginth">
						<th style = "width:5%"><span><?php echo $LANG_NO;?></span></th>
						<th style = "width:10%"><span><?php echo $LANG_MEMBER_NAME;?></span></th>
						<th style = "width:10%"><span><?php echo $LANG_MEMBER_BIRTHDAY;?></span></th>
						<th style = "width:15%"><span><?php echo $LANG_MEMBER_EMAIL;?></span></th>
						<th style = "width:10%"><span><?php echo $LANG_MEMBER_GENDER;?></span></th>
						<th style = "width:15%"><span><?php echo $LANG_LAST_LOGIN_DT;?></span></th>
						<!-- <th style = "width:10%"><span><?php echo $LANG_ACTION;?></span></th> -->
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 1;
						$stmt_select_member = $mysqli -> prepare("SELECT member_id, member_name, member_birthday, member_email, member_gender, member_last_login_datetime FROM member");
						$stmt_select_member -> execute();
						$stmt_select_member -> store_result();
						$stmt_select_member -> bind_result($member_id, $member_name, $member_birthday, $member_email, $member_gender, $member_last_login_datetime);
						while($stmt_select_member -> fetch()){
					?>
					<tr class = "pluginth">
						<td><?php echo $i++;?></td>
						<td><?php echo $member_name;?></td>
						<td><?php echo $member_birthday;?></td>
						<td><?php echo $member_email;?></td>
						<td><?php echo $member_gender;?></td>
						<td><?php echo $member_last_login_datetime;?></td>
						<!-- <td style = "text-align:center;">
							<input type = "button" value = "<?php echo $LANG_DETAIL;?>" onclick = "showMemberForm('<?php echo $member_id;?>')"/>
						</td> -->
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- <div id = "member_modal" class = "modal fade" role = "dialog" aria-hidden = "true">
	<div class = "modal-dialog modal-lg">
		<div class = "modal-content">
			<div class = "modal-header">
				<button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close"><span aria-hidden = "true">&times;</span></button>
				<h4 class = "modal-title"><?php echo $LANG_MEMBER_DETAILS;?></h4>
			</div>
			<div class = "modal-body" id = "member_details">
			
			</div>
			<div class = "modal-footer" style = "border-top:none">
			
			</div>
		</div>
	</div>
</div> -->

<script>

// function showMemberForm(id){
	// $.ajax({
		// url: '?f=member_list',
		// type: 'POST',
		// dataType: 'json',
		// data: {
			// member_id: id
		// },
		// success: function(data){
			// $("#member_modal").modal("show");
			// $("#member_details")html(data);
		// }
	// });
// }

</script>