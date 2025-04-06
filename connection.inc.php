<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "ecom");
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/WAH');

$local_ip = 'localhost'; // Default to localhost

$output = shell_exec('ipconfig');

if ($output) {
    preg_match('/IPv4 Address[. ]+: ([\d.]+)/', $output, $matches);
    if (!empty($matches[1])) {
        $local_ip = $matches[1];
    }
}

define('SITE_PATH', 'http://' . $local_ip . '/WAH/');

define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH . '/media/product/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH . '/media/product/');

define('PRODUCT_MULTIPLE_IMAGE_SERVER_PATH', SERVER_PATH . '/media/product_images/');
define('PRODUCT_MULTIPLE_IMAGE_SITE_PATH', SITE_PATH . '/media/product_images/');



function isInternetAvailable() {
    return @fsockopen("www.google.com", 80);
}

function showOfflinePopup() {
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>No Internet Connection</title>
       <style>
        * {
            box-sizing: border-box;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9fafb;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup {
            background: #ffffff;
            padding: 30px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.38);
            text-align: center;
            max-width: 450px;
            width: 100%;
        }

        .popup .icon {
            font-size: 50px;
            color: #2196F3;
            margin-bottom: 10px;
        }

        .popup h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }

        .popup b {
            font-size: 15px;
            color: red;
            font-width:bold;
        }
    </style>
</head>
<body>
    <div class="popup">
        <div class="popup-content">
            <div class="icon">📡</div>
            <h2>No Internet Connection</h2>
            <b>Please check your connection and try reloading the page.</b>
        </div>
    </div>
</body>
</html>
HTML;
    exit();
}

?>
