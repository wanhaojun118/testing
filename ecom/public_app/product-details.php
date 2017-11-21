


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
						</div><!--/category-products-->
					
						<!-- <div class="brands_products">
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
						</div> -->
						
						<!-- <div class="price-range">
							<h2><?php echo $LANG_PRICE_RANGE;?></h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div> -->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<?php
							$id = $_GET['id'];
							$stmt_select_product = $mysqli -> prepare("SELECT product_name, product_price, product_description, product_image, product_quantity FROM product WHERE product_id = ?");
							$stmt_select_product -> bind_param('i', $id);
							$stmt_select_product -> execute();
							$stmt_select_product -> store_result();
							$stmt_select_product -> bind_result($product_name, $product_price, $product_description, $product_image, $product_quantity);
							$stmt_select_product -> fetch();
							$product_sub_image = explode(",", $product_image);
							
						?>
						<div class="col-sm-5">
							<div class="view-product">
								<img src= "admin/<?php echo $product_sub_image[0];?>" alt="" />
								<h3><?php echo $LANG_ZOOM;?></h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
							
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<?php 
										for($i = 0; $i < count($product_sub_image); $i++){
											if($i<1){
												echo '<div class = "item active">';
												echo '<a href = ""><img src = "admin/' . $product_sub_image[$i] . '"' . 'alt = ""/></a>';
												echo '</div>';
											} else {
												echo '<div class = "item">';
												echo '<a href = ""><img src = "admin/' . $product_sub_image[$i] . '"' . 'alt = ""/></a>';
												echo '</div>';
											} 
										}
										?>
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?php echo $product_name;?></h2>
								<p><?php echo html_entity_decode($product_description);?></p>
								<img src="images/product-details/rating.png" alt="" /><br>
								<span>
									<span> <?php echo display_currency(number_format((float)$product_price, 2, '.', ''));?></span>
									<label><?php echo $LANG_QUANTITY;?></label>
									<input type="text" id = "quantity" value="1" />
									<button type="button" class="btn btn-fefault cart" onclick = "add_cart(<?php echo $id . ',' . $product_price. ',' . $product_quantity;?>)">
										<i class="fa fa-shopping-cart"></i>
										<?php echo $LANG_ADD_TO_CART;?>
									</button>
								</span>
								<div class = "Shipping Fee">
									<span>
										<label><?php echo $LANG_SHIPPING_FEE;?>: </label>
										<p><?php echo $LANG_WEST_MALAYSIA;?>: , <?php echo $LANG_EAST_MALAYSIA;?>: , <?php echo $LANG_CHINA;?>: </p>
									</span>
								</div>
								<p>
									<b><?php echo $LANG_AVAILABILITY;?>: </b> 
									<?php 
									if($product_quantity > 0){
										echo $LANG_IN_STOCK;
									}else{
										echo $LANG_OUT_OF_STOCK;
									}
									 
									?>
								</p>
								
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<!-- <div class="category-tab shop-details-tab"> --><!--category-tab-->
						<!-- <div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab"><?php echo $LANG_DETAILS;?></a></li>
								<li><a href="#companyprofile" data-toggle="tab"><?php echo $LANG_COMPANY_PROFILE;?></a></li>
								<li><a href="#tag" data-toggle="tab"><?php echo $LANG_TAG;?></a></li>
								<li class="active"><a href="#reviews" data-toggle="tab"><?php echo $LANG_REVIEWS;?> (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b><?php echo $LANG_WRITE_YOUR_REVIEW;?></b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b><?php echo $LANG_RATING;?> </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											<?php echo $LANG_SUBMIT;?>
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div> --><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Recommended Items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php
									$i = 1;
									$stmt_select_recommended_product = $mysqli -> prepare("SELECT product_name, product_price, product_image, product_quantity FROM product");
									$stmt_select_recommended_product -> execute();
									$stmt_select_recommended_product -> store_result();
									$stmt_select_recommended_product -> bind_result($product_name, $product_price, $product_image, $product_quantity);
									while($stmt_select_recommended_product -> fetch()){
										$product_sub_image = explode(",", $product_image);
								?>
									<div class = "item active">
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="admin/<?php echo $product_sub_image[0];?>" alt="" />
														<h2><?php echo "RM " . number_format((float)$product_price, 2, '.', '');?></h2>
														<p><?php echo $product_name;?></p>
														<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class = "item">
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="admin/<?php echo $product_sub_image[0];?>" alt="" />
														<h2><?php echo "RM " . number_format((float)$product_price, 2, '.', '');?></h2>
														<p><?php echo $product_name;?></p>
														<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></button>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php }?>
							</div>
									
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
	
<script>
function add_cart(id, price, max_quantity){
	var quantity = $("#quantity").val();
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
