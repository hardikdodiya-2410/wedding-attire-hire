<?php
ob_start();
 require('top.php');

// get
$product_id=mysqli_real_escape_string($con,$_GET['id']);
$get_product=get_product($con,'','',$product_id);

$size_id='';

$qty_id='';

$qty='';
  
  if(isset($_POST['add_to_cart']))
  {
     echo" <script> alret('add') </script>";
  }

//   $resMultipleImages=mysqli_query($con,"select product_images from product_images where product_id='$product_id'");
// 	$multipleImages=[];
// 	if(mysqli_num_rows($resMultipleImages)>0){
// 		while($rowMultipleImages=mysqli_fetch_assoc($resMultipleImages)){
// 			$multipleImages[]=$rowMultipleImages['product_images'];
// 		}
// 	}
$images_query = $con->query("SELECT * FROM product_images WHERE product_id = $product_id");
$images = [];
while ($row = $images_query->fetch_assoc()) {
    $images[] = PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$row['product_images'];
}
	
if(isset($_POST['review_submit'])){
	$rating=get_safe_value($con,$_POST['rating']);
	$review=get_safe_value($con,$_POST['review']);
	
	$added_on=date('Y-m-d h:i:s');
	mysqli_query($con,"insert into product_review(product_id,user_id,rating,review,status,added_on) values('$product_id','".$_SESSION['USER_ID']."','$rating','$review','1','$added_on')");
	header('location:product.php?id='.$product_id);
	die();
}


$product_review_res=mysqli_query($con,"select users.name,product_review.id,product_review.rating,product_review.review,product_review.added_on from users,product_review where product_review.status=1 and product_review.user_id=users.id and product_review.product_id='$product_id' order by product_review.added_on desc");

$resAttr=mysqli_query($con,"select product_attributes.*,color_master.color,size_master.size from product_attributes 
	left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
	left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
	where product_attributes.product_id='$product_id'");
	$productAttr=[];
	$colorArr=[];
	$sizeArr=[];
	if(mysqli_num_rows($resAttr)>0){
		while($rowAttr=mysqli_fetch_assoc($resAttr)){
			$productAttr[]=$rowAttr;
			$colorArr[$rowAttr['color_id']][]=$rowAttr['color'];
			$sizeArr[]=$rowAttr['size'];
            $colorArr1[]=$rowAttr['color'];
		}
	}
    // echo "<pre>";
    // print_r($productAttr);  
	$is_size=count(array_filter($sizeArr));
	$is_color=count(array_filter($colorArr1));
	// $colorArr=array_unique($colorArr);
	// $sizeArr=array_unique($sizeArr);

	
?>
        <!-- Start Bradcaump area -->
        <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .product-container {
            display: flex;
            gap: 20px;
        }
        .main-image {
            width: 400px;
            height: 400px;
            overflow: hidden;
            position: relative;
        }
        .main-image img {
            width: 100%;
            transition: transform 0.3s ease-in-out;
        }
        .thumbnails {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .thumbnails img {
            width: 80px;
            height: 80px;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .thumbnails img:hover, .thumbnails img.active {
            border: 2px solid #000;
        }
        #color_attr:hover, #color_attr.active {
            border: 2px solid #000;
        }
      #color_attr{
      border-radius: 50%;
      }
      #color_attr:active{
        border-color: #000;
      }
    
    </style>
   
</head>
<body>
        <div class="ht__bradcaump__area">
         
                <div class="container" style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px;">
                  
                    <div class="col-xs-12 col-xs-15">
                                 <nav class="bradcaump-inner" style="float:left">
                                  <span class="breadcrumb-item active" style="font-size:23px; text-transform:uppercase;"><?php echo $get_product['0']['name']?></span>
                                </nav>
                                <nav class="bradcaump-inner" style="float:right">
                                  <a style="opacity:0.5"class="breadcrumb-item" href="categories.php?id=<?php echo $get_product['0']['categories_id']?>"><?php echo $get_product['0']['categories']?></a>
                                  <span class="brd-separetor"style="opacity:0.5"><i>/</i></span>
                                  <span class="breadcrumb-item active"><?php echo $get_product['0']['name']?></span>
                                </nav>
                        </div>
                </div>
          
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Details Area -->
 
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-lg-4 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content" style="display: flex; gap: 10px;">
                                    <div class="main-image">
                                    <img id="mainImage" src="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$get_product['0']['image']?>">
                                        </div>
										
										<div class="thumbnails">
        <?php foreach ($images as $img) { ?>
            <img class="thumb" src="<?php echo $img; ?>" onclick="changeImage('<?php echo $img; ?>')">
        
        <?php } ?>
        
    </div>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-8 col-sm-18 col-xs-18 smt-40 xmt-40">
                           <form method="post">
                           <div class="product-det"style=" background: #f9f9f9;
    padding: 10px 15px 10px;
    max-height: 100px!important;
    margin-bottom: 10px;
    position: relative;">
                                <div class="col-md-9" style="padding:0 10px">
                                    <h2 style="    font-size: 24px;
    color: #333;
    margin: 0;
    letter-spacing: 0;
    line-height: 25px;
}"><?php echo $get_product['0']['name']?><br>
                                        <span style="  font-size:12px;"><?php echo $get_product['0']['short_desc']?></span>
                                    </h2>
                                            					               	</div>
                                 <div class="col-md-3" style="padding:0 10px">
                                 	<div class="price">
