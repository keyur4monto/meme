<?php
session_start();
if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}
include('common/db.php');
include('common/adminsetting.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Upload Template |  <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?> </title>
    <link rel="shortcut icon" href="<?php if(!empty($favicon)){echo $siteurl.'/admin/'.$favicon;}else { echo 'favicon.png';}?>" type="image/png"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/potenza-style.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href='css/other-font.css' rel='stylesheet' type='text/css'>
    <script src="js/new/jquery.min.js"></script>
    <script src="js/new/jquery.validate.min.js"></script>
    <script src="js/dropzone.js"></script>
    
</head>
<body>

<?php

	//Header 
	include('common/header.php');

?>
<div class="main-content">
<section>
<div class="container">
    <div class="content white-bg pall-20 pb-40 sm-plr-10 sm-pb-10 xs-pb-0">
        <div class="row">
            <div class="col-sm-12 text-capitalize">
                <h2 class="m-0">Upload Your Own Meme Image</h2>
                <hr>
                <div class="clearfix"></div>
                <div id="actions" class="row">
                      <div class="col-lg-7">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-primary fileinput-button">
                           <i class="glyphicon glyphicon-plus"></i>
                           <span>Upload a file</span>
                        </span>
                        
                      </div>
                      <div class="col-lg-5">
                     <!-- The global file processing state -->
                       <span class="fileupload-process">
                          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                          </div>
                       </span>
                     </div>
               </div>
               <div class="table table-striped table-responsive" class="files" id="previews">

                          <div id="template" class="file-row">
                                 <!-- This is used as the file preview template -->
                                  <div>
                                        <span class="preview"><img data-dz-thumbnail /></span>
                                  </div>
                                 <div>
                                      <p class="name" data-dz-name></p>
                                       <strong class="error text-danger" data-dz-errormessage></strong>
                                  </div>
                                  <div>
                                     <p class="size" data-dz-size></p>
                                     <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                     </div>
                                  </div> 
                                  <div>
                                  
                                   <button class="new1 btn btn-primary start">
                                      <i class="glyphicon glyphicon-upload"></i>
                                     <span>Start</span>
                                  </button>
                                 
                                 <!--  <button  class="btn11" id="btn11">test</button> -->
                                 <button data-dz-remove class="btn btn-warning cancel">
                                     <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Cancel</span>
                                 </button>
                               <button data-dz-remove class="btn btn-danger delete">
                                  <i class="glyphicon glyphicon-trash"></i>
                                  <span>Delete</span>
                              </button>
                            </div>
                  </div>
            </div>
            
            
             <div id="dropzone">
                   <form id="demo-upload" class="dropzone needsclick dz-clickable text-center" action="" id="myAwesomeDropzone">
                     <div class="dz-message needsclick">
                         <i class="fa fa-cloud-upload" aria-hidden="true"></i><br>
                         <span><b>drag and drop files here</b></span>
                         
                     </div>
                  </form>
                 
             </div>
            <div class="clearfix"></div>
         </div>
     </div>
  </div>
</div>
</section>
</div>
<?php 
$username = $_SESSION['session_username']; 

if (!empty($_FILES)) {
                        
                        extract($_POST);
                        $extension=array("jpeg","jpg","png","gif");
                        $file_name=$_FILES["file"]["name"];
                        $uniqid = uniqid();
                        $target_path = "uploads/template_image/".$uniqid.$file_name;
                        $thumb_path = "uploads/template_image/thumb/".$uniqid.$file_name;
                        
                        $file_tmp=$_FILES["file"]["tmp_name"];
                        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                       
                        if(in_array($ext,$extension))
                        {
                            if(!file_exists($target_path))
                            {
                                if($ext=="jpg" || $ext=="jpeg" )
                                {
                                $uploadedfile = $_FILES['file']['tmp_name'];
                                $src = imagecreatefromjpeg($uploadedfile);
                                }
                                else if($ext=="png")
                                {
                                $uploadedfile = $_FILES['file']['tmp_name'];
                                $src = imagecreatefrompng($uploadedfile);
                                }
                                else 
                                {
                                $src = imagecreatefromgif($uploadedfile);
                                }
                                 
                                list($width,$height)=getimagesize($uploadedfile);
                                if ($width > $height) {
                                  $y = 0;
                                  $x = ($width - $height) / 2;
                                  $smallestSide = $height;
                                } else {
                                  $x = 0;
                                  $y = ($height - $width) / 2;
                                  $smallestSide = $width;
                                }
                                
                                // copying the part into thumbnail
                                $thumbSize = 100;
                                $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
                                imagecopyresampled($thumb, $src, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
                                imagejpeg($thumb,$thumb_path,100);
                                
                                
                                /*$newwidth=100;
                                $newheight=100;
                                $tmp=imagecreatetruecolor($newwidth,$newheight);
                                
                                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                                imagejpeg($tmp,$thumb_path,100);
                                imagedestroy($src);
                                imagedestroy($tmp);*/
                                
                                move_uploaded_file($file_tmp=$_FILES["file"]["tmp_name"],$target_path);
                                $success_msg = 'Thanks for uploading! To activate the image, provide a title below and save.';
                            }
                        }
                        
                        $_SESSION['template']=array('img_target_path' => $target_path,'username' => $username);
                     
} 

 ?> 
 
<?php include('common/footer.php'); ?>