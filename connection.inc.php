<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "ecom");
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/ecom');

$local_ip = '127.0.0.1'; // Default to localhost

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

?>
