<!DOCTYPE html>
<html lang="en">

<body>
	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2><?php echo $LANG_CATEGORY;?></h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Sportswear
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Nike </a></li>
											<li><a href="">Under Armour </a></li>
											<li><a href="">Adidas </a></li>
											<li><a href="">Puma</a></li>
											<li><a href="">ASICS </a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Mens
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
											<li><a href="">Armani</a></li>
											<li><a href="">Prada</a></li>
											<li><a href="">Dolce and Gabbana</a></li>
											<li><a href="">Chanel</a></li>
											<li><a href="">Gucci</a></li>
										</ul>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Womens
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Kids</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Fashion</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Households</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Interiors</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Clothing</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Bags</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Shoes</a></h4>
								</div>
							</div>
						</div><!--/category-productsr-->
					
						<div class="brands_products"><!--brands_products-->
							<h2><?php echo $LANG_BRANDS;?></h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2><?php echo $LANG_PRICE_RANGE;?></h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><?php echo $LANG_FEATURED_ITEMS;?></h2>
						
						<?php
							$stmt_select_product = $mysqli -> prepare("SELECT product_id, product_name, product_price, product_rebate, product_image, product_quantity FROM product WHERE product_display = 1");
							$stmt_select_product -> execute();
							$stmt_select_product -> store_result();
							$stmt_select_product -> bind_result($product_id, $product_name, $product_price, $product_rebate, $product_image, $product_quantity);
							while($stmt_select_product -> fetch()){
								$product_sub_image = explode(",", $product_image);
						?>
						
						<div class = "col-sm-4">
							<div class = "product-image-wrapper">
								<div class = "single-products">
									<div class = "productinfo text-center">
										<img src = "admin/<?php echo $product_sub_image[0];?>" style = "width:250px;height:250px;" alt = "" /><br><br>
										<p><b><?php echo $product_name;?></b></p>
										<?php if($product_rebate > 0){ ?>
										<h4><strike style = "color:red">RM <?php echo number_format($product_price, 2, '.', '');?></strike></h4>
										<h4>RM <?php echo number_format(($product_price - $product_rebate), 2, '.', '');?></h4>
										<?php }else{?>
										<h4>RM <?php echo number_format(($product_price), 2, '.', '');?></h4>
										<?php } ?>
										<!-- <a class = "btn btn-default add-to-cart" onclick = "add_cart(<?php echo $product_id . ',' . $product_price. ',' . $product_quantity;?>)"><i class = "fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a> -->
									</div>
									<div class = "product-overlay">
										<div class = "overlay-content">
											<p><?php echo $product_name;?></p>
											<h4>RM <?php echo number_format((float)$product_price - $product_rebate, 2, '.', '');?></h4>
											<a class = "btn btn-default add-to-cart" onclick = "add_cart(<?php echo $product_id . ',' . $product_price. ',' . $product_quantity;?>)"><i class = "fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a><br>
											<a href = "?papp=product-details&id=<?php echo $product_id;?>" class = "btn btn-default add-to-cart"><i class = "fa fa-search"></i><?php echo $LANG_VIEW;?></a>
										</div>
									</div>
								</div>
								<div class = "choose">
									<ul class = "nav nav-pills nav-justified">
										<li><a href = ""><i class = "fa fa-plus-square"></i><?php echo $LANG_ADD_TO_WISHLIST;?></a></li>
										<!-- <li><a href = ""><i class = "fa fa-plus-square"></i><?php echo $LANG_ADD_TO_COMPARE;?></a></li> -->
									</ul>
								</div>
							</div>
						</div>
						<?php } ?>
						
						
						<!-- <div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="images/shop/product12.jpg" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i><?php echo $LANG_ADD_TO_WISHLIST;?></a></li>
										<li><a href=""><i class="fa fa-plus-square"></i><?php echo $LANG_ADD_TO_COMPARE;?></a></li>
									</ul>
								</div>
							</div>
						</div> -->
						
						
						<ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
<script>
function add_cart(id, price, max_quantity){
	var quantity = 1;
	if(quantity > max_quantity || quantity < 1){
		alert("<?php echo $LANG_QUANTITY_NOT_AVAILABLE;?>");
	}else{
		$.ajax({
			url: '?pact=add_cart',
			type: 'post',
			dataType: 'json',
			data:{
				id: id,
				price: price,
				quantity: quantity
			},
			success:function(data){
				if(data[0]){
					$('#cart_number').html(data[1]);
					alert("<?php echo $LANG_ADD_CART_SUCCESSFUL;?>");
					location.reload(true);
				}else{
					alert("Add to cart failed");
				}
			}
		});
	}
}
</script> 



</body>
</html>