<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<div class="panel panel-default" >
    <div class="panel-heading" id = "heading">
        <?php print $LANG_CREATE_PRODUCT; ?>
    </div>
    <!-- /.panel-heading --> 
    <div class="panel-body">
		<form id="product_form">
			<input type = "hidden" id ="product_id" name = "product_id" value= "">	
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_NAME; ?><span style='color:red;'>&nbsp;*</span></label>
				<div class="col-sm-9"  style="margin-bottom:15px;">
					<input class="form-control required" name="product_name" id="product_name" placeholder="">
				</div>
			</div>	
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_CODE; ?><span style='color:red;'>&nbsp;*</span></label>
				<div class="col-sm-9"  style="margin-bottom:15px;">
					<input class="form-control required" name="product_code" id="product_code" placeholder="">
				</div>
			</div>				

			<div class="form-group">
				<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_PRICE; ?><span style='color:red;'>&nbsp;*</span></label>
				<div class="col-sm-9"  style="margin-bottom:15px;">
					<input type="number" min="0" step="any" class="form-control required" name="product_price" id="product_price" placeholder="">
				</div>
			</div>		
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_DISCOUNT; ?><span style='color:red;'>&nbsp;*</span></label>
				<div class="col-sm-9"  style="margin-bottom:15px;">
					<input type="number" min="0" step="any" class="form-control required" name="product_rebate" id="product_rebate" placeholder="">
				</div>
			</div>	
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_QUANTITY; ?><span style='color:red;'>&nbsp;*</span></label>
				<div class="col-sm-9"  style="margin-bottom:15px;">
					<input type="number" min="0" step="1" class="form-control required" name="product_quantity" id="product_quantity" placeholder="">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_VENDOR; ?><span style='color:red;'>&nbsp;*</span></label>
				<div class="col-sm-9"  style="margin-bottom:15px;">
					<input class="form-control required" name="product_vendor" id="product_vendor" placeholder="">
				</div>
			</div>
		
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"><?php echo $LANG_DESCRIPTION; ?><span style='color:red;'>&nbsp;*</span></label>
				<div class="col-sm-9"  style="margin-bottom:15px;">
					<textarea class="form-control ckeditor" name="product_description" rows="6" id="product_description" placeholder="" value=""></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"><?php echo $LANG_DELIVERY_DETAIL; ?><span style='color:red;'>&nbsp;*</span></label>
				<div class="col-sm-9"  style="margin-bottom:15px;">
					<textarea class="form-control ckeditor" name="product_delivery_detail" rows="6" id="product_delivery_detail" placeholder="" value=""></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"><?php echo $LANG_PRODUCT_IMAGE; ?><span style='color:red;'>&nbsp;*</span></label>
				<div class="col-sm-6"  style="margin-bottom:15px;">
					<input type="file" class="col-md-8" id="product_image" name="product_image" multiple/>
				</div>
				<div class="col-md-3" style="margin-bottom:15px;" >
					<!-- <img src="" id="product_image_display" name="product_image_display" style='width:150px;height:150px'> -->
				</div>
			</div>
		</form>
		<div class="box-footer">
			<input type="button" class="btn btn-primary" id = "create_button" onclick="create_product()" value = "<?php echo $LANG_SUBMIT; ?>"/>
			<button type="button" class="btn btn-primary" id = "edit_button" style="display:none" onclick="edit_product();"><?php echo $LANG_EDIT; ?></button>
			<button type="button" class="btn btn-primary" onclick="location.reload();"><?php echo $LANG_CANCEL; ?></button>
		</div>
    </div>
    <!-- /.panel-body -->
</div>

