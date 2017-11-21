<?php 
session_start();

$product_id = $_POST['id'];
$product_price = $_POST['price'];
$product_quantity = $_POST['quantity'];

$quantity = 0;
$new_quantity = 0;
$total_item = 0;

$stmt_select_product = $mysqli -> prepare("SELECT product_name, product_quantity FROM product WHERE product_id = ?");
$stmt_select_product -> bind_param('i', $product_id);
$stmt_select_product -> execute();
$stmt_select_product -> store_result();
$stmt_select_product -> bind_result($product_name, $in_stock_quantity);
$stmt_select_product -> fetch();

if($stmt_select_product -> num_rows > 0){
	
	// $stmt_select_order_details = $mysqli -> prepare("SELECT order_details_quantity FROM order_details WHERE order_details_product_id = ?");
	// $stmt_select_order_details -> bind_param('i', $product_id);
	// $stmt_select_order_details -> execute();
	// $stmt_select_order_details -> store_result();
	// $stmt_select_order_details -> bind_result($order_details_quantity);
	// while($stmt_select_order_details -> fetch()){
		// $quantity += $order_details_quantity;
	// }
	
	$new_quantity = $in_stock_quantity - $quantity;
	
	if($product_quantity <= $new_quantity){
		$p_code = 'code_' . $product_id;
		$itemArray = array($p_code => array('product_id' => $product_id, 'product_quantity' => $product_quantity, 'product_price' => $product_price));
		
		if(!empty($_SESSION['cart_item'])){
			if(array_key_exists($p_code, $_SESSION['cart_item'])){
				foreach($_SESSION['cart_item'] as $k => $v){
					if($p_code == $k){
						$total_quantity = $_SESSION['cart_item'][$k]['product_quantity'] + product_quantity;
						if($total_quantity <= $new_quantity){
							$_SESSION['cart_item'][$k]["product_quantity"] = $total_quantity;
							$output[0] = true;
							$output[1] = " (" .  count($_SESSION['cart_item']) . ")";
						}else{
							$output[0] = false;
							$output[1] = $LANG_LOW_STOCK_ALERT;
						}
					}
				}
			}else{
				$_SESSION['cart_item'] = array_merge($_SESSION['cart_item'], $itemArray);
				$output[0] = true;
				$output[1] = " (" . count($_SESSION['cart_item']) . ")";
			}
		}else{
			$_SESSION['cart_item'] = $itemArray;
			$output[0] = true;
			$output[1] = " (" . count($_SESSION['cart_item']) . ")";
		}
	}else{
		$output[0] = false;
		$output[1] = $LANG_LOW_STOCK_ALERT;
	}
}else{
	$output[0] = false;
	$output[1] = $LANG_ERROR_ALERT;
}

echo json_encode($output);
?>