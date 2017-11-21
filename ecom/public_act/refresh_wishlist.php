<!DOCTYPE>
</html>
</body>
<thead>
	<tr class = "wishlist-menu">
		<td class = "image"><?php echo $LANG_ITEM;?></td>
		<td class = "description"></td>
		<td class = "price"><?php echo $LANG_PRICE;?></td>
		<td class = "add-cart"></td>
		<td class = "remove"></td>
	</tr>
</thead>
<tbody>
	<?php 
		if(isset($_SESSION['wishlist_item']) && count($_SESSION['wishlist_item']) > 0){
			$total_price = 0.00;
			foreach($_SESSION['wishlist_item'] as $wishlist_item => $value){
				$stmt_select_product = $mysqli -> prepare("SELECT product_id, product_name, product_price, product_quantity, product_image FROM product WHERE product_id = ?");
				$stmt_select_product -> bind_param('i', $_SESSION['wishlist_item'][$wishlist_item]['product_id']);
				$stmt_select_product -> execute();
				$stmt_select_product -> store_result();
				$stmt_select_product -> bind_result($product_id, $product_name, $product_price, $product_quantity, $product_image);
				$stmt_select_product -> fetch();
				$product_sub_image = explode(",", $product_image);
	?>
	<tr>
		<td class = "wishlist_product">
			<img src = "admin/<?php echo $product_sub_image[0];?>" style = "width:150px;height:150px;" alt = ""/>
		</td>
		<td class = "wishlist_description">
			<h4><?php echo $product_name;?></h4>
		</td>
		<td class = "wishlist_price">
			<h4><?php echo "RM ". number_format($_SESSION['wishlist_item'][$wishlist_item]['product_price'], 2, '.', '');?></h4>
		</td>
		<td class = "wishlist_add_cart">
			<a class = "btn btn-primary" onclick =" add_cart("<?php echo $product_id . ',' . $product_price . ',' . $product_quantity;?>")"><?php echo $LANG_ADD_CART;?></a>
		</td>
		<td class = "wishlist_remove">
			<a class = "btn-remove" onclick =" remove_item("<?php echo $product_id;?>")"><span class = "fa fa-trash-o"></span></a>
		</td>
	</tr>
	<?php 
			}
		}else{
	?>
	<tr>
		<td colspan = 5 class = "text-center"><?php echo $LANG_EMPTY_WISHLIST;?></td>
	</tr>
	<?php } ?>
</tbody>

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
	
	