<div class="panel panel-default" >
    <div class="panel-heading">
        <?php print $LANG_LIST; ?>
    </div>
    <!-- /.panel-heading --> 
    <div class="panel-body" style="overflow-x:scroll">
		<table class="table table-striped table-bordered table-hover dataTables">
			<thead>
				<tr>
					<th style="width:2%"><span><?php print $LANG_NO; ?></span></th>
					<th style=""><span><?php echo $LANG_PRODUCT_NAME;?></span></th>
					<th style=""><span><?php echo $LANG_PRODUCT_CODE;?></span></th>
					<th style=""><span><?php echo $LANG_PRODUCT_PRICE;?></span></th>
					<th style=""><span><?php echo $LANG_PRODUCT_REBATE;?></span></th>
					<th style=""><span><?php echo $LANG_PRODUCT_QUANTITY;?></span></th>
					<th style=""><span><?php echo $LANG_PRODUCT_VENDOR;?></span></th>
					<th style=""><span><?php echo $LANG_DESCRIPTION;?></span></th>
					<th style=""><span><?php echo $LANG_DELIVERY_DETAIL;?></span></th>
					<th style=""><span><?php echo $LANG_PRODUCT_IMAGE;?></span></th>
					<th style=""><span><?php echo $LANG_EDIT;?></span></th>
					<th style=""><span><?php echo $LANG_DISPLAY;?></span></th>
					<th style=""><span><?php echo $LANG_DELETE;?></span></th>
				</tr>
			</thead>
			<tbody>
			<div class="form-group">
				<?php
				$x = 1;
				$stmt_get_product_details = $mysqli->prepare("SELECT product_id, product_name, product_code, product_price, product_rebate, product_description, product_vendor,product_delivery_detail,product_image,product_quantity,product_display from product");
				$stmt_get_product_details->execute();
				
				$stmt_get_product_details->store_result();
				$stmt_get_product_details->bind_result($product_id, $product_name, $product_code, $product_price, $product_rebate, $product_description, $product_vendor,$product_delivery_detail,$product_image,$product_quantity,$product_display);
				
				while ($stmt_get_product_details->fetch()) {
					$product_sub_image = explode(",", $product_image);
					// $stmt_select_order = $mysqli->prepare("SELECT SUM(od.order_details_quantity) FROM `order_details` od JOIN `order` o WHERE o.order_id=od.order_details_order_id AND od.order_details_product_id=?");
					// $stmt_select_order ->bind_param('i',$product_id);
					// $stmt_select_order ->execute();
					// $stmt_select_order ->store_result(); 
					// $stmt_select_order ->bind_result($sold_out_quantity);
					// $stmt_select_order ->fetch();
					// $in_stock_quantity = $product_quantity - $sold_out_quantity;
					
					print "<tr><td>" . $x . "</td>";					
					print "<td>" . $product_name . "</td>";
					print "<td>" . $product_code . "</td>";
					print "<td>" . $product_price . "</td>";
					print "<td>" . $product_rebate . "</td>";
					print "<td>" . $product_quantity . "</td>";
					print "<td>" . $product_vendor . "</td>";
					print "<td>" . html_entity_decode($product_description) . "</td>";
					print "<td>" . html_entity_decode($product_delivery_detail) . "</td><td>"; 
					for($i = 0; $i < count($product_sub_image); $i++){ ?>
						
						<img src="<?php echo $product_sub_image[$i]; ?>" style="width:100px;height:70px;display:block;">
					
					<?php	
					}
					print "</td>";					
					print "<td><a href='#' onclick='edit_display(" . $product_id . ")' style = 'color:blue;'>
					<i class='fa fa-edit'></i> ".$LANG_EDIT."</a></td>";
					if ($product_display == 1) {
						$on_off = $LANG_SHOW;
						$color = "primary";
						$toggle = "toggle-on";
					} else {
						$on_off = $LANG_HIDE;
						$color = "danger";
						$toggle = "toggle-off";
					}
						echo '<td><input type="checkbox" checked data-toggle="' . $toggle . '" data-on="' . $on_off . '"  data-off="' . $LANG_HIDE . '" data-onstyle="' . $color . '" data-offstyle="danger" value="" 
								onchange="inactive(' . $product_id . ',' . $product_display . ')"></td>';
					//	echo '<td>';
					print "<td><a href='#' onclick='delete_product(" . $product_id . ")' style = 'color:blue;'>
					<i class='fa fa-eraser'></i> ".$LANG_DELETE."</a></td>";
					$x++;
				}
				?>
			</div>
			</tbody>
		</table>
    </div>
    <!-- /.panel-body -->
</div>

<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo $LANG_PRODUCT_IMAGE;?></h4>
			  </div>
			<div class="modal-body" >

			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>


$(function () {
	CKEDITOR.config.height = 150;
	CKEDITOR.config.width = 'auto';
	var imagesPreview = function(input, placeToInsertImagePreview){
		$('.product_image_display').remove();
	
		if(input.files){
			var filesAmount = input.files.length;
			
			for(i = 0; i  < filesAmount; i++){
				var reader = new FileReader();
				
				reader.onload = function(event){
					$($.parseHTML('<img>')).attr({'src':event.target.result, width:'150px', height:'150px'}).appendTo(placeToInsertImagePreview);
				}
				
				reader.readAsDataURL(input.files[i])
			}
		}
	};
	
	$("#product_image").on('change', function(){
		imagesPreview(this, 'div.col-md-3');
	});
});

// function readURL(input){
	// if(input.files && input.files[0]){
		// var reader = new FileReader();
		
		// reader.onload = function(e){
			// $("#product_image_display")
				// .attr('src', e.target.result)
				// .width(200)
				// .height(200);
		// };
		
		// reader.readAsDataURL(input.files[0]);
	// }
// }

