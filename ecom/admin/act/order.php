<?php
$order_id = filter_input(INPUT_POST,"order_id");
$act = filter_input(INPUT_POST,"act");

if($act == 1){
	$stmt_select_order = $mysqli->prepare("SELECT order_id,order_prefix,order_member_id,order_total_amount,order_status,order_customer_name,order_customer_phone,order_customer_address,order_invoice_email FROM `order`  WHERE order_id=?");
	$stmt_select_order ->bind_param('i',$order_id);
	$stmt_select_order ->execute();
	$stmt_select_order ->store_result();
	$stmt_select_order ->bind_result($order_id,$order_prefix,$order_member_id,$order_total_amount,$order_status,$order_customer_name,$order_customer_phone,$order_customer_address,$order_invoice_email);
	$stmt_select_order ->fetch();
?>
	<div class="col-md-6" style="padding-bottom:20px;">
		<table class="" border="0">
			<tr>
				<td><?php echo $LANG_ORDER_ID;?></td>
				<td style="padding-left:5px; padding-right:5px;"> : </td>
				<td><?php echo $order_prefix;?></td>
			</tr>

			<tr>
				<td><?php echo $LANG_ORDER_NAME;?></td>
				<td style="padding-left:5px; padding-right:5px;"> : </td>
				<td><?php echo  select_name($order_member_id, "member_id", "member_name", "member", $mysqli);?></td>
			</tr>

			<tr>
				<td><?php echo $LANG_SHIPPING_DETAIL;?></td>
				<td style="padding-left:5px; padding-right:5px;"> : </td>
				<td><?php
					echo $order_customer_name."<br>";
					echo $order_customer_phone."<br>";
					echo $order_customer_address."<br>";
				?></td>
			</tr>
		</table>
	</div>
	<?php	
		$stmt_select_order_detail = $mysqli->prepare("SELECT order_details_product_id, order_details_quantity,order_details_price FROM order_details WHERE order_details_order_id=?");
		$stmt_select_order_detail ->bind_param('i',$order_id);
		$stmt_select_order_detail ->execute();
		$stmt_select_order_detail ->store_result();
		$stmt_select_order_detail ->bind_result($order_details_product_id,$order_details_quantity,$order_details_price);
	?>
		<table class="table" style="text-align:center">
			<tr style="font-weight:bold;">
				<td><?php echo $LANG_PRODUCT_CODE;?></td>
				<td><?php echo $LANG_PRODUCT_NAME;?></td>
				<td><?php echo $LANG_PRODUCT_QUANTITY;?></td>
				<td><?php echo $LANG_PRODUCT_PRICE;?></td>
			</tr>

		<?php

		while($stmt_select_order_detail ->fetch()){
			echo '<tr>';
			echo '<td>'.select_name($order_details_product_id, "product_id", "product_code", "product", $mysqli).'</td>';
			echo '<td>'.select_name($order_details_product_id, "product_id", "product_name", "product", $mysqli).'</td>';
			echo '<td>'.$order_details_quantity.'</td>';
			echo '<td>'.$order_details_price.'</td>';
			echo '</tr>';
		}

		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td style="font-weight:bold;">'.$LANG_TOTAL.'</td>';
		echo '<td>'.$order_total_amount.'</td>';
		echo '</tr>';
		echo '</table>';

}else if($act == 2){
	
}
?>