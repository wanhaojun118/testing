<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $LANG_TITLE;?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/dropdown.css" rel = "stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
	<style>
		.dropdown-menu2{position:absolute;top:100%;left:0;z-index:1000;display:none;float:left;min-width:160px;padding:5px 0;margin:2px 0 0;font-size:14px;list-style:none;background-color:#fff;border:1px solid #ccc;border:1px solid rgba(0,0,0,0.15);border-radius:4px;-webkit-box-shadow:0 6px 12px rgba(0,0,0,0.175);box-shadow:0 6px 12px rgba(0,0,0,0.175);background-clip:padding-box}
		
		.modal{
			z-index: 99999999999999999;
			padding-top:50px;
		}
		
		.errorBorder{
			border: 1px solid red;
		}
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css"> -->
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<!--<li><a href="#"><i class="fa fa-phone"></i> +6 012-2345681 </a></li>-->
								<li><a href="#"><i class="fa fa-envelope"></i> cs@alliancesglobal.net</a></li>
							</ul>
						</div>
					</div>
					<!--<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>-->
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="?papp=home"><img src="images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<!--<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>-->
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php if(isset($member)){ ?>

								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class = "fa fa-user"></i><?php echo $LANG_GREET . $member->getMember_name();?>
									<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li>
											<a href="?papp=edit_profile" title="" ><?php echo $LANG_EDIT_PROFILE;?></a>
										</li>
										<li>
											<a href="#myModal" data-toggle="modal" title="<?php echo $LANG_CHANGE_PASSWORD;?>"><?php echo $LANG_CHANGE_PASSWORD;?></a></center>
										</li>
										<li>
											<a href="?papp=wishlist" title=""><?php echo $LANG_WISHLIST;?></a>
										</li>
									</ul>
								</li>
								
								
								<?php }else{ ?>
								<li><a href="?papp=login"><i class="fa fa-user"></i> <?php echo $LANG_ACCOUNT;?></a></li>
								<?php } ?>
								<li><a href="?papp=wishlist"><i class="fa fa-star"></i> <?php echo $LANG_WISHLIST;?></a></li>
								<li><a href="?papp=checkout"><i class="fa fa-crosshairs"></i> <?php echo $LANG_CHECKOUT;?></a></li>
								<?php
								if(isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0){
								?>
								<li><a href="?papp=cart"><i class="fa fa-shopping-cart"></i> <?php echo $LANG_CART;?> (<?php echo count($_SESSION['cart_item']);?>)</a></li>
								<?php }else{?>
								<li><a href="?papp=cart"><i class="fa fa-shopping-cart"></i> <?php echo $LANG_CART;?> </a></li>
								<?php }?>
								<?php if(isset($member)){ ?>
								<li><a href="#" onclick = "logout('<?php echo $member->getMember_id();?>')"><i class = "fa fa-lock"></i><?php echo $LANG_LOGOUT;?></a></li>
								<?php }else{ ?>
								<li><a href="?papp=login"><i class="fa fa-lock"></i> <?php echo $LANG_LOGIN;?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left hidden-lg hidden-md">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="?papp=home" class="active"><?php echo $LANG_HOME;?></a></li>
								<li class="dropdown"><a href="#"><?php echo $LANG_SHOP;?><i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										
                                        <li><a href="?papp=shop"><?php echo $LANG_PRODUCTS;?></a></li>
										<li><a href="?papp=product-details"><?php echo $LANG_PRODUCT_DETAILS;?></a></li> 
										<li><a href="?papp=checkout"><?php echo $LANG_CHECKOUT;?></a></li> 
										<li><a href="?papp=cart"><?php echo $LANG_CART;?></a></li> 
										<li><a href="?papp=login"><?php echo $LANG_LOGIN;?></a></li> 
										
                                    </ul>
                                </li> 
								<!--<li class="dropdown"><a href="#"><?php echo $LANG_BLOG;?><i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="?papp=blog"><?php echo $LANG_BLOG_LIST;?></a></li>
										<li><a href="?papp=blog-single"><?php echo $LANG_BLOG_SINGLE;?></a></li>
                                    </ul>
                                </li> 
								<li><a href="?papp=error404">404</a></li>-->
								<li><a href="?papp=contact-us"><?php echo $LANG_CONTACT;?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2" style = "float:right;">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
					<!--<div class = "col-sm-4" style = "float:right;">
						<div class = "mini-cart">
							<div class = "top-cart-title">
								<a href = "?papp=cart" class = "dropdown-toggle" data-toggle = "dropdown">
									<?php echo $LANG_YOUR_CART;?>
									<span class = "price text-center">(<?php echo count($_SESSION['cart_item']);?>)</span>
								</a>
								<div class = "dropdown-menu dropdown-menu-right" style = "transform:translateX(-110px);">
									<div class = "cart-listing">
										<?php
										if(isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0){
											$total_price = 0.00;
											foreach($_SESSION['cart_item'] as $cart_item => $value){
												$new_quantity = 0;
												$stmt_select_product = $mysqli -> prepare("SELECT product_id, product_name, product_price, product_quantity, product_image FROM product WHERE product_id = ?");
												$stmt_select_product -> bind_param('i', $_SESSION['cart_item'][$cart_item]['product_id']);
												$stmt_select_product ->execute();
												$stmt_select_product ->store_result();
												$stmt_select_product ->bind_result($product_id, $product_name, $product_price, $product_quantity, $product_image);
												$stmt_select_product ->fetch();
												$product_sub_image = explode(",", $product_image);
												
												// $stmt_select_order = $mysqli -> prepare("SELECT SUM(od.order_details_quantity) FROM `order_details` od JOIN `order` o WHERE o.order_id = od.order_details_order_id AND od.order_details_product_id = ?");
												// $stmt_select_order -> bind_param('i', $_SESSION['cart_item'][$cart_item]['product_id']);
												// $stmt_select_order -> execute();
												// $stmt_select_order -> store_result();
												// $stmt_select_order -> bind_result($order_quantity);
												// $stmt_select_order -> fetch();
												// $new_quantity = $product_quantity - $order_quantity;																													
										?>
											<div class = "media">
												<div class = "media-left col-sm-4" style = "margin-right:40px;"><a href = "#"><img src = "admin/<?php echo $product_sub_image[0];?>" class = "img-responsive" style = "float:left;" alt = ""></a></div>
												<div class = "media-body">
													<h4>
														<?php
															echo $product_name;
														?>
													</h4>
													<?php $total_each_product_price = $_SESSION['cart_item'][$cart_item]['product_quantity'] * $_SESSION['cart_item'][$cart_item]['product_price'];?>
													<div class = "mini-cart-qty"><?php echo $LANG_QTY;?>: <?php echo $_SESSION['cart_item'][$cart_item]['product_quantity'];?></div>
													<div class = "mini-cart-price"><?php echo "RM " . number_format((float)$total_each_product_price, 2, '.', '');?></div>
												</div>
											</div>
										<?php 
												$total_price += $total_each_product_price;
											}
										}
										?>
									</div> 
									<div class = "mini-cart-subtotal"><?php echo $LANG_TOTAL; ?>: <span class = "price" style = "padding:0 10px 0 90px;"><?php echo "RM " . number_format((float)$total_price, 2, '.', '');?></span></div>
									<div class = "checkout-btn">
										<a href = "?papp=cart" class = "btn btn-default btn-md fwb"><?php echo $LANG_VIEW_CART;?></a>
									
										<a href = "?papp=checkout" class = "btn btn-default btn-md fwb"><?php echo $LANG_CHECKOUT;?></a>
									
									</div>
								</div>
							</div>
						</div>
					</div>-->
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<?php include "content.php";?>
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2><?php echo $LANG_SERVICE;?></h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#"><?php echo $LANG_ONLINE_HELP;?></a></li>
								<li><a href="?papp=contact-us"><?php echo $LANG_CONTACT_US;?></a></li>
								<li><a href="#"><?php echo $LANG_ORDER_STATUS;?></a></li>
								<li><a href="#"><?php echo $LANG_CHANGE_LOCATION;?></a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2><?php echo $LANG_QUICK_SHOP;?></h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="?papp=shop">T-Shirt</a></li>
								<li><a href="?papp=shop">Mens</a></li>
								<li><a href="?papp=shop">Womens</a></li>
								<li><a href="?papp=shop">Gift Cards</a></li>
								<li><a href="?papp=shop">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2><?php echo $LANG_POLICIES;?></h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#"><?php echo $LANG_TERM_OF_USE;?></a></li>
								<li><a href="#"><?php echo $LANG_PRIVACY_POLICY;?></a></li>
								<li><a href="#"><?php echo $LANG_REFUND_POLICY;?></a></li>
								<li><a href="#"><?php echo $LANG_BILLING_SYSTEM;?></a></li>
								<li><a href="#"><?php echo $LANG_TICKET_SYSTEM;?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2><?php echo $LANG_ABOUT_SHOPPER;?></h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#"><?php echo $LANG_COMPANY_INFORMATION;?></a></li>
								<li><a href="#"><?php echo $LANG_CAREERS;?></a></li>
								<li><a href="#"><?php echo $LANG_STORE_LOCATION;?></a></li>
								<li><a href="#"><?php echo $LANG_AFFILLATE_PROGRAM;?></a></li>
								<li><a href="#"><?php echo $LANG_COPYRIGHT;?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2><?php echo $LANG_ABOUT_SHOPPER;?></h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right"><?php echo $LANG_DESIGNED_BY;?> <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
		
		<!-- Edit Password Modal -->
	<div class = "modal" id = "myModal" role = "dialog">
		<div class = "modal-dialog">
			<!-- Model content -->
			<div class = "modal-content">
				<div class = "modal-header">
					<button type = "button" id = "close" class = "close" data-dismiss = "modal" onclick = "reset_form()">&times;</button>
					<h2 class = "modal-title"><?php echo $LANG_CHANGE_PASSWORD;?></h2>
				</div>
				<div class = "modal-body" style="min-height:200px;">
					<form id = "password_form">
						<div class = "form-group">
							<label for="" class="col-sm-3 control-label"><?php echo $LANG_NEW_PASSWORD;?></label>
							<div class = "col-sm-9">
								<input type = "password" id = "new_password" class = "form-control" name = "new_password"/><br><br>
							</div>
						</div>
						<div class = "form-group">
							<label for ="" class="col-sm-3 control-label"><?php echo $LANG_CONFIRM_PASSWORD;?></label>
							<div class = "col-sm-9">
								<input type = "password" id = "confirm_password" class = "form-control" name = "confirm_password"/><br>
							</div>
						</div>
					</form>
				</div>
				<div class = "modal-footer">
					<button type = "button" id = "edit" class = "btn btn-default" style = "" onclick = "change_password()"><?php echo $LANG_SUBMIT_BTN;?></button>
					<button type = "button" class = "btn btn-default" style = "" data-dismiss = "modal" onclick = "reset_form()"><?php echo $LANG_CANCEL_BTN?></button>
				</div>
			</div>
		</div>
	</div>
		
	</footer><!--/Footer-->
	
    <script src="js/jquery.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	<script src="js/collapse.js"></script>
	<script src="js/dropdown.js"></script>
	<script src="js/bootstrap.min.js"></script>

<script>
	$(document).ready(function () {
		$("li").click(function () {
			//Toggle the child but don't include them in the hide selector using .not()
			$('li > ul').not($(this).children("ul").toggle()).hide();

		});
	});

	function logout(member_id){
		if(confirm("<?php echo $LANG_CONFIRM_LOGOUT;?>")){
			$.ajax({
				url: '?pact=logout',
				type: 'POST',
				dataType: 'json',
				data: {
					member_id: member_id
				},
				success:function(data){
					if(data){
						window.location = '?papp=home';
					}else{
						alert("error");
					}
				}
			});
		}
	}
	
	function display_profile(){
		if($(".dropdown-menu2").css('display') == 'none'){
			$(".dropdown-menu2").css('display', 'block');
		}else{
			$(".dropdown-menu2").css('display', 'none');
		}
	}
	
	function change_password(){			
		var new_password = $("#new_password").val();
		var comfirm_password = $("#confirm_password").val();
		var check = true;
		var error_msg = [];

		$("#password_form input").removeClass('errorBorder');
		$("#password_form input").each(function(){
			if($(this).val() == ""){
				$(this).addClass('errorBorder');
				error_msg.push("<?php echo $LANG_BLANK; ?>");
				check = false;
			}
		});
		if(new_password != comfirm_password){
			error_msg.push("<?php echo $LANG_PASSWORD_NOT_MATCH; ?>");
			$('#password_form')[0].reset();
			check = false;
		}
		if(check){
			$.ajax({
				url: '?pact=edit_password',
				dataType: 'json',
				type: 'POST',
				data: {
					new_password: new_password
				},
				success: function(data){
					if(data[0]){
						alert(data[1]);
						location.reload(true);
					}else{
						alert(data[1]);
					}
				}
			});	
		}else{
			alert(jQuery.unique(error_msg).join("\n"));
			$('.errorBorder:first').focus();
		}
	}
	
	function reset_form(){
		$("#password_form")[0].reset();
	}
</script>
</body>
</html>