<?php
require('connection.inc.php');
require('functions.inc.php');
unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
// header('location:login.php');
?>
		<script>
			window.location.href="login.php";
		</script>
		<?php
die();
?>