function create_product() {
	
	if (confirm("<?php echo $LANG_CONFIRM ?>")) {
		var check = true;
		var error_msg = [];
		
		// var names = [];
		// for(var i = 0; i < $("input[name=product_image]").get(0).files.length; ++i){
			// names.push($("input[name=product_image]").get(0).files[i].name);
		// }
		// alert($.unique(names).join("\n"));

		var product_description = CKEDITOR.instances['product_description'].getData();
		var product_delivery_detail = CKEDITOR.instances['product_delivery_detail'].getData();
		
		var product_image = [];
		var imageForm = new FormData();
		var ins = $('input[name = product_image]').get(0).files.length;
		for(var i = 0; i < ins; i++){
			var image = $('input[name=product_image]')[0].files[i];
			imageForm.append('file[]', image);
			product_image[i] = "";
			// check image
			if (image) {
				var fileExtension = ['jpeg', 'jpg', 'png', 'pdf', 'gif'];
				if ($.inArray(image.name.split('.').pop().toLowerCase(), fileExtension) == -1) {
					check = false;
					error_msg.push("<?php echo $LANG_UPLOAD_FORMAT_ALLOW ?>: " + fileExtension.join(', '));
				}
			}
		}
		
		if (product_description == "" ){
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
				url: '?f=upload_file&folder=product_image',
				data: imageForm,
				processData: false,
				contentType: false,
				beforeSend: function () {
					show_processing();
				},
				success: function (data) {
					hide_processing();
					if (data[0]) {
						for(var i = 1; i <= ins; i++){
						product_image[i-1] = data[i];
						}
						$.ajax({
							dataType: 'json',
							type: 'POST',
							url: '?f=<?php echo $_GET['loc'] ?>',
							data: $('#product_form').serialize() + "&act=1&product_image="+product_image+"&product_description="+product_description+"&product_delivery_detail="+product_delivery_detail,
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
		var product_description = CKEDITOR.instances['product_description'].getData();
		var product_delivery_detail = CKEDITOR.instances['product_delivery_detail'].getData();
		
		var product_image = [];
		var imageForm = new FormData();
		var ins = $('input[name = product_image]').get(0).files.length;
		for(var i = 0; i < ins; i++){
			var image = $('input[name=product_image]')[0].files[i];
			imageForm.append('file[]', image);
			product_image[i] = "";
			// check image
			if (image) {
				var fileExtension = ['jpeg', 'jpg', 'png', 'pdf', 'gif'];
				if ($.inArray(image.name.split('.').pop().toLowerCase(), fileExtension) == -1) {
					check = false;
					error_msg.push("<?php echo $LANG_UPLOAD_FORMAT_ALLOW ?>: " + fileExtension.join(', '));
				}
			}
		}
		
		if (product_description == "" ){
			check = false;
			error_msg.push("<?php echo $LANG_DESCRIPTION_BLANK ?>");
		}
		
		if (product_delivery_detail == "" ){
			check = false;
			error_msg.push("<?php echo $LANG_DELIVERY_BLANK ?>");
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
				url: '?f=upload_file&folder=product_image',
				data: imageForm,
				processData: false,
				contentType: false,
				beforeSend: function () {
					show_processing();
				},
				success: function (data) {
					hide_processing();
					if (data[0]) {
						for(var i = 0; i < ins; i++){
							product_image[i] = data[i+1];
						}
						$.ajax({
							dataType: 'json', 
							type: 'POST',
							url: '?f=<?php echo $_GET['loc'] ?>',
							data: $('#product_form').serialize() + "&act=2&product_image="+product_image+"&product_description="+product_description+"&product_delivery_detail="+product_delivery_detail,
							
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
	$('.product_image_display').remove();
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
				$('#product_code').val(data[3]);
				$('#product_price').val(data[4]);
				$("#product_rebate").val(data[5]);
				CKEDITOR.instances['product_description'].setData(data[6]);
				$("#product_vendor").val(data[7]);
				CKEDITOR.instances['product_delivery_detail'].setData(data[8]);
				$("#product_quantity").val(data[9]);
				for(var i = 1; i < data[10]; i++){
					$($.parseHTML('<img>')).attr({'src':data[i+10], 'class':'product_image_display', width:'150px', height:'150px'}).appendTo($('.col-md-3'));
				}
				$('#product_image').removeClass("required");
				
			} else {  
				alert(data[1]);   
			}
		}
	});

}
	
function inactive(product_id, product_display){
	if (confirm("<?php echo $LANG_CONFIRM; ?>")){
		$.ajax({
			dataType: 'json',
			type: 'POST',
			url: '?f=<?php echo $_GET['loc'] ?>',
			data: {
				product_id: product_id,
				product_display: product_display,
				act: 5
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
	} else {
		location.reload();
	}
}

</script>