<!--                                                  <span  style="font-size: 25px"><?//php echo number_format($price,2)?></span>-->
<!--                                                   <span>Rent</span> <br />-->
                                     <div class="product-price txt-xl text-right" style="line-height:20px">
                                       <i class="fa fa-inr" style="color:black;font-weight: 300;
"></i><span class="border-tb p-tb-10" id="rent-amount-calculated-show">  <?php echo $get_product['0']['price']?>  </span>Rent <br>  <span style="font-size:12px; color:#999; padding-right:5px">Inclusive all taxes</span>
                                      </div>
                                                 
                                                 <!--<span1>No Security Deposit
                                                 <a id="c-fiiting" href="#" data-toggle="modal" data-target="#image">
                                                 <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                              </a>-->
                                              
                                   </div>
                                 </div>
                                 <div class="clearfix"></div>
                           </div>
                            <div class="ht__product__dtl">

                            <div class="ht__pro__desc">
									<?php 
									$cart_show='yes';
									$is_cart_box_show="hide";
									if($is_color==0 && $is_size==0){
										$is_cart_box_show="";
									}
									?>
                                    <div class="sin__desc">
                                        <?php
                                       $getProductAttr=getProductAttr($con,$get_product['0']['id']);
									
                                       $productSoldQtyByProductId=productSoldQtyByProductId($con,$get_product['0']['id'],$getProductAttr);
                                    
                                       $pending_qty = $get_product['0'] ['qty']- $productSoldQtyByProductId;
                                      // $pending_qty = max(0, $pending_qty);
                  
                                     if($is_color>0){?>
                                    <div class="sin__desc align--left">
										<p><span>color:</span></p>
										<ul class="pro__color">
											<?php 
											foreach($colorArr as $key=>$val){
												echo "<li style='background:".$val[0]." none repeat scroll 0 0'id='color_attr'><a href='javascript:void(0)'  onclick=loadAttr('".$key."','".$get_product['0']['id']."','color')>".$val[0]."</a></li>";
											}
											?>
											
										</ul>
									</div>
                                    <?php } ?>
                                    <?php if($is_size>0){?>
                                  <div class="sin__desc align--left">
										<p><span>size</span></p>
										<select class="select__size" id="size_attr" onchange="showQty()">
											<option value="">Size</option>
											<?php 
											foreach($sizeArr as $key=>$val){
												echo "<option value='".$key."'>".$val[0]."</option>";
											}
											?>
										</select>
									</div>
                                    <?php } ?>
                                    <?php
									$isQtyHide="hide";
									if($is_color==0 && $is_size==0){
										$isQtyHide="";
									}
									?>
									
									
									<div class="sin__desc align--left <?php echo $isQtyHide?>" id="cart_qty">
                                        <p><span>Qty:</span> 
										<select id="qty"  class="select__size ">
											<?php
											for($i=1;$i<=$pending_qty;$i++){
												echo "<option>$i</option>";
											}
											?>
										</select>
										</p>
										
                                    </div>
									<span style="color: red; margin-left: 10px; font-size: 20px; font-weight: 600;"><div id="cart_attr_msg"></div></span>
									
                                    	
									
                                    <div class="sin__desc align--left" style="    padding-left:15px;">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="#"><?php echo $get_product['0']['categories']?></a></li>
                                        </ul>
                                    </div>
                                    <div id="is_cart_box_show" class="<?php echo $is_cart_box_show?>">
                                    <div class="contact-btn"style="margin-top: 15px;     padding: 10px 15px 10px;">
                               
                                        <a class="fr__btn" name="add_to_cart"href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')">Add to cart</a>
                                       
                                    <?php if(isset($_SESSION['USER_LOGIN'])){
                    ?>
                                    <a class="fr__btn" name="add_to_cart"href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add','yes')">Buy now</a>
                                  <?php } ?>
                                </div>
                      
                                    <p id="field_error" class="field_error"></p>
                                </form> 
                                    </div>
                                    <div id="social_share_box">
									<a href="https://facebook.com/share.php?u=<?php echo $meta_url?>"><img src='images/icons/facebook.png'/></a>
									<a href="https://twitter.com/share?text=&url=<?php echo $meta_url?>"><img src='images/icons/twitter.png'/></a>
									<a href="https://api.whatsapp.com/send?text=<?php echo $meta_url?>"><img src='images/icons/whatsapp.png'/></a>
								</div>
                                </div>
                            </div>
