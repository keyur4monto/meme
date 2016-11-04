<?php
ob_start();
include '../header.php';
$set_watermarktext = $_POST['set_watermarktext'];
$set_watermark = $_POST['set_watermark'];

$extension=array("jpeg","jpg","png","gif");
$watermark=$_FILES["watermark_image"]["name"];
$target_path = "../assets/images/watermark/".$watermark;
$file_tmp=$_FILES["watermark_image"]["tmp_name"];
$ext=pathinfo($watermark,PATHINFO_EXTENSION);

if(in_array($ext,$extension))
{
    if(!file_exists($target_path))
    {
        move_uploaded_file($file_tmp=$file_tmp,$target_path);
        $query = "UPDATE admin_setting_option SET water_mark_text='$set_watermarktext', set_watermark='$set_watermark', water_mark_image='$target_path' where id=1";
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              }  
    }
    else{
        $query = "UPDATE admin_setting_option SET water_mark_text='$set_watermarktext', set_watermark='$set_watermark' where id=1";
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              } 
    }
}
else{
        $query = "UPDATE admin_setting_option SET water_mark_text='$set_watermarktext', set_watermark='$set_watermark' where id=1";
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl.'settings');
              } 
    }
include '../footer.php';
?>
