<?php
include '../db.php';
session_start();
$set_copyright = $_POST['set_copyright'];
$set_aboutus = $_POST['set_aboutus'];

$query = "UPDATE admin_setting_option SET copyright='$set_copyright', about_us_text='$set_aboutus' where id=1";
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              } 
include '../footer.php';
?>
