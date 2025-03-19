<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}


$order_id=get_safe_value($con,$_GET['id']);

$coupon_details=mysqli_fetch_assoc(mysqli_query($con,"select coupon_value from `order` where id='$order_id'"));
$coupon_value=$coupon_details['coupon_value'];
if($coupon_value==''){
	$coupon_value=0;	
}
?>
<div class="ht__bradcaump__area" >
<div class="container" style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px;">
                        <div class="col-xs-5">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i>/</i></span>
                                  <span class="breadcrumb-item active"> My order Details</span>
                                </nav>
                        </div>
                </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Product Name</th>
												<th class="product-thumbnail">Product Image</th>
                                                <th class="product-name">Qty</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-price">Rental Days</th>
                                                <th class="product-price">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$uid=$_SESSION['USER_ID'];
											//$res=mysqli_query($con,"SELECT order_detail.id, order_detail.*, product.name, product.image, MAX(product_attributes.qty) AS qty FROM order_detail JOIN `order` ON order_detail.order_id = `order`.id JOIN product ON order_detail.product_id = product.id LEFT JOIN product_attributes ON product_attributes.product_id = product.id WHERE order_detail.order_id = $order_id AND `order`.user_id = $uid GROUP BY order_detail.id");                              
                                            $res=mysqli_query($con,"select distinct(order_detail.id) ,order_detail.*,product.name,product.image from order_detail,product ,`order` where order_detail.order_id='$order_id' and `order`.user_id='$uid' and order_detail.product_id=product.id");
											
                                            $total_price=0;
                                           
											while($row=mysqli_fetch_assoc($res)){
                                          
											$total_price=$total_price+($row['qty']*$row['price']*$row['rental_days']);  
											?>
                                            
                                            <tr>
												<td class="product-name"><?php echo $row['name']?></td>
                                                <td class="product-name"> <img src="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$row['image']?>"></td>
												<td class="product-name"><?php echo $row['qty']?></td>
												<td class="product-name"><?php echo $row['price']?></td>
                                                <td class="product-name"><?php echo $row['rental_days']?> days</td>
												<td class="product-name"><?php echo   number_format($row['qty'] * $row['price'] * $row['rental_days'], 2, '.', ',')?></td>
                                                
                                            </tr>
                                            
                                            <?php } 
											if($coupon_value!=''){
											?>
											<tr>
												<td colspan="4"></td>
												<td class="product-name">Coupon Value</td>
												<td class="product-name"><?php echo $coupon_value?></td>
                                                
                                            </tr>
											<?php } ?>
											<tr>
												<td colspan="4"></td>
												<td class="product-name">Total Price</td>
												<td class="product-name">
												<?php 
												echo   number_format($total_price - $coupon_value, 2, '.', ',');
												?></td>
                                                
                                            </tr>
                                        </tbody>
                                        
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        						
<?php require('footer.php')?>        