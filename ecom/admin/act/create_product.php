<?php
$act = filter_input(INPUT_POST,"act");
$product_name = filter_input(INPUT_POST,"product_name");
$product_code = filter_input(INPUT_POST,"product_code");
$product_price = filter_input(INPUT_POST,"product_price");
$product_rebate = filter_input(INPUT_POST,"product_rebate");
$product_quantity = filter_input(INPUT_POST,"product_quantity");
$product_description = filter_input(INPUT_POST,"product_description");
$product_image = filter_input(INPUT_POST,"product_image");
$product_vendor = filter_input(INPUT_POST,"product_vendor");
$product_delivery_detail = filter_input(INPUT_POST,"product_delivery_detail");
$product_id = filter_input(INPUT_POST,"product_id");
$product_display = filter_input(INPUT_POST,"product_display");

if($act ==1){
	$stmt_insert_product = $mysqli->prepare("INSERT INTO product (product_name, product_code,product_price,product_rebate,product_description,product_vendor,product_delivery_detail,product_quantity,product_image) VALUES (?,?,?,?,?,?,?,?,?)");
	$stmt_insert_product->bind_param('sssssssss',$product_name, $product_code, $product_price,$product_rebate,$product_description,$product_vendor,$product_delivery_detail,$product_quantity,$product_image);
	if($stmt_insert_product->execute()){
		$last_inserted_id = $stmt_insert_product->insert_id;
		$stmt_insert_product_audit = $mysqli->prepare("INSERT INTO product_audit (product_audit_product_id, product_audit_name, product_audit_code, 
							product_audit_price,product_audit_rebate, product_audit_description, product_audit_vendor, product_audit_delivery_detail,product_audit_image,product_audit_quantity,product_audit_act) VALUES (?,?,?,?,?,?,?,?,?,?,1)");
		$stmt_insert_product_audit->bind_param('ssssssssss',$last_inserted_id, $product_name, $product_code, $product_price, $product_rebate,$product_description, $product_vendor,$product_delivery_detail,$product_image,$product_quantity);
		$stmt_insert_product_audit->execute();
		
		$output[0] = true;
		$output[1] = $LANG_SAVE_SUCCESSFUL;
	}else{
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
}
else if($act == 2){
	$stmt_select_product_info = $mysqli->prepare("SELECT product_name, product_code,product_price,product_rebate,product_description,product_vendor,product_delivery_detail,product_quantity,product_image FROM product WHERE product_id=?");
	$stmt_select_product_info->bind_param('i', $product_id);
	$stmt_select_product_info->execute();
	$stmt_select_product_info->store_result();
    $stmt_select_product_info->bind_result($old_product_name, $old_product_code,$old_product_price,$old_product_rebate,$old_product_description,$old_product_vendor,$old_product_delivery_detail,$old_product_quantity,$old_product_image);
    $stmt_select_product_info->fetch();
	
	$stmt_edit_product = $mysqli->prepare("UPDATE product SET product_name=?, product_code=?,product_price=?,product_rebate=?,product_description=?, product_vendor=?, product_delivery_detail=?,product_quantity=? WHERE product_id = ?");
	$stmt_edit_product ->bind_param('sssssssss',$product_name, $product_code, $product_price, $product_rebate, $product_description,$product_vendor,$product_delivery_detail,$product_quantity, $product_id);
	if($stmt_edit_product ->execute()){
		if($product_image!=""){
			$stmt_update_image = $mysqli->prepare("UPDATE product SET product_image=? WHERE product_id=?");
			$stmt_update_image ->bind_param('si',$product_image,$product_id);
			$stmt_update_image ->execute();
			
			$old_product_sub_image = explode(",", $old_product_image);
			for($i = 0; $i < count($old_product_sub_image); $i++){
				unlink($old_product_sub_image[$i]);
			}
		}
		
		$stmt_insert_product_audit = $mysqli->prepare("INSERT INTO product_audit (product_audit_product_id, product_audit_name, product_audit_code, 
							product_audit_price,product_audit_rebate, product_audit_description, product_audit_vendor, product_audit_delivery_detail,product_audit_image,product_audit_quantity,product_audit_act) VALUES (?,?,?,?,?,?,?,?,?,?,2)");
		$stmt_insert_product_audit->bind_param('ssssssssss',$product_id, $old_product_name, $old_product_code, $old_product_price, $old_product_rebate,$old_product_description, $old_product_vendor,$old_product_delivery_detail,$old_product_image,$old_product_quantity);
		$stmt_insert_product_audit->execute();
		
		$output[0] = true;
		$output[1] = $LANG_SAVE_SUCCESSFUL;
	}else{
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
	
}
else if($act == 3){
	$stmt_select_product_info = $mysqli->prepare("SELECT product_name, product_code,product_price,product_rebate,product_description,product_vendor,product_delivery_detail,product_quantity,product_image FROM product WHERE product_id=?");
	$stmt_select_product_info->bind_param('i', $product_id);
	$stmt_select_product_info->execute();
	$stmt_select_product_info->store_result();
    $stmt_select_product_info->bind_result($old_product_name, $old_product_code,$old_product_price,$old_product_rebate,$old_product_description,$old_product_vendor,$old_product_delivery_detail,$old_product_quantity,$old_product_image);
    $stmt_select_product_info->fetch();
	
	$old_product_sub_image = explode(",", $old_product_image);
	
	$stmt_delete_product = $mysqli->prepare("DELETE from product WHERE product_id = ?");
	$stmt_delete_product->bind_param('i',$product_id);	
	if($stmt_delete_product->execute()){
		
		for($i = 0; $i < count($old_product_sub_image); $i++){
			unlink($old_product_sub_image[$i]);
		}
		
		$stmt_insert_product_audit = $mysqli->prepare("INSERT INTO product_audit (product_audit_product_id, product_audit_name, product_audit_code, 
							product_audit_price,product_audit_rebate, product_audit_description, product_audit_vendor, product_audit_delivery_detail,product_audit_image,product_audit_quantity,product_audit_act) VALUES (?,?,?,?,?,?,?,?,?,?,3)");
		$stmt_insert_product_audit->bind_param('ssssssssss',$product_id, $old_product_name, $old_product_code, $old_product_price, $old_product_rebate,$old_product_description, $old_product_vendor,$old_product_delivery_detail,$old_product_image,$old_product_quantity);
		$stmt_insert_product_audit->execute();

		$output[0] = true;
		$output[1] = $LANG_SUCCESSFULLY_DELETED;
		
	}else {
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
}
else if($act == 4){
	$stmt_select_product = $mysqli->prepare("SELECT product_id,product_name, product_code,product_price,product_rebate,product_description,product_vendor,product_delivery_detail,product_quantity,product_image FROM product WHERE product_id=?");
	$stmt_select_product ->bind_param('i',$product_id);
	$stmt_select_product ->execute();
	$stmt_select_product ->store_result();
	$stmt_select_product ->bind_result($product_id,$product_name, $product_code,$product_price,$product_rebate,$product_description,$product_vendor,$product_delivery_detail,$product_quantity,$product_image);
	$stmt_select_product ->fetch();
	if($stmt_select_product ->num_rows >0){
		
		$output[0] = true;
		$output[1] = $product_id;
		$output[2] = $product_name;
		$output[3] = $product_code;
		$output[4] = $product_price;
		$output[5] = $product_rebate;
		$output[6] = $product_description;
		$output[7] = $product_vendor;
		$output[8] = $product_delivery_detail;
		$output[9] = $product_quantity;
		$product_sub_image = explode(",", $product_image);
		$output[10] = count($product_sub_image);
		for($i = 0; $i < count($product_sub_image); $i++){
			$output[$i+11] = $product_sub_image[$i];
		}
	}else{
		$output[0] = false;
		$output[1] = $LANG_NO_PRODUCT_FOUND;
	}
}else if($act == 5){
	$stmt_select_product_info = $mysqli->prepare("SELECT product_name, product_code,product_price,product_rebate,product_description,product_vendor,product_delivery_detail,product_quantity,product_image,product_display FROM product WHERE product_id=?");
	$stmt_select_product_info->bind_param('i', $product_id);
	$stmt_select_product_info->execute();
	$stmt_select_product_info->store_result();
    $stmt_select_product_info->bind_result($old_product_name, $old_product_code,$old_product_price,$old_product_rebate,$old_product_description,$old_product_vendor,$old_product_delivery_detail,$old_product_quantity,$old_product_image,$old_product_display);
    $stmt_select_product_info->fetch();
	
	if ($product_display == 1) {
        $stmt_update_product_display = $mysqli->prepare("UPDATE product SET product_display = 0 WHERE product_id=?");
        $stmt_update_product_display->bind_param("i", $product_id);
        if ($stmt_update_product_display->execute()) {
			$stmt_insert_product_audit = $mysqli->prepare("INSERT INTO product_audit (product_audit_product_id, product_audit_name, product_audit_code, 
							product_audit_price,product_audit_rebate, product_audit_description, product_audit_vendor, product_audit_delivery_detail,product_audit_image,product_audit_quantity,product_audit_act,product_audit_display) VALUES (?,?,?,?,?,?,?,?,?,?,4,?)");
			$stmt_insert_product_audit->bind_param('ssssssssssi',$product_id, $old_product_name, $old_product_code, $old_product_price, $old_product_rebate,$old_product_description, $old_product_vendor,$old_product_delivery_detail,$old_product_image,$old_product_quantity,$old_product_display);
			$stmt_insert_product_audit->execute();

            $output[0] = true;
            $output[1] = $LANG_SAVE_SUCCESSFUL;
        } else {
            $output[0] = false;
            $output[1] = $LANG_ERROR_ALERT;
        }
    } else {
        $stmt_update_product_display = $mysqli->prepare("UPDATE product SET product_display = 1 WHERE product_id=?");
        $stmt_update_product_display->bind_param("i", $product_id);
        if ($stmt_update_product_display->execute()) {
            $stmt_insert_product_audit = $mysqli->prepare("INSERT INTO product_audit (product_audit_product_id, product_audit_name, product_audit_code, 
							product_audit_price,product_audit_rebate, product_audit_description, product_audit_vendor, product_audit_delivery_detail,product_audit_image,product_audit_quantity,product_audit_act,product_audit_display) VALUES (?,?,?,?,?,?,?,?,?,?,5,?)");
			$stmt_insert_product_audit->bind_param('ssssssssssi',$product_id, $old_product_name, $old_product_code, $old_product_price, $old_product_rebate,$old_product_description, $old_product_vendor,$old_product_delivery_detail,$old_product_image,$old_product_quantity,$old_product_display);
			$stmt_insert_product_audit->execute();

            $output[0] = true;
            $output[1] = $LANG_SAVE_SUCCESSFUL;
        } else {
            $output[0] = false;
            $output[1] = $LANG_ERROR_ALERT;
        }
    }
}

echo json_encode($output);
?>