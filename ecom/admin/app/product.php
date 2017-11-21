<div class="panel">
	<div class="content-box">
		<h3 class="content-box-header bg-black"><?php echo $LANG_CREATE_PRODUCT;?></h3>
		<div class="content-box-wrapper">
			<form id="product_form">
				<input type = "hidden" id ="product_id" name = "product_id" value= "">	
			   <div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_NAME; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input class="form-control required" name="product_name" id="product_name" placeholder="">
					</div>
				</div>	
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_NAME_CN; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input class="form-control required" name="product_name_cn" id="product_name_cn" placeholder="">
					</div>
				</div>			
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_CATEGORY; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<select id="product_category_id" name="product_category_id" class="form-control required" onchange="get_sub_category(this.value)">	
							<option value = "" ><?php print $LANG_SELECT_CATEGORY;?></option>
						<?php
							$stmt_select_category = $mysqli->prepare("SELECT product_category_id,product_category_name FROM product_category");
							$stmt_select_category ->execute();
							$stmt_select_category ->store_result();
							$stmt_select_category ->bind_result($product_category_id, $product_category_name);
							while($stmt_select_category ->fetch()){
								echo "<option value=" . $product_category_id . " >" . $product_category_name . "</option>";
							}
						?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_SUB_CATEGORY; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<select id="product_sub_category_id" name="product_sub_category_id" class="form-control required" >	
							<option value = "" ><?php print $LANG_SELECT_SUB_CATEGORY;?></option>
						
						</select>
					</div>
				</div>
				
				
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_PRICE; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input type="number" min="0" step="any" class="form-control required" name="product_price" id="product_price" placeholder="">
					</div>
				</div>		
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_QUANTITY; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input type="number" min="0" step="1" class="form-control required" name="product_quantity" id="product_quantity" placeholder="">
					</div>
				</div>
			
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_DESCRIPTION; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<textarea class="form-control ckeditor" name="product_description" id="product_description" placeholder="" value=""></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_DESCRIPTION_CN; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<textarea class="form-control ckeditor" name="product_description_cn" id="product_description_cn" placeholder="" value=""></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_PAY_METHOD; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<select class="form-control required" name="product_pay_method" id="product_pay_method">
							<option value=""><?php echo $LANG_SELECT_METHOD;?></option>
							<option value="1"><?php echo $LANG_50_E_WALLET;?></option>
							<option value="2"><?php echo $LANG_100_E_WALLET;?></option>
						</select>
					</div>
				</div>
				
				<div id="image">
					<div class="form-group col-md-12">
						<label for="" class="col-md-3 control-label"><?php echo ucwords($LANG_IMAGE); ?>( min size:700px x 700px)<span style='color:red;'>&nbsp;*</span></label>
						<div class="col-md-2"  id = "picture_div" style="display:none;" >
							<span class="glyphicon glyphicon-remove" id="first_picture" onclick="remove_image(1)" style="cursor:pointer"></span>
							<img src="" id="picture" name="picture" style='width:70px;height:70px; '> 
						</div>  
						
						<input type="hidden" id="product_image_change"  name="product_image_change" value="">
						<div class="col-md-6" style="margin-bottom:15px">
							<input class="required" type="file" id="product_image"  name="product_image" value="" accept="image/x-png,image/jpg,image/jpeg"/>
							<a onclick="undo(1)" id="undo_1" style="display:none; cursor:pointer;"><?php echo $LANG_UNDO;?></a>
						</div>	
					</div>
				</div>
			
				<div id="second_image">
					<div class="form-group col-md-12">
						<label for="" class="col-md-3 control-label"></label>
						<div class="col-md-2"  id = "second_picture_div" style="display:none;" >
							<span class="glyphicon glyphicon-remove" onclick="remove_image(2)" style="cursor:pointer" ></span>
							<img src="" id="second_picture" name="second_picture" style='width:70px;height:70px; '> 
						</div>  
						<input type="hidden" id="second_product_image_change"  name="second_product_image_change" value="">
						<div class="col-md-6" style="margin-bottom:15px">
							<input type="file" id="second_product_image"  name="second_product_image" value="" accept="image/x-png,image/jpg,image/jpeg"/>
							<a onclick="undo(2)" id="undo_2" style="display:none; cursor:pointer;"><?php echo $LANG_UNDO;?></a>
						</div>	
					</div>
				</div>
			
				<div id="third_image">
					<div class="form-group col-md-12">
						<label for="" class="col-md-3 control-label"></label>
						<div class="col-md-2"  id = "third_picture_div" style="display:none;" >
							<span class="glyphicon glyphicon-remove" onclick="remove_image(3)" style="cursor:pointer"></span>
							<img src="" id="third_picture" name="third_picture" style='width:70px;height:70px; '> 
						</div>  
						<input type="hidden" id="third_product_image_change" name="third_product_image_change" value="">
						<div class="col-md-6" style="margin-bottom:15px">
							<input  type="file" id="third_product_image"  name="third_product_image" value="" accept="image/x-png,image/jpg,image/jpeg"/>
							<a onclick="undo(3)" id="undo_3" style="display:none; cursor:pointer;"><?php echo $LANG_UNDO;?></a>
						</div>	
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_WEST_SHIPPING_FEE; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input class="form-control required" name="west_msia_shipping_fee" id="west_msia_shipping_fee" placeholder="West Msia / ??" value="0">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_EAST_SHIPPING_FEE; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input class="form-control required" name="east_msia_shipping_fee" id="east_msia_shipping_fee" placeholder="East Msia / ??" value="0">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_CHINA_SHIPPING_FEE; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input class="form-control required" name="china_shipping_fee" id="china_shipping_fee" placeholder="China / ??" value="0">
					</div>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-primary" id = "create_button" onclick="insert_product();"><?php echo $LANG_SUBMIT; ?></button>
					<button type="button" class="btn btn-primary" id = "edit_button" style="display:none" onclick="edit_product();"><?php echo $LANG_SUBMIT; ?></button>
					<button type="button" class="btn btn-default" onclick="location.reload();"><?php echo $LANG_CANCEL; ?></button>
				</div>
				
			</form>
		</div>
	</div>
