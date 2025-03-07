<?php
	 require('top.php');
	?>

       <section class="ftr__product__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Best Seller</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product__list clearfix mt--30">
							<?php
							$get_product=get_product($con,'','','','','','yes');
							foreach($get_product as $list){
							?>
                            <!-- Start Single Category -->
                            <div class="col-md-3 col-lg-4 col-sm-3 col-xs-12">
                            <div class="category" style="
    box-shadow: 0px 0px 1px #525252;
    width: 310px;
    ">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img src="../ecom/media/product_images/<?php echo $list['image']?>" alt="product images"style="width: 310px;height: 400px;">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info">
										<ul class="product__action">
                                        <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><i class="icon-heart icons"></i></a></li>
                                        <li><a href="product.php?id=<?php echo $list['id']?>"><i class="icon-handbag icons"></i></a></li></ul>
									</div>
                                    <div class="fr__product__inner"style="width: 310px;height: 108px;">
                                        <h4 ><a style="font-weight: 400;
                                        font-size: 17px;"href="product.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a>
                                        <ul class="fr__pro__prize"style="font-weight: 400;
                                        font-size: 17px;">
                                            <li class="old__prize"style="color:black;"><i class="fa fa-inr"></i></li>
                                            <li><?php echo $list['price']?></li>
                                        </ul>
                                         </h4>
                                        <a href="product.php?id=<?php echo $list['id']?>" class="btn" style="border:solid 2px #777; background: none; color:#777; padding:5px 10px ; display: block; text-align: center; clear: both; width: 50%; margin-top: 7px; font-weight: 600; font-family=Maven+Pro; border-radius:0px;}
                                            ">Rent Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Category -->
							<?php } ?>
                        </div>
                </div>
            </div>
        </section>
       
		<?php
	 require('footer.php');?>