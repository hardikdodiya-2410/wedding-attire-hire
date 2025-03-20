<?php
	 require('top.php');
	?>

<section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">New Arrivals</h2>
                       
                </div>
            </div>
        </div>
        <div class="htc__product__container">
            <div class="row">
                <div class="product__list clearfix mt--30">
                    <?php
                        $get_product = get_product($con, '6',);
                        foreach ($get_product as $list) {
                    ?>
                    <div class="col-md-4 col-lg-4 col-sm-3 col-xs-18">
                                <div class="category" style="box-shadow: 0 2px 4px rgba(0,0,0,0.1); width: 100%; margin-bottom: 30px;">
                                    <div class="ht__cat__thumb" style="position: relative; overflow: hidden;">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img src="../ecom/media/product_images/<?php echo $list['image']?>" alt="<?php echo htmlspecialchars($list['name'])?>" 
                                                style="width: 100%; height: 500px; object-fit: cover; transition: transform 0.3s ease;">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0; transition: opacity 0.3s ease;">
                                        <ul class="product__action" style="list-style: none; padding: 0;">
                                            <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')" 
                                                style="background: white; padding: 10px; border-radius: 50%; margin: 5px;">
                                                <i class="icon-heart icons"></i></a></li>
                                            <li><a href="product.php?id=<?php echo $list['id']?>" 
                                                style="background: white; padding: 10px; border-radius: 50%; margin: 5px;">
                                                <i class="icon-handbag icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="fr__product__inner" style="padding: 15px; background: white;">
                                        <h4 style="margin: 0 0 10px 0; font-size: 16px;">
                                            <a href="product.php?id=<?php echo $list['id']?>" style="color: #333; text-decoration: none;">
                                                <?php echo htmlspecialchars($list['name'])?>
                                            </a>
                                        </h4>
                                        <ul class="fr__pro__prize" style="list-style: none; padding: 0; margin-bottom: 15px;">
                                            <li style="font-size: 18px; color: #333;">
                                                <i class="fa fa-inr"></i> <?php echo number_format($list['price'], 2, '.', ',') ?>
                                            </li>
                                        </ul>
                                        <a href="product.php?id=<?php echo $list['id']?>" 
                                            class="btn" 
                                            style="border: 2px solid #333; 
                                                background: none; 
                                                color: #333; 
                                                padding: 8px 20px; 
                                                display: inline-block; 
                                                text-align: center; 
                                                text-decoration: none;
                                                font-weight: 600; 
                                                transition: all 0.3s ease;
                                                width: auto;">
                                            RENT NOW
                                        </a>
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
			   </div>
				
                    </div>
                    </section>
        <!-- End Category Area -->
        <!-- End Product Area -->
            
		<?php
	 require('footer.php');?>