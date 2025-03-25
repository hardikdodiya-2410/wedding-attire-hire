<?php 
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');
$cat_res=mysqli_query($con,"select * from categories where status=1 order by categories desc");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
	$cat_arr[]=$row;	
}
$obj=new add_to_cart();


$totalProduct=0;
if(isset($_SESSION['USER_LOGIN'])){
    $totalProduct=$obj->totalProduct();
    $uid=$_SESSION['USER_ID'];
        if(isset($_GET['w_id']))
        {
        $wid=$_GET['w_id'];
        
        mysqli_query($con,"DELETE FROM `wishlist` WHERE `wishlist`.`id` = '$wid' and user_id ='$uid'");
        }
   
    $wishlist_count=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,product.id as pid,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'"));
   
}
$script_name=$_SERVER['SCRIPT_NAME'];
$script_name_arr=explode('/',$script_name);
$mypage=$script_name_arr[count($script_name_arr)-1];

$meta_title="Wedding Attire Hire";
$meta_desc="Wedding Attire Hire";
$meta_keyword="Wedding Attire Hire";
$meta_url=SITE_PATH;
$meta_image="";
if($mypage=='product.php'){
	$product_id=get_safe_value($con,$_GET['id']);
	$product_meta=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$product_id'"));
	 $meta_title=$product_meta['meta_title'];
	$meta_desc=$product_meta['meta_desc'];
	$meta_keyword=$product_meta['meta_keyword'];
	$meta_url=SITE_PATH."product.php?id=".$product_id;
	$meta_image=PRODUCT_IMAGE_SITE_PATH.$product_meta['image'];
}if($mypage=='contact.php'){
	$meta_title='Contact Us';
}
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $sql = "SELECT categories FROM categories WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
}}
if($mypage=='categories.php'){
	$meta_title="WAH-".$row['categories'];
}
if($mypage=='login.php'){
	$meta_title='WAH-Login-Registraion';
}
if($mypage=='cart.php'){
	$meta_title='WAH-Shopping Cart';
}
  ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    
    <title style="color: red;" ><?php echo $meta_title?> </title>
   <link rel="icon" type="image/x-icon" href="favicon (2).ico">
    <meta name="description" content="<?php echo $meta_desc?> ">
    <meta name="keywords" content="<?php echo $meta_keyword?> ">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
    /* Applies styles to the favicon (may not work in all browsers) */
    
</style>
	<meta property="og:title" stycontent="<?php echo $meta_title?>"/>
	<meta property="og:image" content="<?php echo $meta_image?>"/>
	<meta property="og:url" content="<?php echo $meta_url?>"/>
	<meta property="og:site_name" content="<?php echo SITE_PATH?>"/>
	
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- All css files are included here. -->


    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    
    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    
    <style>
        link[rel="icon"] {
        border-radius: 50%;
        overflow: hidden;
    }
        .htc__shopping__cart a span.htc__wishlist {
    background: black;
    border-radius: 100%;
    color: #fff;
    font-size: 9px;
    height: 17px;
    line-height: 19px;
    position: absolute;
    right: -5px;
    text-align: center;
    top: -4px;
    width: 17px;
}
.header__right i
{
    font-size:20px;
    width:20px;
    height: 20px;
}

        </style>
</head>

<body style=" text-transform: capitalize;  font-family: Arial, Helvetica, sans-serif;">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header" >
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6"> 
                                <div class="logo" style="width:230px; height: 80px;">
                                     <a href="index.php"><img src="images/logo/logo3.png" alt="logo images" style="mix-blend-mode:color-butn;"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-7 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop">
                                        <li><a href="NewArrivals.php">#New Arrivals</a></li>
                                        <li><a href="BestSeller.php">#Best Rental</a></li>
                                        <?php
										foreach($cat_arr as $list){
											?>
											<li class="drop"><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
											
                                            <?php
											$cat_id=$list['id'];
											$sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
											if(mysqli_num_rows($sub_cat_res)>0){
											?>
											
											   <ul class="dropdown">
													<?php
													while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
														echo '<li><a href="categories.php?id='.$list['id'].'&sub_categories='.$sub_cat_rows['id'].'">'.$sub_cat_rows['sub_categories'].'</a></li>
													';
													}
													?>
												</ul>
												<?php } ?>
											</li>
											<?php
										}
										?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                        <li><a href="NewArrivals.php">New Arrivals</a></li>
                                        <li><a href="BestSeller.php">Best Seller</a></li>
                                            <li><a href="login.php">login</a></li>
                                            <?php
                                            foreach($cat_arr as $list){
												?>
												<li class="drop"><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
											<?php
											$cat_id=$list['id'];
											$sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
											if(mysqli_num_rows($sub_cat_res)>0){
											?>
											
											   <ul class="dropdown">
													<?php
													while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
														echo '<li><a href="categories.php?id='.$list['id'].'&sub_categories='.$sub_cat_rows['id'].'">'.$sub_cat_rows['sub_categories'].'</a></li>
													';
													}
													?>
												</ul>
												<?php } ?>
											</li>
												<?php
											}
											?>
                                            <li><a href="contact.php">contact</a></li>
                                            <li><a href="cart.php">Cart</a></li>
                                            <li><a href="my_order.php">My Order</a></li>
                                            <li><a href="wishlist.php" class="mr15">wishlist</a></li>
                                           
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-4">
                                <div class="header__right">
                                <?php 
									$class="mr15";
									if(isset($_SESSION['USER_LOGIN'])){
										$class="";
									}
									?>
                                   <div class="header__search search search__open <?php echo $class?>">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                   <?php if(isset($_SESSION['USER_LOGIN'])){
											?>
                                              
											<nav class="navbar navbar-expand-lg navbar-light bg-light">
											   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
												<span class="navbar-toggler-icon"></span>
											  </button>

											  <div class="collapse navbar-collapse" id="navbarSupportedContent">
												<ul class="navbar-nav mr-auto">
												  <li class="nav-item dropdown">
													<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:25px">
													   <?php echo $_SESSION['USER_NAME']?>
													</a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
													  <a class="dropdown-item" href="my_order.php">Order</a><br>
													  <a class="dropdown-item" href="profile.php">Profile</a>
													  <div class="dropdown-divider"></div>
													  <a class="dropdown-item" href="logout.php">Logout</a>
													</div>
												  </li>
												  
												</ul>
											  </div>
											</nav>
                                           
											<?php
										}else{
											echo '<a href="login.php" class="mr15">Login/Register</a>';
										}
										?>
									
                               
                                   <?php
if(isset($_SESSION['USER_ID'])){
?>

<div class="htc__shopping__cart">
<a href="wishlist.php" class="mr15"><i class="icon-heart icons"></i></a>
 <a href="wishlist.php"><span class="htc__wishlist"><?php echo $wishlist_count?></span></a>
 </div>
 <?php } ?>

 <div class="htc__shopping__cart">
<a href="cart.php"><i class="icon-handbag icons"></i></a>
<a href="cart.php"><span class="htc__qua"><?php echo $totalProduct?></span></a>
</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <div class="body__overlay"></div>
		<div class="offset__wrapper">
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Search here... " type="text" name="str">
                                  
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
    