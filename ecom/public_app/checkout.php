
<style>
	.form-group .col-sm-10{
		margin-bottom: 20px;
	}
	
	input{
		background: #F0F0E9;
		border: none;
	}
</style>


<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#"><?php echo $LANG_HOME;?></a></li>
			  <li class="active"><?php echo $LANG_CHECK_OUT;?></li>
			</ol>
		</div><!--/breadcrums-->

		<div class="step-one">
			<h2 class="heading"><?php echo $LANG_CHECKOUT_DETAILS;?></h2>
		</div>
		<!--<div class="checkout-options">
			<h3><?php echo $LANG_NEW_USER;?></h3>
			<p><?php echo $LANG_CHECKOUT_OPTIONS;?></p>
			<ul class="nav">
				<li>
					<label><input type="checkbox"> <?php echo $LANG_REGISTER_ACCOUNT;?></label>
				</li>
				<li>
					<label><input type="checkbox"> <?php echo $LANG_GUEST_CHECKOUT;?></label>
				</li>
				<li>
					<a href=""><i class="fa fa-times"></i><?php echo $LANG_CANCEL;?></a>
				</li>
			</ul>
		</div>-->
		<!--/checkout-options-->
			
		<!--<div class="register-req">
			<p><?php echo $LANG_ADVICE;?></p>
		</div>-->
		<!--/register-req-->
			
		<div class = "guest-information">
			<div class = "row">
			<?php 
				if(!isset($member)){
			?>
				<div class="col-sm-6">
					<div class="checkout-form">
						<div style="padding:15px;">
							<span style="color:red"><?php echo $LANG_LOGIN_MESSAGE;?></span><br>
							<span><?php echo $LANG_REGISTER_MESSAGE;?></span>
						</div>
					</div>
				</div>
				<?php 
					}else{
				?>
					<div class="col-sm-6">
						<table border="1" style="margin: 10px 0 20px 0">
							<tr>
								<th colspan="4" style="text-align:center;">
									<h4><?php echo $LANG_ORDER_SUMMARY;?> <?php echo "( " . count($_SESSION['cart_item']) . " " . $LANG_ITEMS . " )";?></h4>
								</th>
							</tr>
							<tr>
								<th width="25%" style="text-align:center;">
									<?php echo $LANG_PRODUCT;?>
								</th>
								
								<th width="10%" style="text-align:center;">
									<?php echo $LANG_QUANTITY;?>
								</th>
								
								<th width="30%" style="text-align:center;">
									<?php echo $LANG_UNIT_PRICE;?></span>
								</th>
								
								<th width="25%" style="text-align:center;">
									<?php echo $LANG_PRICE;?>
								</th>
							</tr>
						<?php
							$total_price = 0.00;
							$shipping_charge = 3.00;
							if(isset($_SESSION['cart_item']) && count($_SESSION[cart_item]) > 0){
								foreach($_SESSION['cart_item'] as $cart_item => $value){
									$stmt_select_product = $mysqli -> prepare("SELECT product_name, product_price, product_quantity FROM product WHERE product_id = ?");
									$stmt_select_product -> bind_param('i', $_SESSION['cart_item'][$cart_item]['product_id']);
									$stmt_select_product -> execute();
									$stmt_select_product -> store_result();
									$stmt_select_product -> bind_result($product_name, $product_price, $product_quantity);
									$stmt_select_product -> fetch();
										
									
						?>
							<tr>
								<td style="padding-left:10px;">
									<?php echo $product_name;?>
								</td>
								
								<td style="text-align:center;">
									<?php echo $_SESSION['cart_item'][$cart_item]['product_quantity'];?>
								</td>
								
								<td style="text-align:center;">
									<?php 
										if($product_rebate !="" || $product_rebate !=0){
											echo "RM ".number_format(($product_price),2,'.','');
										}else{
											echo "RM ".number_format($product_price,2,'.','');
										}
									
									
									?>
								</td>
								
								<td style="text-align:center; padding-right:10px;">
									<?php $total_each_product_price = $_SESSION['cart_item'][$cart_item]['product_quantity'] * ($_SESSION['cart_item'][$cart_item]['product_price']); ?>
									RM <?php echo number_format($total_each_product_price, 2, '.', '');?>
								</td>
							</tr>
								
						<?php
									$total_price += $total_each_product_price;
								}
							}
						?>
							<tr>
								<td colspan="3" style="padding: 10px 0 10px 10px;">
									<?php echo "<b>" . $LANG_SUBTOTAL . "</b>";?>
								</td>
								<td style="text-align:center; padding-right:10px;">
									<?php echo "RM " . number_format((float)$total_price, 2, '.', '');?>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="color:green; padding: 10px 0px 10px 10px;">
									<?php echo "<b>" . $LANG_SHIPPING_CHARGE . "</b>";?>
								</td>
								<td style="text-align: center; padding-right:10px;">
									<?php 
										echo "RM " . number_format($shipping_charge, 2, '.', ''); 
										$total_price += $shipping_charge;
									?>
								</td>
							</tr>
							
							<tr>
								<td colspan="3" style="padding-left:10px;">
									<?php echo "<h4><b>" . $LANG_TOTAL . "</b></h4>";?>
								</td>
								
								<td style="text-align: center; padding-right:10px; color:orange;">
									<h4>RM <?php echo number_format($total_price, 2, '.', '');?></h4>
								</td>	
							</tr>
							
						</table>
						<?php
						if(isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0){
						?>
						<div>
							<a href="?papp=payment" class="btn btn-primary" style="margin: 0 0 20px 0" onclick="member_checkout()"><?php echo $LANG_CHECKOUT;?></a>
						</div>
						<?php }?>
					</div>
					<?php 
						$stmt_select_member = $mysqli -> prepare("SELECT member_address, member_postcode, member_city, member_province, member_country FROM `member` WHERE member_id = ?");
						$stmt_select_member -> bind_param('i', $member->getMember_id());
						$stmt_select_member -> execute();
						$stmt_select_member -> store_result();
						$stmt_select_member -> bind_result($member_address, $member_postcode, $member_city, $member_province, $member_country);
						$stmt_select_member -> fetch();	
						
						// $stmt_select_country = $mysqli -> prepare("SELECT country_name FROM country WHERE country_id = ?");
						// $stmt_select_country -> bind_param('i', $member_country);
						// $stmt_select_country -> execute();
						// $stmt_select_country -> store_result();
						// $stmt_select_country -> bind_result($member_country_name);
						// $stmt_select_country -> fetch();
					?>
					<div class="col-sm-6">
						<div class="shipping-address">
							<form id="shipping_form" >
								<div class="form-group">
									<label for="" class="col-sm-2"  style="padding:5px;"><?php echo $LANG_ADDRESS;?>: </label>
									<div class="col-sm-10">
										<textarea rows="3" id ="member_address" name="member_address" style="height:100px; padding:5px;"><?php echo $member_address;?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label for="" class="col-sm-2" style="padding:5px;" ><?php echo $LANG_POSTCODE;?>: </label>
									<div class="col-sm-10">
										<input type="text" id="member_postcode" name="member_postcode" style="width:100%;padding:5px;" value="<?php echo $member_postcode;?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="" class="col-sm-2" style="padding:5px;"><?php echo $LANG_CITY;?>: </label>
									<div class="col-sm-10">
										<input type="text" id="member_city" name="member_city" style="width:100%; padding:5px;" value="<?php echo $member_city;?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="" class="col-sm-2" style="padding:5px;"><?php echo $LANG_STATE;?>: </label>
									<div class="col-sm-10">
										<input type="text" id="member_state" name="member_state" style="width:100%; padding:5px;" value="<?php echo $member_province;?>"/>
									</div>
								</div>
								 
								<div class="form-group">
									<label for="" class="col-sm-2" style="padding:5px;"><?php echo $LANG_COUNTRY;?>: </label>
									<div class="col-sm-10">
										<select id="member_country_country" name="member_country_country">
											<option value="">Please select country</option>
											<?php
												$stmt_select_country = $mysqli -> prepare("SELECT country_id, country_name FROM country");
												$stmt_select_country -> execute();
												$stmt_select_country -> store_result();
												$stmt_select_country -> bind_result($country_id, $country_name);
												while($stmt_select_country -> fetch()){
													if($member_country==$country_id){
											?>
											<option value = "<?php echo $country_id;?>" selected ><?php echo $country_name;?></option>
											<?php 	
													}else{
											?>
											<option value = "<?php echo $country_id;?>"><?php echo $country_name;?></option>
											<?php			
													}
												} 
											?>
										</select>
										<!-- <input type="text" id="country" name="country" style="width:100%; padding:5px;" value="<?php echo $member_country_name;?>"/> -->
									</div>
								</div>
								
							</form>
						</div>
					</div>
					<?php }?>
				</div>
			</div>
			
			<!--<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p><?php echo $LANG_SHOPPER_INFORMATION;?></p>
							<form>
								<input type="text" placeholder="Display Name">
								<input type="text" placeholder="User Name">
								<input type="password" placeholder="Password">
								<input type="password" placeholder="Confirm password">
							</form>
							<a class="btn btn-primary" href=""><?php echo $LANG_GET_QUOTES;?></a>
							<a class="btn btn-primary" href=""><?php echo $LANG_CONTINUE;?></a>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p><?php echo $LANG_BILL_TO;?></p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="Company Name">
									<input type="text" placeholder="Email*">
									<input type="text" placeholder="Title">
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Middle Name">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address 1 *">
									<input type="text" placeholder="Address 2">
								</form>
							</div>
							<div class="form-two">
								<form>
									<input type="text" placeholder="Zip / Postal Code *">
									<select>
										<option>-- <?php echo $LANG_COUNTRY;?> --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<select>
										<option>-- <?php echo $LANG_STATE;?>  --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<input type="password" placeholder="Confirm password">
									<input type="text" placeholder="Phone *">
									<input type="text" placeholder="Mobile Phone">
									<input type="text" placeholder="Fax">
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p><?php echo $LANG_SHIPPING_ORDER;?></p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> <?php echo $LANG_SHIPPING_TO_BILL_ADDRESS;?></label>
						</div>	
					</div>					
				</div>
			</div>-->
			<!-- <div class="review-payment">
				<h2><?php echo $LANG_REVIEW_AND_PAYMENT;?></h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image"><?php echo $LANG_ITEM;?></td>
							<td class="description"></td>
							<td class="price"><?php echo $LANG_PRICE;?></td>
							<td class="quantity"><?php echo $LANG_QUANTITY;?></td>
							<td class="total"><?php echo $LANG_TOTAL;?></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/one.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Colorblock Scuba</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$59</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$59</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>

						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/two.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Colorblock Scuba</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$59</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$59</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/three.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Colorblock Scuba</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$59</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$59</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td><?php echo $LANG_CART_SUB_TOTAL;?></td>
										<td>$59</td>
									</tr>
									<tr>
										<td><?php echo $LANG_ECO_TAX;?></td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td><?php echo $LANG_SHIPPING_COST;?></td>
										<td>Free</td>										
									</tr>
									<tr>
										<td><?php echo $LANG_TOTAL;?></td>
										<td><span>$61</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
				<span>
					<label><input type="checkbox"> <?php echo $LANG_DIRECT_BANK_TRANSFER;?></label>
				</span>
				<span>
					<label><input type="checkbox"> <?php echo $LANG_CHECK_PAYMENT;?></label>
				</span>
				<span>
					<label><input type="checkbox"> <?php echo $LANG_PAYPAL;?></label>
				</span>
			</div> -->
		</div>
	</section> <!--/#cart_items-->

