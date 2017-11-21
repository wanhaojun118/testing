<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>
						
					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>Free E-Commerce Template</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
								<img src="images/home/pricing.png"  class="pricing" alt="" />
							</div>
						</div>
						<div class="item">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>100% Responsive Design</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
								<img src="images/home/pricing.png"  class="pricing" alt="" />
							</div>
						</div>						
						<div class="item">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>Free Ecommerce Template</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
								<img src="images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>	
					</div>
						
					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>		
			</div>
		</div>
	</div>
</section><!--/slider-->
	
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
						<h2><?php echo $LANG_CATEGORY;?></h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							<?php
								$stmt_select_category = $mysqli->prepare("SELECT product_category_id,product_category_name,product_category_name_cn FROM product_category WHERE product_category_is_display =1");
								$stmt_select_category ->execute();
								$stmt_select_category ->store_result();
								$stmt_select_category ->bind_result($product_category_id,$product_category_name,$product_category_name_cn);
								while($stmt_select_category ->fetch()){
							?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo strtolower(str_replace(' ', '_', $product_category_name));?>">
												<span class="badge pull-right"><i class="fa fa-plus"></i></span>
												<?php 
													if($language == 'en'){
														echo $product_category_name;
													}else{
														echo $product_category_name_cn;
													}
												?>
											</a>
										</h4>
									</div>
									<?php
										$stmt_select_sub_category = $mysqli->prepare("SELECT product_sc_id,product_sc_name,product_sc_name_cn FROM product_sub_category WHERE product_sc_product_category_id=? AND product_sc_is_display=1");
										$stmt_select_sub_category ->bind_param('i',$product_category_id);
										$stmt_select_sub_category ->execute();
										$stmt_select_sub_category ->store_result();
										$stmt_select_sub_category ->bind_result($product_sc_id,$product_sc_name,$product_sc_name_cn);
										if($stmt_select_sub_category ->num_rows >0){
									?>
										<div id="<?php echo strtolower(str_replace(' ', '_', $product_category_name)); ?>" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
									<?php
											while($stmt_select_sub_category ->fetch()){
												if($language == 'en'){
													echo '<li><a href="#">'.$product_sc_name.'</a></li>';
												}else{
													echo '<li><a href="#">'.$product_sc_name_cn.'</a></li>';
												}
											}
									?>
												</ul>
											</div>
										</div>
									<?php
										}
									?>
									
								</div>
							<?php		
								}
							?>
							
							
							<!--<div class="panel panel-default">
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
											<li><a href="#">Fendi</a></li>
											<li><a href="#">Guess</a></li>
											<li><a href="#">Valentino</a></li>
											<li><a href="#">Dior</a></li>
											<li><a href="#">Versace</a></li>
											<li><a href="#">Armani</a></li>
											<li><a href="#">Prada</a></li>
											<li><a href="#">Dolce and Gabbana</a></li>
											<li><a href="#">Chanel</a></li>
											<li><a href="#">Gucci</a></li>
										</ul>
									</div>
								</div>
							</div>-->

							<!--<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Kids</a></h4>
								</div>
							</div>-->
					
						</div><!--/category-products-->
						<!--brands_products-->
						<!--<div class="brands_products">
							<h2><?php echo $LANG_BRANDS;?></h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div>
						<!--/brands_products-->
						
						<!--price-range-->
						<!--<div class="price-range">
							<h2><?php echo $LANG_PRICE_RANGE;?></h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div>
						<!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><?php echo $LANG_FEATURED_ITEMS;?></h2>
						
						<?php
							$stmt_select_product = $mysqli -> prepare("SELECT product_id, product_name, product_price, product_image, product_quantity FROM product WHERE product_is_display = 1");
							$stmt_select_product -> execute();
							$stmt_select_product -> store_result();
							$stmt_select_product -> bind_result($product_id, $product_name, $product_price, $product_image, $product_quantity);
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
										<!--<a class = "btn btn-default add-to-cart" onclick = "add_cart(<?php echo $product_id . ',' . $product_price. ',' . $product_quantity;?>)"><i class = "fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>-->
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
								<?php if($member){ ?>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a onclick="add_wishlist(<?php echo $product_id . ',' . $product_price;?>)" style="cursor:pointer"><i class = "fa fa-plus-square"></i><?php echo $LANG_ADD_TO_WISHLIST;?></a></li>
										<!--<li><a href=""><i class = "fa fa-plus-square"></i><?php echo $LANG_ADD_TO_COMPARE;?></a></li>-->
									</ul>
								</div>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
						
						<!-- <div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="images/home/product1.jpg" alt="" />
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
										<li><a href="#"><i class="fa fa-plus-square"></i><?php echo $LANG_ADD_TO_WISHLIST;?></a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i><?php echo $LANG_ADD_TO_COMPARE;?></a></li>
									</ul>
								</div>
							</div>
						</div> -->
						
						
					</div><!--features_items-->
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
								<li><a href="#blazers" data-toggle="tab">Blazers</a></li>
								<li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
								<li><a href="#kids" data-toggle="tab">Kids</a></li>
								<li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<?php
								// $stmt_select_category = $mysqli->prepare("SELECT product_category_id,product_category_name,product_category_name_cn FROM product_category WHERE product_category_is_display =1");
								// $stmt_select_category -> execute();
								// $stmt_select_category -> store_result();
								// $stmt_select_category -> bind_result($product_category_id,$product_category_name,$product_category_name_cn);
								// while($stmt_select_category -> fetch();{
							?>
							<div class="tab-pane fade active in" id="tshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
								<?php //} ?>
							<div class="tab-pane fade" id="blazers" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
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
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
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
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="sunglass" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
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
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
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
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="kids" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
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
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
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
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
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
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="poloshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
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
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
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
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center"><?php echo $LANG_RECOMMENDED_ITEMS;?></h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?php echo $LANG_ADD_TO_CART;?></a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
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

function add_wishlist(id, price){
	var product_quantity = 1;
	if(product_quantity < 1){
		alert("<?php echo $LANG_QUANTITY_NOT_AVAILABLE; ?>");
	}else{
		$.ajax({
			url: '?pact=add_wishlist',
			type: 'POST',
			dataType: 'json',
			data: {
				id: id,
				price: price,
				product_quantity: product_quantity
			},
			success:function(data){
				if(data[0]){
					alert(data[1]);
				}else{
					alert(data[1]);
				}
			}
		});
	}
}
</script>
	