<?php
$act = filter_input(INPUT_POST,"act");
$category_name = filter_input(INPUT_POST,"category_name");
$category_name_cn = filter_input(INPUT_POST,"category_name_cn");
$display = filter_input(INPUT_POST,"display");
$product_category_id = filter_input(INPUT_POST, "product_category_id");
$category_description = filter_input(INPUT_POST,"category_description");
$category_description_cn = filter_input(INPUT_POST,"category_description_cn");

if($act == 1){ //insert
	$stmt_insert_category = $mysqli->prepare("INSERT INTO product_category (product_category_name, product_category_is_display, product_category_description, product_category_name_cn, product_category_description_cn) VALUES (?,?,?,?,?)");
	$stmt_insert_category->bind_param('sisss',$category_name, $display, $category_description, $category_name_cn, $category_description_cn );
	if($stmt_insert_category->execute()){
		$last_inserted_id = $stmt_insert_category->insert_id;
		$stmt_insert_category_audit = $mysqli->prepare("INSERT INTO product_category_audit (product_ca_product_category_id, 
														product_ca_type, product_ca_product_category_name, product_ca_product_category_is_display,
														product_ca_product_category_description, product_ca_product_category_name_cn, product_ca_product_category_description_cn) VALUES (?,1,?,?,?,?,?)");
		$stmt_insert_category_audit->bind_param('isisss',$last_inserted_id, $category_name, $display, $category_description, $category_name_cn, $category_description_cn);
		$stmt_insert_category_audit->execute();
		$output[0] = true;
		$output[1] = $LANG_SAVE_SUCCESSFUL;
	}else {
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
}
else if($act == 2){ //edit
	$stmt_select_category_info = $mysqli->prepare("SELECT product_category_name, product_category_id, product_category_is_display,product_category_description, product_category_name_cn, product_category_description_cn FROM product_category WHERE product_category_id = ?");
	$stmt_select_category_info->bind_param('i', $product_category_id);
	$stmt_select_category_info->execute();
	$stmt_select_category_info->store_result();
    $stmt_select_category_info->bind_result($product_category_name, $product_category_id, $product_category_is_display, $product_category_description, $product_category_name_cn ,$product_category_description_cn);
	$stmt_select_category_info->fetch();
	
	$stmt_edit_category = $mysqli->prepare("UPDATE product_category SET product_category_name= ?, product_category_is_display=?,product_category_description=?, product_category_name_cn=?, product_category_description_cn=? WHERE product_category_id = ?");
	$stmt_edit_category->bind_param('sisssi',$category_name, $display,$category_description, $category_name_cn, $category_description_cn, $product_category_id);
	if($stmt_edit_category->execute()){
		$stmt_insert_category_audit = $mysqli->prepare("INSERT INTO product_category_audit (product_ca_product_category_id, 
														product_ca_type, product_ca_product_category_name, product_ca_product_category_is_display,
														product_ca_product_category_description, product_ca_product_category_name_cn, product_ca_product_category_description_cn) VALUES (?,2,?,?,?,?,?)");
		$stmt_insert_category_audit->bind_param('isisss',$product_category_id, $product_category_name,$product_category_is_display,$product_category_description, $product_category_name_cn, $product_category_description_cn );
		$stmt_insert_category_audit->execute();
		$output[0] = true;
		$output[1] = $LANG_SUCCESSFULLY_UPDATED;
	}else {
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
}

else if($act == 3){ //delete
	$stmt_select_category_info = $mysqli->prepare("SELECT product_category_name, product_category_id, product_category_is_display, product_category_description, product_category_name_cn, product_category_description_cn FROM product_category WHERE product_category_id = ?");
	$stmt_select_category_info->bind_param('i', $product_category_id);
	$stmt_select_category_info->execute();
	$stmt_select_category_info->store_result();
    $stmt_select_category_info->bind_result($product_category_name, $product_category_id, $product_category_is_display, $product_category_description, $product_category_name_cn ,$product_category_description_cn);
	$stmt_select_category_info->fetch();
	
	$check = true;

	$stmt_check_sub_category = $mysqli->prepare("SELECT * FROM product_sub_category WHERE product_sc_product_category_id=?");
	$stmt_check_sub_category ->bind_param('i',$product_category_id);
	$stmt_check_sub_category ->execute();
	$stmt_check_sub_category ->store_result();
	$stmt_check_sub_category ->bind_result();
	$stmt_check_sub_category ->fetch();
	if($stmt_check_sub_category ->num_rows>0){
		$check = false;
	}
	
	if($check){
		$stmt_delete_category = $mysqli->prepare("DELETE from product_category WHERE product_category_id = ?");
		$stmt_delete_category->bind_param('i',$product_category_id);
		if($stmt_delete_category->execute()){
			$stmt_insert_category_audit = $mysqli->prepare("INSERT INTO product_category_audit (product_ca_product_category_id, 
															product_ca_type, product_ca_product_category_name, product_ca_product_category_is_display,product_ca_product_category_description, product_ca_product_category_name_cn, product_ca_product_category_description_cn) VALUES (?,3,?,?,?,?,?)");
			$stmt_insert_category_audit->bind_param('isisss',$product_category_id, $product_category_name,$product_category_is_display,$product_category_description, $product_category_name_cn ,$product_category_description_cn);
			$stmt_insert_category_audit->execute();
			$output[0] = true;
			$output[1] = $LANG_SUCCESSFULLY_DELETED;
		}else {
			$output[0] = false;
			$output[1] = $LANG_ERROR_ALERT;
		}
	}else{ 
		$output[0] = false;
		$output[1] = $LANG_SUB_CATEGORY_LINKING_ERROR;
	}
}

else if($act == 4){
	$stmt_select_category_info = $mysqli->prepare("SELECT product_category_name, product_category_id, product_category_is_display,product_category_description, product_category_name_cn, product_category_description_cn FROM product_category WHERE product_category_id = ?");
	$stmt_select_category_info->bind_param('i', $product_category_id);
	$stmt_select_category_info->execute();
	$stmt_select_category_info->store_result();
    $stmt_select_category_info->bind_result($product_category_name, $product_category_id, $product_category_is_display,$product_category_description, $product_category_name_cn, $product_category_description_cn);
    if ($stmt_select_category_info->num_rows>0) {
		$stmt_select_category_info->fetch();
        $output[0] = true;
        $output[1] = $product_category_name;
		$output[2] = $product_category_name_cn;
		$output[3] = $product_category_is_display;
		$output[4] = $product_category_id;
		$output[5] = $product_category_description;
		$output[6] = $product_category_description_cn;
    } else {
        $output[0] = false;
        $output[1] = $LANG_ERROR_ALERT;
    }
}

echo urldecode(json_encode($output));



?>