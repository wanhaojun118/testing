<?php 
$member_username = filter_input(INPUT_POST, "member_username");
if($language=='cn'){
	include_once 'language/cn/member_list.php';
}else{
	include_once 'language/en/member_list.php';
}
?>
<script>
$(document).ready(function () {
	//datatable 
	$('.dataTables').DataTable({
		"pageLength": 25
	});
});	
</script>								
<?php
?>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTables" id="">
		<thead>
			<tr class="pluginth">	
                        <th style="width:5%"><span><?php echo $LANG_NO; ?></span></th>					              
                        <th style="width:15%"><span><?php echo $LANG_MEMBER_NAME; ?></span></th>				
						<th style="width:15%"><span><?php echo $LANG_MEMBER_PARENT_NAME; ?></span></th>					
                        <th style="width:15%"><span><?php echo $LANG_MEMBER_PARENT_PHONE; ?></span></th>							
                        <th style="width:10%"><span><?php echo $LANG_ACTION; ?></span></th>
                    </tr>
		</thead>
		<tbody>
			 <?php
                    $i = 1;
                    $stmt_member_list = $mysqli->prepare('select member_id,member_name,member_username, member_parent_id, member_password FROM member WHERE member_username=?');
                    $stmt_member_list->bind_param('s',$member_username);
                    $stmt_member_list->execute();
                    $stmt_member_list->store_result();
                    $stmt_member_list->bind_result($member_id,$member_name,$member_username, $member_parent_id, $member_password);
                    while ($stmt_member_list->fetch()) {
						$member_parent_name = select_name($member_parent_id,"member_id","member_name","member",$mysqli);
						$member_parent_phone = select_name($member_parent_id,"member_id","member_phone","member",$mysqli);
                        ?>
                         <tr class="plugintr">
                            <td ><?php print $i++; ?></td>
                            <td ><?php print $member_username; ?></td>
							
							<?php if($member_parent_name){?>
							<td ><?php print $member_parent_name; ?></td>
							<td ><?php print $member_parent_phone; ?></td>
							<?php } else{?>
							<td >-</td>
							<td >-</td>
							<?php }?>
							
							
                            <td style="text-align: center">
								<!--<input type="button" value="<?php echo $LANG_DETAIL ?>" onclick="showMemberForm('<?php echo $member_id; ?>')">-->
                                <input type="button" value="<?php echo $LANG_LOGIN ?>" onclick="auto_login('<?php echo $member_username; ?>', '<?php echo $member_password; ?>')">
                                <input type="button" value="Reset Second Password" onclick="reset_second_password('<?php echo $member_id; ?>')">
							</td>
                        </tr>
                    <?php } ?>
		</tbody>
	</table>
 </div>

