<?php
$act = filter_input(INPUT_POST,"act");
$category = filter_input(INPUT_POST,"category");
$sub_category_name = filter_input(INPUT_POST,"sub_category_name");
$product_sc_name_cn = filter_input(INPUT_POST,"sub_category_name_cn");
$display = filter_input(INPUT_POST,"display");
$product_sub_category_id = filter_input(INPUT_POST, "product_sub_category_id");

if($act == 1){ //insert
	$stmt_insert_sub_category = $mysqli->prepare("INSERT INTO product_sub_category (product_sc_name,product_sc_product_category_id, product_sc_is_display,product_sc_name_cn) VALUES (?,?,?,?)");
	$stmt_insert_sub_category->bind_param('siis',$sub_category_name, $category, $display,$product_sc_name_cn);
	if($stmt_insert_sub_category->execute()){
		$last_inserted_id = $stmt_insert_sub_category->insert_id;
		$stmt_insert_sub_category_audit = $mysqli->prepare("INSERT INTO product_sub_category_audit (product_sca_product_sub_category_id, 
														product_sca_type, product_sca_product_sub_category_name, product_sca_product_sc_product_category_id, 
														product_sca_product_sc_is_display,product_sca_product_sub_category_name_cn,product_sca_admin_id) VALUES (?,1,?,?,?,?,?)");
		$stmt_insert_sub_category_audit->bind_param('isiisi',$last_inserted_id, $sub_category_name, $category, $display,$product_sc_name_cn,$admin->getAdmin_id());
		$stmt_insert_sub_category_audit->execute();
		$output[0] = true;
		$output[1] = $LANG_SAVE_SUCCESSFUL;
	}else {
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
}
else if($act == 2){ //edit
	$stmt_select_sub_category_info = $mysqli->prepare("SELECT product_sc_id, product_sc_name,product_sc_product_category_id, product_sc_is_display,product_sc_name_cn FROM product_sub_category WHERE product_sc_id = ?");
	$stmt_select_sub_category_info->bind_param('i', $product_sub_category_id);
	$stmt_select_sub_category_info->execute();
	$stmt_select_sub_category_info->store_result();
    $stmt_select_sub_category_info->bind_result($product_sc_id,$product_sc_name,$product_sc_product_category_id, $product_sc_is_display, $old_product_sc_name_cn);
	$stmt_select_sub_category_info->fetch();
	
	$stmt_edit_category = $mysqli->prepare("UPDATE product_sub_category SET product_sc_name= ?, product_sc_product_category_id=?, product_sc_is_display=?,product_sc_name_cn=? WHERE product_sc_id = ?");
	$stmt_edit_category->bind_param('siisi',$sub_category_name, $category, $display,$product_sc_name_cn ,$product_sub_category_id);
	if($stmt_edit_category->execute()){
		$stmt_insert_sub_category_audit = $mysqli->prepare("INSERT INTO product_sub_category_audit (product_sca_product_sub_category_id, 
														product_sca_type, product_sca_product_sub_category_name, product_sca_product_sc_product_category_id, 
														product_sca_product_sc_is_display,product_sca_product_sub_category_name_cn,product_sca_admin_id) VALUES (?,2,?,?,?,?,?)");
		$stmt_insert_sub_category_audit->bind_param('isiisi',$product_sc_id, $product_sc_name, $product_sc_product_category_id, $product_sc_is_display,$old_product_sc_name_cn,$admin->getAdmin_id());
		$stmt_insert_sub_category_audit->execute();
		$output[0] = true;
		$output[1] = $LANG_SUCCESSFULLY_UPDATED;
	}else {
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
}
else if($act == 3){ //delete
	$check = true;
	$stmt_select_sub_category_info = $mysqli->prepare("SELECT product_sc_id, product_sc_name,product_sc_product_category_id, product_sc_is_display,product_sc_name_cn FROM product_sub_category WHERE product_sc_id = ?");
	$stmt_select_sub_category_info->bind_param('i', $product_sub_category_id);
	$stmt_select_sub_category_info->execute();
	$stmt_select_sub_category_info->store_result();
    $stmt_select_sub_category_info->bind_result($product_sc_id,$product_sc_name,$product_sc_product_category_id, $product_sc_is_display,$product_sc_name_cn);
	$stmt_select_sub_category_info->fetch();
	
	
	// $stmt_select_product_type = $mysqli->prepare("SELECT * FROM product_type WHERE product_type_product_sub_category_id=?");
	// $stmt_select_product_type ->bind_param('i',$product_sub_category_id);
	// $stmt_select_product_type ->execute();
	// $stmt_select_product_type ->store_result();
	// $stmt_select_product_type ->bind_result();
	// $stmt_select_product_type ->fetch();
	// if($stmt_select_product_type ->num_rows>0){
		// $check = false;
	// }
	
	
	$stmt_select_product = $mysqli->prepare("SELECT * FROM product WHERE product_sub_category_id=?");
	$stmt_select_product ->bind_param('i',$product_sub_category_id);
	$stmt_select_product ->execute();
	$stmt_select_product ->store_result();
	$stmt_select_product ->bind_result();
	$stmt_select_product ->fetch();
	if($stmt_select_product ->num_rows>0){
		$check = false;
	}
	
	if($check){
		$stmt_delete_sub_category = $mysqli->prepare("DELETE from product_sub_category WHERE product_sc_id = ?");
		$stmt_delete_sub_category->bind_param('i',$product_sub_category_id);
		if($stmt_delete_sub_category->execute()){
			$stmt_insert_sub_category_audit = $mysqli->prepare("INSERT INTO product_sub_category_audit (product_sca_product_sub_category_id, 
															product_sca_type, product_sca_product_sub_category_name, product_sca_product_sc_product_category_id, 
															product_sca_product_sc_is_display,product_sca_product_sub_category_name_cn,product_sca_admin_id) VALUES (?,3,?,?,?,?,?)");
			$stmt_insert_sub_category_audit->bind_param('isiisi',$product_sc_id, $product_sc_name, $product_sc_product_category_id, $product_sc_is_display,$product_sc_name_cn,$admin->getAdmin_id());
			$stmt_insert_sub_category_audit->execute();
			$output[0] = true;
			$output[1] = $LANG_SUCCESSFULLY_DELETED;
		}else {
			$output[0] = false;
			$output[1] = $LANG_ERROR_ALERT;
		}
	}else{
		$output[0] = false;
		$output[1] = $LANG_PRODUCT_LINKING_ERROR;
	}
}
else if($act == "4"){
	$stmt_get_sub_category_info = $mysqli->prepare("SELECT product_sc_id, product_sc_name,product_sc_product_category_id, product_sc_is_display,product_sc_name_cn FROM product_sub_category WHERE product_sc_id = ?");
	$stmt_get_sub_category_info->bind_param('i', $product_sub_category_id);
	$stmt_get_sub_category_info->execute();
	$stmt_get_sub_category_info->store_result();
    $stmt_get_sub_category_info->bind_result($product_sc_id,$product_sc_name,$product_sc_product_category_id, $product_sc_is_display, $product_sc_name_cn);
    if ($stmt_get_sub_category_info->num_rows>0) {
		$stmt_get_sub_category_info ->fetch();
        $output[0] = true;
        $output[1] = $product_sc_product_category_id;
		$output[2] = $product_sc_name;
		$output[3] = $product_sc_is_display;
		$output[4] = $product_sc_id;
		$output[5] = $product_sc_name_cn;

    } else {
        $output[0] = false;
        $output[1] = $LANG_ERROR_ALERT;
    }
}
echo urldecode(json_encode($output));



?>