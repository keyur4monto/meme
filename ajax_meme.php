<?php
session_start();

include('common/db.php');
/*if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}*/
define('UPLOAD_DIR', 'admin/assets/images/meme_image/');
// make sure the image-data exists and is not empty
// xampp is particularly sensitive to empty image-data 
if ( isset($_POST["image"]) && !empty($_POST["image"]) ) {    

    // get the dataURL
    $dataURL = $_POST["image"];
    $meme_name = $_POST["meme_name"];
    $meme_tag = $_POST["meme_tag"];
    $template_id = $_POST["template_id"];
    $user_id = $_POST["user_id"];
    $meme_lang = $_POST["meme_lang"];
   
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
    
    //count tag name insert meme [start code] 
    $temp_tags = explode(',',$meme_tag);
		
		foreach($temp_tags as $temp_tag){
			$sel_tag = "SELECT * FROM `tag` WHERE `tag_name`='$temp_tag'";
			$ex_sel_tag = mysqli_query($conn,$sel_tag);
		    if(!empty($meme_tag)){	
    			if(mysqli_num_rows($ex_sel_tag) > 0){
    			     $row_sel_tag = mysqli_fetch_array($ex_sel_tag);
                     $count = $row_sel_tag['count'];
                     $count++;
                     
                     $updt_tag = "UPDATE `tag` SET `count`='$count',`tagof`='1' WHERE `tag_name`='$temp_tag'";
                     $ex_updt_tag = mysqli_query($conn,$updt_tag);
    			}
    			else{
    				$ins_tag = "INSERT INTO `tag` (`tag_name`,`status`,`tagof`) VALUES ('$temp_tag','1','1')";
                    $ex_ins_tag = mysqli_query($conn,$ins_tag);
    			}
		  }		
		} 
     //count tag name insert meme [end code] 
    
    $query = "INSERT INTO meme (user_id,template_id, meme_name,meme_tag,meme_lang,meme_image) VALUES ('$user_id','$template_id','$meme_name','$meme_tag','$meme_lang','$file')";      
   
    if (mysqli_query($conn, $query)) {
        $last_id = $conn->insert_id;
        $totalcount= mysqli_query($conn, "SELECT * FROM template where id='$template_id'");
            $tem_counts = $totalcount->fetch_assoc();
            $tem_count = $tem_counts['template_count']+1;
            $template_count_query = "UPDATE `template` SET `template_count` = '".$tem_count."' WHERE `id` = '$template_id'";
            $updt_tem_count = mysqli_query($conn,$template_count_query);
      $result = array($file,$meme_name,$last_id);
      echo json_encode($result);
    }
}