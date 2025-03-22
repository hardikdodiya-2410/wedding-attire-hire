<?php 
require('top.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
	?>
	<script>
	window.location.href='my_order.php';
	</script>
	<?php
}
?>
<!-- Start Bradcaump area -->
 <html>
	<head>
		
	</head>
<div class="ht__bradcaump__area" >
    <div class="container" style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px;">
                        <div class="col-xs-5">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i>/</i></span>
                                  <span class="breadcrumb-item active"> Login/Register </span>
                                </nav>
                        </div>
                </div>
        </div>
        <!-- End Bradcaump area -->
        
		<!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="login-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="field_error" id="login_email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="login_password" id="login_password" placeholder="Your Password*" minlength="8" style="width:100%">
										</div>
										<span class="field_error" id="login_password_error"></span>
										<div class="show_password">
										<input type="checkbox" onclick="showpassword()">
										<label for="show_password">Show Password</label>
										</div>
										<script>
									function showpassword(){
				var password=document.getElementById('login_password');
				if(password.type=='password'){
					password.type='text';
				}else{
					password.type='password';
				}
			}
										</script>
									</div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="user_login()">Login</button>
										<a href="forget_password.php" class="forgot_password">Forgot Password</a>
									</div>
								</form>
								<div class="form-output login_msg">
									<p class="form-messege field_error"></p>
								</div>
							</div>
						</div> 
                
				</div>
				

					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="register-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" maxlength="7"style="width:100%">
										</div>
										<span class="field_error" id="name_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="email" id="email" placeholder="Your Email*" style="width:45%" required>
											
											
											<button type="button" class="fv-btn email_sent_otp height_60px" onclick="email_sent_otp()">Send OTP</button>
											
											<input type="text" id="email_otp" placeholder="OTP" style="width:45%"   maxlength="4"  maxlength="4"class="email_verify_otp">
											
											
											<button type="button" class="fv-btn email_verify_otp height_60px" onclick="email_verify_otp()">Verify OTP</button>
											
											<span id="email_otp_result"></span>
										</div>
										<span class="field_error" id="email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="mobile" id="mobile" placeholder="Your Mobile*"  maxlength="10" style="width:100%">
										</div>
									
										<span class="field_error" id="mobile_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="password" id="password" placeholder="Your Password*"  minlength="8" style="width:100%">
										</div>
										<span class="field_error" id="password_error"></span>
										<div class="show_password">
										<input type="checkbox" onclick="show_password()">
										<label for="show_password">Show Password</label>
										</div>
									</div>
							
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="user_register()"  id="btn_register">Register</button>
									</div>
								</form>
								<div class="form-output register_msg">
									<p class="form-messege field_error"></p>
								</div>
							</div>
						</div> 
                
				</div>
					
            </div>
        </section>
		<input type="hidden" id="is_email_verified"/>
		
		<script>
		// 	 const button = document.getElementById('btn_register');
        // button.addEventListener('click', function() {
        //     alert('Please enter your details.');
        // });

			function show_password(){
				var password=document.getElementById('password');
				if(password.type=='password'){
					password.type='text';
				}else{
					password.type='password';
				}
			}
