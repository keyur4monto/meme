<?php
session_start();

include('common/db.php');
	//This is just like a normal form submission
	//You can access the uploaded files through $_FILES 
/*	if(isset($_FILES["file"]))
		move_uploaded_file($_FILES["file"]["tmp_name"], "picture1.jpg");*/
        
        $ds          = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = 'uploads';   //2
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
     echo  'hii'.$tempFile;
     die();
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
 
    move_uploaded_file($tempFile,$targetFile); //6
     
}

?>