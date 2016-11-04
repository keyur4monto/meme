<?php
include '../db.php';
session_start();
$set_bannertext = $_POST['set_bannertext'];
$set_banner = $_POST['set_banner'];

$extension=array("jpeg","jpg","png","gif");
$banner=$_FILES["banner_image"]["name"];
$target_path = "../assets/images/banner/".$banner;
$file_tmp=$_FILES["banner_image"]["tmp_name"];
$ext=pathinfo($banner,PATHINFO_EXTENSION);

if(in_array($ext,$extension))
{
    if(!file_exists($target_path))
    {
        move_uploaded_file($file_tmp=$file_tmp,$target_path);
        $query = "UPDATE admin_setting_option SET banner_text='$set_bannertext', set_banner='$set_banner', banner_image='$target_path' where id=1";
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              }  
    }
    else{
        $query = "UPDATE admin_setting_option SET banner_text='$set_bannertext', set_banner='$set_banner' where id=1";
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              } 
    }
}
else{
        $query = "UPDATE admin_setting_option SET banner_text='$set_bannertext', set_banner='$set_banner' where id=1";
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              } 
    }
include '../footer.php';
?>
