<?php require('top.php');
date_default_timezone_set('Asia/Kolkata');
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
error_reporting(0);
$name=$_POST['name'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$comment=$_POST['comment'];
$added_on=date("d-m-Y h:i:s");
$res=mysqli_query($con,"select * from users where id='$uid'");
$check_user=mysqli_num_rows($res);
if($check_user>0){
    $row=mysqli_fetch_assoc($res);
    $name=$row['name'];
    $email=$row['email'];
    $mobile=$row['mobile'];
}
if(isset ($_POST["insert"]))
{
    if(!$name)
    {
        $name_error="<br>*Please enter your name";
    }
    if(!$comment)
    {
        $message_error="<br>*Please enter your message";
    }
    if(!$email)
    {
        $email_error="<br>*Please enter your  email";
	
    }
    if(!$mobile)
    {
        $mobile_error="<br>*Please enter your  mobile";	
    }
    if($name && $comment && $email && $mobile)
    {
   // $insert="INSERT INTO `contact_us` ( `id`,`name`, `email`, `mobile`,`comment`,`added_on`) VALUES (NULL, '$name', '$email', '$mobile', '$comment','$added_on')";
    $insert="INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES (NULL, '$name', '$email', '$mobile', '$comment','$added_on')";
     $result=mysqli_query($con,$insert);
        if(!$result)
        {
            echo "<script> alert('sory to faild insert') </script>";
        }
        else
        {
            echo "<script> alert('Message sent successfully!') </script>";
            
            
            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);
            
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'weddingattirehire@gmail.com';
                $mail->Password   = 'docn enfi endy rqbk'; // Use App Password for Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
            
                // Recipients
                $mail->setFrom('weddingattirehire@gmail.com');
                $mail->addAddress ($email) ;
            
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Feedback from '.$name;
                $mail->Body    = '
                <html>
                <head>
                    <title>User Feedback</title>
                </head>
                <body>
                    <h2>Feedback from: ' . $name . '</h2>
                    <div style="margin: 20px 0; padding: 15px; background-color: #f8f9fa; border-radius: 5px;">
                        <p style="font-size: 16px;">' . nl2br(htmlspecialchars($comment)) . '</p>
                    </div>
                    <p style="color: #666;">Email: ' . $email . '</p>
                </body>
                </html>';
            
                $mail->send();
                echo "Email sent successfully.";
            } catch (Exception $e) {
                echo "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
            }
                   
        } 
    }
}

?>
 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area" >
 <div class="container" style="widht:100%; padding:20px;background-color:#f5f5f5;margin-bottom:20px;margin-top:20px;">
                        <div class="col-xs-5">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i>/</i></span>
                                  <span class="breadcrumb-item active"> Contact Us  </span>
                                </nav>
                        </div>
                </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                        <div class="map-contacts--2">
                            <div id="googleMap"></div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                        <h2 class="title__line--6">CONTACT US</h2>
                        <div class="address">
                            <div class="address__icon">
                                <i class="icon-location-pin icons"></i>
                            </div>
                            <div class="address__details">
                                <h2 class="ct__title">our address</h2>
                                
                                    <p>waghawadi road,Bhavnagar-364001</p>
                            </div>
                        </div>
                        <div class="address">
                            <div class="address__icon">
                                <i class="icon-envelope icons"></i>
                            </div>
                            <div class="address__details">
                                <h2 class="ct__title">openning hour</h2>
                                <p>10:00 AM to 10:00 PM</p>
                            </div>
                        </div>

                        <div class="address">
                            <div class="address__icon">
                                <i class="icon-phone icons"></i>
                            </div>
                            <div class="address__details">
                                <h2 class="ct__title">Phone Number</h2>
                                <p>+91 7285008403</p>
                            </div>
                        </div>
                    </div>      
                </div>
                <?php if(isset($_SESSION['USER_LOGIN'])){
                    ?>
                <div class="row">
                    <div class="contact-form-wrap mt--60">
                        <div class="col-xs-12">
                            <div class="contact-title">
                                <h2 class="title__line--6">SEND A MAIL</h2>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <form id="contact-form"  method="post">
                                <div class="single-contact-form">
                                    <div class="contact-box message">
                                        <textarea  id="comment" name="comment" value="comment" placeholder="Your Message"  ></textarea>
                                    </div>
                                    <span class="field_error" id="name_error"><?php echo $message_error ?></span>
                                </div>
                                <div class="contact-btn">
                                    <button type="submit" name="insert" id="insert" class="fv-btn">Send MESSAGE</button>
                                </div>
                            </form>
                         
                        </div>
                    </div> 
                </div>
                <?php }?>
            </div>
        </section>
        <!-- End Contact Area -->
        <!-- End Banner Area -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmGmeot5jcjdaJTvfCmQPfzeoG_pABeWo "></script>
        <script src="js/contact-map.js"></script>
        <script>
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 12,

                scrollwheel: false,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(21.76287000,72.1533100), // New York

                // How you would like to style the map. 
                // This is where you would paste any style found on Snazzy Maps.
                 styles: 
        [ {
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "saturation": 36
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 40
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    },
                    {
                        "weight": 1.2
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 18
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 19
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#141516"
                    },
                    {
                        "lightness": 17
                    }
                ]
            }
        ]
            };

            // Get the HTML DOM element that will contain your map 
            // We are using a div with id="map" seen below in the <body>
            var mapElement = document.getElementById('googleMap');

            // Create the Google Map using our element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            // Let's also add a marker while we're at it
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(23.7286, 90.3854),
                map: map,
                title: 'Ramble!',
                icon: 'images/icons/map-2.png',
                animation:google.maps.Animation.BOUNCE

            });
        }
    </script>

      	<?php require('footer.php');?>
