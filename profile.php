<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
?>
        <!-- End Bradcaump area -->
        <div class="ht__bradcaump__area" >
                <div class="container" style="height:100px; widht:100%; padding:30px 20px;">
                        <div class="col-xs-5">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">Profile</span>
                                </nav>

                        </div>

                </div>

        </div>
		<!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Profile</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="login-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%" value="<?php echo $_SESSION['USER_NAME']?>">
										</div>
										<span class="field_error" id="name_error"></span>
									</div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="update_profile()" id="btn_submit">Update</button>
										
									</div>
								</form>
								
								
								
							</div>
						</div> 
                
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Change Password</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form method="post" id="frmPassword">
									<div class="single-contact-form">
										<label class="password_label">Current Password</label>
										<div class="contact-box name">
											<input type="password" name="current_password" id="current_password" style="width:100%" >
										</div>
										<span class="field_error" id="current_password_error"></span>
									</div>
									<div class="single-contact-form">
										<label class="password_label">New Password</label>
										<div class="contact-box name">
											<input type="password" name="new_password" id="new_password" minlength="8" style="width:100%" >
										</div>
										<span class="field_error" id="new_password_error"></span>
									</div>
									<div class="single-contact-form">
										<label class="password_label">Confirm New Password</label>
										<div class="contact-box name">
											<input type="password" name="confirm_new_password" id="confirm_new_password" minlength="8"  style="width:100%">
										</div>
										<span class="field_error" id="confirm_new_password_error"></span>
									</div>
								<div class="show_password">
										<input type="checkbox" onclick="show_password()">
										<label for="show_password">Show Password</label>
										</div>
										<script>
										function show_password(){
					var current_password=document.getElementById('current_password');
				var new_password=document.getElementById('new_password');
				var confirm_new_password=document.getElementById('confirm_new_password');
				if(current_password.type=='password'){
					current_password.type='text';
					new_password.type='text';
					confirm_new_password.type='text';
				}else{
					current_password.type='password';
					new_password.type='password';
					confirm_new_password.type='password';
				}
			}
			</script>
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="update_password()" id="btn_update_password">Update</button>
										
									</div>
								</form>
								
								
								
							</div>
						</div> 
                
				</div>
				

					
            </div>
        </section>
		<script>
	function update_profile(){
    jQuery('.field_error').html('');
    var name = jQuery('#name').val();

    if(name == ''){
        jQuery('#name_error').html('Please enter your name');
    } else if(name.length > 7) {
        jQuery('#name_error').html('Name cannot exceed 7 characters');
    } else {
        jQuery('#btn_submit').html('Please wait...');
        jQuery('#btn_submit').attr('disabled', true);

        jQuery.ajax({
            url: 'update_profile.php',
            type: 'post',
            data: { name: name },
            success: function(result){
                if(result.trim() == "Your name updated successfully"){
                    //location.reload(); // Reload the page after successful update
					window.location.href='profile.php';
                } else {
                    jQuery('#name_error').html(result);
                }
                jQuery('#btn_submit').html('Update');
                jQuery('#btn_submit').attr('disabled', false);
            }
        });
    }
}

		
		function isValidPassword(password) {
    // Check if password is exactly 8 characters
    if (password.length !== 8) {
        return {
            isValid: false,
            errors: ["Password must be exactly 8 characters long"]
        };
    }

    var hasUpperCase = /[A-Z]/.test(password);
    var hasLowerCase = /[a-z]/.test(password);
    var hasNumbers = /\d/.test(password);
    var hasSpecialChar = /[@$!%*?&]/.test(password);
    
    var errors = [];
    
    if (!hasUpperCase) {
        errors.push("Password must contain at least one uppercase letter");
    }
    if (!hasLowerCase) {
        errors.push("Password must contain at least one lowercase letter");
    }
    if (!hasNumbers) {
        errors.push("Password must contain at least one number");
    }
    if (!hasSpecialChar) {
        errors.push("Password must contain at least one special character (@$!%*?&)");
    }
    
    return {
        isValid: errors.length === 0,
        errors: errors
    };
}

function update_password(){
    jQuery('.field_error').html('');
    var current_password = jQuery('#current_password').val();
    var new_password = jQuery('#new_password').val();
    var confirm_new_password = jQuery('#confirm_new_password').val();
    var is_error = '';

    // Current password validation
    if(current_password == ''){
        jQuery('#current_password_error').html('Please enter current password');
        is_error = 'yes';
    }

    // New password validation
    if(new_password == ''){
        jQuery('#new_password_error').html('Please enter new password');
        is_error = 'yes';
    } else {
        var passwordCheck = isValidPassword(new_password);
        if(!passwordCheck.isValid) {
            jQuery('#new_password_error').html(passwordCheck.errors.join('<br>'));
            is_error = 'yes';
        }
    }
    
    // Confirm password validation
    if(confirm_new_password == ''){
        jQuery('#confirm_new_password_error').html('Please enter confirm password');
        is_error = 'yes';
    } else if(new_password != confirm_new_password){
        jQuery('#confirm_new_password_error').html('New password and confirm password do not match');
        is_error = 'yes';
    }
    
    if(is_error == ''){
        jQuery('#btn_update_password').html('Please wait...');
        jQuery('#btn_update_password').attr('disabled', true);
        jQuery.ajax({
            url: 'update_password.php',
            type: 'post',
            data: 'current_password='+current_password+'&new_password='+new_password,
            success: function(result){
                jQuery('#current_password_error').html(result);
                jQuery('#btn_update_password').html('Update');
                jQuery('#btn_update_password').attr('disabled', false);
                jQuery('#frmPassword')[0].reset();
            }
        });
    }
}
		</script>

<?php require('footer.php')?>        