<?php require('top.php');
?>

		<div class="ht__bradcaump__area" >
		<div class="container" style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px;">
                        <div class="col-xs-5">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i>/</i></span>
                                  <span class="breadcrumb-item active">Forget Password</span>
                                </nav>
                        </div>
                </div>
        </div> 
        <!-- End Bradcaump area -->
        <section class="htc__contact__area ptb--50 bg__white">
            <div class="container">
                <div class="row">
           
					<div class="col-md-12">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Forget Password</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form method="post" id="frmPassword">
									<div class="single-contact-form">
										<label class="password_label">Email</label>
										<div class="contact-box name">
											<input type="email" name="email" placeholder=" Enter Your Registered Email" id="email" style="width:100%">
										</div>
										<span class="field_error" id="email_error"></span>
									</div>
									
									<div class="single-contact-form">
										<label class="password_label">New Password</label>
										<div class="contact-box name">
											<input type="password" name="new_password" placeholder=" Enter Your New Password" id="new_password" style="width:100%">
										</div>
										<span class="field_error" id="new_password_error"></span>
									</div>
									<div class="single-contact-form">
										<label class="password_label">Confirm New Password</label>
										<div class="contact-box name">
											<input type="password" name="confirm_new_password"placeholder="Enter Your Confirm New Password" id="confirm_new_password" style="width:100%">
										</div>
										<span class="field_error" id="confirm_new_password_error"></span>
									</div>
									<span class="field_error" id="current_password_error"></span>
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="forget_password()" id="btn_update_password">forget password</button>
										
									</div>
								</form>
								
								
								
							</div>
						</div> 
                
				</div>
				

				</div>
					
            </div>
        </section>
        <script>
            		function forget_password(){
			jQuery('.field_error').html('');
			// var current_password=jQuery('#current_password').val();
			var new_password=jQuery('#new_password').val();
			var confirm_new_password=jQuery('#confirm_new_password').val();
			var email=jQuery('#email').val();
			var is_error='';
            
			if(new_password==''){
				jQuery('#new_password_error').html('Please enter password');
				is_error='yes';
			}
			else if(!isValidPassword(new_password)) {
				jQuery('#new_password_error').html('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character');
				is_error='yes';
			}
			if(confirm_new_password==''){
				jQuery('#confirm_new_password_error').html('Please enter password');
				is_error='yes';
			}
			
			if(new_password!='' && confirm_new_password!='' && new_password!=confirm_new_password){
				jQuery('#confirm_new_password_error').html('Please enter same password');
				is_error='yes';
			}
			
			if(is_error==''){
				jQuery('#btn_update_password').html('Please wait...');
				jQuery('#btn_update_password').attr('disabled',true);
				jQuery.ajax({
					url:'forget_update_password.php',
					type:'post',
					data:'&email='+email+'&new_password='+new_password,
					success:function(result){
						jQuery('#current_password_error').html(result);
						jQuery('#btn_update_password').html('Update');
						jQuery('#btn_update_password').attr('disabled',false);
						jQuery('#frmPassword')[0].reset();
						if(result == 'not_exists'){
                    		jQuery('#email_error').html('Email is not registered');
                    		is_error = 'yes';
                } else {
                    // Continue with password validation
                    validatePassword();
                }
					}
				})
			}
			
		}
	
	function isValidPassword(new_password) {
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return passwordRegex.test(new_password);
}
		</script>


	<?php require('footer.php');?>
