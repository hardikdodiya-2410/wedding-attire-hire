<?php
require('top.php');
$cat_women = mysqli_query($con, "select * from categories where id=1");
$cat_men = mysqli_query($con, "select * from categories where id=2");
$cat_arr = array();
while ($row = mysqli_fetch_assoc($cat_women)) {
    $cat_arr[] = $row;
}
$cat_arrr = array();
while ($rows = mysqli_fetch_assoc($cat_men)) {
    $cat_arrr[] = $rows;
}
?>
<html>

<head>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <style>

        

        li.cat_hover:hover {

            box-shadow: 0px 0px 5px #525252;

        }

        li.cat_hover {
            width: 200px;
        }

        .page-content {
            display: inline-block;
            width: 100%;
            padding: 50px 0 25px;
        }

        .featured-item .title .h4 {
            margin-bottom: 15px;
            letter-spacing: .5px;
            font-weight: normal;
            text-transform: none;
            font-weight: 500;
        }

        .featured-item .desc {
            color: #7e7e7e;
            font-size: 13px;
        }

        select#style-select {
            background: none;
            border: 0;
            outline: none;
            /* color: #fff; */
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            height: 100%;
            width: 65%;
            font-weight: bold;
        }

        /* .slider__container.slider--one.bg__cat--3 {
    background-image: url('banner_1.webp'); /* Image path */
        background-size: cover;
        /* Ensures the image covers the entire area */
        background-position: center;
        /* Centers the image */
        background-repeat: no-repeat;
        /* Prevents image repetition */
        height: 100vh;
        /* Full viewport height (adjust as needed) */
        width: 100%;
        /* Full width */
        }

        */ .single__slide {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            /* Full viewport height */
            width: 100%;
            /* Full width */
        }
        .slider__container {
                    width: 100%;
                    overflow: hidden;
                }
                
                .single__slide {
                    height: 650px;
                    background-size: cover;
                    background-position: center;
                    position: relative;
                }
                
                @media (max-width: 768px) {
                    .single__slide {
                        height: 400px;
                    }
                }
                
                @media (max-width: 480px) {
                    .single__slide {
                        height: 300px;
                    }
                }
                
                /* Custom styling for slick arrows and dots */
                .slick-prev, .slick-next {
                    z-index: 1;
                }
                
                .slick-prev {
                    left: 25px;
                }
                
                .slick-next {
                    right: 25px;
                }
                
                .slick-dots {
                    bottom: 20px;
                }
    </style>
</head>

