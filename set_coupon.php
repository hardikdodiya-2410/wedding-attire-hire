<?php
require('connection.inc.php');
require('functions.inc.php');
header('Content-type: application/json');



$coupon_str = get_safe_value($con, $_POST['coupon_str']);
$user_id = $_SESSION['USER_ID']; // Assuming user ID is stored in session
// Initialize cart total to avoid undefined variable error
$cart_total = 0;

// Calculate cart total before checking coupon usage
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $val) {
        foreach ($val as $key1 => $val1) {
            $resAttr = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM product_attributes WHERE id='$key1'"));
            $price = $resAttr['price'];
            $qty = $val1['qty'];

            // Calculate rental days
            $rental_days = 1; // Default to 1 day
            if (isset($val1['rent_from']) && isset($val1['rent_to'])) {
                $date1 = new DateTime($val1['rent_from']);
                $date2 = new DateTime($val1['rent_to']);
                $interval = $date1->diff($date2);
                $rental_days = max(1, $interval->days + 1 - 2); // Ensure at least 1 day
            }

            // Calculate item total
            $item_total = $price * $qty * $rental_days;
            $cart_total += $item_total;
        }
    }
}
$cart_total = round($cart_total); // Ensure a whole number

// Check if the coupon was already used by the user
$check_used = mysqli_query($con, "SELECT * FROM `order` 
WHERE `user_id`=$user_id
AND `coupon_code` IN (SELECT `coupon_code` FROM `coupon_master` WHERE `coupon_code` LIKE '$coupon_str');");

if (mysqli_num_rows($check_used) > 0) {
    echo json_encode([
        'is_error' => 'yes',
        'result' => $cart_total,
        'dd' => 'This coupon has already been used and cannot be applied again.'
    ]);
    exit;
}
$res = mysqli_query($con, "SELECT * FROM coupon_master WHERE coupon_code='$coupon_str' AND status='1'");
$count = mysqli_num_rows($res);
$jsonArr = array();
$cart_total = 0;

if (isset($_SESSION['COUPON_ID'])) {
	unset($_SESSION['COUPON_ID']);
	unset($_SESSION['COUPON_CODE']);
	unset($_SESSION['COUPON_VALUE']);
}

foreach ($_SESSION['cart'] as $key => $val) {
	foreach ($val as $key1 => $val1) {
		$resAttr = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM product_attributes WHERE product_attributes.id='$key1'"));
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

$cart_total = round($cart_total); // Ensure whole number

if ($count > 0) {
	$coupon_details = mysqli_fetch_assoc($res);
	$coupon_value = $coupon_details['coupon_value'];
	$id = $coupon_details['id'];
	$coupon_type = $coupon_details['coupon_type'];
	$cart_min_value = $coupon_details['cart_min_value'];

	if ($cart_min_value > $cart_total) {
		$jsonArr = array(
			'is_error' => 'yes',
			'result' => $cart_total,
			'dd' => 'Cart total value must be ' . round($cart_min_value)
		);
	} else {
		if ($coupon_type == 'Rupee') {
			$final_price = $cart_total - $coupon_value;
		} else {
			$final_price = $cart_total - (($cart_total * $coupon_value) / 100);
		}
		$dd = $cart_total - $final_price;

		$_SESSION['COUPON_ID'] = $id;
		$_SESSION['FINAL_PRICE'] = round($final_price);
		$_SESSION['COUPON_VALUE'] = round($dd);
		$_SESSION['COUPON_CODE'] = $coupon_str;

		$jsonArr = array(
			'is_error' => 'no',
			'result' => round($final_price),
			'dd' => round($dd)
		);
	}
} else {
	$jsonArr = array(
		'is_error' => 'yes',
		'result' => $cart_total,
		'dd' => 'Coupon code not found'
	);
}

echo json_encode($jsonArr);
?>