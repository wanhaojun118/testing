<?php
$act = filter_input(INPUT_POST,"act");
$product_name = filter_input(INPUT_POST,"product_name");
$product_category_id = filter_input(INPUT_POST,"product_category_id");
$product_sub_category_id = filter_input(INPUT_POST,"product_sub_category_id");
$product_price = filter_input(INPUT_POST,"product_price");
$product_quantity = filter_input(INPUT_POST,"product_quantity");
$product_description = filter_input(INPUT_POST,"product_description",FILTER_SANITIZE_SPECIAL_CHARS);
$product_description_cn = filter_input(INPUT_POST,"product_description_cn",FILTER_SANITIZE_SPECIAL_CHARS);
$product_image = filter_input(INPUT_POST,"product_image");
$product_id = filter_input(INPUT_POST, "product_id");
$product_name_cn = filter_input(INPUT_POST, "product_name_cn");
$west_msia_shipping_fee = filter_input(INPUT_POST, "west_msia_shipping_fee");
$east_msia_shipping_fee = filter_input(INPUT_POST, "east_msia_shipping_fee");
$china_shipping_fee = filter_input(INPUT_POST, "china_shipping_fee");
$product_pay_method = filter_input(INPUT_POST, "product_pay_method");

$product_image_change = filter_input(INPUT_POST, "product_image_change");
$second_product_image_change = filter_input(INPUT_POST, "second_product_image_change");
$third_product_image_change = filter_input(INPUT_POST, "third_product_image_change");

if($west_msia_shipping_fee == ""){
	$west_msia_shipping_fee = 0;
}

if($east_msia_shipping_fee == ""){
	$east_msia_shipping_fee = 0;
}

if($china_shipping_fee == ""){
	$china_shipping_fee = 0;
}

