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
                var html='';
                for(i=1; i<=qty; i++){
                    html=html+"<option>"+i+"</option>";
                }
                jQuery('#cart_qty').show();
                jQuery('#qty').html(html);
                jQuery('#is_cart_box_show').removeClass('hide');
                jQuery('#cart_attr_msg').html('');
                jQuery('#cart_qty').removeClass('hide');
            } else {
                jQuery('#cart_attr_msg').html('Out of stock');
                jQuery('#cart_qty').hide();
            }
        }
    });
} 