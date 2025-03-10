<?php
require('connection.inc.php');
require('functions.inc.php');
header('Content-type: application/json');
	$name=get_safe_value($con,$_POST['name']);
	$email=get_safe_value($con,$_POST['email']);
	$mobile=get_safe_value($con,$_POST['mobile']);
	$password=get_safe_value($con,$_POST['password']);
	date_default_timezone_set('Asia/Kolkata');

	$check_user=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));
	$check_mobile=mysqli_num_rows(mysqli_query($con,"select * from users where mobile='$mobile'"));
	if($check_user>0){
		echo json_encode(["email_present" => true, "status" => 200, "message" => "email_present"]);
		die();
	}
	if($check_mobile>0){
		echo json_encode(["mobile_present" => true, "status" => 200, "message" => "mobile_present"]);
		die();
	}
	$added_on=date('Y-m-d h:i:s');
	
	mysqli_query($con,"insert into users(name,email,mobile,password,added_on) values('$name','$email','$mobile','$password','$added_on')");

	echo json_encode(["insert" => true, "status" => 200, "message" => "insert"]);
		die();

?>