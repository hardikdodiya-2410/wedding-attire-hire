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
     echo" <script> alert('add') </script>";
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <style>
        .product-container {
            display: flex;
            gap: 20px;
        }
        
        .img-magnifier-container {
            position: relative;
            width: 400px;
            height: 400px;
        }
        
        .img-magnifier-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        .magnifier-lens {
            position: absolute;
            width: 50%;
            height: 40%;
            border: 2px solid #000;
            background: rgba(255, 255, 255, 0.8);
            cursor: none;
            display: none;
            pointer-events: none;
            background-repeat: no-repeat;
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
            border-radius: 4px;
            transition: all 0.3s ease;
            object-fit: cover;
        }
        .thumbnails img:hover, .thumbnails img.active {
            border: 2px solid #000;
            transform: translateY(-2px);
        }
        /* General Styling */
input[type="date"] {
    width: 160px;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #000000;
    color: #000000;
    border-radius: 5px;
    background-color: #fff;
 
    cursor: pointer;
    outline: none;
    transition: all 0.3s ease-in-out;
}

/* On Focus */
input[type="date"]:focus {
    border: 1px solid #000000;
    color: #000000;

}

/* Read-only Date Field */
input[type="date"][readonly] {
    background-color: #f2f2f2;
    color: #666;
    cursor: not-allowed;
}

/* Mobile-Friendly Adjustments */
@media (max-width: 600px) {
    input[type="date"] {
        width: 100%;
        font-size: 16px;
        padding: 10px;
    }
}
/* Style for the select dropdown */
select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding: 12px 40px 12px 20px;
            font-size: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background: #fff url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="%23333" viewBox="0 0 16 16"><path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/></svg>') no-repeat;
            background-position: calc(100% - 15px) center;
            cursor: pointer;
            min-width: 160px;
            max-width: 100%;
            transition: all 0.25s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin: 5px 0;
            font-weight: 500;
            color: #333;
        }

        select:hover {
            border-color: #bdbdbd;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-1px);
        }

        select:focus {
            border-color: #2196F3;
            outline: none;
            box-shadow: 0 4px 12px rgba(33,150,243,0.15);
            transform: translateY(-1px);
        }

        select option {
            padding: 15px 20px;
            font-size: 15px;
            background-color: #fff;
            color: #333;
            border-bottom: 1px solid #f5f5f5;
            transition: all 0.2s ease;
            cursor: pointer;
            font-weight: 400;
        }

        select option:first-child {
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }

        select option:last-child {
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
            border-bottom: none;
        }

        select option:hover,
        select option:focus,
        select option:active,
        select option:checked {
            background-color: #f5f5f5;
            color: #2196F3;
            padding-left: 25px;
        }

        /* Disabled state */
        select:disabled {
            background-color: #f8f9fa;
            cursor: not-allowed;
            opacity: 0.75;
            box-shadow: none;
        }

        select:disabled option {
            color: #9e9e9e;
            background: #f8f9fa;
            cursor: not-allowed;
        }

        /* Custom styles for specific select elements */
        .select__size {
            min-width: 120px;
            margin-left: 10px;
        }

        .qty__select {
            min-width: 100px;
            text-align: center;
        }
        /* Style for the color list container */
