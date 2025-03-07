<?php 
require('top.php');
// $res=mysqli_query ($con, "select * from users where id=$uid ")  ;
//     $check_user=mysqli_num_rows($res);
//     if($check_user>0){
//         $row=mysqli_fetch_assoc($res);
//         $email=$row['email'];
//         $name=$row['name'];
// $to = $email;

// $subject = "Wedding Attire hire ";
// $message = "Hello,$name Your order has been successfully placed!";
// $headers = "From: weddingattirehire@gmail.com";
// if (mail($to, $subject, $message, $headers)) {
//     echo " ";
// } else {
//     echo "Email sending failed.";
// }
// }
?>

        <div class="ht__bradcaump__area" >
<div class="container" style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px;">
                        <div class="col-xs-5">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i>/</i></span>
                                  <span class="breadcrumb-item active"> Thank_you</span>
                                </nav>
                        </div>
                </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    Your order has been placed successfully
									
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        						
<?php require('footer.php')?>        