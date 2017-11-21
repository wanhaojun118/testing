<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $LANG_C_WALLET_TOPUP; ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" id="">
                <thead>
                    <tr class="pluginth">	
                        <th style="width:5%"><span><?php echo $LANG_NO; ?></span></th>					              
                        <th style="width:15%"><span><?php echo $LANG_MEMBER; ?></span></th>				
						<th style="width:15%"><span><?php echo $LANG_TOPUP_AMOUNT; ?></span></th>					
                        <th style="width:15%"><span><?php echo $LANG_BANK_SLIP; ?></span></th>							
                        <th style="width:15%"><span><?php echo $LANG_STATUS; ?></span></th>							
                        <th style="width:10%"><span><?php echo $LANG_ACTION; ?></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $stmt_member_list = $mysqli->prepare('SELECT member_atu_id,member_atu_member_id,member_atu_amount,member_atu_bank_slip,member_atu_dt,member_atur_result,member_atur_reason,member_atur_dt FROM member_audit_top_up JOIN member_audit_top_up_result WHERE member_atur_member_atu_id=member_atu_id ORDER by member_atu_dt DESC');
                    $stmt_member_list->execute();
                    $stmt_member_list->store_result();
                    $stmt_member_list->bind_result($member_atu_id,$member_atu_member_id,$member_atu_amount,$member_atu_bank_slip,$member_atu_dt,$member_atur_result,$member_atur_reason,$member_atur_dt);
						while ($stmt_member_list->fetch()) {						
                    ?>
                         <tr class="plugintr">
                            <td><?php print $i++; ?></td>
                            <td>
								<?php 
									print select_name($member_atu_member_id,"member_id","member_name","member",$mysqli)."<br>"; 
									print select_name($member_atu_member_id,"member_id","member_phone","member",$mysqli)."<br>"; 
								?>
							</td>
							<td><?php echo $member_atu_amount;?></td>
							<td><?php echo "<a href='../".$member_atu_bank_slip."' target='_blank'>".$LANG_VIEW."</a>";?></td>
							<td>
							<?php
								if($member_atur_result == 0){
									echo '<span style="color:orange;">'.$LANG_WAITING_APPROVE.'</span>';
								}else if($member_atur_result == 1){
									echo '<span style="color:green;">'.$LANG_APPROVE.'</span>';
								}else if($member_atur_result == 2){
									echo '<span style="color:red;">'.$LANG_REJECT.'</span><br>';
									echo $member_atur_reason;
								}
							?>
							</td>
                            <td style="text-align: center">
								<?php
									if($member_atur_result == 0){
								?>
									<a class="btn btn-primary" onclick="approve('<?php echo $member_atu_id; ?>')"><?php echo $LANG_APPROVE_BTN;?></a>
									<a class="btn btn-danger" onclick="open_reject_modal('<?php echo $member_atu_id; ?>')"><?php echo $LANG_REJECT_BTN;?></a>
								<?php		
									}else{
										echo ' - ';
									}
								?>
                            
							</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
</div>

<div id="reject_modal" class="modal fade" role="dialog" aria-hidden="true" >
	<div class="modal-dialog modal-lg">
	<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $LANG_REJECT_TOPUP?></h4>
			</div>
			<div class="modal-body"> 
				<form id="reject_form">
					<input type="hidden" id="topup_id" value="">
					<div class="form-group col-md-12">
						<label class="col-sm-3 control-label"><?php echo $LANG_REASON;?><span style='color:red;'>&nbsp;*</span></label>
						<div class="col-sm-6">
							<input type="text" class="required col-md-6 form-control" id="reject_reason" name="reject_reason" value="" >
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer" style="border-top:none">
				 <button type="button" class="btn btn-primary" onclick="reject()"><?php echo $LANG_SUBMIT?></button>
				 <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $LANG_CLOSE;?></button>
			</div>
		</div>
	</div>
</div>

<script>
function approve(id){
	if(confirm("<?php echo $LANG_CONFIRM; ?>")){
		$.ajax({
			url:'?f=c_wallet_topup',
			type:'POST',
			dataType:'json',
			data:{
				act:'1',
				id:id
			},
			beforeSend:function(){
				show_processing();
			},
			success:function(data){
				hide_processing();
				if(data[0]){
					alert(data[1]);
					location.reload();
				}else{
					alert(data[1]);
				}
			}
		});
	}
}

function open_reject_modal(id){
	$('#topup_id').val(id);
	$('#reject_modal').modal('toggle');
}

function reject(){
	var id = $('#topup_id').val();
	var reject_reason = $('#reject_reason').val();
	
	$('#reject_reason').removeClass('errorBorder');
	if(reject_reason == ""){
		alert("<?php echo $LANG_BLANK;?>");
		$('#reject_reason').addClass('errorBorder');
	}else{	
		if(confirm("<?php echo $LANG_CONFIRM;?>")){
			$.ajax({
				url:'?f=c_wallet_topup',
				type:'POST',
				dataType:'json',
				data:{
					id:id,
					reject_reason:reject_reason,
					act:'2'
				},
				beforeSend:function(){
					show_processing();
				},
				success:function(data){
					hide_processing();
					if(data[0]){
						alert(data[1]);
						location.reload();
					}else{
						alert(data[1]);
					}
				}
			});
		}
	}
}
</script>