<script>
function submit_information(){
	var name =  $("#name").val();
	var email =  $("#email").val();
	var address =  $("#address").val();
	var postcode =  $("#postcode").val();
	var city =  $("#city").val();
	var province =  $("#province").val();
	var phone = $("#phone").val();
	
	var check = true;
	var error_msg = [];
	var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
	
	$("#guest-form").removeClass("errorBorder");
	$("#phone").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).addClass("errorBorder");
			check = false;
			error_msg.push("<?php echo $LANG_PHONE_BLANK;?>");
		}
	});
	
	$("#province").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).addClass("errorBorder");
			check = false;
			error_msg.push("<?php echo $LANG_PROVINCE_BLANK;?>");
		}
	});
	
	$("#city").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).addClass("errorBorder");
			check = false;
			error_msg.push("<?php echo $LANG_CITY_BLANK;?>");
		}
	});
	
	$("#postcode").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).addClass("errorBorder");
			check = false;
			error_msg.push("<?php echo $LANG_POSTCODE_BLANK;?>");
		}
	});
	
	$("#address").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).css('border', '');
			$(this).addClass("errorBorder");
			check = false;
			error_msg.push("<?php echo $LANG_ADDRESS_BLANK;?>");
		}
	});
	
	$("#email").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).addClass("errorBorder");
			check = false;
			error_msg.push("<?php echo $LANG_EMAIL_BLANK;?>");
		}else{
			if(!pattern.test($(this).val())){
				$(this).addClass("errorBorder");
				error_msg.push("<?php echo $LANG_INVALID_EMAIL_FORMAT;?>")
				check = false;
			}
		}
	});
	
	$("#name").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).addClass("errorBorder");
			check = false;
			error_msg.push("<?php echo $LANG_NAME_BLANK;?>");
		}
	});
	
	if(check){
		$.ajax({
			url: '?pact=checkout',
			type: 'POST',
			dataType: 'json',
			data: {
				name: name,
				email: email,
				address: address,
				postcode: postcode,
				city: city,
				province: province,
				phone: phone,
				act: 1
			},
			success:function(data){
				if(data[0]){
					window.location = '?papp=payment';
				}else{
					alert(data[1]);
				}
			}
		});
	}else{
		alert($.unique(error_msg).join("\n\n"));
	}
}

