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
                            <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="category" style="box-shadow: 0 2px 4px rgba(0,0,0,0.1); width: 100%; margin-bottom: 30px; text-align: left;">
                                    <div class="ht__cat__thumb" style="position: relative; overflow: hidden;">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img src="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH . $list['image'] ?>" alt="<?php echo htmlspecialchars($list['name'])?>" 
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
                                    <div class="fr__product__inner" style="padding: 15px; background: white; text-align: left">
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
                <?php }}
					 else
					 {
						 echo "<img src='download.jpeg' style='width:300px;height:300px;'>";
					 }?>
            </div>
                    </div>
           
        </section>
        <!-- End Product Grid -->
        <!-- End Banner Area -->
		<input type="hidden" id="qty" value="1"/>
<?php require('footer.php')?>        