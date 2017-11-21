<?php 
$product_id = $_POST['product_id'];
$quantity =  $_POST['quantity'];
$act = $_POST['act'];

if($act == 1){
	//$_SESSION['product_quantity'] = $quantity;
	if(isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0){
		foreach($_SESSION['cart_item'] as $cart_item => $value){
			if($product_id == $_SESSION['cart_item'][$cart_item]['product_id']){
				$_SESSION['cart_item'][$cart_item]['product_quantity'] = $quantity;

			}
		}
	}
}else{
	if(isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0){
		foreach($_SESSION['cart_item'] as $cart_item => $value){
			if($product_id == $_SESSION['cart_item'][$cart_item]['product_id']){
				$_SESSION['cart_item'][$cart_item]['product_quantity'] = $quantity;
			}
		}
	}
}

echo json_encode($output);
?>