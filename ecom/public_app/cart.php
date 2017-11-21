<style>
	a:hover{
		cursor:pointer;
	}
</style>

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<div class = "continue-shopping" style = "float: right;">
					<a href = "?papp=home"><span>< <?php echo $LANG_CONTINUE_SHOPPING;?></span></a>
				</div>
				<ol class="breadcrumb">
				  <li><a href="?papp=home"><?php echo $LANG_HOME;?></a></li>
				  <li class="active"><?php echo $LANG_SHOPPING_CART;?></li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed" id = "cart_table">
					<thead>
						<tr class="cart_menu">
							<td class="image"><?php echo $LANG_ITEM;?></td>
							<td class="description"></td>
							<td class="price"><?php echo $LANG_PRICE;?></td>
							<td class="quantity"><?php echo $LANG_QUANTITY;?></td>
							<td class="total" ><?php echo $LANG_TOTAL;?></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php 
						if(isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0){
							$total_price = 0.00;
							foreach ($_SESSION['cart_item'] as $cart_item => $value){
								//$new_quantity = 0;
								$stmt_select_product = $mysqli -> prepare("SELECT product_id, product_name, product_price, product_quantity, product_image FROM product WHERE product_id = ?");
								$stmt_select_product -> bind_param('i', $_SESSION['cart_item'][$cart_item]['product_id']);
								$stmt_select_product -> execute();
								$stmt_select_product -> store_result();
								$stmt_select_product -> bind_result($product_id, $product_name, $product_price, $product_quantity, $product_image);
								$stmt_select_product -> fetch();
								$product_sub_image = explode(",", $product_image);
								
								// $stmt_select_order = $mysqli -> prepare("SELECT SUM(od.order_details_quantity) FROM `order_details` od JOIN `order` o WHERE o.order_id = od.order_details_order_id AND od.order_details_product_id = ?");
								// $stmt_select_order -> bind_param('i', $_SESSION['cart_item'][$cart_item]['product_id']);
								// $stmt_select_order -> execute();
								// $stmt_select_order -> store_result();
								// $stmt_select_order -> bind_result($order_quantity);
								// $stmt_select_order -> fetch();
								// $new_quantity = $product_quantity - $order_quantity;
						?>
						
						<tr>
							<td class = "cart_product">
								<img src = "admin/<?php echo $product_sub_image[0];?>" style = "width:150px;height:150px;" alt = ""/>
							</td>	
							<td class = "cart_description">
								<h4><?php echo $product_name;?></h4>
							</td>
							<td class = "cart_price">
								<p><?php echo "RM " . number_format($_SESSION['cart_item'][$cart_item]['product_price'], 2, '.', '');?></p>
							</td>
							<td class = "cart_quantity">
								<div class = "cart_quantity_button">
									<a class = "cart_quantity_up" onclick = "add_quantity('<?php echo $product_id;?>')"> + </a>
									<input class = "cart_quantity_input" type = "text" id = "<?php echo $product_id;?>" name = "quantity" value = "<?php echo $_SESSION['cart_item'][$cart_item]['product_quantity'];?>" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" autocomplete = "off" size = "2">
									<a class = "cart_quantity_down" onclick = "substract_quantity(<?php echo $product_id;?>)"> - </a>
								</div>
							</td>
							<td class = "cart_total">
								<?php $total_each_product_price = $_SESSION['cart_item'][$cart_item]['product_quantity'] * ($_SESSION['cart_item'][$cart_item]['product_price']);?>
								<?php echo "RM " . number_format((float)$total_each_product_price, 2, '.', '');?>
							</td>
							<td class = "cart_delete">
								<a class = "btn-remove" onclick = remove_item("<?php echo $product_id ;?>")><span class = "fa fa-trash-o"></span></a>
							</td>
						</tr>
						<?php 
								$total_price += $total_each_product_price;
							}
						}else{
						?>
						<tr>
							<td colspan=5 class = "text-center"><?php echo $LANG_EMPTY_CART;?></td>
						</tr>
						<?php 
						}
						?>
					</tbody>
				</table>
			</div>
			<?php 
			if(isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0){
			?>
			<div class = "row">
				<div class = "checkout col-sm-8">
					<a href = "?papp=checkout" type = "button" class = "btn btn-primary" id = "checkout" name = "checkout">Checkout</a>	
				</div>
				<div class = "total col-sm-4">
					<h3><?php echo $LANG_TOTAL;?>: <span id = "total_price" style = "float:right; color: orange;"><?php echo "RM " . number_format((float)$total_price, 2, '.', '');?></span></h3>
				</div>
			</div>
			<?php }?>
		</div>
	</section> <!--/#cart_items-->