.pro__color {
    display: flex;
    gap: 10px;
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Style for each color option */
.pro__color li {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-left: 10px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: transform 0.2s ease-in-out, border-color 0.3s ease;
}

/* Hover effect */
.pro__color li:hover {
    transform: scale(1.1);
    border-color: #000;
}

/* Active/selected color */
.pro__color li.active {
    border: 2px solid #ff0000; /* Change to your preferred highlight color */
}

/* Style for the anchor inside color options */
.pro__color li a {
    display: block;
    width: 100%;
    height: 100%;
    text-indent: -9999px; /* Hide text */
}

/* Default styles for large screens (laptop/desktop) */
.product-det {
    background: #f9f9f9;
    padding: 10px 15px;
    margin-bottom: 10px;
    position: relative;
}
.main-image img {
    width: 100%;
    height: auto;
}
.thumbnails img {
    width: 70px;
    cursor: pointer;
}

/* Tablet (medium screens) */
@media (max-width:991px) {
    .col-md-3, .col-md-6, .col-md-9 {
        width: 100%;
        padding: 0 5px;
    }
    .main-image img {
        width: 100%;
        height: auto;
    }
    .thumbnails img {
        width: 60px;
    }
    
}

/* Mobile (small screens) */
@media (max-width: 991px) {
    .htc__product__details__top .row {
        display: flex;
        flex-direction: column;
    }
   
    .product-det {
        padding: 10px;
        width: 100%;
    }

    .main-image img {
        width: 100%;
        height: 400px;
    }

    .thumbnails {
        display: flex;
        gap: 5px;
        overflow-x: auto;
    }

    .product-price {
        text-align: left;
        font-size: 20px;
    }

    .fr__btn {
        width: 100%;
        text-align: center;
        margin-top: 10px;
    }

    #date_picker_div input[type="date"] {
        width: 100%;
    }
}
.sin__desc {
    margin-left: 10px;
}
   select.select__size {
    /* border: 1px solid #000000; */
    box-shadow: 1px 1px 3px black;
    color: #000000;
    /* height: 20px; */
    margin-left: 10px;
    width: 60px;
    padding: 0 4px;
    font-size: 15px;
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
                                    <div class="img-magnifier-container main-image">
                                    <img id="mainImage" style="
    height: 400px;
" src="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$get_product['0']['image']?>">
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
"></i><span class="border-tb p-tb-10" id="rent-amount-calculated-show">  <?php echo  number_format($get_product['0']['price'], 2, '.', ',')?>  </span>Rent <br>  <span style="font-size:12px; color:#999; padding-right:5px">Inclusive all taxes</span>
                                      </div>
                                                 
                                                 <!--<span1>No Security Deposit
                                                 <a id="c-fiiting" href="#" data-toggle="modal" data-target="#image">
                                                 <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                              </a>-->
                                              
                                   </div>
                                 </div>
                                 <div class="clearfix"></div>
                           </div>
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
									
                                      // $productSoldQtyByProductId=productSoldQtyByProductId($con,$get_product['0']['id'],$getProductAttr);
                                    
                                       $pending_qty = intval($get_product['0']['qty']);
                                      // $pending_qty = max(0, $pending_qty);

              //
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
										<select class="select__size" style="width: 150px; height: 35px; padding: 5px;"id="size_attr" onchange="showQty()">
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
										<select id="qty" class="select__size" style="width: 150px; height: 35px; padding: 5px;" onchange="showDatePicker()">

											<?php
											// Get the pending quantity
											$pending_qty = intval($get_product['0']['qty']);
											
											// Display quantity options from 1 to pending_qty
											if($pending_qty > 0){
                                                echo "<option value='0'>Qty</option>";
												for($i=1; $i<=$pending_qty; $i++){
													echo "<option value='".$i."'>".$i."</option>";
												}
											}
											?>
										</select>
										</p>
										
                                    </div>

<!-- Add date picker div -->
<div id="date_picker_div" style="display:none; margin: 15px 0;">
    <div class="sin__desc align--left">
        <div>
            <p style="margin: 0;"><span>Rental Period (Minimum 3 days):</span></p>
            <div>
            <p><span>From:</span></p>
                <input type="date" id="rent_from_date" min="<?php echo date('Y-m-d'); ?>" style="width: 150px; padding: 5px;">
                
                <p><span>To:</span></p>
                <input type="date" id="rent_to_date" min="<?php echo date('Y-m-d'); ?>" style="width: 150px; padding: 5px;">
            </div>
        </div>
        
    </div>
</div>
                               
<span id="cart_attr_wrapper" style="color: red; margin-left: 10px; font-size: 20px; font-weight: 600; display: none;">
    <div id="cart_attr_msg"></div>
</span>
				
                                    <div class="sin__desc align--left" style="    padding-left:15px;">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="#"><?php echo $get_product['0']['categories']?></a></li>
                                        </ul>
                                    </div>
                                    <div id="is_cart_box_show" class="<?php echo $is_cart_box_show?>">
                                    <div class="contact-btn"style="margin-top: 15px;     padding: 10px 15px 10px;">
                               
                                        <!-- <a class="fr__btn" name="add_to_cart"href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')">Add to cart</a>
                                        -->
                
                                    <a class="fr__btn" name="add_to_cart"href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add','yes')">Rent Now</a>
                              
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
                                  
                                    <!-- <div class="fr__product__inner"style="width: 270px;height: 50px;">
                                        <h4><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a></h4>
                                       <br>
                                    
                                    </div> -->
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
    function initMagnifier() {
    const container = document.querySelector('.img-magnifier-container');
    const img = container.querySelector('img');
    let lens = container.querySelector('.magnifier-lens');
    
    if (!lens) {
        lens = document.createElement('div');
        lens.className = 'magnifier-lens';
        container.appendChild(lens);
    }
    
    const zoom = 2;
    
    container.addEventListener('mousemove', moveLens);
    container.addEventListener('mouseenter', showLens);
    container.addEventListener('mouseleave', hideLens);
    
    function showLens() {
        lens.style.display = 'block';
        updateLensBackground();
    }
    
    function hideLens() {
        lens.style.display = 'none';
    }
    
    function moveLens(e) {
        e.preventDefault();
        const rect = container.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        let posX = x - lens.offsetWidth / 2;
        let posY = y - lens.offsetHeight / 2;
        
        // Prevent lens from going outside the image
        if (posX < 0) posX = 0;
        if (posY < 0) posY = 0;
        if (posX > container.offsetWidth - lens.offsetWidth) {
            posX = container.offsetWidth - lens.offsetWidth;
        }
        if (posY > container.offsetHeight - lens.offsetHeight) {
            posY = container.offsetHeight - lens.offsetHeight;
        }
        
        lens.style.left = posX + 'px';
        lens.style.top = posY + 'px';
        
        // Calculate background position
        const bgX = -(posX * zoom);
        const bgY = -(posY * zoom);
        
        lens.style.backgroundImage = `url(${img.src})`;
        lens.style.backgroundSize = (container.offsetWidth * zoom) + 'px ' + 
                                  (container.offsetHeight * zoom) + 'px';
        lens.style.backgroundPosition = bgX + 'px ' + bgY + 'px';
    }
    
    function updateLensBackground() {
        lens.style.backgroundImage = `url(${img.src})`;
        lens.style.backgroundSize = (container.offsetWidth * zoom) + 'px ' + 
                                  (container.offsetHeight * zoom) + 'px';
    }
}

function changeImage(src) {
    const mainImage = document.getElementById('mainImage');
    const thumbs = document.querySelectorAll('.thumb');
    
    // Change main image
    mainImage.src = src;
    
    // Update active thumbnail
    thumbs.forEach(thumb => {
        if(thumb.src === src) {
            thumb.classList.add('active');
        } else {
            thumb.classList.remove('active');
        }
    });
    
    // Reinitialize magnifier for new image
    setTimeout(initMagnifier, 100);
}

// Initialize magnifier on page load
window.addEventListener('load', function() {
    initMagnifier();
    
    // Add active class to first thumbnail
    const firstThumb = document.querySelector('.thumb');
    if(firstThumb) {
        firstThumb.classList.add('active');
    }
});
</script>
    
<script>
function checkCartMessage() {
    let cartMsg = document.getElementById("cart_attr_msg").innerHTML.trim();
    let wrapper = document.getElementById("cart_attr_wrapper");

    if (cartMsg === "") {
        wrapper.style.display = "none";
    } else {
        wrapper.style.display = "inline"; // or "block" if needed
    }
}

// Run the function whenever the message updates
setInterval(checkCartMessage, 500); // Checks every 500ms
</script>


<script>
let is_color='<?php echo $is_color?>';
			let is_size='<?php echo $is_size?>';
			let pid='<?php echo $product_id?>';

</script>
    
<script>
// Show date inputs when quantity is selected
function showDatePicker() {
    let selectedQty = jQuery('#qty').val();
    if (selectedQty != '' && parseInt(selectedQty) > 0) {
        jQuery('#date_picker_div').show();
    } else {
        jQuery('#date_picker_div').hide();
    }
}

// Add event listeners for date changes
document.getElementById('rent_from_date').addEventListener('change', function() {
    document.getElementById('rent_to_date').min = this.value;
    validateDates();
    calculateRentalPrice();
});

document.getElementById('rent_to_date').addEventListener('change', function() {
    validateDates();
    calculateRentalPrice();
});

function validateDates() {
    let fromDate = new Date(document.getElementById('rent_from_date').value);
    let toDate = new Date(document.getElementById('rent_to_date').value);
    
    if (fromDate && toDate && !isNaN(fromDate) && !isNaN(toDate)) {
        let diffTime = Math.abs(toDate - fromDate);
        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        
        if (diffDays < 3) {
            document.getElementById('cart_attr_msg').innerHTML = 'Please select at least 3 days rental period';
            return false;
        } else {
            document.getElementById('cart_attr_msg').innerHTML = '';
            return true;
        }
    }
    return false;
}

function calculateRentalPrice() {
    let fromDate = new Date(document.getElementById('rent_from_date').value);
    let toDate = new Date(document.getElementById('rent_to_date').value);
    
    if (fromDate && toDate && !isNaN(fromDate) && !isNaN(toDate)) {
        let days = Math.floor((toDate - fromDate) / (1000 * 60 * 60 * 24)) + 1;
        let basePrice = <?php echo $get_product['0']['price'] ?>;
        let totalPrice = basePrice * days;
        
        if (days > 0) {
            $('#rent-amount-calculated-show').text(totalPrice);
        }
    }
}

       
// Update manage_cart function to include dates
function manage_cart(pid, type, is_checkout) {
    let qty = jQuery('#qty').val();
    let rent_from = jQuery('#rent_from_date').val();
    let rent_to = jQuery('#rent_to_date').val();
       
        if(!rent_from || !rent_to) {
                document.getElementById('cart_attr_msg').innerHTML = 'Please select rental dates';
                return;
        }
    
   

    // Validate minimum rental period
    if (!validateDates()) {
        return;
    }

    // Calculate number of days
    let fromDate = new Date(rent_from);
    let toDate = new Date(rent_to);
    let diffTime = Math.abs(toDate - fromDate);
    let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

    // Validate dates
    if (fromDate > toDate) {
        alert('Return date must be after rental date');
        return;
    }

    jQuery.ajax({
        url: 'manage_cart.php',
        type: 'post',
        data: {
            pid: pid,
            qty: qty,
            type: type,
            rent_from: rent_from,
            rent_to: rent_to,
            rental_days: diffDays,
            cid: jQuery('#cid').val(),
            sid: jQuery('#sid').val()
        },
        success: function(result) {
            if (result.status == 'not_available') {
                alert('Quantity not available');
            } else {
                jQuery('#cart_count').html(result);
                window.location.href = 'cart.php';
                if (is_checkout) {
                    window.location.href = 'checkout.php';
                }
            }
        }
    });
}
</script>
    
<?php require('footer.php');

ob_flush();?>