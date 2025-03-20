<?php
	 require('top.php');
	?>
<head>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
        }

        .pagination>.active>a,
        .pagination>.active>span,
        .pagination>.active>a:hover,
        .pagination>.active>span:hover,
        .pagination>.active>a:focus,
        .pagination>.active>span:focus {
            z-index: 3;
            color: #fff;
            background-color: #337ab7;
            border-color: #000000;
            cursor: default
        }

        .pagination>li>a,
        .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            line-height: 1.42857143;
            text-decoration: none;
            color: black;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-left: -1px
        }
    </style>
</head>

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
							$items_per_page = 3;
							$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
							$offset = ($page - 1) * $items_per_page;
							
							$get_product = get_product($con,'','','','','','yes');
							$total_products = count($get_product);
							$total_pages = ceil($total_products / $items_per_page);
							
							// Get products for current page
							$current_products = array_slice($get_product, $offset, $items_per_page);
							
							foreach($current_products as $list){
							?>
                            <!-- Start Single Category -->
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
							<?php } ?>
                        </div>
                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pagination text-center" style="margin: 30px 0;">
                                    <?php if($total_pages > 1) { ?>
                                        <ul class="pagination" style="display: inline-block; padding-left: 0; margin: 20px 0; border-radius: 4px;">
                                            <?php if($page > 1) { ?>
                                                <li style="display: inline;">
                                                    <a href="?page=<?php echo $page-1; ?>" style="float: left; padding: 8px 16px; text-decoration: none; border: 1px solid #ddd; margin: 0 4px;">Previous</a>
                                                </li>
                                            <?php } ?>
                                            
                                            <?php for($i = 1; $i <= $total_pages; $i++) { ?>
                                                <li style="display: inline;">
                                                    <a href="?page=<?php echo $i; ?>" style="float: left; padding: 8px 16px; text-decoration: none; border: 1px solid #ddd; margin: 0 4px; <?php echo ($i == $page) ? 'background-color:rgb(0, 0, 0); color: white;' : ''; ?>">
                                                        <?php echo $i; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            
                                            <?php if($page < $total_pages) { ?>
                                                <li style="display: inline;">
                                                    <a href="?page=<?php echo $page+1; ?>" style="float: left; padding: 8px 16px; text-decoration: none; border: 1px solid #ddd; margin: 0 4px;">Next</a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
		<?php
	 require('footer.php');?>