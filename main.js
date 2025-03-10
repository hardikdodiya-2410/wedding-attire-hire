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
                try {
                    result = JSON.parse(result);
                    if(result.status=='not_avaliable'){
                        alert('Qty not available');    
                    } else if(result.status=='max_qty_reached'){
                        alert('Maximum quantity reached');
                    } else {
                        jQuery('.htc__qua').html(result.cart_count);
                        if(type=='add'){
                            window.location.href='cart.php';
                        } else if(is_checkout=='yes'){
                            window.location.href='checkout.php';
                        }
                        else if(type=='update'){
                            window.location.reload();
                        }
                    }
                } catch(e) {
                    jQuery('.htc__qua').html(result);
                    if(type=='add'){
                        window.location.href='cart.php';
                    } else if(is_checkout=='yes'){
                        window.location.href='checkout.php';
                    }
                }
            }   
        }); 
    }
} 