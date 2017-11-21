<div class="panel panel-default" >
    <div class="panel-heading">
        <?php echo $LANG_ORDER; ?>
    </div>

	<div class="panel-body" id="">
		<div class="dataTable_wrapper table-responsive" >
			<table class="table table-striped table-bordered table-hover dataTables" >
				<thead>
					<tr class="pluginth">
						<th style=""><span><?php print $LANG_NO; ?></span></th>
						<th style=""><span><?php print $LANG_ORDER_ID; ?></span></th>
						<th style=""><span><?php print $LANG_ORDER_NAME; ?></span></th>
						<th style=""><span><?php print $LANG_ORDER_AMOUNT; ?></span></th>
						<th style=""><span><?php print $LANG_ORDER_STATUS; ?></span></th>
						<th style=""><span><?php print $LANG_DATETIME; ?></span></th>
						<th style=""><span><?php print $LANG_ACTION; ?></span></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$stmt_select_order = $mysqli->prepare("SELECT o.order_id,o.order_prefix,o.order_member_id,o.order_total_amount,o.order_status FROM `order` o ORDER by o.order_id DESC");
					$stmt_select_order ->bind_param('i',$admin->getAdmin_id());
					$stmt_select_order ->execute();
					$stmt_select_order ->store_result();
					$stmt_select_order ->bind_result($order_id,$order_prefix,$order_member_id,$order_total_amount,$order_status);
					while($stmt_select_order ->fetch()){
						$stmt_select_order_audit = $mysqli->prepare("SELECT order_audit_dt FROM order_audit WHERE order_audit_order_id=? AND order_audit_type=1");
						$stmt_select_order_audit ->bind_param('i',$order_id);
						$stmt_select_order_audit ->execute();
						$stmt_select_order_audit ->store_result();
						$stmt_select_order_audit ->bind_result($order_audit_dt);
						$stmt_select_order_audit ->fetch();
					
						if($order_status == 1){
							$status = $LANG_PAID;
						}else if($order_status == 2){
							$status = $LANG_PRODUCT_DELIVERED;
						}
					
						print "<tr><td>" . $i . "</td>";
						print "<td>" . $order_prefix . "</td>";
						
						print "<td>" . select_name($order_member_id,"member_id","member_name","member",$mysqli) . "</td>";
						print "<td>" . $order_total_amount . "</td>";
						print "<td>" . $status . "</td>";
						// if($order_bank_slip ==""){
							// print "<td>-</td>";
						// }else{
							// print "<td><a href='../".$order_bank_slip."' target='_blank'>" . $LANG_VIEW . "</a></td>";
						// }
						print "<td>".$order_audit_dt."</td>";
						print "<td><a onclick='display_order(".$order_id.")' style='cursor:pointer; font-size:14px; text-decoration:none;'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> ".$LANG_VIEW."</a></td>"; 
						print "</tr>";

						$i++;

					}

					?>
				</tbody>
			</table>
		</div>
	</div>
			
	<div class="box box-default" id="order_box" style="display:none">
		<div class="box-body">
			<div class="panel panel-default" >
				<div class="panel-heading">
					<div id="heading">
						<?php echo ucwords($LANG_ORDER_DETAILS); ?>
					</div>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" id="order_detail">
				</div>
			</div><!-- /.panel-body -->
		</div><!-- /.box-body -->
	</div><!-- /.box -->

</div>

<script>
function display_order(order_id){
	$('#order_detail').html("");
	$.ajax({
		url:'?f=order',
		type:'POST',
		data:{
			order_id:order_id,
			act:'1'
		},
		beforeSend:function(){
			show_processing();
		},
		success:function(data){
			hide_processing();
			$('#order_detail').html(data);
			$('#order_box').show();
		}
	});
}
</script>