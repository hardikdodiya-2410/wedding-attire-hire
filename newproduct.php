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

  
$product_attributes_query = mysqli_query($con, "SELECT product_attributes.size_id, product_attributes.qty, size_master.size 
FROM product_attributes 
LEFT JOIN size_master ON product_attributes.size_id = size_master.id 
WHERE product_attributes.product_id='$product_id' AND size_master.status=1");

$product_attributes = [];
while ($row = mysqli_fetch_assoc($product_attributes_query)) {
    $product_attributes[$row['size_id']] = [
        'size' => $row['size'],
        'qty' => $row['qty']
    ];
}

	
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
        .size-button {
            display: inline-block;
    min-width: 10px;
    padding: 8px 12px;
    font-size: 12px;
    font-weight: bold;
    line-height: 1;
    color: #ffffff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    background-color: #999999;
    border:none;
    border-radius: 13px;
            transition: background 0.3s, color 0.3s;
            margin-left: 15px;
        }
         .size-button.selected {
            background-color: #000;
            color: #fff;
        }
        select#qty {
    width: 17%;
    margin-left: 15px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
    
    </style>
    <script>
        let productData = <?php echo json_encode($product_attributes); ?>;
        
        function updateQty(sizeId) {
            let qtyDropdown = document.getElementById("qty");
            let buttons = document.querySelectorAll(".size-button");
            
            // Reset button styles
            buttons.forEach(btn => btn.classList.remove("selected"));
            
            // Highlight selected button
            let selectedButton = document.getElementById("size-" + sizeId);
            if (selectedButton) selectedButton.classList.add("selected");
            
            // Clear existing options
            qtyDropdown.innerHTML = "";
            
            // Add default "Select Quantity" option
            let defaultOption = document.createElement("option");
            defaultOption.value = "";
            defaultOption.textContent = "-Quantity-";
            qtyDropdown.appendChild(defaultOption);
            
            if (sizeId && productData[sizeId]) {
                let maxQty = productData[sizeId]['qty'];
                
                for (let i = 1; i <= maxQty; i++) {
                    let option = document.createElement("option");
                    option.value = i;
                    option.textContent = i;
                    qtyDropdown.appendChild(option);
                }
            }
        }
    </script>
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
                                    <div class="sin__desc">
                                        <?php
                                        $productSoldQtyByProductId=productSoldQtyByProductId($con,$get_product['0']['id']);
                                        $pending_qty=$get_product['0']['qty']-$productSoldQtyByProductId;

                                        $catt_show='yes';
                                        if($get_product['0']['qty']> $productSoldQtyByProductId)
                                        {
                                            $gstock='in stock';
                                            ?>  <p style="color:green;font-family: 'Poppins';     padding-left:15px;"><span>Availability:</span><?php echo $gstock?></p>
                                            <?php
                                        }
                                        else
                                        {
                                            $rstock=' not in stock';
                                            ?>
                                           
                                            <p style="color:red;font-family: 'Poppins';   padding-left:15px;" ><span>Availability:</span><?php echo $rstock?></p>
                                            <?php
                                            $catt_show='';
                                        }
                                        ?>
                                     <div class="row">
									  
                                     <div class="sin__desc align--left" style="    padding-left:35px;">
                                     <p><span>Size Range</span></p>
                                        <?php foreach ($product_attributes as $size_id => $data): ?>
                                            <button type="button" id="size-<?php echo $size_id; ?>" class="size-button" onclick="updateQty('<?php echo $size_id; ?>')">
                                                <?php echo $data['size']; ?>
                                            </button>
                                        <?php endforeach; ?>
     
                                                                    </div>
                                                                    
									  </div>
									</div>
                                    <div class="sin__desc align--left" style="    padding-left:15px;">
                                        <p><span>Quantity</span></p>
                                      <select id="qty" name="qty">  <option value="">-Quantity-</option>
                                      </select></div>
                                    <?php
                                    if($catt_show!='')
                                    {
                                        ?>
                                
                                    <?php
                                            if($pending_qty<=2)
                                            {
                                                // $avb= "left only $pending_qty qty Please  Buy Fast  ";
                                            }
                                            else
                                            {
                                                $avb= " ";
                                            }
											?>

                                    <!-- </p>  <p Style="color:red;font-family: 'Poppins'; "><?php echo $avb?></p> -->
                                
                      
                                  
                                    <?php
                                    }
                                    ?>
                                    	<div id="cart_attr_msg"></div>
                                    <div class="sin__desc align--left" style="    padding-left:15px;">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="#"><?php echo $get_product['0']['categories']?></a></li>
                                        </ul>
                                    </div>
                                    <?php 
                                    if($catt_show!='')
                                    {
                                        ?>
                                    <div class="contact-btn"style="margin-top: 15px;     padding: 10px 15px 10px;">
                                    <a class="fr__btn" name="add_to_cart"href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')">Add to cart</a>
                                   </div>
                                   <?php
                                   
                                }?>
                                   
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
			function get_qty(qty){
				var size_id=jQuery('#size_id').val();
				jQuery.ajax({
					url:'get_qty.php',
					type:'post',
					data:'size_id='+size_id,
					success:function(result){
						jQuery('#qty_id').html(result);
					}
				});
			}
</script>
        <!-- End Product Description -->
       
	<?php require('footer.php');

ob_flush();?>

<script>
<?php
if(isset($_GET['id'])){
?>
get_qty('<?php echo $qty?>');

<?php } ?>
</script>
    
