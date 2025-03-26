<?php 
require('top.php');
$str=mysqli_real_escape_string($con,$_GET['str']);
if($str!=''){
	$get_product=get_product($con,'','','',$str);
}else{
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}										
?>

        <div class="ht__bradcaump__area" >
 <div class="container" style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px;">
                        <div class="col-xs-5">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i>/</i></span>
                                  <span class="breadcrumb-item active"> Search  </span>
                                  <span class="brd-separetor"><i>/</i></span>
                                  <span class="breadcrumb-item active"><?php echo $str?></span>
                                </nav>
                        </div>
                </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
                <?php if(count($get_product)>0){?>
                      <div class="col-md-11">
                        <div class="htc__product">
                            <!-- Start Product View -->
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                        <!-- Start Single Product -->
                                        <?php 
							foreach($get_product as $list){
							?>
                            <div class="col-md-4 col-lg-4 col-sm-3 col-xs-18">
                            <div class="category" style="
    box-shadow: 0px 0px 2px rgb(0, 0, 0);
    width: 270px;
   
    ">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img src="../WAH/media/product_images/<?php echo $list['image']?>" alt="product images" style=" width: 270px;height: 400px;border: 1px solid gray;border-bottom: none;">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info">
										<ul class="product__action">
										<li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><i class="icon-heart icons"></i></a></li>
											<li><a href="product.php?id=<?php echo $list['id']?>"><i class="icon-handbag icons"></i></a></li>
										</ul>
									</div>
                                    <div class="fr__product__inner"style="width: 270px;height: 108px;">
                                        <h4><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize"><i class="fa fa-inr"></i>
                                            <li><?php echo $list['price']?></li>
                                        </ul>
                                        <a href="product.php?id=<?php echo $list['id']?>" class="btn" style="border:solid 2px #777; background: none; color:#777; padding:5px 10px ; display: block; text-align: center; clear: both; width: 50%; margin-top: 7px; font-weight: 600; font-family=Maven+Pro; border-radius:0px;}
">Rent Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Category -->
							<?php  }?>
   <!-- End Single Product -->
                             </div>
                            </div>
                        </div>
                    </div>
			   </div>
					<?php }
					 else
					 {
						 echo "data not found";
					 }?>
            </div>
                    </div>
           
        </section>
        <!-- End Product Grid -->
        <!-- End Banner Area -->
		<input type="hidden" id="qty" value="1"/>
<?php require('footer.php')?>        