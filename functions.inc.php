<?php

function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return strip_tags(mysqli_real_escape_string($con,$str));
	}
}

function get_product($con,$limit='',$cat_id='',$product_id='',$search_str='',$sort_order='',$is_best_seller='',$sub_categories='',$attr_id=''){
	$sql="select product.*,categories.categories,
	product_attributes.mrp,product_attributes.price,product_attributes.qty

	from product,categories,product_attributes where product.status=1 and product.id=product_attributes.product_id  ";

	if($cat_id!=''){
		$sql.=" and product.categories_id=$cat_id ";
	}
	if($product_id!=''){
		$sql.=" and product.id=$product_id ";
	}
	if($sub_categories!=''){
		$sql.=" and product.sub_categories_id=$sub_categories ";
	}
	if($is_best_seller!=''){
		$sql.=" and product.best_seller=1 ";
	}
	if($attr_id>0){
		$sql.=" and product_attributes.id=$attr_id ";
	}
	$sql.=" and product.categories_id=categories.id ";
	if($search_str!=''){
		if($search_str=='men')
		{
			$sql.=" and product.categories_id='2' ";
		}
		elseif($search_str=='women')
		{
			$sql.=" and product.categories_id='1' ";
		}

		else
		{
		$sql.=" and (product.name like '%$search_str%' or product.description like '%$search_str%') ";
	}
	}
	$sql.=" group by product.id ";
	if($sort_order!=''){
		$sql.= $sort_order;
	}else{
		$sql.=" order by product.id desc";
	}
	if($limit!=''){
		$sql.=" limit $limit";
	}
	//echo $sql;
	$res=mysqli_query($con,$sql);
	$data=array();
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;
}
function wishlist_add($con,$uid,$pid)
{
	$added_on=date('Y-m-d h:i:s');
	mysqli_query($con,"insert into wishlist(user_id,product_id,added_on) values('$uid','$pid','$added_on')");
	
}

function productSoldQtyByProductId($con, $pid, $attr_id) {
    $sql = "SELECT SUM(order_detail.qty) as qty 
            FROM order_detail, `order` 
            WHERE `order`.id = order_detail.order_id 
            AND order_detail.product_id = $pid 
            AND order_detail.product_attr_id = '$attr_id' 
            AND `order`.order_status != 4 
            AND ((`order`.payment_type = 'payu' AND `order`.payment_status = 'Success') 
            OR (`order`.payment_type = 'COD' AND `order`.payment_status != ''))";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
    return $row['qty'] ?? 0; // Ensure it returns 0 if no rows are found
}

