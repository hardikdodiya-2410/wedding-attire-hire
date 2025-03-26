<?php
require('connection.inc.php');
require('functions.inc.php');

if(isset($_POST['id'])){

	if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

	}else{
		?>
		
		<script>
			window.location.href = "login.php";
		</script>
		<?php
	}

	$id=get_safe_value($con,$_POST['id']);
	mysqli_query($con,"delete from product_attributes where id='$id'");
}
?>