<body>
    <div class="body__overlay"></div>

    <!-- Start Slider Area -->
    <div class="slider__container">
        <div class="slick-slider">
            <!-- Slide 1 -->
            <div class="single__slide" style="background-image: url('banner_1.webp');">
                <div class="container">
                    <div class="row align-items__center">
                        <div class="col-md-5 p-top-10 col-xs-6" style="margin-top: 200px;"></div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="single__slide" style="background-image: url('banner_2.jpg');">
                <div class="container">
                    <div class="row align-items__center">
                        <div class="col-md-5 p-top-10 col-xs-6" style="margin-top: 200px;"></div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Start Slider Area -->
    <div class="page-content">
        <div class="container">
            <!--feature border box start-->
            <div class="row">

                <div class="section__title--2 text-center" style="    margin-bottom: 40px;">
                    <h2 class="title__line">How RAA Works</h2>
                </div>


                <div class="col-md-3 col-xs-6">
                    <div class="featured-item text-center m-bot-80">
                        <div>
                            <img src="https://www.rentanattire.com/assetsmain/img/home/Hanger.png">
                        </div>
                        <div class="title text-uppercase">
                            <div class="h4">Select a Style</div>
                        </div>
                        <div class="desc">
                            Pick your perfect style from our collection of designer outfits and accessories.
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="featured-item text-center m-bot-80">
                        <div>
                            <img src="https://www.rentanattire.com/assetsmain/img/home/book-your-outfit.png">
                        </div>
                        <div class="title text-uppercase">
                            <div class="h4">Book your Outfit</div>
                        </div>
                        <div class="desc">
                            Book your look for a minimum of 3 days. The outfit will be altered to your size and
                            dry-cleaned before delivery.</div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="featured-item text-center m-bot-80">
                        <div>
                            <img src="https://www.rentanattire.com/assetsmain/img/home/flaunt-it.png">
                        </div>
                        <div class="title text-uppercase">
                            <div class="h4">Flaunt It</div>
                        </div>
                        <div class="desc">
                            Flaunt your look with that perfect outfit chosen by you and enjoy the compliments
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="featured-item text-center m-bot-80" style="    margin-bottom: 80px;">
                        <div>
                            <img src="https://www.rentanattire.com/assetsmain/img/home/Freepickup.png">
                        </div>
                        <div class="title text-uppercase">
                            <div class="h4">Return It </div>
                        </div>
                        <div class="desc">
                            Pack the outfit and we'll pick it up a day after your occasion or the dates chosen by you.
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <img src="https://www.rentanattire.com/assetsmain/img/home/nos.png"
                        style="max-width: 85%; margin-top: -60px" class="steps">
                </div>
            </div>
            <!--feature border box end-->
        </div>
    </div>
    <!-- Start Category Area -->
    <section class="htc__category__area ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center" style="    margin-bottom: 40px;">
                        <h2 class="title__line">Categories</h2>
                        <p> Browse through our dreamy catalog and enrobe your wishes</p>
                    </div>
                </div>
            </div>
            <div class="htc__product__container">
                <div class="row">
                    <div class="row align-items__center">
                        <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                            <div class="slide">
                                <div class="slider__inner">
                                    <?php
                                    foreach ($cat_arr as $list) {
                                        ?>

                                        <?php
                                        $cat_id = $list['id'];
                                        $sub_cat_res = mysqli_query($con, "select * from sub_categories where status='1' and categories_id='$cat_id'");
                                        if (mysqli_num_rows($sub_cat_res) > 0) {
                                            ?>

                                            <ul class="dropdown"
                                                style="font-size: 24px; color: #333; text-decoration: none; padding: 5px 10px 7px;line-height: 45px;list-style: none; /* margin: 15px 100px; */ margin: 100px 10px 10px 100px;border: solid 1px transparent;">
                                                <?php
                                                while ($sub_cat_rows = mysqli_fetch_assoc($sub_cat_res)) {
                                                    echo '<li class="cat_hover"><a href="categories.php?id=' . $list['id'] . '&sub_categories=' . $sub_cat_rows['id'] . '">' . $sub_cat_rows['sub_categories'] . '</a></li>
													';
                                                }
                                                ?>
                                            </ul>
                                        <?php } ?>
                                        </li>
                                        <li
                                            style="text-decoration: none;list-style-type: none;background: #333; padding: 5px 10px 7px;font-size: 22px;display: block;margin-left: 100px; width: 35%;text-align: center;border: 1px solid black;">
                                            <a style="text-decoration: none; color: white;"
                                                href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-sm-6 col-xs-12 col-md-6">
                            <div class="slide__thumb">
                                <img src="../ecom/media/product_images/women.png" alt="slider images"
                                    style="height:400px; width:700px">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row align-items__center">
                    <div class="col-lg-10 col-sm-6 col-xs-12 col-md-6">
                        <div class="slide__thumb">
                            <img src="../ecom/media/product_images/men.png" alt="slider images"
                                style="height:400px; width:700px">
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                        <div class="slide">
                            <div class="slider__inner">
                                <?php
                                foreach ($cat_arrr as $list) {
                                    ?>

                                    <?php
                                    $cat_id = $list['id'];
                                    $sub_cat_res = mysqli_query($con, "select * from sub_categories where status='1' and categories_id='$cat_id'");
                                    if (mysqli_num_rows($sub_cat_res) > 0) {
                                        ?>

                                        <ul class="dropdown"
                                            style="font-size: 24px; color: #333; text-decoration: none; padding: 5px 10px 7px;line-height: 45px;list-style: none; /* margin: 15px 100px; */ margin: 100px 10px 10px 100px;border: solid 1px transparent;">
                                            <?php
                                            while ($sub_cat_rows = mysqli_fetch_assoc($sub_cat_res)) {
                                                echo '<li class="cat_hover"><a href="categories.php?id=' . $list['id'] . '&sub_categories=' . $sub_cat_rows['id'] . '">' . $sub_cat_rows['sub_categories'] . '</a></li>
													';
                                            }
                                            ?>
                                        </ul>
                                    <?php } ?>
                                    </li>
                                    <li
                                        style="text-decoration: none;list-style-type: none;background: #333; padding: 5px 10px 7px;font-size: 22px;display: block;margin-left: 100px; width: 35%;text-align: center;border: 1px solid black;">
                                        <a style="text-decoration: none; color: white;"
                                            href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End Category Area -->
    <!-- End Product Area -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script><script type="text/javascript">
                $(document).ready(function(){
                    console.log("Document ready");
                    if(typeof $.fn.slick !== 'undefined') {
                        console.log("Slick is loaded");
                        $('.slick-slider').slick({
                            dots: true,
                            infinite: true,
                            speed: 500,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            autoplay: true,
                            autoplaySpeed: 3000,
                            arrows: false,
                            pauseOnHover: false,
                            responsive: [
                                {
                                    breakpoint: 1024,
                                    settings: {
                                        arrows: false,
                                        dots: true,
                                        autoplay: true
                                    }
                                },
                                {
                                    breakpoint: 768,
                                    settings: {
                                        arrows: false,
                                        dots: true,
                                        autoplay: true
                                    }
                                },
                                {
                                    breakpoint: 480,
                                    settings: {
                                        arrows: false,
                                        dots: true,
                                        autoplay: true
                                    }
                                }
                            ]
                        });
                    } else {
                        console.log("Slick is NOT loaded");
                    }
                });
            </script>
    <?php
    require('footer.php'); ?>