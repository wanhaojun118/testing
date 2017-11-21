<?php 
$act = $_POST['act'];
if($act == 1){
?>

<thead>
	<tr class="cart_menu">
		<td class="image"><?php echo $LANG_ITEM;?></td>
		<td class="description"></td>
		<td class="price"><?php echo $LANG_PRICE;?></td>
		<td class="quantity"><?php echo $LANG_QUANTITY;?></td>
		<td class="total"><?php echo $LANG_TOTAL;?></td>
		<td></td>
	</tr>
</thead>
<tbody>
	<?php 
	if(isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0){
		$total_price = 0.00;
		foreach ($_SESSION['cart_item'] as $cart_item => $value){
			$new_quantity = 0;
			$stmt_select_product = $mysqli -> prepare("SELECT product_id, product_name, product_price, product_quantity, product_image FROM product WHERE product_id = ?");
			$stmt_select_product -> bind_param('i', $_SESSION['cart_item'][$cart_item]['product_id']);
			$stmt_select_product -> execute();
			$stmt_select_product -> store_result();
			$stmt_select_product -> bind_result($product_id, $product_name, $product_price, $product_quantity, $product_image);
			$stmt_select_product -> fetch();
			$product_sub_image = explode(",", $product_image);
			
			// $stmt_select_order = $mysqli -> prepare("SELECT SUM(od.order_details_quantity) FROM `order_details` od JOIN `order` o WHERE o.order_id = od.order_details_order_id AND od.order_details_product_id = ?");
			// $stmt_select_order -> bind_param('i', $_SESSION['cart_item'][$cart_item]['product_id']);
			// $stmt_select_order -> execute();
			// $stmt_select_order -> store_result();
			// $stmt_select_order -> bind_result($order_quantity);
			// $stmt_select_order -> fetch();
			// $new_quantity = $product_quantity - $order_quantity;
	?>
	
	<tr>
		<td class = "cart_product">
			<a href = ""><img src = "admin/<?php echo $product_sub_image[0];?>" style = "width:150px;height:150px;" alt = ""/>
		</td>	
		<td class = "cart_description">
			<h4><a href = ""><?php echo $product_name;?></a></h4>
		</td>
		<td class = "cart_price">
			<p><?php echo "RM " . number_format($_SESSION['cart_item'][$cart_item]['product_price'], 2, '.', '');?></p>
		</td>
		<td class = "cart_quantity">
			<div class = "cart_quantity_button">
				<a class = "cart_quantity_up" onclick = "add_quantity('<?php echo $product_id;?>')"> + </a>
				<input class = "cart_quantity_input" type = "text" id = "<?php echo $product_id;?>" name = "quantity" value = "<?php echo $_SESSION['cart_item'][$cart_item]['product_quantity'];?>" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" autocomplete = "off" size = "2">
				<a class = "cart_quantity_down" onclick = "substract_quantity(<?php echo $product_id;?>)"> - </a>
			</div>
		</td>
		<td class = "cart_total">
			<?php $total_each_product_price = $_SESSION['cart_item'][$cart_item]['product_quantity'] * ($_SESSION['cart_item'][$cart_item]['product_price']);?>
			<?php echo "RM " . number_format($total_each_product_price, 2, '.', '');?>
		</td>
		<td class = "cart_delete">
			<a class = "btn-remove" onclick =" remove_item("<?php echo $product_id ;?>")"><span class = "fa fa-trash-o"></span></a>
		</td>
	</tr>
	<?php 
			$total_price += $total_each_product_price;
		}
	}else{
	?>
	<tr>
		<td colspan=5 class = "text-center"><?php echo $LANG_EMPTY_CART;?></td>
	</tr>
	<?php 
	}
	?>
</tbody>

<?php 
}else if($act == 2){
	$total_price = 0.00;
	foreach ($_SESSION['cart_item']as $cart_item => $value){
		$stmt_select_product = $mysqli -> prepare("SELECT product_id, product_name, product_price, product_quantity FROM product WHERE product_id = ?");
		$stmt_select_product -> bind_param('i', $_SESSION['cart_item'][$cart_item]['product_id']);
		$stmt_select_product -> execute();
		$stmt_select_product -> store_result();
		$stmt_select_product -> bind_result($product_id, $product_name, $product_price, $product_quantity);
		$stmt_select_product -> fetch();
		
		$total_each_product_price = $_SESSION['cart_item'][$cart_item]['product_quantity'] * ($_SESSION['cart_item'][$cart_item]['product_price']);
		$total_price += $total_each_product_price;
	}
	
	echo "RM" . number_format($total_price, 2, '.', '');
}
?>