function user_register(){
	jQuery('.field_error').html('');
	var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var mobile=jQuery("#mobile").val();
	var password=jQuery("#password").val();
	var is_email_verified=jQuery("#is_email_verified").val();
	
	var is_error='';
	
	// Name validation
	if(name==""){
		jQuery('#name_error').html('Please enter name');
		is_error='yes';
	} else if(name.length > 7) {
		jQuery('#name_error').html('Name cannot be longer than 7 characters');
		is_error='yes';
	}
	else
	{
		jQuery('#name_error').html(' ');
	}
	
	// Email validation
	if(email==""){
		jQuery('#email_error').html('Please enter email');
		is_error='yes';
	} else if(!isValidEmail(email)) {
		jQuery('#email_error').html('Please enter a valid email address');
		is_error='yes';
	}
	
	// Mobile validation
	if(mobile==""){
		jQuery('#mobile_error').html('Please enter mobile');
		is_error='yes';
	} else if(!isValidMobile(mobile)) {
		jQuery('#mobile_error').html('Please enter a valid 10-digit mobile number');
		is_error='yes';
	}
	
	// Password validation
	if(password==""){
		jQuery('#password_error').html('Please enter password');
		is_error='yes';
	} else {
		var passwordCheck = isValidPassword(password);
		if(!passwordCheck.isValid) {
			jQuery('#password_error').html(passwordCheck.errors.join('<br>'));
			is_error='yes';
		}
	}

	if(is_error==''){
		jQuery.ajax({
			url:'register_submit.php',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password+'&is_email_verified='+is_email_verified,
			success:function(result){
				console.log(result);
				if(result.email_present){
					jQuery('#email_error').html('Email id already present');
				}
				if(result.mobile_present){
					jQuery('#mobile_error').html('Mobile number already present');
				}
				if(result.email_not_verified)
				{
					jQuery('#email_error').html('Email id not verified');
				}
				if(result.insert){
					alert('Thank you for registeration');
					window.location.reload();
				}
			}	
		});
	}
	
}

function isValidEmail(email) {
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailRegex.test(email);
}

function isValidMobile(mobile) {
    var mobileRegex = /^[0-9]{10}$/;
    return mobileRegex.test(mobile);
}

function isValidPassword(password) {
	// if (password.length >= 8) {
    //     return {
    //         isValid: false,
    //         errors: ["Password must be exactly 8 characters long"]
    //     };
    // }
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

function user_login(){
	jQuery('.field_error').html('');
	var email=jQuery("#login_email").val();
	var password=jQuery("#login_password").val();
	var is_error='';
	if(email==""){
		jQuery('#login_email_error').html('Please enter email');
		is_error='yes';
	}if(password==""){
		jQuery('#login_password_error').html('Please enter password');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				result=result.trim();
				if(result=='wrong'){
					jQuery('.login_msg p').html('Please enter valid login details');
				}
				if(result=='valid'){
					window.location.href='index.php';
				}
			}	
		});
	}	
}

		function email_sent_otp(){
			jQuery('#email_error').html('');
			var email=jQuery('#email').val();
			if(email==''){
				jQuery('#email_error').html('Please enter email id');
			}else{
				jQuery('.email_sent_otp').html('Please wait..');
				jQuery('.email_sent_otp').attr('disabled',true);
				jQuery.ajax({
					url:'send_otp.php',
					type:'post',
					data:'email='+email+'&type=email',
					success:function(result){
						console.log(result);
						if(result.success){
							jQuery('#email').attr('disabled',true);
							jQuery('.email_verify_otp').show();
							jQuery('.email_sent_otp').hide();
							
						}
						else if(result.email_present){
							jQuery('.email_sent_otp').html('Send OTP');
							jQuery('.email_sent_otp').attr('disabled',false);
							jQuery('#email_error').html('Email id already exists');
						}
						else{
							jQuery('.email_sent_otp').html('Send OTP');
							jQuery('.email_sent_otp').attr('disabled',false);
							jQuery('#email_error').html('Please try after sometime');
						}
					}
				});
			}
		}
		function email_verify_otp(){
			jQuery('#email_error').html('');
			var email_otp=jQuery('#email_otp').val();
			if(email_otp==''){
				jQuery('#email_error').html('Please enter OTP');
			}else{
				jQuery.ajax({
					url:'check_otp.php',
					type:'post',
					data:'otp='+email_otp+'&type=email',
					success:function(result){
						if(result.success){
							jQuery('.email_verify_otp').hide();
							jQuery('#email_otp_result').html('Email id verified');
							jQuery('#is_email_verified').val('1');

							//  jQuery('#btn_register').attr('disabled',false);

							
						}else{
							jQuery('#email_error').html('Please enter valid OTP');
						}
					}
				});
			}
		}
		
		
		</script>
<?php require('footer.php')?>        