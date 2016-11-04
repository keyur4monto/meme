<?php
ob_start();
include '../header.php';
if($_GET['id']!=''){
$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id=".$id;
if ($conn->query($sql) === TRUE) {
header("Location:".$siteurl."users");
} 
}
include '../footer.php';
?>
