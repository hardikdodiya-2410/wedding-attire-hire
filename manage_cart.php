<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');
header('Content-Type: application/json');
$pid=get_safe_value($con,$_POST['pid']);
$qty=get_safe_value($con,$_POST['qty']);
$type=get_safe_value($con,$_POST['type']);

// Add these lines to handle rental dates
$rent_from = isset($_POST['rent_from']) ? get_safe_value($con, $_POST['rent_from']) : '';
$rent_to = isset($_POST['rent_to']) ? get_safe_value($con, $_POST['rent_to']) : '';

$attr_id=0;
if(isset($_POST['sid']) && isset($_POST['cid'])){
	$sub_sql='';
	$sid=get_safe_value($con,$_POST['sid']);
	$cid=get_safe_value($con,$_POST['cid']);
	
	// Debugging output
	error_log("SID: $sid, CID: $cid");

	if($sid>0){
		$sub_sql.=" and size_id=$sid ";
	}
	if($cid>0){
		$sub_sql.=" and color_id=$cid ";
	}
	$row=mysqli_fetch_assoc(mysqli_query($con,"select id from product_attributes where product_id='$pid' $sub_sql"));
	$attr_id=$row['id'];
	
}

$productQty=productQty($con,$pid,$attr_id);

$pending_qty=$productQty;

if($pending_qty==0 && $type!='remove'){
	echo json_encode(['status' => 'not_available']);
	die();
}

// Check if the requested quantity exceeds the available quantity
if($qty > $pending_qty && $type != 'remove'){
	echo json_encode(['status' => 'max_qty_reached', 'productQty' => $productQty]);
	die();
}

$obj=new add_to_cart();

if($type=='add'){
	if($obj->totalProduct() >= 1){
		// echo json_encode(["success" => false, "message"=> "You must add only one item in cart at a time"]);
		echo json_encode(['status' => 'duplicate']);
		die();
	}
	else
	{
	$obj->addProduct($pid, $qty, $attr_id, $rent_from, $rent_to);
	}
}

if($type=='remove'){
	$obj->removeProduct($pid,$attr_id);
}

if($type=='update'){
	$obj->updateProduct($pid,$qty,$attr_id);
}

echo json_encode([
	'status' => 'success',
	'cart_count' => $obj->totalProduct(),
	'rent_from' => $rent_from,
	'rent_to' => $rent_to
]);
?>