if($act == 1){ //insert
	$product_shipping_fee = $west_msia_shipping_fee.",".$east_msia_shipping_fee.",".$china_shipping_fee;
	
	$stmt_insert_product = $mysqli->prepare("INSERT INTO product (product_name, product_category_id,product_price,product_quantity,product_description,product_sub_category_id,product_description_cn,product_name_cn,product_image,product_shipping_fee,product_pay_method) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
	$stmt_insert_product->bind_param('sidisissssi',$product_name, $product_category_id, $product_price,$product_quantity,$product_description,$product_sub_category_id,$product_description_cn,$product_name_cn,$product_image,$product_shipping_fee,$product_pay_method);
	if($stmt_insert_product->execute()){
		$last_inserted_id = $stmt_insert_product->insert_id;
	
		$stmt_insert_product_audit = $mysqli->prepare("INSERT INTO product_audit (product_audit_product_id, product_audit_product_name, product_audit_product_category_id, 
							product_audit_product_price,product_audit_product_quantity, product_audit_product_description, product_audit_product_sub_category_id,product_audit_product_description_cn,product_audit_product_name_cn,product_audit_product_image,product_audit_product_shipping_fee,product_audit_product_is_display,product_audit_product_pay_method,product_audit_type) VALUES (?,?,?,?,?,?,?,?,?,?,?,1,?,1)");
		$stmt_insert_product_audit->bind_param('isidisissssi',$last_inserted_id, $product_name, $product_category_id, $product_price, $product_quantity,$product_description, $product_sub_category_id,$product_description_cn,$product_name_cn,$product_image,$product_shipping_fee,$product_pay_method);
		$stmt_insert_product_audit->execute();

		$output[0] = true;
		$output[1] = $LANG_SAVE_SUCCESSFUL;
		
	}else {
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
	echo urldecode(json_encode($output));
}

else if($act == 2){ //edit
	$stmt_select_product_info = $mysqli->prepare("SELECT product_id, product_name, product_category_id, product_price,product_quantity,product_description, product_sub_category_id,product_description_cn,product_name_cn,product_shipping_fee,product_is_display,product_pay_method,product_image FROM product WHERE product_id = ?");
	$stmt_select_product_info->bind_param('i', $product_id);
	$stmt_select_product_info->execute();
	$stmt_select_product_info->store_result();
    $stmt_select_product_info->bind_result($product_id, $name, $category_id, $price, $quantity,$description,$sub_category,$description_cn,$old_product_name_cn,$old_product_shipping_fee,$product_is_display,$old_product_pay_method,$old_product_image);
    $stmt_select_product_info->fetch();
	
	$product_shipping_fee = $west_msia_shipping_fee.",".$east_msia_shipping_fee.",".$china_shipping_fee;
	
	if($stmt_select_product_info->num_rows>0){
		// $stmt_select_product_image = $mysqli->prepare("SELECT product_image_id, product_image_name FROM product_image WHERE product_image_product_id=?");
		// $stmt_select_product_image->bind_param('i', $product_id);
		// $stmt_select_product_image->execute();
		// $stmt_select_product_image->store_result();
		// $stmt_select_product_image->bind_result($stored_product_image_id, $stored_product_image_name);
		// $stmt_select_product_image->fetch();
		$stored_product_image_list = explode(",",$old_product_image);

		if ($product_image) { //if new image uploaded then update
			$images_uploaded = 1;
			$product_image_list=explode(",",$product_image);
			foreach($product_image_list as $value){
				if($images_uploaded == 1){
					$first_uploaded_image = $value;
				}
				if($images_uploaded == 2){
					$second_uploaded_image = $value;
				}
				if($images_uploaded == 3){
					$third_uploaded_image = $value;
				}
				$images_uploaded++;
			}
		}
		$no_image == 0;
		if ($product_image_change == ""){ //if any changes in image
			$no_image++;
			if($first_uploaded_image!=""){ //replace old image
				unlink($stored_product_image_list[0]);
				$stored_product_image_list[0] = $first_uploaded_image;
			}else{//if old image is deleted
				if($stored_product_image_list[0]){
					unlink($stored_product_image_list[0]);
					unset($stored_product_image_list[0]);
				}
			}
		}
		
		if ($second_product_image_change == ""){
			if($no_image == 0){
				$image_path = $first_uploaded_image;
			}else if($no_image == 1){
				$image_path = $second_uploaded_image;
			}
			$no_image++;
			if($image_path!=""){//replace old image
				unlink($stored_product_image_list[1]);
				$stored_product_image_list[1] = $image_path;
			}else{//if old image is deleted
				if($stored_product_image_list[1]){
					unlink($stored_product_image_list[1]);
					unset($stored_product_image_list[1]);
				}
			}
		}
		
		if ($third_product_image_change == ""){
			if($no_image == 0){
				$image_path = $first_uploaded_image;
			}else if($no_image == 1){
				$image_path = $second_uploaded_image;
			}else if($no_image == 2){
				$image_path = $third_uploaded_image;
			}
			if($image_path!=""){ //replace old image
				unlink($stored_product_image_list[2]);
				$stored_product_image_list[2] = $image_path;
			}else{ //if old image is deleted
				if($stored_product_image_list[2]){
					unlink($stored_product_image_list[2]);
				}
			}
		}
		
		$stored_product_image_list = array_values($stored_product_image_list); //rearrange the index of array
		$stored_product_image_list = implode(",",$stored_product_image_list); //convert array into string
		
		// $stmt_update_product_image = $mysqli->prepare("UPDATE product_image SET product_image_name=? WHERE product_image_id=?");
		// $stmt_update_product_image->bind_param('si',$stored_product_image_list, $stored_product_image_id);
		// if($stmt_update_product_image->execute()){
			// $stmt_insert_product_image_audit = $mysqli->prepare("INSERT INTO product_image_audit (product_ia_product_image_id, product_ia_product_id, product_ia_product_image_name, product_ia_type) VALUES (?,?,?,2)");
			// $stmt_insert_product_image_audit->bind_param('iis', $stored_product_image_id, $product_id,$stored_product_image_name);
			// $stmt_insert_product_image_audit->execute();
		// }     

		$stmt_edit_product = $mysqli->prepare("UPDATE product SET product_name=?, product_category_id=?,product_price=?,product_quantity=?,product_description=?, product_sub_category_id=?,product_description_cn=?,product_name_cn=?,product_shipping_fee=?,product_pay_method=?,product_image=? WHERE product_id = ?");
		$stmt_edit_product->bind_param('sidisisssisi',$product_name, $product_category_id, $product_price, $product_quantity, $product_description,$product_sub_category_id,$product_description_cn,$product_name_cn,$product_shipping_fee,$product_pay_method ,$stored_product_image_list,$product_id);	
		if($stmt_edit_product->execute()){
			$stmt_insert_product_audit = $mysqli->prepare("INSERT INTO product_audit (product_audit_product_id, product_audit_product_name, product_audit_product_category_id, 
															 product_audit_product_price,product_audit_product_quantity, product_audit_product_description,product_audit_type ,product_audit_product_sub_category_id,product_audit_product_description_cn,product_audit_product_name_cn,product_audit_product_image,product_audit_product_shipping_fee,product_audit_product_is_display,product_audit_product_pay_method) VALUES (?,?,?,?,?,?,2,?,?,?,?,?,?,?)");
			$stmt_insert_product_audit->bind_param('isidisissssii',$product_id, $name, $category_id, $price, $quantity,$description, $sub_category, $description_cn,$old_product_name_cn,$old_product_image,$old_product_shipping_fee,$product_is_display,$old_product_pay_method);
			$stmt_insert_product_audit->execute();
			$output[0] = true;
			$output[1] = $LANG_SAVE_SUCCESSFUL;
		}else {
			$output[0] = false;
			$output[1] = $LANG_ERROR_ALERT;
		}
	}else{
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
	echo urldecode(json_encode($output));
}

else if($act == 3){ //delete
	$stmt_select_product_info = $mysqli->prepare("SELECT product_id, product_name, product_category_id, product_price,product_quantity,product_description, product_sub_category_id,product_description_cn,product_name_cn,product_shipping_fee,product_is_display,product_pay_method,product_image FROM product WHERE product_id = ? ");
	$stmt_select_product_info->bind_param('i', $product_id);
	$stmt_select_product_info->execute();
	$stmt_select_product_info->store_result();
    $stmt_select_product_info->bind_result($product_id, $name, $category_id, $price, $quantity,$description,$sub_category,$description_cn,$old_product_name_cn,$old_product_shipping_fee,$product_is_display,$product_pay_method,$product_image);
    $stmt_select_product_info->fetch();	
	if($stmt_select_product_info->num_rows>0){
		
		$product_image_list = explode(",",$product_image);
		
		$stmt_delete_product = $mysqli->prepare("DELETE from product WHERE product_id = ?");
		$stmt_delete_product->bind_param('i',$product_id);	
		if($stmt_delete_product->execute()){

			$stmt_insert_product_audit = $mysqli->prepare("INSERT INTO product_audit (product_audit_product_id, product_audit_product_name, product_audit_product_category_id, 
															product_audit_product_price,product_audit_product_quantity, product_audit_product_description,product_audit_type ,product_audit_product_sub_category_id,product_audit_product_description_cn,product_audit_product_name_cn,product_audit_product_image,product_audit_product_shipping_fee,product_audit_product_is_display,product_audit_product_pay_method) VALUES (?,?,?,?,?,?,3,?,?,?,?,?,?,?)");
			$stmt_insert_product_audit->bind_param('isidisissssii',$product_id, $name, $category_id, $price, $quantity,$description, $sub_category,$description_cn, $old_product_name_cn,$product_image,$old_product_shipping_fee,$product_is_display,$product_pay_method);
			$stmt_insert_product_audit->execute();
			
			
			for($j=0; $j<count($product_image_list);$j++){	
				unlink($product_image_list[$j]);
			}

			$output[0] = true;
			$output[1] = $LANG_SUCCESSFULLY_DELETED;
			
		}else {
			$output[0] = false;
			$output[1] = $LANG_ERROR_ALERT;
		}
	}else{
		$output[0] = false;
		$output[1] = $LANG_ERROR_ALERT;
	}
	echo urldecode(json_encode($output));
}


else if($act == "4"){ //display 
	$stmt_select_product_info = $mysqli->prepare("SELECT product_id, product_name, product_category_id, product_price,product_quantity,product_description, product_sub_category_id,product_description_cn,product_name_cn,product_shipping_fee,product_pay_method,product_image FROM product WHERE product_id = ?");
	$stmt_select_product_info->bind_param('i', $product_id);
	$stmt_select_product_info->execute();
	$stmt_select_product_info->store_result();
    $stmt_select_product_info->bind_result($product_id, $product_name, $product_category_id, $product_price,$product_quantity,$product_description, $product_sub_category_id, $product_description_cn,$product_name_cn,$product_shipping_fee,$product_pay_method,$product_image);
    $stmt_select_product_info->fetch();
	if($stmt_select_product_info ->num_rows>0){
		
		// $stmt_select_product_image = $mysqli->prepare("SELECT product_image_id, product_image_name FROM product_image WHERE product_image_product_id = ?");
		// $stmt_select_product_image->bind_param('i', $product_id);
		// $stmt_select_product_image->execute();
		// $stmt_select_product_image->store_result();
		// $stmt_select_product_image->bind_result($product_image_id, $product_image_name);
		// $stmt_select_product_image->fetch();
		$product_image_list = explode(",",$product_image);
		$product_shipping_fee =explode(",",$product_shipping_fee);
		
		for($i=0; $i<count($product_image_list); $i++){
			if($i == 0){	
				$first_product_image = $product_image_list[$i];
			}
			if($i == 1){
				$second_product_image = $product_image_list[$i];
			}
			if($i == 2){
				$third_product_image = $product_image_list[$i];
			}
		}
		
		$output[0] = true;
		$output[1] = $product_id;
		$output[2] = $product_name;
		$output[3] = $product_category_id;
		$output[4] = $product_price;
		$output[5] = $product_quantity;
		$output[6] = html_entity_decode($product_description);
		$output[7] = $first_product_image;
		$output[8] = $second_product_image;
		$output[9] = $third_product_image;
		$output[10] = $product_sub_category_id;
		$output[11] = html_entity_decode($product_description_cn);
		$output[12] = $product_name_cn;
		$output[13] = $product_shipping_fee[0];
		$output[14] = $product_shipping_fee[1];
		$output[15] = $product_shipping_fee[2];
		$output[16] = $product_pay_method;
	}	
     else {
        $output[0] = false;
        $output[1] = $LANG_ERROR_ALERT;
    }
	echo urldecode(json_encode($output));
}

else if ($act == 5){ //image
	$stmt_select_product_info = $mysqli->prepare("SELECT product_id, product_name, product_category_id, product_price,product_quantity,product_description, product_sub_category_id,product_description_cn,product_name_cn,product_shipping_fee,product_pay_method,product_image FROM product WHERE product_id = ?");
	$stmt_select_product_info->bind_param('i', $product_id);
	$stmt_select_product_info->execute();
	$stmt_select_product_info->store_result();
    $stmt_select_product_info->bind_result($product_id, $product_name, $product_category_id, $product_price,$product_quantity,$product_description, $product_sub_category_id, $product_description_cn,$product_name_cn,$product_shipping_fee,$product_pay_method,$product_image);
	$stmt_select_product_info->fetch();
	if($stmt_select_product_info ->num_rows>0){
?>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_NAME; ?><span style='color:red;'>&nbsp;*</span></label>
		<div class="col-sm-9"  style="margin-bottom:15px;">
			<input class="form-control required" name="product_name" id="product_name" placeholder="" value="<?php echo $product_name;?>" readonly>
		</div>
	</div>	
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_NAME_CN; ?><span style='color:red;'>&nbsp;*</span></label>
		<div class="col-sm-9"  style="margin-bottom:15px;">
			<input class="form-control required" name="product_name_cn" id="product_name_cn" value="<?php echo $product_name_cn;?>" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"><?php echo $LANG_CATEGORY; ?><span style='color:red;'>&nbsp;*</span></label>
		<div class="col-sm-9"  style="margin-bottom:15px;">
			<input class="form-control required" value="<?php echo select_name($product_category_id,"product_category_id","product_category_name","product_category",$mysqli);?>" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"><?php echo $LANG_SUB_CATEGORY; ?><span style='color:red;'>&nbsp;*</span></label>
		<div class="col-sm-9"  style="margin-bottom:15px;">
			<input class="form-control required" value="<?php echo select_name($product_sub_category_id,"product_sc_id","product_sc_name","product_sub_category",$mysqli);?>" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_PRICE; ?><span style='color:red;'>&nbsp;*</span></label>
		<div class="col-sm-9"  style="margin-bottom:15px;">
			<?php
				echo $product_price;
				//echo " ?".$product_price." - ".convert_to_rm($product_price,$mysqli);
			?>
			<!--<input type="number" min="0" step="any" class="form-control required" name="product_price" id="product_price" value="<?php echo $product_price;?>" readonly>-->
		</div>
	</div>	
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"><?php echo $LANG_DESCRIPTION; ?><span style='color:red;'>&nbsp;*</span></label>
		<div class="col-sm-9"  style="margin-bottom:15px;">
			<?php echo html_entity_decode($product_description);?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"><?php echo $LANG_DESCRIPTION_CN; ?><span style='color:red;'>&nbsp;*</span></label>
		<div class="col-sm-9"  style="margin-bottom:15px;">
			<?php echo html_entity_decode($product_description_cn);?>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"><?php echo $LANG_SHIPPING_FEE; ?><span style='color:red;'>&nbsp;*</span></label>
		<div class="col-sm-9"  style="margin-bottom:15px;">
			<?php
				$product_shipping_fee = explode(",",$product_shipping_fee);
				echo $LANG_WEST_SHIPPING_FEE . " : RM " .$product_shipping_fee[0]."<br>";
				echo $LANG_EAST_SHIPPING_FEE . " : RM " .$product_shipping_fee[1]."<br>";
				echo $LANG_CHINA_SHIPPING_FEE . " : RM " .$product_shipping_fee[2]."<br>";
			?>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_PAY_METHOD; ?><span style='color:red;'>&nbsp;*</span></label>
		<div class="col-sm-9"  style="margin-bottom:15px;">
			<?php
				if($product_pay_method == 1){
					echo $LANG_50_E_WALLET;
				}else {
					echo $LANG_100_E_WALLET;
				}
			?>
		</div>
	</div>
<?php	
	

	// $stmt = $mysqli->prepare("SELECT product_image_name from product_image where product_image_product_id = ?");
	// $stmt->bind_param('i',$product_id);
	// $stmt->execute();
	// $stmt->store_result();
	// $stmt->bind_result($product_image_name);
	// $stmt->fetch(); 
	$product_image_list = explode(",",$product_image);	
	for($i=0; $i<count($product_image_list); $i++){
		$string .= "<img src = " . $product_image_list[$i] . " height='150' width='150' >&nbsp;&nbsp;";
	}
?>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"><?php echo $LANG_IMAGE; ?><span style='color:red;'>&nbsp;*</span></label>
		<div class="col-sm-9"  style="margin-bottom:15px;">
			<?php echo $string;?>
		</div>
	</div>
	
<?php
	}
}
else if ($act == "6"){//display value for sub category dropdown list
	$category_id = filter_input(INPUT_POST,"category");
	$sub_category_id = filter_input(INPUT_POST,"sub_category_id");
	$string .= '<option value="">'.$LANG_SELECT_SUB_CATEGORY.'</option>';
	$stmt_select_type = $mysqli->prepare("SELECT product_sc_id,product_sc_name FROM product_sub_category WHERE product_sc_product_category_id=?");
	$stmt_select_type ->bind_param('i',$category_id);
	$stmt_select_type ->execute();
	$stmt_select_type ->store_result();
	$stmt_select_type ->bind_result($product_sc_id,$product_sc_name);
	while($stmt_select_type ->fetch()){
		if($sub_category_id!=""){
			if($sub_category_id == $product_sc_id){
				$string .= '<option value="'.$product_sc_id.'" selected>'.$product_sc_name.'</option>';
			}else{
				$string .= '<option value="'.$product_sc_id.'">'.$product_sc_name.'</option>';
			}
		}else{
			$string .= '<option value="'.$product_sc_id.'">'.$product_sc_name.'</option>';
		}
	}
	$output[0] = $string;
	echo urldecode(json_encode($output));
}

?>
