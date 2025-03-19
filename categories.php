<?php require('top.php');
// get
error_reporting(0);
$cat_id=get_safe_value($con,$_GET['id']);
$sub_categories=get_safe_value($con,$_GET['id']);
$sub_categories='';
if(isset($_GET['sub_categories'])){
	$sub_categories=get_safe_value($con,$_GET['sub_categories']);
    $sql_name=mysqli_query($con,"select sub_categories from sub_categories where id='$sub_categories'");

}
$price_high_selected="";
$price_low_selected="";
$new_selected="";
$old_selected="";
$sort_order="";
if(isset($_GET['sort'])){
	$sort=get_safe_value($con,$_GET['sort']);
	if($sort=="price_high"){
		$sort_order=" order by product.price desc ";
		$price_high_selected="selected";	
	}if($sort=="price_low"){
		$sort_order=" order by product.price asc ";
		$price_low_selected="selected";
	}if($sort=="new"){
		$sort_order=" order by product.id desc ";
		$new_selected="selected";
	}if($sort=="old"){
		$sort_order=" order by product.id asc ";
		$old_selected="selected";
	}

}
if($cat_id>0)
{
    $get_product=get_product($con,'',$cat_id,'','',$sort_order,'',$sub_categories);
    $products_per_page = 3;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $products_per_page;
    $total_products = count($get_product);
    $total_pages = ceil($total_products / $products_per_page);
    
    // Get products for current page
    $get_product = array_slice($get_product, $offset, $products_per_page);
}

else{
    ?>
    <script>
    window.location.href='index.php';
    </script>
    <?php
}
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $sql = "select categories.categories, sub_categories from categories,sub_categories where categories.id=? and sub_categories.id='$sub_categories'";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
}} /*
if(isset($_GET['sort'])){
	$sort=get_safe_value($con,$_GET['sort']);
	if($sort=="price_high"){
		$sort_order=" order by product.price desc ";
      
		
	}if($sort=="price_low"){
		$sort_order=" order by product.price asc ";
      
	}if($sort=="new"){
		$sort_order=" order by product.id desc ";
       
		
	}if($sort=="old"){
		$sort_order=" order by product.id asc ";
       
	}

}*/

?>

<head>
    <style>
.pagination{
display: flex;
justify-content: center;
}
.pagination>.active>a,.pagination>.active>span,.pagination>.active>a:hover,.pagination>.active>span:hover,.pagination>.active>a:focus,.pagination>.active>span:focus {
    z-index: 3;
    color: #fff;
    background-color: #337ab7;
    border-color: #000000;
    cursor: default
}

.pagination>li>a,.pagination>li>span {
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
        <!-- Start Bradcaump area -->
		<!-- change the site map path banner -->
        <div class="ht__bradcaump__area" >
        <div class="container" style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px; ">
                        <div class="col-xs-5">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i>/</i></span>
                                  <span class="breadcrumb-item active">  <?php echo htmlspecialchars($row['categories'])?>  </span>
                                  <span class="brd-separetor"><i>/</i></span>
                                  <span class="breadcrumb-item active">  <?php echo htmlspecialchars($row['sub_categories'])?>  </span>
                                </nav>
                        </div>
                </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__contact__area ptb--50 bg__white" syle="padding-top:0px;">  
            <div class="container">
                <div class="row">
                <?php if(count($get_product)>0){?>
                    <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12">
                        <div class="htc__product">
                            <!-- <div class="col-md-3">
                                <div class="htc__grid__bottom">
                                
                                <div class="htc__select__option">
                                <select class="ht__select" onchange="sort_product_drop('<?php echo $cat_id?>','<?php echo SITE_PATH?>')" id="sort_product_id">
                                        <option value="">Default softing</option>
                                        <option value="price_low" <?php echo $price_low_selected?>>Sort by price low to hight</option>
                                        <option value="price_high" <?php echo $price_high_selected?>>Sort by price high to low</option>
                                        <option value="new" <?php echo $new_selected?>>Sort by new first</option>
										<option value="old" <?php echo $old_selected?>>Sort by old first</option>
                                       </select>
                                </div>
                             
                                
                            </div>
                            </div> -->
                            <!-- Start Product View -->
                            <div class="col-md-12">
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
                                            <img src="../ecom/media/product_images/<?php echo $list['image']?>" alt="product images" style=" width: 270px;height: 400px;border: 1px solid gray;border-bottom: none;">
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
                                            <li><?php echo number_format($list['price'], 2, '.', ',') ?></li>
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
        <!-- Pagination -->
        <div class="row" style="display: flex; justify-content: center; margin: 20px 0;    margin-bottom: 50px;
    margin-top: -50px;">
            <div class="col-xs-12">
                <div class="pagination" style="text-align: center;">
                    <?php if($total_pages > 1) { ?>
                        <ul class="pagination" style="display: inline-flex; margin: 0 auto;">
                            <?php if($page > 1) { ?>
                                <li><a href="?id=<?php echo $cat_id?>&page=<?php echo $page-1?><?php echo $sub_categories ? '&sub_categories='.$sub_categories : ''?><?php echo isset($_GET['sort']) ? '&sort='.$_GET['sort'] : ''?>" style="padding: 8px 16px; margin: 0 4px;">Previous</a></li>
                            <?php } ?>
                            
                            <?php for($i = 1; $i <= $total_pages; $i++) { ?>
                                <li <?php echo $i == $page ? 'class="active"' : ''?>><a href="?id=<?php echo $cat_id?>&page=<?php echo $i?><?php echo $sub_categories ? '&sub_categories='.$sub_categories : ''?><?php echo isset($_GET['sort']) ? '&sort='.$_GET['sort'] : ''?>" style="padding: 8px 16px; margin: 0 4px; <?php echo $i == $page ? 'background-color: black; color: white;' : ''?>"><?php echo $i?></a></li>
                            <?php } ?>
                            
                            <?php if($page < $total_pages) { ?>
                                <li><a href="?id=<?php echo $cat_id?>&page=<?php echo $page+1?><?php echo $sub_categories ? '&sub_categories='.$sub_categories : ''?><?php echo isset($_GET['sort']) ? '&sort='.$_GET['sort'] : ''?>" style="padding: 8px 16px; margin: 0 4px;">Next</a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- End Pagination -->
       
	<?php require('footer.php');?>
