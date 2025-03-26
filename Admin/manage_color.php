<?php
require('top.inc.php');
isAdmin();
$color_code='';
$color_name='';
$order_by= '';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from color_master where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$color=$row['color'];
	}else{
		?>
		<script>
			window.location.href="color.php";
		</script>
		<?php
	}
}

if(isset($_POST['submit'])){
	$color_name=get_safe_value($con,$_POST['color_name']);
	$color_code = get_safe_value($con, $_POST['color_code']);
	$res=mysqli_query($con,"select * from color_master where color='$color_code' and color_name='$color_name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Color already exist";
			}
		}else{
			$msg="Color already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update color_master set color='$color' where id='$id'");
		}else{
			
			mysqli_query($con, "INSERT INTO `color_master` (`id`, `color`, `color_name`, `order_by`, `status`) VALUES (NULL, '$color_code', '$color_name', '$order_by', '1');");
		}
		?>
		<script>
			window.location.href="color.php";
		</script>
		<?php
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="color" class=" form-control-label">Color code</label>
									<input type="text" name="color_code" placeholder="Enter color code" class="form-control" required value="<?php echo $color_code?>">
								</div>
								 <div class="form-group">
									<label for="color" class=" form-control-label">color name</label>
									<input type="text" name="color_name" placeholder="Enter color name" class="form-control" required value="<?php echo $color_name ?>">
								</div>
								 <div class="form-group">
									<label for="color" class=" form-control-label">order by</label>
									<input type="text" name="order_by" placeholder="order by" class="form-control" required value="<?php echo $order_by ?>">
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.inc.php');
?>