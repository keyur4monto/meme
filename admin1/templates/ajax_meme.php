<?php
include('../db.php');
define('UPLOAD_DIR', '../assets/images/meme_image/');
// make sure the image-data exists and is not empty
// xampp is particularly sensitive to empty image-data 
if ( isset($_POST["image"]) && !empty($_POST["image"]) ) {    

    // get the dataURL
    $dataURL = $_POST["image"];
    $meme_name = $_POST["meme_name"];
    $meme_tag = $_POST["meme_tag"];
    $template_id = $_POST["template_id"];
    $admin_id = $_POST["admin_id"];

    // the dataURL has a prefix (mimetype+datatype) 
    // that we don't want, so strip that prefix off
    $parts = explode(',', $dataURL);  
    $data = $parts[1];  

    // Decode base64 data, resulting in an image
    $data = base64_decode($data);  

    // create a temporary unique file name
    $file = UPLOAD_DIR . uniqid() . '.png';

    // write the file to the upload directory
    $success = file_put_contents($file, $data);
    $query = "INSERT INTO meme (admin_id,template_id, meme_name,meme_tag,meme_image) VALUES ('$admin_id','$template_id','$meme_name','$meme_tag','$file')";      
                          if (mysqli_query($conn, $query)) {
                          //header("Location:".$siteurl."category");
                          echo $file;
                          }
    // return the temp file name (success)
    // or return an error message just to frustrate the user (kidding!)
    

}