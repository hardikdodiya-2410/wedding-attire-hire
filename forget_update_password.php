<?php
require('connection.inc.php');
require('functions.inc.php');
$email=get_safe_value($con,$_POST['email']);

$new_password=get_safe_value($con,$_POST['new_password']);


$res = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($res) > 0){
    echo "exists";
} else {
    echo "not_exists";
}
$row=mysqli_fetch_assoc(mysqli_query($con,"select password from users where email='$email'"));
$check_user=mysqli_num_rows (mysqli_query ($con, "select * from users where email='$email' ") ) ;
			if ($check_user>0) {
	

	mysqli_query($con,"update users set password='$new_password' where email='$email'");

?>

	<script>
		alert('Your password has been successfully reset. You can now login with your new password');
	window.location.href="login.php";
</script><?php
}
		
			else
			{
				?>
	<script>
		alert('Email not found. Please check your email or register a new account');
	window.location.href="login.php";
</script><?php
			}
?>