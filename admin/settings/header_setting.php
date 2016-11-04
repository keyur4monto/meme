<?php
include '../db.php';
session_start();
$set_title = $_POST['set_title'];
$set_description = $_POST['set_description'];

$extension=array("jpeg","jpg","png","gif");
$logo=$_FILES["logo"]["name"];
$target_path = "../assets/images/logo/".$logo;
$file_tmp=$_FILES["logo"]["tmp_name"];
$ext=pathinfo($logo,PATHINFO_EXTENSION);

$fevicon=$_FILES["fevicon"]["name"];
$target_path1 = "../assets/images/fevicon/".$fevicon;
$fevicon_tmp=$_FILES["fevicon"]["tmp_name"];
$ext1=pathinfo($fevicon,PATHINFO_EXTENSION);

if(in_array($ext1,$extension))
{
    if(!file_exists($target_path1))
    {
        move_uploaded_file($fevicon_tmp=$fevicon_tmp,$target_path1);
        $query1 = "UPDATE admin_setting_option SET fevicon='$target_path1' where id=1";
              if ($conn->query($query1) === TRUE) {
              }  
    }
}

if(in_array($ext,$extension))
{
    if(!file_exists($target_path))
    {
        move_uploaded_file($file_tmp=$file_tmp,$target_path);
        $query = "UPDATE admin_setting_option SET website_title='$set_title', tagline='$set_description', logo='$target_path' where id=1";
             //echo $query; exit;
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              }  
    }
    else{
        $query = "UPDATE admin_setting_option SET website_title='$set_title', tagline='$set_description' where id=1";
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              } 
    }
}
else{
        $query = "UPDATE admin_setting_option SET website_title='$set_title', tagline='$set_description' where id=1";
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              } 
    }
include '../footer.php';
?>
