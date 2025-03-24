/*-----------------------------------------------------------------------------------

  Template Name: Asbab eCommerce HTML5 Template.
  Template URI: #
  Description: Asbab is a unique website template designed in HTML with a simple & beautiful look. There is an excellent solution for creating clean, wonderful and trending material design corporate, corporate any other purposes websites.
  Author: HasTech
  Author URI: https://themeforest.net/user/hastech/portfolio
  Version: 1.0

-----------------------------------------------------------------------------------*/

/*-------------------------------
[  Table of contents  ]
---------------------------------
    01. jQuery MeanMenu
    02. wow js active
    03. Product  Masonry (width)
    04. Sticky Header
    05. ScrollUp
    06. Search Bar
    07. Shopping Cart Area
    08. Filter Area
    09. Toogle Menu   
    10. User Menu 
    11. Menu 
    12. Menu Dropdown
    13. Overlay Close
    14. Testimonial Image Slider As Nav
    15. Brand Area
    16. Price Slider Active
    17. Accordion
    18. Ship to another
    19. Payment credit card    
    20 Slider Activations



/*--------------------------------
[ End table content ]
-----------------------------------*/


(function($) {
    'use strict';


/*-------------------------------------------
    01. jQuery MeanMenu
--------------------------------------------- */
    
    $('.mobile-menu nav').meanmenu({
        meanMenuContainer: '.mobile-menu-area',
        meanScreenWidth: "1199",
        meanRevealPosition: "right",
    });

/*-------------------------------------------
    02. wow js active
--------------------------------------------- */

    new WOW().init();


/*-------------------------------------------
    03. Product  Masonry (width)
--------------------------------------------- */ 

    $('.htc__product__container').imagesLoaded( function() {
      
        // filter items on button click
        $('.product__menu').on( 'click', 'button', function() {
          var filterValue = $(this).attr('data-filter');
          $grid.isotope({ filter: filterValue });
        }); 
        // init Isotope
        var $grid = $('.product__list').isotope({
          itemSelector: '.single__pro',
          percentPosition: true,
          transitionDuration: '0.7s',
          masonry: {
            // use outer width of grid-sizer for columnWidth
            columnWidth: '.single__pro',
          }
        });

    });

    $('.product__menu button').on('click', function(event) {
        $(this).siblings('.is-checked').removeClass('is-checked');
        $(this).addClass('is-checked');
        event.preventDefault();
    });



/*-------------------------------------------
    04. Sticky Header
--------------------------------------------- */ 
    var win = $(window);
    var sticky_id = $("#sticky-header-with-topbar");
        win.on('scroll',function() {    
        var scroll = win.scrollTop();
        if (scroll < 245) {
        sticky_id.removeClass("scroll-header");
        }else{
            sticky_id.addClass("scroll-header");
        }
    });

/*--------------------------
    05. ScrollUp
---------------------------- */
    $.scrollUp({
        scrollText: '<i class="zmdi zmdi-chevron-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });


/*------------------------------------    
    06. Search Bar
--------------------------------------*/ 
    
    $( '.search__open' ).on( 'click', function () {
        $( 'body' ).toggleClass( 'search__box__show__hide' );
        return false;
    });

    $( '.search__close__btn .search__close__btn_icon' ).on( 'click', function () {
        $( 'body' ).toggleClass( 'search__box__show__hide' );
        return false;
    });


/*------------------------------------    
    07. Shopping Cart Area
--------------------------------------*/

    $('.cart__menu').on('click', function(e) {
        e.preventDefault();
        $('.shopping__cart').addClass('shopping__cart__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.offsetmenu__close__btn').on('click', function(e) {
        e.preventDefault();
        $('.shopping__cart').removeClass('shopping__cart__on');
        $('.body__overlay').removeClass('is-visible');
    });


/*------------------------------------    
    08. Filter Area
--------------------------------------*/

    $('.filter__menu').on('click', function(e) {
        e.preventDefault();
        $('.filter__wrap').addClass('filter__menu__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.filter__menu__close__btn').on('click', function(e) {
        e.preventDefault();
        $('.filter__wrap').removeClass('filter__menu__on');
        $('.body__overlay').removeClass('is-visible');
    });


/*------------------------------------    
    09. Toogle Menu
--------------------------------------*/

    $('.toggle__menu').on('click', function(e) {
        e.preventDefault();
        $('.offsetmenu').addClass('offsetmenu__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.offsetmenu__close__btn').on('click', function(e) {
        e.preventDefault();
        $('.offsetmenu').removeClass('offsetmenu__on');
        $('.body__overlay').removeClass('is-visible');
    });


/*------------------------------------    
    10. User Menu
--------------------------------------*/

    $('.user__menu').on('click', function(e) {
        e.preventDefault();
        $('.user__meta').addClass('user__meta__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.offsetmenu__close__btn').on('click', function(e) {
        e.preventDefault();
        $('.user__meta').removeClass('user__meta__on');
        $('.body__overlay').removeClass('is-visible');
    });



/*------------------------------------    
    11. Menu 
--------------------------------------*/

    $('.menu__click').on('click', function(e) {
        e.preventDefault();
        $('.off__canvars__wrap').addClass('off__canvars__wrap__on');
        $('.body__overlay').addClass('is-visible');
        $('body').addClass('off__canvars__open');
        $(this).hide();
    });

    $('.menu__close__btn').on('click', function() {
        $('.off__canvars__wrap').removeClass('off__canvars__wrap__on');
        $('.body__overlay').removeClass('is-visible');
        $('body').removeClass('off__canvars__open');
        $('.menu__click').show();
    });


/*------------------------------------    
    12. Menu Dropdown
--------------------------------------*/
    function offCanvasMenuDropdown(){

        $('.off__canvars__dropdown-menu').hide();

        $('.off__canvars__dropdown > a').on('click', function(e){
        e.preventDefault();

        $(this).find('i.zmdi').toggleClass('zmdi-chevron-up');
        $(this).siblings('.off__canvars__dropdown-menu').slideToggle();
        return false;
        });
    }
    offCanvasMenuDropdown();


/*------------------------------------    
    13. Overlay Close
--------------------------------------*/

    $('.body__overlay').on('click', function() {
        $(this).removeClass('is-visible');
        $('.offsetmenu').removeClass('offsetmenu__on');
        $('.shopping__cart').removeClass('shopping__cart__on');
        $('.filter__wrap').removeClass('filter__menu__on');
        $('.user__meta').removeClass('user__meta__on');
        $('.off__canvars__wrap').removeClass('off__canvars__wrap__on');
        $('body').removeClass('off__canvars__open');
        $('.menu__click').show();
    });


/*---------------------------------------------------
    14. Testimonial Image Slider As Nav
---------------------------------------------------*/

    $('.ht__testimonial__activation').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    swipeToSlide: true,
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    centerPadding: '10px',
    responsive: [
      {
        breakpoint: 600,
        settings: {
          dots: false,
          slidesToShow: 1,
          slidesToScroll: 1,  
          centerPadding: '10px',
          }
      },
      {
        breakpoint: 320,
        settings: {
          autoplay: true,
          dots: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          centerMode: false,
          focusOnSelect: false,
          }
      }
    ]
    });


/*-----------------------------------------------
    15. Brand Area
-------------------------------------------------*/

    $('.brand__list').owlCarousel({
      loop: true,
      margin:0,
      nav:false,
      autoplay: true,
      autoplayTimeout: 10000,
      items:5,
      dots: false,
      lazyLoad: true,
      responsive: {
        0: {
          items: 2,
        },
        767: {
          items: 4,
        },
        991: {
          items: 5,
        }
      }
    });



/*-------------------------------
    16. Price Slider Active
--------------------------------*/

    $("#slider-range").slider({
          range: true,
          min: 10,
          max: 500,
          values: [110, 400],
          slide: function(event, ui) {
              $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
          }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
      " - $" + $("#slider-range").slider("values", 1));




/*---------------------------------------------------
    17. Accordion
---------------------------------------------------*/
function emeAccordion(){
    $('.accordion__title')
      .siblings('.accordion__title').removeClass('active')
      .first().addClass('active');
    $('.accordion__body')
      .siblings('.accordion__body').slideUp()
      .first().slideDown();
    $('.accordion').on('click', '.accordion__title', function(){
      $(this).addClass('active').siblings('.accordion__title').removeClass('active');
      $(this).next('.accordion__body').slideDown().siblings('.accordion__body').slideUp();
    });
    };
emeAccordion();



/*---------------------------------------------------
    18. Ship to another
---------------------------------------------------*/

    function shipToAnother(){
        var trigger = $('.ship-to-another-trigger'),
          container = $('.ship-to-another-content');
        trigger.on('click', function(e){
          e.preventDefault();
          container.slideToggle();
        });
    };
    shipToAnother();



/*---------------------------------------------------
    19. Payment credit card
---------------------------------------------------*/

    function paymentCreditCard(){
        var trigger = $('.paymentinfo-credit-trigger'),
        container = $('.paymentinfo-credit-content');
        trigger.on('click', function(e){
        e.preventDefault();
        container.slideToggle();
    });
    };
    paymentCreditCard();


/*-----------------------------------------------
    20 Slider Activations
-------------------------------------------------*/

    if ($('.slider__activation__wrap').length) {
        $('.slider__activation__wrap').owlCarousel({
        loop: true,
        margin:0,
        nav:true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1000,
        autoplay: false,
        navText: [ '<i class="icon-arrow-left icons"></i>', '<i class="icon-arrow-right icons"></i>' ],
        autoplayTimeout: 10000,
        items:1,
        dots: false,
        lazyLoad: true,
        responsive: {
          0: {
            items: 1,
          },
          767: {
            items: 1,
          },
          991: {
            items: 1,
          }
        }
        });
    }




})(jQuery);
function manage_cart_update(pid,type,color_id,size_id){
 jQuery('#cid').val(color_id);
 jQuery('#sid').val(size_id);
 manage_cart(pid,type);
}


function manage_cart(pid,type,is_checkout){
    var is_error='';
    jQuery('.field_error').html('');
    if(type=='update')
    {
        var qty=jQuery("#"+pid+"qty").val();
    }
    else
    {
        var qty=jQuery("#qty").val();
    }
    let cid=jQuery('#cid').val();
    let sid=jQuery('#sid').val();
    let rent_from = jQuery('#rent_from_date').val();
    let rent_to = jQuery('#rent_to_date').val();
    let fromDate = new Date(rent_from);
    let toDate = new Date(rent_to);
    let diffTime = Math.abs(toDate - fromDate);
    let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
    // Validate dates
    if (fromDate > toDate) {
        alert('Return date must be after rental date');
        return;
    }
    if(type=='add')
    {
        if(is_color!=0 && cid==''){
            jQuery('#cart_attr_msg').html('Please select color');
            is_error='yes';
        }
        if(is_size!=0 && sid=='' && is_error==''){
            jQuery('#cart_attr_msg').html('Please select size');
            is_error='yes';
        }
        if (qty == 0) {
            is_error = "yes";
            return;
        }
        if(qty > 0 && (!rent_from || !rent_to)){
            jQuery('#cart_attr_msg').html('Please select rental period');
            is_error='yes';
        }
    }
    
    if(is_error==''){
        jQuery.ajax({
            url:'manage_cart.php',
            type:'post',
            data:'pid='+pid+'&qty='+qty+'&type='+type+'&cid='+cid+'&sid='+sid+'&rent_from='+rent_from+'&rent_to='+rent_to,
            success:function(result){
                console.log(result);
                if(result.status=='not_avaliable'){
                    alert('Qty not available');	
                } else if(result.status=='max_qty_reached'){
                    alert('Maximum quantity reached');
                } else if (result.status == "duplicate") {
                
                   Swal.fire({
                     title: " ",
                     text: "You must add only one item in cart at a time",
                     icon: "warning",
                     timer: 5000,
                     showConfirmButton: false,
                   }).then(() => {
                     window.location.href = "cart.php";
                   });
                  
                } else {
                  jQuery(".htc__qua").html(result);

                  if (is_checkout == "yes") {
                    window.location.href = "checkout.php";
                  } else if (type == "add") {
                    window.location.href = "cart.php";
                  }
                }
            }   
        }); 
    }
}

function loadAttr(c_s_id,pid,type){
	jQuery('#cart_qty').addClass('hide');
	jQuery('#is_cart_box_show').addClass('hide');
 jQuery('#cid').val(c_s_id);				
	 if(is_size==0){
		jQuery('#cart_attr_msg').html('');
		jQuery('#cart_qty').removeClass('hide');
		getAttrDetails(pid);
	}else{
	 	jQuery('#cart_attr_msg').html('');
		jQuery.ajax({
			url:'load_attr.php',
			type:'post',
			data:'c_s_id='+c_s_id+'&pid='+pid+'&type='+type,
			success:function(result){
              jQuery('#cid').val(c_s_id);	
				jQuery('#size_attr').html("<option value=''>Size</option>"+result);
			}
			
		});	
	}
	
}
function showQty(){
	let cid=jQuery('#cid').val();
	if(cid=='' && is_color>0){
		jQuery('#cart_attr_msg').html('Please select color');
	}else{
        jQuery('#cart_qty').removeClass('hide');
        jQuery('#cart_attr_msg').html('');
		 let sid=jQuery('#size_attr').val();
		jQuery('#sid').val(sid);
		 getAttrDetails(pid);
	}
   
}


function getAttrDetails(pid){
    jQuery('#is_cart_box_show').addClass('hide');
    jQuery('#cart_qty').hide();
    let color=jQuery('#cid').val();
    let size=jQuery('#sid').val();
    jQuery.ajax({
        url:'getAttrDetails.php',
        type:'post',
        data:'pid='+pid+'&color='+color+'&size='+size,
        success:function(result){
            result=jQuery.parseJSON(result);
            jQuery('.old__prize').html(result.mrp);
            jQuery('.new__price').html(result.price);
            var qty=result.qty;
            
            if(qty > 0){
                jQuery('#cart_qty').show();
                jQuery('#is_cart_box_show').removeClass('hide');
                jQuery('#cart_attr_msg').html('');
                jQuery('#cart_qty').removeClass('hide');
            } else {
                jQuery('#cart_attr_msg').html('Out of stock');
            }
        }
    });
} 

function sort_product_drop(cat_id,site_path){
	var sort_product_id=jQuery('#sort_product_id').val();
	window.location.href=site_path+"categories.php?id="+cat_id+"&sort="+sort_product_id;

}

function wishlist_manage(pid,type){
	jQuery.ajax({
		url:'wishlist_manage.php',
		type:'post',
		data:'pid='+pid+'&type='+type,
		success:function(result){
			result=result.trim();
			if(result=='not_login'){
				window.location.href='login.php';
			}else{
				jQuery('.htc__wishlist').html(result);
			}
		}	
	});	
}

function showDatePicker(e) {
    jQuery('#date_picker_div').show();
    if(e.value == 0){
        jQuery("#cart_attr_msg").html("Please select quanity");
    }else{
        jQuery("#cart_attr_msg").html("");
    }
    jQuery('#rent_dates').daterangepicker({
        minDate: moment().add(1, 'days'),
        startDate: moment().add(1, 'days'),
        endDate: moment().add(7, 'days'),
        locale: {
            format: 'YYYY-MM-DD'
        }
    }, function(start, end) {
        jQuery('#rent_from_date').val(start.format('YYYY-MM-DD'));
        jQuery('#rent_to_date').val(end.format('YYYY-MM-DD'));
    });
}











