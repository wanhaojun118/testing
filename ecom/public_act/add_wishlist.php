<?php
	// session_id('wishlist');
	// session_start();
	
	$product_id = $_POST['id'];
	$product_price = $_POST['price'];
	$product_quantity = $_POST['product_quantity'];
	
	$quantity = 0;
	$new_quantity = 0;
	$total_item = 0;
	
	$stmt_select_product = $mysqli -> prepare("SELECT product_name, product_quantity, product_rebate FROM product WHERE product_id = ?");
	$stmt_select_product -> bind_param('i', $product_id);
	$stmt_select_product -> execute();
	$stmt_select_product -> store_result();
	$stmt_select_product -> bind_result($product_name, $in_stock_quantity, $product_rebate);
	$stmt_select_product -> fetch();
	
	if($stmt_select_product -> num_rows > 0){
		
		$new_quantity = $in_stock_quantity - $quantity;
		
		if($product_quantity <= $new_quantity){
			$new_quantity = $in_stock_quantity - $quantity;
			$p_code = 'code_' . $product_id;
			$itemArray = array($p_code => array('product_id' => $product_id, 'product_quantity' => $product_quantity, 'product_price' => $product_price, 'product_rebate' => $product_rebate));
			
			if(!empty($_SESSION['wishlist_item'])){
				if(array_key_exists($p_code, $_SESSION['wishlist_item'])){
					foreach($_SESSION['wishlist_item'] as $k => $v){
						if($p_code == $k){
							if($total_quantity <= $new_quantity){
								$output[0] = true;
								$output[1] = $LANG_ADD_TO_WISHLIST_SUCCESSFUL;
							}else{
								$output[0] = false;
								$output[1] = $LANG_ADD_TO_WISHLIST_FAILED;
							}
						}
					}
				}else{
					$_SESSION['wishlist_item'] = array_merge($_SESSION['wishlist_item'], $itemArray);
					$output[0] = true;
					$output[1] = $LANG_ADD_TO_WISHLIST_SUCCESSFUL;
				}
			}else{
				$_SESSION['wishlist_item'] = $itemArray;
				$output[0] = true;
				$output[1] = $LANG_ADD_TO_WISHLIST_SUCCESSFUL;
			}
		}else{
			$output[0] = false;
			$output[1] = $LANG_LOW_STOCK;
		}
	}else{
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
	
echo json_encode($output);
?>

