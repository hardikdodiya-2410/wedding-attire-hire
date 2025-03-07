<?php 
require('top.php');

if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$uid=$_SESSION['USER_ID'];

if(isset($_GET['id']))
{
    $wid=$_GET['id'];
    mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid'");
}

$res=mysqli_query($con,"select product.name,product.image,product.id as pid,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'");
?>


        <div class="ht__bradcaump__area" >
		<div class="container" style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px;">
                        <div class="col-xs-5">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i>/</i></span>
                                  <span class="breadcrumb-item active"> Wishlist  </span>
                                </nav>
                        </div>
                </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                            <th class="product-name">Remove</th>
										
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										while($row=mysqli_fetch_assoc($res)){
                                            
										?>
											<tr>
												<td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$row['image']?>"style="
    height: 220px;
    width: 220px;
"  /></a></td>
												<td class="product-name"><a href="#"><?php echo $row['name']?></a>
													<ul  class="pro__prize">
											
														<!-- <li><?php echo $row['price']?> </li> -->
													</ul>
												</td>
											<?php  $p_id=$row['pid'];?>
                                         
                                           <?php $res_id=mysqli_query($con,"SELECT product_id FROM `wishlist`where product_id= $p_id");?>
                                           
                                                <td class="product-remove"><a href="wishlist.php?w_id=<?php echo $row['id']?>"><i class="icon-trash icons"></i></a></td>


											</tr>
											<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="<?php echo SITE_PATH?>">Continue Shopping</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        
		<input type="hidden" id="qty" value="1"/>						
<?php require('footer.php')?>        