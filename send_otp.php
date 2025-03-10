<?php
require('connection.inc.php');
require('functions.inc.php');

header('Content-type: application/json');
$type=get_safe_value($con,$_POST['type']);
if($type=='email'){
	$email=get_safe_value($con,$_POST['email']);
	$check_user=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));
	if($check_user>0){
		echo json_encode(["email_present" => true, "status" => 200, "message" => "email_present"]);
		die();
	}
	
	$otp=rand(1111,9999);
	$_SESSION['EMAIL_OTP']=$otp;
	$html = "
    <div style='font-family: Arial, sans-serif; text-align: center; padding: 20px; background-color: #f4f4f4; border-radius: 10px; width: 80%; margin: auto;'>
        <h2 style='color: #333;'>Your OTP for Verification</h2>
        <p style='font-size: 18px; color: #555;'>Use the following One-Time Password (OTP) to complete your process. This OTP is valid for <strong>10 minutes</strong>.</p>
        <div style='font-size: 22px; font-weight: bold; color: #d9534f; padding: 10px; border: 2px dashed #d9534f; display: inline-block; margin-top: 10px;'>
            $otp
        </div>
        <p style='font-size: 14px; color: #777; margin-top: 20px;'>If you did not request this OTP, please ignore this message.</p>
    </div>
";
	
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
	$mail->Subject="New OTP";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		echo json_encode(["success" => true, "status" => 200, "message" => "OTP sent successfully"]);
	}else{
		echo json_encode(["success" => false, "status" => 500, "message" => "OTP not sent"]);;
		die();
	}
}

// if($type=='mobile'){
// 	$mobile=get_safe_value($con,$_POST['mobile']);
// 	$check_mobile=mysqli_num_rows(mysqli_query($con,"select * from users where mobile='$mobile'"));
// 	if($check_mobile>0){
// 		echo "mobile_present";
// 		die();
// 	}
// 	$otp=rand(1111,9999);
// 	$_SESSION['MOBILE_OTP']=$otp;
// 	$message="$otp is your otp";
// 	/*
// 	$mobile=$mobile;
	
// 	/*$apiKey = urlencode('API_KEY');
// 	$numbers = array($mobile);
// 	$sender = urlencode('TXTLCL');
// 	$message = rawurlencode($message);
// 	$numbers = implode(',', $numbers);
//  	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
//  	$ch = curl_init('https://api.textlocal.in/send/');
// 	curl_setopt($ch, CURLOPT_POST, true);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	$response = curl_exec($ch);
// 	curl_close($ch);*/
// 	$fields = array(
// 		"sender_id" => "TXTIND",
// 		"message" => $message,
// 		"route" => "v3",
// 		"numbers" => $mobile,
// 	);

// 	$curl = curl_init();

// 	curl_setopt_array($curl, array(
// 	  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
// 	  CURLOPT_RETURNTRANSFER => true,
// 	  CURLOPT_ENCODING => "",
// 	  CURLOPT_MAXREDIRS => 10,
// 	  CURLOPT_TIMEOUT => 30,
// 	  CURLOPT_SSL_VERIFYHOST => 0,
// 	  CURLOPT_SSL_VERIFYPEER => 0,
// 	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	  CURLOPT_CUSTOMREQUEST => "POST",
// 	  CURLOPT_POSTFIELDS => json_encode($fields),
// 	  CURLOPT_HTTPHEADER => array(
// 		"authorization: OfPVkREDXlL4aJKpUAht6c5djm29u3v0xTMIFWGbC8So7grQiwK9euyqCMoU48LjXAv1Rp7lNa0IOfQY",
// 		"accept: */*",
// 		"cache-control: no-cache",
// 		"content-type: application/json"
// 	  ),
// 	));

// 	$response = curl_exec($curl);
// 	$err = curl_error($curl);

// 	curl_close($curl);

// 	if ($err) {
// 	  //echo "cURL Error #:" . $err;
// 	} else {
// 	  echo "done";
// 	}
// 	//echo "done";
// }
?>