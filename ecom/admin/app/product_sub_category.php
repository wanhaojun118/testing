<div class="panel">
	<div class="content-box">
		<h3 class="content-box-header bg-black"><?php echo $LANG_SUB_CATEGORY;?></h3>
		<div class="content-box-wrapper">
			<form id="sub_category_form">
				<input type = "hidden" id ="product_sub_category_id" name = "product_sub_category_id" value= "">
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_CATEGORY; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<select id="category" name="category" class="form-control required">	
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
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_SUB_CATEGORY_NAME; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input class="form-control required" name="sub_category_name" id="sub_category_name" placeholder="">
					</div>
				</div>
				
				 <div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_SUB_CATEGORY_NAME_CN; ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9"  style="margin-bottom:15px;">
						<input class="form-control required" name="sub_category_name_cn" id="sub_category_name_cn" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_DISPLAY ?><span style='color:red;'>&nbsp;*</span></label>
					<div class="col-sm-9" style="margin-bottom:15px;">
						<select class="form-control" name="display" id ="display">
							<option value ="1"><?php echo $LANG_YES ?></option>
							<option value ="0"><?php echo $LANG_DISPLAY_NO ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-primary" id = "create_button" onclick="add_sub_category();"><?php echo $LANG_SUBMIT; ?></button>
					<button type="button" class="btn btn-primary" id = "edit_button" style="display:none" onclick="edit_sub_category();"><?php echo $LANG_UPDATE; ?></button>
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
                        <th style=""><span><?php echo $LANG_SUB_CATEGORY_NAME;?></span></th>
                        <th style=""><span><?php echo $LANG_SUB_CATEGORY_NAME_CN;?></span></th>
                        <th style=""><span><?php echo $LANG_DISPLAY;?></span></th>
						<th style="width:10%"><span><?php echo $LANG_EDIT;?></span></th>
						<th style="width:10%"><span><?php echo $LANG_DELETE;?></span></th>
                    </tr>
                </thead>
				<tbody>           
				<?php
                    $x = 1;
                    $stmt_get_sub_category_details = $mysqli->prepare("select product_sc_name_cn,product_sc_id, product_sc_name,product_sc_is_display, 
															product_category_name,product_category_name_cn from product_sub_category psc join product_category pc 
															on psc.product_sc_product_category_id = pc.product_category_id");
                    $stmt_get_sub_category_details->execute();
                    $stmt_get_sub_category_details->store_result();
                    $stmt_get_sub_category_details->bind_result($product_sc_name_cn,$product_sc_id, $product_sc_name, $product_sc_is_display, $product_category_name,$product_category_name_cn);
                    while ($stmt_get_sub_category_details->fetch()) {
                        print "<tr><td>" . $x . "</td>";
						if($language == 'en'){
							print "<td>" . $product_category_name . "</td>";
						}else{
							print "<td>" . $product_category_name_cn . "</td>";
						}

						print "<td>" . $product_sc_name . "</td>";
						print "<td>" . $product_sc_name_cn . "</td>";
						if ($product_sc_is_display == 1){
							print "<td>" . $LANG_YES . "</td>";
						}else{
							print "<td>" . $LANG_DISPLAY_NO . "</td>";
						}
						print "<td><a onclick='edit_display(" . $product_sc_id . ")' style='color:#000; cursor:pointer; text-decoration:none'>
						<i class='fa fa-edit'></i> ".$LANG_EDIT."</a></td>";
						print "<td><a onclick='delete_sub_category(" . $product_sc_id . ")' style='color:#000; cursor:pointer; text-decoration:none'>
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
function add_sub_category() {
	var check = true;
	var error_msg = [];
	var form_data = $('#sub_category_form').serialize();
	
	$('#sub_category_form input,select,textarea,checkbox').removeClass('errorBorder');
	$('#sub_category_form .required').each(function () {
		if ($.trim($(this).val()) == "")
		{
			$(this).addClass('errorBorder');
			check = false;
			error_msg.push("<?php echo $LANG_BLANK ?>");
		}
	});
		
	if (check) {
		if (confirm("<?php echo $LANG_CONFIRM ?>")) {
			$.ajax({
				dataType: 'json',
				type: 'POST',
				url: '?f=<?php echo $_GET['loc'] ?>',
				data: form_data + "&act=1", 
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
	} else {
		alert(jQuery.unique(error_msg).join("\n"));
		$('.errorBorder:first').focus();
	}
}

function edit_sub_category() {
	var check = true;
	var error_msg = [];
	var form_data = $('#sub_category_form').serialize();
	
	$('#sub_category_form input,select,textarea,checkbox').removeClass('errorBorder');
	$('#sub_category_form .required').each(function () {
		if ($.trim($(this).val()) == ""){
			$(this).addClass('errorBorder');
			check = false;
			error_msg.push("<?php echo $LANG_BLANK ?>");
		}
	});
		
	if (check) {
		if (confirm("<?php echo $LANG_CONFIRM ?>")) {
			$.ajax({
				dataType: 'json',
				type: 'POST',
				url: '?f=<?php echo $_GET['loc'] ?>',
				data: form_data + "&act=2", 
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
	} else {
		alert(jQuery.unique(error_msg).join("\n"));
		$('.errorBorder:first').focus();
	}
}

function delete_sub_category(product_sub_category_id){
	if (confirm("<?php echo $LANG_CONFIRM; ?>")){
		$.ajax({
			dataType: 'json',
			type: 'POST',
			url: '?f=<?php echo $_GET['loc'] ?>',
			data: {
				product_sub_category_id: product_sub_category_id,
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

function edit_display(product_sub_category_id){
	if (confirm("<?php echo $LANG_CONFIRM ?>")) {
	$.ajax({
		dataType: 'json',
		type: 'POST',
		url: '?f=<?php echo $_GET['loc'] ?>',
		data: {
			product_sub_category_id: product_sub_category_id,
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
				$('#heading').html("<?php echo $LANG_EDIT_SUB_CATEGORY; ?>"); //change title
				$('#category').val(data[1]);
				$('#sub_category_name').val(data[2]);
				$('#display').val(data[3]);
				$('#product_sub_category_id').val(data[4]);
				$('#sub_category_name_cn').val(data[5]);
			} else {
				alert(data[1]);   
			}
		}
	});
	}
}
</script>