</div>

<div class="panel">
	<div class="content-box">
		<h3 class="content-box-header bg-blue"><?php echo $LANG_LIST;?></h3>
		<div class="content-box-wrapper" style="overflow-x:scroll">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable-example">
				<thead>
				<tr>
					<th style="width:2%"><span><?php print $LANG_NO; ?></span></th>
					<th style=""><span><?php echo $LANG_PRODUCT_NAME;?></span></th>
					<th style=""><span><?php echo $LANG_DETAILS;?></span></th>
					<th style=""><span><?php echo $LANG_ACTION;?></span></th>
				</tr>
			</thead>
			</tbody>
				<?php
				$x = 1;
				$stmt_get_product_details = $mysqli->prepare("SELECT  product_id, product_name, product_category_id, product_price, product_quantity, product_description, product_sub_category_id,product_description_cn from product");
				$stmt_get_product_details->execute();
				$stmt_get_product_details->store_result();
				$stmt_get_product_details->bind_result($product_id,$product_name, $product_category_id,$product_price,$product_quantity,$product_description, $product_sub_category_id,$product_description_cn);
				while ($stmt_get_product_details->fetch()) {
					
					print "<tr><td>" . $x . "</td>";					
					print "<td>" . $product_name . "</td>";	
					print "<td><a href='#' data-toggle='modal' data-target='#image-modal' onclick='view_details(" . $product_id . ")' style='color:#000; cursor:pointer; text-decoration:none'>".$LANG_VIEW_DETAILS."</a></td>";
					 
					
					
					print "<td><a href='#' onclick='edit_display(" . $product_id . ")' style='color:#000; cursor:pointer; text-decoration:none'>
					<i class='fa fa-edit'></i> ".$LANG_EDIT."</a>";
					print "<a href='#'  onclick='delete_product(" . $product_id . ")' style='padding-left:10px;color:#000; cursor:pointer; text-decoration:none'>
					<i class='fa fa-eraser'></i> ".$LANG_DELETE."</a></td>";
					$x++;
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
 

<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo $LANG_PRODUCT_IMAGE;?></h4>
			  </div>
			<div class="modal-body" style="height:100%; width:100%;overflow:auto">

			</div>
			
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
function insert_product() {
	if (confirm("<?php echo $LANG_CONFIRM ?>")) {
		var check = true;
		var error_msg = [];

		var product_name = $("#product_name").val();
		var product_name_cn = $("#product_name_cn").val();
		var product_category_id = $("#product_category_id").val();
		var product_sub_category_id = $("#product_sub_category_id").val();
		var product_price = $("#product_price").val();
		var product_quantity = $("#product_quantity").val();
		var west_msia_shipping_fee = $("#west_msia_shipping_fee").val();
		var east_msia_shipping_fee = $("#east_msia_shipping_fee").val();
		var china_shipping_fee = $("#china_shipping_fee").val();
		
		var product_pay_method = $('#product_pay_method').val();
		
		var product_description = CKEDITOR.instances['product_description'].getData();
		var product_description_cn = CKEDITOR.instances['product_description_cn'].getData();
		
		var second_image = $('input[name=second_product_image]')[0].files[0];
		var third_image = $('input[name=third_product_image]')[0].files[0];
		var image = $('input[name=product_image]')[0].files[0];
		var imageForm = new FormData();
		imageForm.append('file[]', image);
		imageForm.append('file[]', second_image);
		imageForm.append('file[]', third_image);
		var product_image = "";
	
		//check image	
		if (image) {
			//var fileExtension = ['jpeg', 'jpg', 'png', 'pdf', 'gif'];
			var fileExtension = ['jpeg', 'jpg', 'png'];
			if ($.inArray(image.name.split('.').pop().toLowerCase(), fileExtension) == -1) {
				check = false;
				error_msg.push("<?php echo $LANG_UPLOAD_FORMAT_ALLOW ?>: " + fileExtension.join(', '));
			}
		}
		if (second_image) {
			var fileExtension = ['jpeg', 'jpg', 'png'];
			if ($.inArray(second_image.name.split('.').pop().toLowerCase(), fileExtension) == -1) {
				check = false;
				error_msg.push("<?php echo $LANG_UPLOAD_FORMAT_ALLOW ?>: " + fileExtension.join(', '));
			}
		}
		if (third_image) {
			var fileExtension = ['jpeg', 'jpg', 'png'];
			if ($.inArray(third_image.name.split('.').pop().toLowerCase(), fileExtension) == -1) {
				check = false;
				error_msg.push("<?php echo $LANG_UPLOAD_FORMAT_ALLOW ?>: " + fileExtension.join(', '));
			}
		}

		if (product_description == "" || product_description_cn == ""){
			check = false;
			error_msg.push("<?php echo $LANG_DESCRIPTION_BLANK ?>");
		}
		
		$('#product_form input,select,textarea,checkbox').removeClass('errorBorder');
		$('#product_form .required').each(function () {
			if ($.trim($(this).val()) == "")
			{
				$(this).addClass('errorBorder');
				check = false;
				error_msg.push("<?php echo $LANG_BLANK ?>");
			}
		});
		
		if (check) {
			$.ajax({
				dataType: 'json',
				type: 'POST',
				url: '?f=upload_product_image&folder=product_image',
				data: imageForm,
				processData: false,
				contentType: false,
				beforeSend: function () {
					show_processing();
				},
				success: function (data) {
					hide_processing();
					if (data[0]) {
						product_image = data[1];
						
						$.ajax({
							dataType: 'json',
							type: 'POST',
							url: '?f=<?php echo $_GET['loc'] ?>',
							data:{
								act:1,
								product_image:product_image,
								product_description:product_description,
								product_description_cn:product_description_cn,
								product_name:product_name,
								product_name_cn:product_name_cn,
								product_category_id:product_category_id,
								product_sub_category_id:product_sub_category_id,
								product_price:product_price,
								product_quantity:product_quantity,
								west_msia_shipping_fee:west_msia_shipping_fee,
								east_msia_shipping_fee:east_msia_shipping_fee,
								china_shipping_fee:china_shipping_fee,
								product_pay_method:product_pay_method
							}, 
							//$('#product_form').serialize() + "&act=1&product_image="+product_image+"&product_description="+product_description+"&product_description_cn="+product_description_cn,
							beforeSend: function () {
								show_processing();
							},
							success: function (data) {
								hide_processing();
								if (data[0]) {
									alert(data[1]);
									location.reload();
								} else {
									alert(data[1]);
								}
							}
						});
					}
				}
			}); 
		}else {
			alert(jQuery.unique(error_msg).join("\n"));
			$('.errorBorder:first').focus();
		}
	}
}

function edit_product() {
	if (confirm("<?php echo $LANG_CONFIRM ?>")) {
		var check = true;
		var error_msg = [];

		var product_name = $("#product_name").val();
		var product_name_cn = $("#product_name_cn").val();
		var product_category_id = $("#product_category_id").val();
		var product_sub_category_id = $("#product_sub_category_id").val();
		var product_price = $("#product_price").val();
		var product_quantity = $("#product_quantity").val();
		var product_id = $("#product_id").val();
		var west_msia_shipping_fee = $("#west_msia_shipping_fee").val();
		var east_msia_shipping_fee = $("#east_msia_shipping_fee").val();
		var china_shipping_fee = $("#china_shipping_fee").val();
		var product_pay_method = $("#product_pay_method").val();
		
		var product_description =  CKEDITOR.instances['product_description'].getData();
		var product_description_cn = CKEDITOR.instances['product_description_cn'].getData();
		
		var product_image_change = $("#product_image_change").val();
		var second_product_image_change = $("#second_product_image_change").val();
		var third_product_image_change = $("#third_product_image_change").val();
		console.log(product_description);
		
		var second_image = $('input[name=second_product_image]')[0].files[0];
		var third_image = $('input[name=third_product_image]')[0].files[0];
		var image = $('input[name=product_image]')[0].files[0];
		var imageForm = new FormData();
		imageForm.append('file[]', image);
		imageForm.append('file[]', second_image);
		imageForm.append('file[]', third_image);
		var product_image = "";
		//check at least one image
		if(product_image_change == "" && second_product_image_change == "" && third_product_image_change == "" && image=="undefined" && second_image=="undefined" && third_image=="undefined" ){ 
			$('#product_image').addClass("required");
		}

		//check image	
		if (image) {
			var fileExtension = ['jpeg', 'jpg', 'png'];
			if ($.inArray(image.name.split('.').pop().toLowerCase(), fileExtension) == -1) {
				check = false;
				error_msg.push("<?php echo $LANG_UPLOAD_FORMAT_ALLOW ?>: " + fileExtension.join(', '));
			}
		}
		if (second_image) {
			var fileExtension = ['jpeg', 'jpg', 'png'];
			if ($.inArray(second_image.name.split('.').pop().toLowerCase(), fileExtension) == -1) {
				check = false;
				error_msg.push("<?php echo $LANG_UPLOAD_FORMAT_ALLOW ?>: " + fileExtension.join(', '));
			}
		}
		if (third_image) {
			var fileExtension = ['jpeg', 'jpg', 'png'];
			if ($.inArray(third_image.name.split('.').pop().toLowerCase(), fileExtension) == -1) {
				check = false;
				error_msg.push("<?php echo $LANG_UPLOAD_FORMAT_ALLOW ?>: " + fileExtension.join(', '));
			}
		}
		
		if (product_description == "" || product_description_cn == ""){
			check = false;
			error_msg.push("<?php echo $LANG_DESCRIPTION_BLANK ?>");
		}

		$('#product_form input,select,textarea,checkbox').removeClass('errorBorder');
		$('#product_form .required').each(function () {
			if ($.trim($(this).val()) == "")
			{
				$(this).addClass('errorBorder');
				check = false;
				error_msg.push("<?php echo $LANG_BLANK ?>");
			}
		});
		
		if (check) {
			$.ajax({
				dataType: 'json',
				type: 'POST',
				url: '?f=upload_product_image&folder=product_image',
				data: imageForm,
				processData: false,
				contentType: false,
				beforeSend: function () {
					show_processing();
				},
				success: function (data) {
					hide_processing();
					if (data[0]) {
						console.log(product_description);
						product_image = data[1];
						$.ajax({
							dataType: 'json',
							type: 'POST',
							url: '?f=<?php echo $_GET['loc'] ?>',
							data:{
								act:2,
								product_image:product_image,
								product_description:product_description,
								product_description_cn:product_description_cn,
								product_name:product_name,
								product_name_cn:product_name_cn,
								product_category_id:product_category_id,
								product_sub_category_id:product_sub_category_id,
								product_price:product_price,
								product_quantity:product_quantity,
								product_id:product_id,
								west_msia_shipping_fee:west_msia_shipping_fee,
								east_msia_shipping_fee:east_msia_shipping_fee,
								china_shipping_fee:china_shipping_fee,
								product_image_change:product_image_change,
								second_product_image_change:second_product_image_change,
								third_product_image_change:third_product_image_change,
								product_pay_method:product_pay_method
								
							},
							// $('#product_form').serialize() + "&act=2&product_image="+product_image+"&product_description="+product_description+"&product_description_cn="+product_description_cn,
							beforeSend: function () {
								show_processing();
							},
							success: function (data) {
								hide_processing();
								if (data[0]) {
									alert(data[1]);
									location.reload();
								} else {
									alert(data[1]);
								}
							}
						});
					}else{
						alert(data[1]);
					} 
				}
			}); 
		}else {
			alert(jQuery.unique(error_msg).join("\n"));
			$('.errorBorder:first').focus();
		}
	}
}

function delete_product(product_id){       
	if (confirm("<?php echo $LANG_CONFIRM; ?>")){
		$.ajax({
			dataType: 'json',
			type: 'POST',
			url: '?f=<?php echo $_GET['loc'] ?>',
			data: {
				product_id: product_id,
				act: "3"
			},
			beforeSend: function () {
				show_processing();
			},
			success: function (data) {
				hide_processing();
				if (data[0]) {
					alert(data[1]);
					location.reload();
				} else {
					alert(data[1]);   
				}
			}
		});
	}
}

function edit_display(product_id){ 
	if (confirm("<?php echo $LANG_CONFIRM; ?>")){
		$.ajax({
			dataType: 'json',
			type: 'POST',
			url: '?f=<?php echo $_GET['loc'] ?>',
			data: {
				product_id: product_id,
				act: "4"
			},
			beforeSend: function () {
				show_processing();
			},
			success: function (data) {
				hide_processing();
				if (data[0]) {
					$('#create_button').css('display', 'none');
					$('#edit_button').show();
					$('#heading').html("<?php echo $LANG_EDIT_PRODUCT; ?>"); //change title
					$('#product_id').val(data[1]);
					$('#product_name').val(data[2]);
					$('#product_name_cn').val(data[12]);
					$('#product_category_id').val(data[3]);
					$('#product_price').val(data[4]);
					$("#product_quantity").val(data[5]);
					CKEDITOR.instances['product_description'].setData(data[6]);
					CKEDITOR.instances['product_description_cn'].setData(data[11]);
					$('#product_image').removeClass("required");
							 
					$('#picture').attr('src', data[7]);
					$('#second_picture').attr('src', data[8]);
					$('#third_picture').attr('src', data[9]);
					get_sub_category(data[3],data[10]);

					$('#picture_div').show();
					$('#product_image').css("display","none");
					$("#product_image_change").val("1");
					
					if(data[7]){
						$('#picture_div').show();
						$('#product_image').css("display","none");
						$("#product_image_change").val("1");
					}
					
					if(data[8]){
						$('#second_picture_div').show();
						$('#second_product_image').css("display","none");
						$("#second_product_image_change").val("1");
					}
					
					if(data[9]){
						$('#third_picture_div').show();
						$('#third_product_image').css("display","none");
						$("#third_product_image_change").val("1");
					}
					
					$('#west_msia_shipping_fee').val(data[13]);
					$('#east_msia_shipping_fee').val(data[14]);
					$('#china_shipping_fee').val(data[15]);
					$('#product_pay_method').val(data[16]);

				} else {
					alert(data[1]);   
				}
			}
		});
	}
}
	
function remove_image(num){
	if (num ==1){
		$('#picture_div').css("display","none");
		$('#product_image').show();
		$("#product_image_change").val("");
		$('#undo_'+num).show();
	}
	if (num ==2){
		$('#second_picture_div').css("display","none");
		$('#second_product_image').show();
		$("#second_product_image_change").val("");
		$('#undo_'+num).show();
	}
	if (num ==3){
		$('#third_picture_div').css("display","none");
		$('#third_product_image').show();
		$("#third_product_image_change").val("");
		$('#undo_'+num).show();
	}
}
	
function view_details(product_id){
	$.ajax({
		//dataType: 'json',
		type: 'POST',
		url: '?f=<?php echo $_GET['loc'] ?>',
		data: {
			act:5,
			product_id:product_id
		},
		success: function (data) {
			$(".modal-body").html(data);
		}
	});
}

function undo(id){
	if(id == 1){
		$('#picture_div').show();
		$('#product_image').hide();
		$("#product_image_change").val(1);
		$('#undo_'+id).hide();
	}else if(id == 2){
		$('#second_picture_div').show();
		$('#second_product_image').hide();
		$("#second_product_image_change").val(1);
		$('#undo_'+id).hide();
	}else if(id == 3){
		$('#third_picture_div').show();
		$('#third_product_image').hide();
		$("#third_product_image_change").val(1);
		$('#undo_'+id).hide();
	}
}

function get_sub_category(category,sub_category_id){	
	$.ajax({
		url: '?f=product', 
		type: 'POST', 
		dataType: 'json', 
		data: {
			act: '6', 
			category: category,
			sub_category_id:sub_category_id
			}, 
		success: function (data) {
			$('#product_sub_category_id').html(data[0]);
		}
	});
}

</script>

