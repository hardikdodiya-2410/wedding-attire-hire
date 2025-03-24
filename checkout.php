<?php
require('top.php');


date_default_timezone_set('Asia/Kolkata');
error_reporting(0);
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

if (isset($_POST["login"])) {
	$res = mysqli_query($con, "select * from users where email='$email'and password='$password' ");
	$check_user_res = mysqli_num_rows($res);
	if ($check_user_res > 0) {

		$fetch = mysqli_fetch_array($res);
		$row = mysqli_fetch_assoc($res);
		$_SESSION['USER_LOGIN'] = 'yes';
		$_SESSION['USER_NAME'] = $row['name'];
		$_SESSION['USER_id'] = $row['id'];
		?>
		<script>
			window.location.href = window.location.href;
		</script>
		<?php
	} else {
		$msg = "Please enter correct login details";
	}
}


if (isset($_POST["register"])) {
	if (!$name) {
		$name_error = "<br>*enter name";
	}
	if (!$password) {
		$password_error = "<br>*enter password";
	}
	if (!$email) {
		$email_error = "<br>*enter email";
	}
	if (!$mobile) {
		$mobile_error = "<br>*enter mobile";
	}
	if ($name && $password && $email && $mobile) {
		$check_user = mysqli_num_rows(mysqli_query($con, "select * from users where email='$email' "));
		if ($check_user > 0) {
			echo "<script> alert('email already exist')</script>";
		} else {
			$insert = "INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `add_on`) VALUES (NULL, '$name', '$password', '$email', '$mobile', '$add_on')";
			$result = mysqli_query($con, $insert);
			if (!$result) {
				echo " ";
			} else {
				echo "<script> alert('Registriton')</script>";
			}
		}
	} else {
		echo " ";
	}
} else {
	echo " ";
}
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
	?>
	<script>
		window.location.href = 'index.php';
	</script>
	<?php
}

