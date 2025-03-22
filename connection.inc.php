<?php
session_start();
$con=mysqli_connect("localhost","root","","ecom");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/ecom');

$local_ip = 'Not Found';
$output = shell_exec('ipconfig');

if ($output) {
    preg_match('/IPv4 Address[. ]+: ([\d.]+)/', $output, $matches);
    $local_ip = $matches[1] ?? 'Not Found';
}

define('SITE_PATH', 'http://' . $local_ip . '/ecom/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');

define('PRODUCT_MULTIPLE_IMAGE_SERVER_PATH',SERVER_PATH.'/media/product_images/');
define('PRODUCT_MULTIPLE_IMAGE_SITE_PATH',SITE_PATH.'/media/product_images/');

?>
