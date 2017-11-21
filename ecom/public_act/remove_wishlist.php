<?php 
$product_id = $_POST['id'];

$stmt_select_product = $mysqli -> prepare("SELECT product_name FROM product WHERE product_id = ?");
$stmt_select_product -> bind_param('i', $product_id);
$stmt_select_product -> execute();
$stmt_select_product -> store_result();
if($stmt_select_product -> num_rows > 0){
	if(!empty($_SESSION['wishlist_item'])){
		foreach($_SESSION['wishlist_item'] as $k => $v){
			if($_SESSION['wishlist_item'][$k]['product_id'] == $product_id){
				unset($_SESSION['wishlist_item'][$k]);
			}
		}
	}
	$output[0] = true;
	
}else{
	$output = false;
	$output = $LANG_ERROR_ALERT;
}

echo json_encode($output);
?>