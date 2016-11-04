<?php

session_start();

if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}
/*if(!isset($_SESSION['template'])){
    header('location:upload.php');
}*/
include('common/db.php');
include('common/adminsetting.php');
if(!empty($_SESSION['template']))
{
    $img_target_path=$_SESSION['template']['img_target_path'];    
}
$username= $_SESSION['session_useremail'];

if(!empty($_POST['template_id'])){
     $_SESSION['template_id'] = $_POST['template_id'];	
     $templateid = $_SESSION['template_id'];
}

$templateid = $_SESSION['template_id'];

$template_edit_query = "SELECT * FROM `template` where id='$templateid'";
$template_edit_res=mysqli_query($conn, $template_edit_query);

while($template_edit_row = mysqli_fetch_assoc($template_edit_res)) {
            $tid=$template_edit_row['id'];
            $cat_id=$template_edit_row['cat_id'];
            $tag_id=$template_edit_row['tag_id'];
            $template_name=$template_edit_row['template_name'];
            $template_image=$template_edit_row['template_image'];
} 

if (isset($_POST["edittemplate"])) { 
       $tname = $_POST["tname"];
       $category =$_POST["category"];
       $tag_name= $_POST["tag_name"]; 
       $fileToUpload=$_FILES["fileToUpload"]["name"]; 
       
       //check same tag name or not [start]
       $temp_tags = explode(',',$tag_name);
		
		foreach($temp_tags as $temp_tag){
			$sel_tag = "SELECT * FROM `tag` WHERE `tag_name`='$temp_tag'";
			$ex_sel_tag = mysqli_query($conn,$sel_tag);
			
			if(mysqli_num_rows($ex_sel_tag) > 0){
			    /* $row_sel_tag = mysqli_fetch_array($ex_sel_tag);
                 $count = $row_sel_tag['count'];
                 $count++;
                 
                 $updt_tag = "UPDATE `tag` SET `count`='$count' WHERE `tag_name`='$temp_tag'";
                 $ex_updt_tag = mysqli_query($conn,$updt_tag); */
			}
			else{
				$ins_tag = "INSERT INTO `tag` (`tag_name`,`status`) VALUES ('$temp_tag','1')";
                $ex_ins_tag = mysqli_query($conn,$ins_tag);
			}
				
		}
        //check same tag name or not [end]
      
       if (!empty($fileToUpload)) 
       {
             $del_img_path = $_SERVER['DOCUMENT_ROOT'].'/'.$template_image;
             unlink($del_img_path);
       
            $extension=array("jpeg","jpg","png","gif");
            $file_name=$_FILES["fileToUpload"]["name"];
            $uniqid = uniqid();
            $edit_target_path = "uploads/template_image/".$uniqid.$file_name;
            
            $file_tmp=$_FILES["fileToUpload"]["tmp_name"];
            $ext=pathinfo($file_name,PATHINFO_EXTENSION);
            if(in_array($ext,$extension))
            {
                if(!file_exists($edit_target_path))
                { move_uploaded_file($file_tmp=$_FILES["fileToUpload"]["tmp_name"],$edit_target_path);}
            }
       } 
       
       if (empty($fileToUpload)) // if image is not edit 
       { $edit_target_path = $template_image; }
     
       foreach($category as $c){
          $cat_id .= $c.",";
       }
       $category_id=rtrim($cat_id, ",");
       $updt_template = "UPDATE `template` SET `template_name`='".$tname."',`template_image`='".$edit_target_path."',`cat_id`='".$category_id."',`tag_id` = '".$tag_name."' WHERE `id` = '$templateid'";
       $ex_updt_template = mysqli_query($conn,$updt_template);
      
       if($ex_updt_template)
       {
               $template_update_msg = 'Template Data Update Successfully...';
               $_SESSION['template_update_msg'] = $template_update_msg;
               header('location:template-details.php');
       }
}                             
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Template Meme | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?> </title>
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
    
    <!-- Add js and css AutoComplte tag -->
    <link href="css/jquery.tagsinput.css" rel="stylesheet">
    <script src="js/jquery.tagsinput.js"></script>
    
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
        <div class="col-sm-12">
          <h2>Just uploaded</h2>
        </div>
      </div>
    <form class="form-horizontal" method="post" id="template-form" enctype="multipart/form-data"> 
     <div class="row">
              <div class="col-md-5">
             	  <div class="mr-30">
                      <img class="img-responsive" src="<?php echo $template_image;?>" alt="user">
                      <input type="file" name="fileToUpload" id="fileToUpload">
                   </div>
              </div>
              <div class="col-md-7">
                    Thanks for uploading! To activate the image, provide a title below and save.
                  <div class="light-gray-bg tag-line mb-20 pl-10 ptb-10 border-rad-3"> If we cannot make you laugh, and make sure you get your time back.</div>
                  <div class="light-gray-bg text-black sm-mt-30 pall-30">
                	<div class="form-group">
                            	<label class="col-sm-3">Template title:</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control"  placeholder="Enter a name for the template image" name="tname" value="<?php echo $template_name; ?>">
                                </div>
                            </div>
                            <input type="hidden" name="templateid" value="<?php echo $tid; ?>" />
                            <input type="hidden" name="upload_template" value="<?php echo $template_image; ?>" />
                            <div class="form-group" >
                            	<label class="col-sm-3">Category:</label>
                                <div class="col-sm-9">
                                 <?php
                                   $query = mysqli_query($conn, "SELECT * FROM category");
                                 
                                   $c=explode(",",$cat_id);
                                     while($row1 = $query->fetch_assoc()) {  
                                            ?>
                                               <input type="checkbox" name="category[]"  value="<?php echo $row1['id'];?>"
                                                <?php   foreach($c as $catval){  
                                                            if($catval == $row1['id'])
                                                                { echo "checked";}
                                                            }?> 
                                                />
                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                        <?php echo $row1['cat_name']."<br>";?>
                                 <?php  } ?>
                                 <span id="cat_error"></span>
                                 </div>  
                            </div>
                            <div class="form-group">
                            	<label class="col-sm-3">Tags:</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control tags" id="tags_1"  name="tag_name" placeholder="" value="<?php echo $tag_id;?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                            	<div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                	<p>Confirm each tag by pressing Enter (tags can consist of multiple words).</p>
                                 </div>
                            </div>
                            <div class="form-group text-uppercase mt-30">
                                    <div class="col-sm-12">
                                        <input  type="submit" value="Save Tamplate" name="edittemplate" class="btn btn-success"/> 
                                    </div>
                            </div>
                       </form>
                      <div class="clearfix"></div>
                </div>
             </div>
       </div>
   </div>
  </div>
</section>
</div>

<script>
$(function() {
	$('#tags_1').tagsInput({width:'auto'});
});

$("#template-form").validate({
             
            rules: {
                tname:{
                    required: true,
                  /*  remote : 
                    {
                        url: 'check_validation.php',
                        type: "POST",
                        data:
                        {
                            tname: function(){
                                 return $('#template-form :input[name="tname"]').val();
                            }
                        }
                    }  */
                  
                }, 
             
                tag_name: {
                    required: true,
                },
             },
            messages: {
                tname: {
                    required: "Please Enter Your Template Title",
                  //  remote: jQuery.validator.format("{0} is already taken."),
                  //  minlength: "Template title at least have 8 Charaters",
                },
              
               tag_name:{
                     required: "Please Enter Your Tags",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
}); 
</script>
<?php include('common/footer.php'); ?>