<!--	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3><?php echo $LANG_ACTION;?></h3>
				<p><?php echo $LANG_CHOICE;?></p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label><?php echo $LANG_USE_COUPON_CODE;?></label>
							</li>
							<li>
								<input type="checkbox">
								<label><?php echo $LANG_USE_GIFT_VOUCHER;?></label>
							</li>
							<li>
								<input type="checkbox">
								<label><?php echo $LANG_ESTIMATE_SHIPPING_AND_TAXES;?></label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label><?php echo $LANG_COUNTRY;?></label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label><?php echo $LANG_REGION_OR_STATE;?></label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label><?php echo $LANG_ZIP_CODE;?></label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href=""><?php echo $LANG_GET_QUOTES;?></a>
						<a class="btn btn-default check_out" href=""><?php echo $LANG_CONTINUE;?></a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li><?php echo $LANG_CART_SUB_TOTAL;?> <span><?php echo $total_each_product_price;?></span></li>
							<li><?php echo $LANG_ECO_TAX;?> <span></span></li>
							<li><?php echo $LANG_SHIPPING_COST;?> <span></span></li>
							<li><?php echo $LANG_TOTAL;?> <span></span></li>
						</ul>
							<a class="btn btn-default update" href=""><?php echo $LANG_UPDATE;?></a>
							<?php if(isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0){ ?>
							<a class="btn btn-default check_out" href="?papp=checkout"><?php echo $LANG_CHECK_OUT;?></a>
							<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>-->
<!--/#do_action-->
<script>

function remove_item(id){
	if(confirm("<?php echo $LANG_CONFIRM;?>")){
		$.ajax({
			url: '?pact=remove_cart',
			type: 'post',
			dataType: 'json',
			data: {
				id: id
			},
			success:function(data){
				if(data[0]){
					$("#cart_number").html(data[1]);
					refresh_item();
					//refresh_price();
				}else{
					alert(data[1]);
					//swal(data[1]);
				}
			}
		});
	}
}

function refresh_item(){
	$.ajax({
		url: '?pact=refresh_cart',
		type: 'post',
		data: {
			act: 1
		},
		success: function(data){
			$("#cart_table").html(data);
			location.reload(true);
		}
	});
}

function refresh_price(){
	$.ajax({
		url: '?pact=refresh_cart',
		type: 'post',
		data: {
			act: 2
		},
		success: function(data){
			if(data == 0.00){
				$("#total_price").html(data);
			}else{
				$("#total_price").html(data);
			}location.reload(true);
		}
	});
}

function add_quantity(product_id){
	var quantity = $(".cart_quantity").find('#' + product_id).val();
	quantity++;
	$(".cart_quantity").find('#' + product_id).val(quantity);
	
	$.ajax({
		url: '?pact=manage_quantity',
		type: 'POST',
		dataType: 'json',
		data: {
			product_id: product_id,
			quantity: quantity,
			act:1
		},
		success:function(data){
			//location.reload(true);
			refresh_price();
		}
	});
}

function substract_quantity(product_id){
	var quantity = $(".cart_quantity").find('#' + product_id).val();
	if(quantity == 1){
		$(".cart_quantity").find('#' + product_id).val(quantity);
	}else{
		quantity--;
		$(".cart_quantity").find('#' + product_id).val(quantity);
	}
	
	$.ajax({
		url: '?pact=manage_quantity',
		type: 'POST',
		dataType: 'json',
		data:{
			product_id: product_id,
			quantity: quantity,
			act: 2
		},
		success:function(data){
			//location.reload(true);
			refresh_price();
		}
	});
}
</script>
