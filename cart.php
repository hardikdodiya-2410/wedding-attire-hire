<?php 
require('top.php');
// unset($_SESSION['cart']);

if(!isset($_SESSION['USER_LOGIN'])){
?>
<script>
    window.location.href='login.php';
</script>
<?php
}
?>

<div class="ht__bradcaump__area" >
                <div class="container" style="height:100px; widht:100%; padding:30px 20px;">
                        <div class="col-xs-5">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">shopping cart</span>
                                </nav>

                        </div>

                </div>

        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--0 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <p id="field_error" class="field_error"></p>
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table style= " ">
                                    <thead>
                                        
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Rental Dates</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										if(isset($_SESSION['cart'])){
											foreach($_SESSION['cart'] as $key=>$val){
                                                foreach($val as $key1=>$val1){


                                                    $resAttr=mysqli_fetch_assoc(mysqli_query($con,"select product_attributes.*,color_master.color,size_master.size from product_attributes 
	left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
	left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
	where product_attributes.id='$key1'"));
// prx($resAttr);

                                            $productArr=get_product($con,'','',$key,'','','','',$key1);
											$pname=$productArr[0]['name'];
											$mrp=$productArr[0]['mrp'];
											$price=$productArr[0]['price'];
											$image=$productArr[0]['image'];
											$qty=$val1['qty'];
                                            $rent_from = $val1['rent_from'];
                                            $rent_to = $val1['rent_to'];
											?>
											<tr>
												<td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$image?>"> </a></td>
												<td class="product-name"><a href="#"><?php echo $pname?></a>
                                                    
                                                <br>
                                                <?php
                                                    if(isset($resAttr['color']) && $resAttr['color']!=''){
                                                        echo "<span class='product-name'>Color: </span>";
                                                        echo "<span style='font-weight:600;color:".$resAttr['color']."'class='product-name'>".$resAttr['color']."</span>";
                                                    }
                                                    if(isset($resAttr['size']) && $resAttr['size']!=''){
                                                        echo "<br><span class='product-name'>Size: </span>";
                                                        echo "<span class='product-name'> ".$resAttr['size']."</span>";
                                                    }
                                                   ?>

                                                    <ul  class="pro__prize">
														<li class="old__prize"><i class="fa fa-inr"></i>
														<li><?php echo $price?></li>
													</ul>
												</td>
                                          
                                                   
                                       
												<td class="product-price"><i class="fa fa-inr"></i><span class="amount"><?php echo $price?></span></td>
												<td class="product-quantity"><input type="number" min="1" id="<?php echo $key?>qty" value="<?php echo $qty?>" style="text-align:center;" />
                                                <br>
												<br/><a href="javascript:void(0)" onclick="manage_cart_update('<?php echo $key?>','update','<?php echo $resAttr['size_id']?>','<?php echo $resAttr['color_id']?>')" class="btn" style="padding: 5px; background: #f5efef; margin-top: 5px; color: rgb(33, 33, 33); box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .26); text-transform: capitalize; font-family: 'Poppins', sans-serif;">update</a>
												</td>
												
                                                <td>
                                                    
                                                    <?php
                                                    // Calculate number of rental days
                                                    $date1 = new DateTime($rent_from);
                                                    $date2 = new DateTime($rent_to);
                                                    $interval = $date1->diff($date2);
                                                    $days = $interval->days + 1; // Add 1 to include both start and end dates
                                                    $days = $days-2;
                                                    ?>
                                                    <?php
											if(isset($val1['rent_from']) && isset($val1['rent_to'])){
												echo "	<label>From:</label> <a class='product-name'>".date('d M Y', strtotime($val1['rent_from']))."</a><br>";
												echo "	<label>To:</label> <a class='product-name'>".date('d M Y', strtotime($val1['rent_to']))."</a><br>";
												}
										?>
                                        <label>Total Days:</label>
                                        <a href="#"><?php echo $days?></a><br>
                                                </td>
                                                <td class="product-subtotal"><i class="fa fa-inr"></i><?php echo $qty*$price*$days?></td>
												<td class="product-remove">
													<a href="javascript:void(0)" onclick="manage_cart_update('<?php echo $key?>','remove','<?php echo $resAttr['size_id']?>','<?php echo $resAttr['color_id']?>')"><i class="icon-trash icons"></i></a>
												</td>
                                               
                                            
                                            </tr>
                                         
											<?php } } } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="index.php">Continue Shopping</a>
                                        </div>
                                        <?php
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
?>
    <div class="buttons-cart checkout--btn">
        <a href="checkout.php">checkout</a>
    </div>
<?php
}
?>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="cid" />
        <input type="hidden" id="pid" />
        <input type="hidden" id="sid" />
										
<?php require('footer.php')?>        

<script>
function manage_cart_update(pid, type, size_id, color_id) {
    var qty = (type === 'update') ? jQuery("#" + pid + "qty").val() : 0;
    jQuery.ajax({
        url: 'manage_cart.php',
        type: 'post',
        data: {
            pid: pid,
            qty: qty,
            type: type,
            sid: size_id,
            cid: color_id
        },
        success: function(result) {
            console.log(result);
            if (result.status === 'not_avaliable') {
                alert('Quantity not available');
            } else if (result.status === 'max_qty_reached') {
                alert('Maximum quantity reached');
                jQuery("#" + pid + "qty").val(result.productQty);
            } else {
                window.location.href = 'cart.php';
            }
        }
    });
}
</script>        