function productQty($con,$pid,$attr_id){
	$sql="select qty from product_attributes where id='$attr_id'";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row['qty'];
}
function getProductAttr($con,$pid){
	$sql="select id from product_attributes where product_id='$pid'";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row['id'];
}
function sentInvoice($con,$order_id){
	$res=mysqli_query($con,"SELECT DISTINCT(order_detail.id), 
       order_detail.*, 
       product.name, 
       product.image, 
       color_master.color, 
	   color_master.color_name, 
       size_master.size
FROM order_detail
JOIN product_attributes ON order_detail.product_attr_id = product_attributes.id
JOIN product ON product_attributes.product_id = product.id
JOIN color_master ON product_attributes.color_id = color_master.id
JOIN size_master ON product_attributes.size_id = size_master.id
JOIN `order` ON order_detail.order_id = `order`.id
WHERE order_detail.order_id = '$order_id';");

	$user_order=mysqli_fetch_assoc(mysqli_query($con,"select `order`.*, users.name,users.email  from `order`,users where users.id=`order`.user_id and `order`.id='$order_id'"));

	$coupon_details=mysqli_fetch_assoc(mysqli_query($con,"select coupon_value from `order` where id='$order_id'"));
	$coupon_value=$coupon_details['coupon_value'];
	if($coupon_value==''){
		$coupon_value=0;	
	}

	$total_price=0;

	$html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html>
	  <head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="x-apple-disable-message-reformatting" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title></title>
		<style type="text/css" rel="stylesheet" media="all">
		/* Base ------------------------------ */
		
		@import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
		body {
		  width: 100% !important;
		  height: 100%;
		  margin: 0;
		  -webkit-text-size-adjust: none;
		}
		
		a {
		  color: #3869D4;
		}
		
		a img {
		  border: none;
		}
		
		td {
		  word-break: break-word;
		}
		
		.preheader {
		  display: none !important;
		  visibility: hidden;
		  mso-hide: all;
		  font-size: 1px;
		  line-height: 1px;
		  max-height: 0;
		  max-width: 0;
		  opacity: 0;
		  overflow: hidden;
		}
		/* Type ------------------------------ */
		
		body,
		td,
		th {
		  font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
		}
		
		h1 {
		  margin-top: 0;
		  color: #333333;
		  font-size: 22px;
		  font-weight: bold;
		  text-align: left;
		}
		
		h2 {
		  margin-top: 0;
		  color: #333333;
		  font-size: 16px;
		  font-weight: bold;
		  text-align: left;
		}
		
		h3 {
		  margin-top: 0;
		  color: #333333;
		  font-size: 14px;
		  font-weight: bold;
		  text-align: left;
		}
		
		td,
		th {
		  font-size: 16px;
		}
		
		p,
		ul,
		ol,
		blockquote {
		  margin: .4em 0 1.1875em;
		  font-size: 16px;
		  line-height: 1.625;
		}
		
		p.sub {
		  font-size: 13px;
		}
		/* Utilities ------------------------------ */
		
		.align-right {
		  text-align: right;
		}
		
		.align-left {
		  text-align: left;
		}
		
		.align-center {
		  text-align: center;
		}
		/* Buttons ------------------------------ */
		
		.button {
		  background-color: #3869D4;
		  border-top: 10px solid #3869D4;
		  border-right: 18px solid #3869D4;
		  border-bottom: 10px solid #3869D4;
		  border-left: 18px solid #3869D4;
		  display: inline-block;
		  color: #FFF;
		  text-decoration: none;
		  border-radius: 3px;
		  box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
		  -webkit-text-size-adjust: none;
		  box-sizing: border-box;
		}
		
		.button--green {
		  background-color: #22BC66;
		  border-top: 10px solid #22BC66;
		  border-right: 18px solid #22BC66;
		  border-bottom: 10px solid #22BC66;
		  border-left: 18px solid #22BC66;
		}
		
		.button--red {
		  background-color: #FF6136;
		  border-top: 10px solid #FF6136;
		  border-right: 18px solid #FF6136;
		  border-bottom: 10px solid #FF6136;
		  border-left: 18px solid #FF6136;
		}
		
		@media only screen and (max-width: 500px) {
		  .button {
			width: 100% !important;
			text-align: center !important;
		  }
		}
		/* Attribute list ------------------------------ */
		
		.attributes {
		  margin: 0 0 21px;
		}
		
		.attributes_content {
		  background-color: #F4F4F7;
		  padding: 16px;
		}
		
		.attributes_item {
		  padding: 0;
		}
		/* Related Items ------------------------------ */
		
		.related {
		  width: 100%;
		  margin: 0;
		  padding: 25px 0 0 0;
		  -premailer-width: 100%;
		  -premailer-cellpadding: 0;
		  -premailer-cellspacing: 0;
		}
		
		.related_item {
		  padding: 10px 0;
		  color: #CBCCCF;
		  font-size: 15px;
		  line-height: 18px;
		}
		
		.related_item-title {
		  display: block;
		  margin: .5em 0 0;
		}
		
		.related_item-thumb {
		  display: block;
		  padding-bottom: 10px;
		}
		
		.related_heading {
		  border-top: 1px solid #CBCCCF;
		  text-align: center;
		  padding: 25px 0 10px;
		}
		/* Discount Code ------------------------------ */
		
		.discount {
		  width: 100%;
		  margin: 0;
		  padding: 24px;
		  -premailer-width: 100%;
		  -premailer-cellpadding: 0;
		  -premailer-cellspacing: 0;
		  background-color: #F4F4F7;
		  border: 2px dashed #CBCCCF;
		}
		
		.discount_heading {
		  text-align: center;
		}
		
		.discount_body {
		  text-align: center;
		  font-size: 15px;
		}
		/* Social Icons ------------------------------ */
		
		.social {
		  width: auto;
		}
		
		.social td {
		  padding: 0;
		  width: auto;
		}
		
		.social_icon {
		  height: 20px;
		  margin: 0 8px 10px 8px;
		  padding: 0;
		}
		/* Data table ------------------------------ */
		
		.purchase {
		  width: 100%;
		  margin: 0;
		  padding: 35px 0;
		  -premailer-width: 100%;
		  -premailer-cellpadding: 0;
		  -premailer-cellspacing: 0;
		}
		
		.purchase_content {
		  width: 100%;
		  margin: 0;
		  padding: 25px 0 0 0;
		  -premailer-width: 100%;
		  -premailer-cellpadding: 0;
		  -premailer-cellspacing: 0;
		}
		
		.purchase_item {
		  padding: 10px 0;
		  color: #51545E;
		  font-size: 15px;
		  line-height: 18px;
		}
		
		.purchase_heading {
		  padding-bottom: 8px;
		  border-bottom: 1px solid #EAEAEC;
		}
		
		.purchase_heading p {
		  margin: 0;
		  color: #85878E;
		  font-size: 16px;
		}
		
		.purchase_footer {
		  padding-top: 15px;
		  border-top: 1px solid #EAEAEC;
		}
		
		.purchase_total {
		  margin: 0;
		  text-align: right;
		  font-weight: bold;
		  color: #333333;
		}
		
		.purchase_total--label {
		  padding: 0 15px 0 0;
		}
		
		body {
		  background-color: #F4F4F7;
		  color: #51545E;
		}
		
		p {
		  color: #51545E;
		}
		
		p.sub {
		  color: #6B6E76;
		}
		
		.email-wrapper {
		
		     width: 100%; 
        text-align: center; 
        padding: 20px; 
		  -premailer-width: 100%;
		  -premailer-cellpadding: 0;
		  -premailer-cellspacing: 0;
		  background-color: #F4F4F7;
		}
		
		.email-content {
		  width: 100%;
		  margin: 0;
		  padding: 0;
		  -premailer-width: 100%;
		  -premailer-cellpadding: 0;
		  -premailer-cellspacing: 0;
		}
		/* Masthead ----------------------- */
		
		.email-masthead {
		  padding: 25px 0;
		  text-align: center;
		}
		
		.email-masthead_logo {
		  width: 94px;
		}
		
		.email-masthead_name {
		  font-size: 16px;
		  font-weight: bold;
		  color: #A8AAAF;
		  text-decoration: none;
		  text-shadow: 0 1px 0 white;
		}
		/* Body ------------------------------ */
		
		.email-body {
		  background-color: #ffffff; 
        width: 570px; 
        margin: 0 auto; 
        padding: 20px; 
        border-radius: 8px; 
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		}
		
		.email-body_inner {
		  width: 570px;
		  margin: 0 auto;
		  padding: 0;
		  -premailer-width: 570px;
		  -premailer-cellpadding: 0;
		  -premailer-cellspacing: 0;
		  background-color: #FFFFFF;
		}
		
		.email-footer {
		  width: 570px;
		  margin: 0 auto;
		  padding: 0;
		  -premailer-width: 570px;
		  -premailer-cellpadding: 0;
		  -premailer-cellspacing: 0;
		  text-align: center;
		}
		
		.email-footer p {
		  color: #6B6E76;
		}
		
		.body-action {
		  width: 100%;
		  margin: 30px auto;
		  padding: 0;
		  -premailer-width: 100%;
		  -premailer-cellpadding: 0;
		  -premailer-cellspacing: 0;
		  text-align: center;
		}
		
		.body-sub {
		  margin-top: 25px;
		  padding-top: 25px;
		  border-top: 1px solid #EAEAEC;
		}
		
		.content-cell {
		  padding: 35px;
		}
		/*Media Queries ------------------------------ */
		
		@media only screen and (max-width: 600px) {
		  .email-body_inner,
		  .email-footer {
			width: 100% !important;
		  }
		}
		
		@media (prefers-color-scheme: dark) {
		  body,
		  .email-body,
		  .email-body_inner,
		  .email-content,
		  .email-wrapper,
		  .email-masthead,
		  .email-footer {
			background-color: #333333 !important;
			color: #FFF !important;
		  }
		  p,
		  ul,
		  ol,
		  blockquote,
		  h1,
		  h2,
		  h3 {
			color: #FFF !important;
		  }
		  .attributes_content,
		  .discount {
			background-color: #222 !important;
		  }
		  .email-masthead_name {
			text-shadow: none !important;
		  }
		}
		</style>
		<!--[if mso]>
		<style type="text/css">
		  .f-fallback  {
			font-family: Arial, sans-serif;
		  }
		</style>
	  <![endif]-->
	  </head>
	  <body>
		
		<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
		  <tr>
			<td align="center">
			  <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
				
				<!-- Email Body -->
				<tr>
				  <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
					<table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
					  <!-- Body content -->
					  <tr>
						<td class="content-cell">
						  <div class="f-fallback">
							<h1>Hi '.$user_order['name'].',</h1>
							<p>Thanks for using our website. This is an invoice for your recent purchase.</p>
							<table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
							  <tr>
								<td class="attributes_content">
								  <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
									<tr>
									  <td class="attributes_item">
										<span class="f-fallback">
				  <strong>Amount Due:</strong> '.  number_format($user_order['total_price'], 2, '.', ',').'.
				</span>
									  </td>
									</tr>
								   
								  </table>
								</td>
							  </tr>
							</table>
							<!-- Action -->
							
							<table class="purchase" width="100%" cellpadding="0" cellspacing="0">
							  <tr>
								<td>
								  <h3>'.$user_order['id'].'.</h3>
								</td>
								<td>
								  <h3 class="align-right">'.$user_order['added_on'].'.</h3>
								</td>
							  </tr>
							  
							  <tr>
								<td colspan="2">
								  <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
									<tr>
									  <th class="purchase_heading" align="left" style="text-align: left; font-size: 16px;">
										<p class="f-fallback">Description</p>
									  </th>
									  <th class="purchase_heading" align="right" style="text-align: right; font-size: 16px;">
										<p class="f-fallback">Amount</p>
									  </th>
									</tr>
									Invoice Details';
									while($row=mysqli_fetch_assoc($res)){
										$total_price += ($row['qty'] * $row['price']*$row['rental_days']);
										$pp = $row['qty'] * $row['price'];
								
										$html .= '<tr>
										  <td width="60%" class="purchase_item">
										  <label class="f-fallback purchase_total purchase_total--label">Product-Name:</label>
										  <span class="f-fallback">'.$row['name'].'</span><br>
										  <label class="f-fallback purchase_total purchase_total--label">Color:</label>
										  <span class="f-fallback">'.$row['color_name'].'</span><br>
										  <label class="f-fallback purchase_total purchase_total--label">Size:</label>
										  <span class="f-fallback">'.$row['size'].'</span><br>
										  <label class="f-fallback purchase_total purchase_total--label">Quantity:</label>
										  <span class="f-fallback">'.$row['qty'].'</span>
							
										  </td>
									
										<td class="align-right" width="40%" class="purchase_item"><span class="f-fallback">'. number_format($pp, 2, '.', ',').'</span></td>
										</tr>
										<tr>
								<td colspan="2">
									<label class="f-fallback purchase_total purchase_total--label">Rental Dates</label>
									<br>
									<span class="f-fallback">
Delivery Date:</span>
									<span class="f-fallback">'.$row['rent_from'].'</span>
									<br>
									<span class="f-fallback">Return Date:</span>
									<span class="f-fallback">'.$row['rent_to'].'</span>
									<br>
									<span class="f-fallback">Total Rental Days:</span>
									<span class="f-fallback">'.$row['rental_days'].'</span>
								</td>
							  </tr>';
									}
									
									if($coupon_value != ''){								
										$html .= ' <tr>
										<td width="80%" class="purchase_footer" valign="middle">
										<p class="f-fallback purchase_total purchase_total--label">Coupon Value</p>
									  </td>
									  <td width="20%" class="purchase_footer" valign="middle">
										<p class="f-fallback purchase_total">'.$coupon_value.'</p>
									  </td>
									</tr>';
									}
									$total_price -= $coupon_value;
									$html .= '<tr>
									  <td width="80%" class="purchase_footer" valign="middle">
										<p class="f-fallback purchase_total purchase_total--label">Total</p>
									  </td>
									  <td width="20%" class="purchase_footer" valign="middle">
										<p class="f-fallback purchase_total">'. number_format($total_price, 2, '.', ',').'</p>
									  </td>
									</tr>
								  </table>
								</td>
							  </tr>
							</table>
							
						  </div>
						</td>
					  </tr>
					</table>
				  </td>
				</tr>
				
			  </table>
			</td>
		  </tr>
		</table>
	  </body>
	</html>';
	
     
$email=$user_order['email'];

include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
    $mail->Username   = 'weddingattirehire@gmail.com';
    $mail->Password   = 'docn enfi endy rqbk'; // Use App Password for Gmail
    $mail->setFrom('weddingattirehire@gmail.com');
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject="Sent from weddingattirehire";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
	
	}else{
		echo "Mailer Error: " . $mail->ErrorInfo;
	}
}
?>