function member_checkout(){
	$.ajax({
		url: '?pact=checkout',
		type: 'POST',
		dataType: 'json',
		data: {
			act: 2
		},
		success:function(data){
			if(data[0]){
				window.location = '?papp=payment';
			}else{
				alert(data[1]);
			}
		}
	});
}

function checkout(){
	var check = true;
	var error_msg = [];
	
	var member_address = $('#member_address').val();
	var member_postcode = $('#member_postcode').val();
	var member_country = $('#member_country').val();
	var member_state = $('#member_state').val();
	var member_city = $('#member_city').val();
	
	$('#shipping_form input,select,textarea').removeClass('errorBorder');
	$('#shipping_form .required').each(function () {
		if ($.trim($(this).val()) == ""){
			$(this).addClass('errorBorder');
			check = false;
			error_msg.push("<?php echo $LANG_BLANK ?>");
		}
	});
	
	if(check){
		if(confirm("<?php echo $LANG_CONFIRM;?>")){
			$.ajax({
				url:'?f=checkout',
				type:'POST',
				dataType:'json',
				data:$('#shipping_form').serialize(),
				success:function(data){
					if(data[0]){
						alert(data[1]);
						location.reload();
					}else{
						alert(data[1]);
					}
				}
			});
		}
	}else{
		alert(jQuery.unique(error_msg).join("\n"));
		$('.errorBorder:first').focus();
	}
	
}

</script>
