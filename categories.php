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
}} 

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
                                <div class="category" style="box-shadow: 0 2px 4px rgba(0,0,0,0.1); width: 100%; margin-bottom: 30px;">
                                    <div class="ht__cat__thumb" style="position: relative;overflow: hidden;height: 500px;">
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
					<?php }
					 else
					 {
						 echo "<img src='download.jpeg' style='width:300px;height:300px>";
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