</form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
        </section>
        <input type="hidden" id="cid"/>
		<input type="hidden" id="sid"/>
        <!-- End Product Details Area -->
		 <!-- Start Product Description -->
         <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Start List And Grid View -->
                        <ul class="pro__details__tab" role="tablist">
                            <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
							<li role="presentation" class="review"><a href="#review" role="tab" data-toggle="tab" class="active show" aria-selected="true">review</a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <?php echo $get_product['0']['description']?>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            
							<div role="tabpanel" id="review" class="pro__single__content tab-pane fade active show">
                                <div class="pro__tab__content__inner">
                                    <?php 
									if(mysqli_num_rows($product_review_res)>0){
									
									while($product_review_row=mysqli_fetch_assoc($product_review_res)){
									?>
									
									<article class="row">
										<div class="col-md-12 col-sm-12">
										  <div class="panel panel-default arrow left">
											<div class="panel-body">
											  <header class="text-left">
												<div><span class="comment-rating"> <?php echo $product_review_row['rating']?></span> (<?php echo $product_review_row['name']?>)</div>
												<time class="comment-date"> 
<?php
$added_on=strtotime($product_review_row['added_on']);
echo date('d M Y',$added_on);
?>
												
												
												
												</time>
											  </header>
											  <div class="comment-post">
												<p>
												  <?php echo $product_review_row['review']?>
												</p>
											  </div>
											</div>
										  </div>
										</div>
									</article>
									<?php } }else { 
										echo "<h3 class='submit_review_hint'>No review added</h3><br/>";
									}
									?>
									
									
                                    <h3 class="review_heading">Enter your review</h3><br/>
									<?php
									if(isset($_SESSION['USER_LOGIN'])){
									?>
									<div class="row" id="post-review-box" style=>
									   <div class="col-md-12">
										  <form action="" method="post">
											 <select class="form-control" name="rating" required>
												  <option value="">Select Rating</option>
												  <option>Worst</option>
												  <option>Bad</option>
												  <option>Good</option>
												  <option>Very Good</option>
												  <option>Fantastic</option>
											 </select>	<br/>
											 <textarea class="form-control" cols="50" id="new-review" name="review" placeholder="Enter your review here..." rows="5"></textarea>
											 <div class="text-right mt10" style="
    margin: 10px;
">
												<button class="fv-btn" type="submit" name="review_submit">Submit</button>
											 </div>
										  </form>
									   </div>
									</div>
									<?php } else {
										echo "<span class='submit_review_hint'>Please <a href='login.php'>login</a> to submit your review</span>";
									}
									?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
		<?php
		// unset($_COOKIE['recently_viewed']);
		if(isset($_COOKIE['recently_viewed'])){
           
			$arrRecentView=unserialize($_COOKIE['recently_viewed']);
			$countRecentView=count($arrRecentView);
			$countStartRecentView=$countRecentView-4;
			if($countStartRecentView>4){
				$arrRecentView=array_slice($arrRecentView,$countStartRecentView,4);
			}
			$recentViewId=implode(",",$arrRecentView);
			$res=mysqli_query($con,"select product.*from product  where id IN ($recentViewId) and product.status=1 limit 4");
			
		?>
		<section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                     
                        <div class="ht__bradcaump__area">
         
         <div class="container" style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px;">
           
             <div class="col-xs-12 col-xs-15">
                          <nav class="bradcaump-inner" style="float:left">
                          <h3 style="font-size: 20px;font-weight: bold;">Recently Viewed</h3>
                        </nav>
                    
                 </div>
         </div>
   
 </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <div class="row">
                            <?php while($list=mysqli_fetch_assoc($res)){?>
								<div class="col-xs-3">
                                <div class="category" style="
    box-shadow: 0px 0px 2px rgb(0, 0, 0);
    width: 270px;
   
    ">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img src="../ecom/media/product_images/<?php echo $list['image']?>" alt="product images" style=" width: 270px;height: 400px;border: 1px solid gray;border-bottom: none;">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info">
										<ul class="product__action">
										<li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><i class="icon-heart icons"></i></a></li>
											<li><a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']?>','add')"><i class="icon-handbag icons"></i></a></li>
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
								<?php } ?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php 
			$arrRec=unserialize($_COOKIE['recently_viewed']);
			if(($key=array_search($product_id,$arrRec))!==false){
				unset($arrRec[$key]);
			}
			$arrRec[]=$product_id;
		}else{
			$arrRec[]=$product_id;
		}
		setcookie('recently_viewed',serialize($arrRec),time()+60*60*24*365);
		?>
		<!-- <script>
			function showMultipleImage(im){
				jQuery('#img-tab-1').html("<img src='"+im+"' data-origin='"+im+"'/>");
				// jQuery('.imageZoom').imgZoom();
			}
			</script>
           -->
           <script>
    function changeImage(src) {
        $("#mainImage").attr("src", src);
        $(".thumb").removeClass("active");
        $(event.target).addClass("active");
    }
  
    $("#mainImage").hover(
        function () {
            $(this).css("transform", "scale(1.5)");
        },
        function () {
            $(this).css("transform", "scale(1)");
        }
    );
			
</script>
        <!-- End Product Description -->
       
	<?php require('footer.php');

ob_flush();?>

<script>
let is_color='<?php echo $is_color?>';
			let is_size='<?php echo $is_size?>';
			let pid='<?php echo $product_id?>';
</script>
    