$total_price = 0;
$errMsg = "";
if (isset($_POST['submit'])) {
	$address = get_safe_value($con, $_POST['address']);
	$city = get_safe_value($con, $_POST['city']);
	$pincode = get_safe_value($con, $_POST['pincode']);
	$payment_type = get_safe_value($con, $_POST['payment_type']);
	$cart_total = 0;
	$payment_status = 'pending';
	if ($payment_type == 'COD') {
		$payment_status = 'success';
	}
	$order_status = '1';
	$added_on = date('Y-m-d h:i:s');
	$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

	// Calculate the total price of the cart
	foreach ($_SESSION['cart'] as $key => $val) {
		foreach ($val as $key1 => $val1) {
			$resAttr = mysqli_fetch_assoc(mysqli_query($con, "select product_attributes.*,color_master.color,size_master.size from product_attributes 
left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
where product_attributes.id='$key1'"));
			$price = $resAttr['price'];
			$qty = $val1['qty'];

			// Calculate rental days
			$rental_days = 0;
			if (isset($val1['rent_from']) && isset($val1['rent_to'])) {
				$date1 = new DateTime($val1['rent_from']);
				$date2 = new DateTime($val1['rent_to']);
				$interval = $date1->diff($date2);
				$rental_days = $interval->days + 1; // Adding 1 to include both start and end dates
				$rental_days = $rental_days - 2; // Adjust days as per your requirement
			}

			// Calculate item total with rental days
			$item_total = $price * $qty * $rental_days;
			$cart_total += $item_total;


		}
	}
	$total_price = $cart_total; // Set total price

	// Check if the order with the same transaction ID already exists
	$order_check_query = mysqli_query($con, "SELECT id FROM `order` WHERE txnid='$txnid'");
	if (mysqli_num_rows($order_check_query) == 0) {
		if (isset($_SESSION['COUPON_ID'])) {
			$coupon_id = $_SESSION['COUPON_ID'];
			$coupon_code = $_SESSION['COUPON_CODE'];
			$coupon_value = $_SESSION['COUPON_VALUE'];
			$total_price = $total_price - $coupon_value; // Apply coupon value
			unset($_SESSION['COUPON_ID']);
			unset($_SESSION['COUPON_CODE']);
			unset($_SESSION['COUPON_VALUE']);
		} else {
			$coupon_id = '';
			$coupon_code = '';
			$coupon_value = '';
		}

		// Insert into the order table and get the order_id
		mysqli_query($con, "insert into `order`(user_id,address,city,pincode,payment_type,payment_status,order_status,added_on,total_price,txnid,coupon_id,coupon_code,coupon_value) values('$uid','$address','$city','$pincode','$payment_type','$payment_status','$order_status','$added_on','$total_price','$txnid','$coupon_id','$coupon_code','$coupon_value')");

		$order_id = mysqli_insert_id($con); // Retrieve the last inserted order_id

		foreach ($_SESSION['cart'] as $key => $val) {
			foreach ($val as $key1 => $val1) {
				$resAttr = mysqli_fetch_assoc(mysqli_query($con, "select * from product_attributes where product_attributes.id='$key1'"));
				$price = $resAttr['price'];
				$qty = $val1['qty'];
				$rent_from = $val1['rent_from'];
				$rent_to = $val1['rent_to'];
				if (isset($val1['rent_from']) && isset($val1['rent_to'])) {
					$date1 = new DateTime($val1['rent_from']);
					$date2 = new DateTime($val1['rent_to']);
					$interval = $date1->diff($date2);
					$rental_days = $interval->days + 1; // Adding 1 to include both start and end dates
					$rental_days = $rental_days - 2; // Adjust days as per your requirement


					// Check if the product is out of stock
					if ($resAttr['qty'] < $qty) {
						echo "<script>alert('Some items in your cart are out of stock. Please update your cart.');</script>";
						echo "<script>window.location.href='cart.php';</script>";
						exit;
					}

					// Decrement the product quantity
					$new_qty = $resAttr['qty'] - $qty;
					mysqli_query($con, "UPDATE product_attributes SET qty='$new_qty' WHERE id='$key1'");

					// Insert into order_detail with rental dates
					mysqli_query($con, "insert into `order_detail`(order_id,product_id,product_attr_id,qty,price,rent_from,rent_to,rental_days) 
					values('$order_id','$key','$key1','$qty','$price','$rent_from','$rent_to','$rental_days')");
				}
			}
		}

		if ($payment_type == 'Payu') {

			$userArr = mysqli_fetch_assoc(mysqli_query($con, "select * from users where id='$uid'"));

			$MERCHANT_KEY = "XvF2Ju";
			$SALT = "f7atLzhhPvHsHUM1SsF3W8filpzaTQ7Y";
			$hash_string = '';
			//$PAYU_BASE_URL = "https://secure.payu.in";
			$PAYU_BASE_URL = "https://test.payu.in";
			$action = '';
			$posted = array();
			if (!empty($_POST)) {
				foreach ($_POST as $key => $value) {
					$posted[$key] = $value;
				}
			}

			$formError = 0;

			$posted['txnid'] = $txnid;
			$posted['amount'] = $total_price;
			$posted['firstname'] = $userArr['name'];
			$posted['email'] = $userArr['email'];
			$posted['phone'] = $userArr['mobile'];
			$posted['productinfo'] = "productinfo";
			$posted['key'] = $MERCHANT_KEY;
			$hash = '';
			$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
			if (empty($posted['hash']) && sizeof($posted) > 0) {
				if (
					empty($posted['key'])
					|| empty($posted['txnid'])
					|| empty($posted['amount'])
					|| empty($posted['firstname'])
					|| empty($posted['email'])
					|| empty($posted['phone'])
					|| empty($posted['productinfo'])

				) {
					$formError = 1;
				} else {
					$hashVarsSeq = explode('|', $hashSequence);
					foreach ($hashVarsSeq as $hash_var) {
						$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
						$hash_string .= '|';
					}
					$hash_string .= $SALT;
					$hash = strtolower(hash('sha512', $hash_string));
					$action = $PAYU_BASE_URL . '/_payment';
				}
			} elseif (!empty($posted['hash'])) {
				$hash = $posted['hash'];
				$action = $PAYU_BASE_URL . '/_payment';
			}


			$formHtml = '<form method="post" name="payuForm" id="payuForm" action="' . $action . '"><input type="hidden" name="key" value="' . $MERCHANT_KEY . '" /><input type="hidden" name="hash" value="' . $hash . '"/><input type="hidden" name="txnid" value="' . $posted['txnid'] . '" /><input name="amount" type="hidden" value="' . $posted['amount'] . '" /><input type="hidden" name="firstname" id="firstname" value="' . $posted['firstname'] . '" /><input type="hidden" name="email" id="email" value="' . $posted['email'] . '" /><input type="hidden" name="phone" value="' . $posted['phone'] . '" /><textarea name="productinfo" style="display:none;">' . $posted['productinfo'] . '</textarea><input type="hidden" name="surl" value="http://127.0.0.1/ecom/payment_complete.php" /><input type="hidden" name="furl" value="http://127.0.0.1/ecom/payment_fail.php"/><input type="submit" style="display:none;"/></form>';
			echo $formHtml;
			echo '<script>document.getElementById("payuForm").submit();</script>';
			unset($_SESSION['cart']);
		} else {

			sentInvoice($con, $order_id);

			echo '<script>
				window.location.href = "thank_you.php";
			</script>';
			?>
			<?php
			unset($_SESSION['cart']);
		}
	} else {
		// Handle the case where the order already exists
		echo "<script>alert('Order already processed.');</script>";
	}
}
?>

<div class="ht__bradcaump__area">
	<div class="container"
		style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px;">
		<div class="col-xs-5">
			<nav class="bradcaump-inner">
				<a class="breadcrumb-item" href="index.php">Home</a>
				<span class="brd-separetor"><i>/</i></span>
				<a class="breadcrumb-item" href="cart.php">Cart</a>
				<span class="brd-separetor"><i>/</i></span>
				<span class="breadcrumb-item active">Checkout</span>

			</nav>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="checkout__inner">
					<div class="accordion-list">
						<div class="accordion">
							<?php
							if (!isset($_SESSION['USER_LOGIN'])) {
								?>
								?>
								<script>
									window.location.href = 'login.php';
								</script>
								<?php
							}
							if (isset($_SESSION['USER_LOGIN'])) {


								$lastOrderDetailsRes = mysqli_query($con, "SELECT `address`,`city`,`pincode` FROM `order` WHERE user_id='" . $uid . "'");
								if (mysqli_num_rows($lastOrderDetailsRes) > 0) {
									$lastOrderDetailsrow = mysqli_fetch_assoc($lastOrderDetailsRes);
									$address = $lastOrderDetailsrow['address'];
									$city = $lastOrderDetailsrow['city'];
									$pincode = $lastOrderDetailsrow['pincode'];
								}

								?>
								<div class="accordion__title">
									Address Information
								</div>
								<form method="post">
									<div class="accordion__body">
										<div class="bilinfo">

											<div class="row">

												<div class="col-md-12">
													<div class="single-input">
														<input type="text" name="address" placeholder="Street Address"
															value="<?php echo $address; ?>" required>
													</div>
												</div>

												<div class="col-md-6">
													<div class="single-input">
														<input type="text" name="city" placeholder="City/State"
															value="<?php echo $city; ?>" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="single-input">
														<input type="text" name="pincode" placeholder="Post code/ zip"
															value="<?php echo $pincode; ?>" required>
													</div>
												</div>

											</div>

										</div>
									</div>
									<div class="accordion__title">
										payment information
									</div>
									<div class="accordion__body">
										<div class="paymentinfo">
											<div class="single-method">
												COD <input type="radio" name="payment_type" value="COD" required />

											</div>
											<div class="single-method">

											</div>
										</div>

									</div>

									<input type="submit" name="submit" class="fv-btn" />
								<?php } ?>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="order-details">
					<h5 class="order-details__title">Your Order</h5>
					<div class="order-details__item">
						<?php
						$total_price = 0;
						$cart_total = 0; // Initialize cart_total
						foreach ($_SESSION['cart'] as $key => $val) {
							foreach ($val as $key1 => $val1) {
								$resAttr = mysqli_fetch_assoc(mysqli_query($con, "select product_attributes.*,color_master.color,color_master.color_name,size_master.size from product_attributes 
                                            left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
                                            left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
                                            where product_attributes.id='$key1'"));

								$productArr = get_product($con, '', '', $key, '', '', '', '', $key1);
								$pname = $productArr[0]['name'];
								$mrp = $productArr[0]['mrp'];
								$price = $productArr[0]['price'];
								$image = $productArr[0]['image'];
								$qty = $val1['qty'];

								// Calculate rental days
								$rental_days = 0;
								if (isset($val1['rent_from']) && isset($val1['rent_to'])) {
									$date1 = new DateTime($val1['rent_from']);
									$date2 = new DateTime($val1['rent_to']);
									$interval = $date1->diff($date2);
									$rental_days = $interval->days + 1; // Adding 1 to include both start and end dates
									$rental_days = $rental_days - 2; // Adjust days as per your requirement
								}

								// Calculate item total with rental days
								$item_total = $price * $qty * $rental_days;
								$cart_total += $item_total;
								?>
								<div class="single-item">
									<div class="single-item__thumb">
										<img src="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH . $image ?>" />
									</div>
									<div class="single-item__content">
										<label>Name:</label>
										<a href="#"><?php echo $pname ?></a><br>
										<label>Quantity:</label>
										<a href="#"><?php echo $qty ?></a><br>
										<label>Per Day:</label>
										<a href="#"><i
												class="fa fa-inr"></i><?php echo number_format($price, 2, '.', ',') ?></a><br>
										<?php
										if (isset($val1['rent_from']) && isset($val1['rent_to'])) {
											echo "	<label>From:</label> <a class='product-name'>" . date('d M Y', strtotime($val1['rent_from'])) . "</a><br>";
											echo "	<label>To:</label> <a class='product-name'>" . date('d M Y', strtotime($val1['rent_to'])) . "</a><br>";
										}
										?>
										<label> Days:</label>
										<a href="#"><?php echo $rental_days ?></a><br>
										<label> Amounts:</label>
										<a href="#"><i
												class="fa fa-inr"></i><?php echo number_format($item_total, 2, '.', ',') ?></a><br>
										<label>Color:</label>
										<?php
										if (isset($resAttr['color']) && $resAttr['color'] != '') {

											echo "<a href='#' style='font-weight:600;'class='product-name'>" . $resAttr['color_name'] . "</a>";

										}
										?><br>
										<label>Size:</label>
										<?php
										if (isset($resAttr['size']) && $resAttr['size'] != '') {

											echo "<a class='product-name'> " . $resAttr['size'] . "</a>";
										}
										?>
										<br>


									</div>

								</div>
							<?php }
						} ?>
					</div>
					<div class="ordre-details__total" id="coupon_box">
						<h5>Coupon Value</h5>
						<span class="price" id="coupon_price"></span>
					</div>
					<div class="ordre-details__total">
						<h5>Order total</h5>
						<span class="price"
							id="order_total_price"><?php echo number_format($cart_total, 2, '.', ',') ?></span>
					</div>

					<div class="ordre-details__total bilinfo">
						<input type="textbox" id="coupon_str" class="coupon_style mr5" style="
	width: 100%;
	height: 50px;
	margin-right: 5px;
" />
						<input type="button" name="submit" class="fv-btn" value="Apply Coupon" onclick="set_coupon()" />


					</div>
					<div id="coupon_result"></div>



				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function set_coupon() {
		var coupon_str = jQuery('#coupon_str').val();
		if (coupon_str != '') {
			jQuery('#coupon_result').html('');
			jQuery.ajax({
				url: 'set_coupon.php',
				type: 'post',
				data: 'coupon_str=' + coupon_str,
				success: function (result) {
					console.log(result);
					if (result.is_error == 'yes') {
						jQuery('#coupon_box').hide();
						jQuery('#coupon_result').html(result.dd);
						jQuery('#order_total_price').html(result.result);
					}
					if (result.is_error == 'no') {
						jQuery('#coupon_box').show();
						jQuery('#coupon_price').html(result.dd);
						jQuery('#order_total_price').html(result.result);
					}
				}
			});
		}
	}
</script>
<?php
if (isset($_SESSION['COUPON_ID'])) {
	unset($_SESSION['COUPON_ID']);
	unset($_SESSION['COUPON_CODE']);
	unset($_SESSION['COUPON_VALUE']);
}

// After successful order completion, clear the rental dates from session
if ($payment_type == 'COD') {
	unset($_SESSION['cart_rent_from']);
	unset($_SESSION['cart_rent_to']);
}

require('footer.php');
?>