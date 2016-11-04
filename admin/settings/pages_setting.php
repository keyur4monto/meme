<?php
include '../db.php';
session_start();
/*$set_aboutme = $_POST['set_aboutme'];
$set_terms = $_POST['set_terms'];
$set_disclaimer = $_POST['set_disclaimer'];
$set_privacy = $_POST['set_privacy']; */

$set_aboutme    = mysqli_real_escape_string($conn,$_POST['editor1']);

$set_terms      = mysqli_real_escape_string($conn,$_POST['editor2']);
$set_disclaimer = mysqli_real_escape_string($conn,$_POST['editor3']);
$set_privacy    = mysqli_real_escape_string($conn,$_POST['editor4']); 
echo 'hiii:'. $set_aboutme;
$query = "UPDATE admin_setting_option SET `aboutme_page`='$set_aboutme', `terms_page`='$set_terms', `disclaimer_page`='$set_disclaimer', `privacy_page`='$set_privacy' WHERE `id`=1";
 echo "HELLO :".$query;            
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              } 
include '../footer.php';
?>
