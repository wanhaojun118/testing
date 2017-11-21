<!DOCTYPE>
<html>
<head>
<style>
	.col-sm-12 {
		margin-bottom: 15px;
	}
	
	#cards:hover,
	#online-banking:hover,
	#paypal:hover,
	i:hover {
		cursor: pointer;
	}
	
	#submit:hover {
		background: burlywood;
	}
</style>
</head>

<body>
<div class = "container">
	<div class = "row">
		<div class = "left-col col-sm-6" style = "margin: 0 0 30px 0;">
			<table width = "100%" border = "1">
				<tr>
					<td colspan = "3" style = "padding: 0 10px 0 10px;">
					<h4><?php echo $LANG_PAYMENT_OPTION;?></h4>
					</td>
				</tr>
				<tr>
					<td id = "cards" width = "30%" align = "center" onclick = "show_cards()">
						<h5><?php echo $LANG_CREDIT_OR_DEBIT;?></h5>
					</td>
					<td id = "online-banking" width = "30%" align = "center" onclick = "show_online_banking()">
						<h5><?php echo $LANG_ONLINE_BANKING;?></h5>
					</td>
					<td id = "paypal" width = "30%" align = "center" onclick = "show_paypal()">
						<h5><?php echo $LANG_USE_PAYPAL;?></h5>
					</td>
				</tr>
				<tr>
					<td colspan = "3" id = "column-cards">
						<form id = "card-payment-form">
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_CARD_NUMBER;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "card_number" name = "card_number" value = "" onkeypress = "return event.charCode >= 48 && event.charCode <= 57"/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_CARD_NAME;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "card_name" name = "card_name" value = ""/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_EXPIRY_DATE;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "month" name = "month" value = "" placeholder = "MM" style = "width: 10%;"/>
									<input type = "text" id = "year" name = "year" value = "" placeholder = "YY" style = "width: 10%;"/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_CCV_CVV;?> <i class = "fa fa-question-circle"></i></label>
								<div class = "col-sm-12">
									<input type = "text" id = "ccv_cvv" name = "ccv_cvv" value = "" onkeypress ="return event.charCode >= 48 && event.charCode <= 57"/>
								</div>
							</div>
							
							<div class = "form-group">
								<div class = "col-sm-12">
									<input type = "button" class = "btn btn-primary" id = "submit" name = "submit" value = "<?php echo $LANG_PLACE_YOUR_ORDER;?>" />
								</div>
							</div>
						</form>
					</td>
					
					<td colspan = "3" id = "column-online-banking" style = "display:none;">
						<form id = "card-payment-form">
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_CARD_NUMBER;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "card_number" name = "card_number" value = "" onkeypress = "return event.charCode >= 48 && event.charCode <= 57"/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_CARD_NAME;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "card_name" name = "card_name" value = ""/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_EXPIRY_DATE;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "month" name = "month" value = "" placeholder = "MM" style = "width: 10%;"/>
									<input type = "text" id = "year" name = "year" value = "" placeholder = "YY" style = "width: 10%;"/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_CCV_CVV;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "ccv_cvv" name = "ccv_cvv" value = "" onkeypress ="return event.charCode >= 48 && event.charCode <= 57"/>
								</div>
							</div>
							
							<div class = "form-group">
								<div class = "col-sm-12">
									<input type = "button" class = "btn btn-primary" id = "submit" name = "submit" value = "<?php echo $LANG_PLACE_YOUR_ORDER;?>" />
								</div>
							</div>
						</form>
					</td>
					
					<td colspan = "3" id = "column-paypal" style = "display:none;">
						<form id = "card-payment-form">
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_CARD_NUMBER;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "card_number" name = "card_number" value = "" onkeypress = "return event.charCode >= 48 && event.charCode <= 57"/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_CARD_NAME;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "card_name" name = "card_name" value = ""/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_EXPIRY_DATE;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "month" name = "month" value = "" placeholder = "MM" style = "width: 10%;"/>
									<input type = "text" id = "year" name = "year" value = "" placeholder = "YY" style = "width: 10%;"/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = "" class = "col-sm-3 control-label"><?php echo $LANG_CCV_CVV;?></label>
								<div class = "col-sm-12">
									<input type = "text" id = "ccv_cvv" name = "ccv_cvv" value = "" onkeypress ="return event.charCode >= 48 && event.charCode <= 57"/>
								</div>
							</div>
							
							<div class = "form-group">
								<div class = "col-sm-12">
									<input type = "button" class = "btn btn-primary" id = "submit" name = "submit" value = "<?php echo $LANG_PLACE_YOUR_ORDER;?>" />
								</div>
							</div>
						</form>
					</td>
				</tr>
			</table>
		</div>
		<div class = "right-col col-sm-6">
			<div class = "row">
				<div class = "shipping-information col-sm-12">
					<table border = "1">
						<tr>
							<th style = "padding:0 10px 0 10px;">
								<h4><?php echo $LANG_SHIPPING_AND_BILLING_ADDRESS;?></h4>
							</th>
						</tr>
						
							<?php
								if(isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0){
									if(isset($member)){
										$stmt_select_member = $mysqli -> prepare("SELECT member_name, member_email FROM member WHERE member_id = ?");
										$stmt_select_member -> bind_param('i', $member->getMember_id());
										$stmt_select_member -> execute();
										$stmt_select_member -> store_result();
										$stmt_select_member -> bind_result($member_name, $member_email);
										$stmt_select_member -> fetch();
									}else{
										$stmt_select_guest = $mysqli -> prepare("SELECT guest_name, guest_email, guest_address, guest_postcode, guest_city, guest_province FROM guest WHERE guest_id = ?");
										$stmt_select_guest -> bind_param('i', $_SESSION['guest_id']);
										$stmt_select_guest -> execute();
										$stmt_select_guest -> store_result();
										$stmt_select_guest -> bind_result($guest_name, $guest_email, $guest_address, $guest_postcode, $guest_city, $guest_province);
										$stmt_select_guest -> fetch();
									}
								}
							?>
						<tr>
							<td style = "padding: 0 10px 0 10px;">
								<?php 
									if(isset($member)){
								?>
										<h5><b><?php echo $member_name;?></b></h5>
										<h5><?php echo $member_email;?></h5>
										<!-- <h5><?php echo $guest_address . ", " . $guest_postcode . " " . $guest_city . ", " . $guest_province . ".";?></h5> -->
								<?php 
									}else{
								?>
										<h5><b><?php echo $guest_name;?></b></h5>
										<h5><?php echo $guest_email;?></h5>
										<h5><?php echo $guest_address . ", " . $guest_postcode . " " . $guest_city . ", " . $guest_province . ".";?></h5>
								<?php
									}
								?>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class = "row">
				<div class = "order-summary col-sm-12">
					<table border = "1">
						<tr>
							<th colspan = "3" style = "padding-left:10px;">
								<h4><?php echo $LANG_ORDER_SUMMARY;?> <?php echo "( " . count($_SESSION['cart_item']) . " " . $LANG_ITEMS . " )";?></h4>
							</th>
						</tr>
						<tr>
							<th width = "25%" style = "text-align:center;">
								<?php echo $LANG_PRODUCT;?>
							</th>
							
							<th width = "10%" style = "text-align:center;">
								<?php echo $LANG_QUANTITY;?>
							</th>
							
							<!-- <th width = "30%" style = "text-align:center;">
								<?php echo $LANG_STANDARD_DELIVERY;?><br><span style = "color:red;"> (YY-MM-DD)</span>
							</th> -->
							
							<th width = "25%" style = "text-align:center;">
								<?php echo $LANG_PRICE;?>
							</th>
						</tr>
					<?php
						$total_price = 0.00;
						$shipping_charge = 3.00;
						if(isset($_SESSION['cart_item']) && count($_SESSION[cart_item]) > 0){
							foreach($_SESSION['cart_item'] as $cart_item => $value){
								$stmt_select_product = $mysqli -> prepare("SELECT product_name, product_price, product_rebate, product_quantity FROM product WHERE product_id = ?");
								$stmt_select_product -> bind_param('i', $_SESSION['cart_item'][$cart_item]['product_id']);
								$stmt_select_product -> execute();
								$stmt_select_product -> store_result();
								$stmt_select_product -> bind_result($product_name, $product_price, $product_rebate, $product_quantity);
								$stmt_select_product -> fetch();
								
								// if(isset($member)){
									// $stmt_select_buy_member = $mysqli -> prepare("SELECT buy_earliest_delivery_date, buy_latest_delivery_date FROM buy WHERE buy_member_id = ? AND buy_product_id = ?");
									// $stmt_select_buy_member -> bind_param('ii', $_SESSION['member_id'], $_SESSION['cart_item'][$cart_item]['product_id']);
									// $stmt_select_buy_member -> execute();
									// $stmt_select_buy_member -> store_result();
									// $stmt_select_buy_member -> bind_result($earliest_delivery_date, $latest_delivery_date);
									// $stmt_select_buy_member -> fetch();
									// $earliest = explode(" ", $earliest_delivery_date);
									// $latest = explode(" ", $latest_delivery_date);
								// }else{
									// $stmt_select_buy = $mysqli -> prepare("SELECT buy_earliest_delivery_date, buy_latest_delivery_date FROM buy WHERE buy_guest_id = ? AND buy_product_id = ?");
									// $stmt_select_buy -> bind_param('ii', $_SESSION['guest_id'], $_SESSION['cart_item'][$cart_item]['product_id']);
									// $stmt_select_buy -> execute();
									// $stmt_select_buy -> store_result();
									// $stmt_select_buy -> bind_result($earliest_delivery_date, $latest_delivery_date);
									// $stmt_select_buy -> fetch();
									// $earliest = explode(" ", $earliest_delivery_date);
									// $latest = explode(" ", $latest_delivery_date);
								// }
								$stmt_select_product = $mysqli -> prepare("SELECT p.product_name, p.product_quantity, p.product_price, p.product_rebate FROM `product` p JOIN `buy` b WHERE p.product_id = b.buy_product_id");
								$stmt_select_product -> execute();
								$stmt_select_product -> store_result();
								$stmt_select_product -> bind_result($product_name, $product_quantity, $product_price, $product_rebate);
									
								
					?>
						<tr>
							<td style = "padding-left:10px;">
								<?php echo $product_name;?>
							</td>
							
							<td style = "text-align:center;">
								<?php echo $_SESSION['cart_item'][$cart_item]['product_quantity'];?>
							</td>
							
							<!-- <td style = "text-align:center;">
								<?php echo $earliest[0] . " ~ " . $latest[0];?>
							</td> -->
							
							<td style = "text-align:right; padding-right:10px;">
								<?php $total_each_product_price = $_SESSION['cart_item'][$cart_item]['product_quantity'] * ($_SESSION['cart_item'][$cart_item]['product_price'] - $_SESSION['cart_item'][$cart_item]['product_rebate']); ?>
								RM <?php echo number_format((float)$total_each_product_price, 2, '.', '');?>
							</td>
						</tr>
							
					<?php
								$total_price += $total_each_product_price;
							}
						}
					?>
						<tr>
							<td colspan = "2" style = "padding: 10px 0 10px 10px;">
								<?php echo "<b>" . $LANG_SUBTOTAL . "</b>";?>
							</td>
							<td style = "text-align: right; padding-right: 10px;">
								<?php echo "RM " . number_format((float)$total_price, 2, '.', '');?>
							</td>
						</tr>
						
						<tr>
							<td colspan = "2" style = "color:green; padding: 10px 0 10px 10px;">
								<?php echo "<b>" . $LANG_SHIPPING_CHARGE . "</b>";?>
							</td>
							<td style = "text-align: right; padding-right:10px;">
								<?php echo "RM " . number_format((float)$shipping_charge, 2, '.', ''); $total_price += $shipping_charge;?>
							</td>
						</tr>
						
						<tr>
							<td colspan = "2" style = "padding-left:10px;">
								<?php echo "<h4><b>" . $LANG_TOTAL . "</b></h4>";?>
							</td>
							
							<td style = "text-align: right; padding-right:10px; color:orange;">
								<h4>RM <?php echo number_format((float)$total_price, 2, '.', '');?></h4>
							</td>	
						</tr>
						
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function show_online_banking(){
	$("#column-cards").css('display', 'none');
	$("#column-paypal").css('display', 'none');
	$("#column-online-banking").css('display', 'table-cell');
}

function show_paypal(){
	$("#column-cards").css('display', 'none');
	$("#column-paypal").css('display', 'table-cell');
	$("#column-online-banking").css('display', 'none');
}

function show_cards(){
	$("#column-cards").css('display', 'table-cell');
	$("#column-paypal").css('display', 'none');
	$("#column-online-banking").css('display', 'none');
}
</script>
</body>
</html>