<?php
require('top.php');
?>

<head>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .pagination>li>a {
            padding: 8px 12px;
            border: 1px solid #ddd;
            margin: 4px;
            text-decoration: none;
            color: black;
            background-color: #fff;
        }

        .pagination>.active>a {
            background-color: #000;
            color: #fff;
            cursor: default;
        }

        .category {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background: #fff;
            margin-bottom: 20px;
            padding: 15px;
        }

        .ht__cat__thumb img {
            width: 100%;
       
            object-fit: cover;
            transition: transform 0.3s ease;
            position: relative;
                overflow: hidden;
        }

        .fr__product__inner {
            text-align: center;
            padding: 15px;
        }

        .btn {
            border: 2px solid #333;
            background: none;
            color: #333;
            padding: 8px 20px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #333;
            color: #fff;
        }

        /* Responsive Styles */
        @media (max-width: 991px) {
            .col-md-4 {
                width: 50%;
                float: left;
            }

            .ht__cat__thumb img {
                max-height: 400px;
            }
        }

        @media (max-width: 767px) {
            .col-md-4 {
                width: 100%;
                float: none;
            }

            .ht__cat__thumb img {
                max-height: 500px;
                
            }

            .pagination>li>a {
                padding: 6px 10px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .ht__cat__thumb img {
                max-height: 400px;
            }

            .pagination>li>a {
                padding: 4px 8px;
                font-size: 12px;
            }
        }
    </style>
</head>
<section class="ftr__product__area ptb--100">
    <div class="container">
                        <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Best Rental</h2>
                       <p>Best Rentals offers top-quality, affordable, and reliable rental services for a seamless experience.</p>
                <br>
                    </div>
            </div>
        </div>
        <div class="row">
            <?php
            $items_per_page = 3;
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $offset = ($page - 1) * $items_per_page;
            $get_product = get_product($con, '', '', '', '', '', 'yes');
            $total_products = count($get_product);
            $total_pages = ceil($total_products / $items_per_page);
            $current_products = array_slice($get_product, $offset, $items_per_page);
            foreach ($current_products as $list) {
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
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <ul class="pagination">
                    <?php if ($page > 1) { ?>
                        <li><a href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <li class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($page < $total_pages) { ?>
                        <li><a href="?page=<?php echo $page + 1; ?>">Next</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php
require('footer.php');
?>