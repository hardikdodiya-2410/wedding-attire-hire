<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecom";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id =$_GET['id'];
$status = $_GET['status'];
$sql = "UPDATE product SET status='$status' WHERE id=$id";
$conn->query($sql);
header('location:admin_panel.php?page=products');
exit;


?>