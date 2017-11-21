<div class="panel">
	<div class="content-box">
		<h3 class="content-box-header bg-black"><?php echo $LANG_CATEGORY;?></h3>
		<div class="content-box-wrapper">
			<form id="category_form">
				<input type = "hidden" id ="product_category_id" name = "product_category_id" value= "">
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_CATEGORY_NAME; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input class="form-control required" name="category_name" id="category_name" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_CATEGORY_NAME_CN;?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input class="form-control required" name="category_name_cn" id="category_name_cn" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_DESCRIPTION; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<textarea class="form-control ckeditor" name="category_description" rows="6" id="category_description" placeholder="" value=""></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_DESCRIPTION_CN; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<textarea class="form-control ckeditor" name="category_description_cn" rows="6" id="category_description_cn" placeholder="" value=""></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_DISPLAY ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9" style="margin-bottom:15px;">
						<select class="form-control" name="display" id ="display">
						<option value ="1"><?php echo $LANG_YES ?></option>
						<option value ="0"><?php echo $LANG_NO ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-primary" id = "create_button" onclick="add_category();"><?php echo $LANG_SUBMIT; ?></button>
					<button type="button" class="btn btn-primary" id = "edit_button" style="display:none" onclick="edit_category();"><?php echo $LANG_UPDATE; ?></button>
					<button type="button" class="btn btn-primary" onclick="location.reload();"><?php echo $LANG_CANCEL; ?></button>
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
						<th style=""><span><?php echo $LANG_CATEGORY_NAME;?></span></th>
						<th style=""><span><?php echo $LANG_CATEGORY_NAME_CN;?></span></th>
						<th style=""><span><?php echo $LANG_DESCRIPTION;?></span></th>
						<th style=""><span><?php echo $LANG_DESCRIPTION_CN;?></span></th>
						<th style=""><span><?php echo $LANG_DISPLAY;?></span></th>
						<th style="width:10%"><span><?php echo $LANG_EDIT;?></span></th>
						<th style="width:10%"><span><?php echo $LANG_DELETE;?></span></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$x = 1;
					$stmt_get_category_details = $mysqli->prepare("select product_category_name, product_category_id, product_category_is_display,product_category_description, product_category_name_cn, product_category_description_cn
															from product_category");
					$stmt_get_category_details->execute();
					$stmt_get_category_details->store_result();
					$stmt_get_category_details->bind_result($product_category_name, $product_category_id, $product_category_is_display,$product_category_description, $product_category_name_cn, $product_category_description_cn);
					while ($stmt_get_category_details->fetch()) {
						print "<tr><td>" . $x . "</td>";
						print "<td>" . $product_category_name . "</td>";
						print "<td>" . $product_category_name_cn . "</td>";
						print "<td>" . $product_category_description . "</td>";
						print "<td>" . $product_category_description_cn . "</td>";
						if ($product_category_is_display == 1){
							print "<td>" . $LANG_YES . "</td>";
						}else{
							print "<td>" . $LANG_NO . "</td>";
						}

						print "<td><a onclick='edit_display(" . $product_category_id . ")' style='color:#000; cursor:pointer; text-decoration:none' >
						<i class='fa fa-edit'></i> ".$LANG_EDIT."</a></td>";
						print "<td><a onclick='delete_category(" . $product_category_id . ")' style='color:#000; cursor:pointer; text-decoration:none'>
						<i class='fa fa-eraser'></i> ".$LANG_DELETE."</a></td>";
						
						$x++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
function add_category() {
	if (confirm("<?php echo $LANG_CONFIRM ?>")) {
		var check = true;
		var error_msg = [];
		var category_name = $('#category_name').val();
		var category_name_cn = $('#category_name_cn').val();
		var category_description = CKEDITOR.instances['category_description'].getData();
		var category_description_cn = CKEDITOR.instances['category_description_cn'].getData();
		var display = $('#display').val();
		
		$('#category_form input,select,textarea,checkbox').removeClass('errorBorder');
		$('#category_form .required').each(function () {
			if ($.trim($(this).val()) == ""){
				$(this).addClass('errorBorder');
				check = false;
				error_msg.push("<?php echo $LANG_BLANK ?>");
			}
		});
		
		if (category_description == "" || category_description_cn == ""){
			check = false;
			error_msg.push("<?php echo $LANG_DESCRIPTION_BLANK; ?>");
		}
		
		if (check) {
			$.ajax({
				dataType: 'json',
				type: 'POST',
				url: '?f=<?php echo $_GET['loc'] ?>',
				data: {
					category_name: category_name,
					category_name_cn: category_name_cn,
					category_description: category_description,
					category_description_cn: category_description_cn,
					display: display,
					act: "1"
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
			alert(jQuery.unique(error_msg).join("\n"));
			$('.errorBorder:first').focus();
		}
	}
}

function edit_category() {
	if (confirm("<?php echo $LANG_CONFIRM ?>")) {
		var check = true;
		var error_msg = [];
		var form_data = $('#category_form').serialize();
		var category_description = CKEDITOR.instances['category_description'].getData();
		var category_description_cn = CKEDITOR.instances['category_description_cn'].getData();
		
		$('#category_form input,select,textarea,checkbox').removeClass('errorBorder');
		$('#category_form .required').each(function () {
			if ($.trim($(this).val()) == "")
			{
				$(this).addClass('errorBorder');
				check = false;
				error_msg.push("<?php echo $LANG_BLANK ?>");
			}
		});
		
		if (category_description == "" || category_description_cn == ""){
			check = false;
			error_msg.push("<?php echo $LANG_DESCRIPTION_BLANK; ?>");
		}
		
		if (check) {
			$.ajax({
				dataType: 'json',
				type: 'POST',
				url: '?f=<?php echo $_GET['loc'] ?>',
				data: form_data + "&act=2&category_description="+category_description+"&category_description_cn="+category_description_cn,
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
			alert(jQuery.unique(error_msg).join("\n"));
			$('.errorBorder:first').focus();
		}
	}
}

function delete_category(product_category_id){
	if (product_category_id == undefined){
		alert("<?php echo $LANG_PLEASE_SELECT; ?>");
	} else
	{
		if (confirm("<?php echo $LANG_CONFIRM; ?>"))
		{
			$.ajax({
				dataType: 'json',
				type: 'POST',
				url: '?f=<?php echo $_GET['loc'] ?>',
				data: {
					product_category_id: product_category_id,
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
}

 function edit_display(product_category_id){	
	if (confirm("<?php echo $LANG_CONFIRM; ?>")){
		$.ajax({
			dataType: 'json',
			type: 'POST',
			url: '?f=<?php echo $_GET['loc'] ?>',
			data: {
				product_category_id: product_category_id,
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
					$('#heading').html("<?php echo $LANG_EDIT_CATEGORY; ?>"); //change title
					$('#category_name').val(data[1]);
					$('#category_name_cn').val(data[2]);
					$('#display').val(data[3]);
					$('#product_category_id').val(data[4]);
					CKEDITOR.instances['category_description'].setData(data[5]);
					CKEDITOR.instances['category_description_cn'].setData(data[6]);
				} else {
					alert(data[1]);   
				}
			}
		});
	}
}
</script>
