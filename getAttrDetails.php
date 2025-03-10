<?php
require('connection.inc.php');
require('functions.inc.php');

$color=get_safe_value($con,$_POST['color']);
$pid=get_safe_value($con,$_POST['pid']);
$size=get_safe_value($con,$_POST['size']);
if($color==''){
	$color=0;
}if($size==''){
	$size=0;
}
$res=mysqli_query($con,"select * from product_attributes where product_id=$pid and color_id=$color and size_id=$size");
if(mysqli_num_rows($res)>0){
	$row=mysqli_fetch_assoc($res);
	$pending_qty=$row['qty'];
	$pending_qty = max(0, $pending_qty);
	$pending_qty = min($pending_qty, $pending_qty);

	echo json_encode(['qty'=>intval($pending_qty) ,'price'=>$row['price'],'mrp'=>$row['mrp']]);
}else{
	
}
?>