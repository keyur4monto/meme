<?php

session_start();

if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}
if(!isset($_SESSION['template'])){
    header('location:upload.php');
}
include('common/db.php');
include('common/adminsetting.php');
if(!empty($_SESSION['template']))
{
    $img_target_path=$_SESSION['template']['img_target_path'];
    //$username=$_SESSION['template']['username'];
    
}
$username= $_SESSION['session_useremail'];                    
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
     <div class="row">
              <div class="col-md-5">
                   <div class="mr-30">
                      <img class="img-responsive" src="<?php echo $img_target_path;?>" alt="user">
                      
                   </div>
              </div>
              <div class="col-md-7">
                    Thanks for uploading! To activate the image, provide a title below and save.
                  <div class="light-gray-bg tag-line mb-20 pl-10 ptb-10 border-rad-3"> If we cannot make you laugh, and make sure you get your time back.</div>
                  <div class="light-gray-bg text-black sm-mt-30 pall-30">
                		<form action="create-meme.php" class="form-horizontal" method="post" id="template-form">
                        	<div class="form-group">
                            	<label class="col-sm-3">Template title:</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control"  placeholder="Enter a name for the template image" name="tname" style="text-transform:capitalize">
                                </div>
                            </div>
                             <input type="hidden" name="upload_template" value="<?php echo $img_target_path; ?>" />
                            <div class="form-group" >
                            	<label class="col-sm-3">Category:</label>
                                <div class="col-sm-9">
                                 <?php $query = mysqli_query($conn, "SELECT * FROM category");
                                                        while($row1 = $query->fetch_assoc()) {
															if($row1['status']==1){
															?>
                                                        <input type="checkbox" name="category[]"  value="<?php echo $row1['id'];?>" />
                                                        <i class="fa fa-<?=$row1['icon']?>"></i>
                                                        <?php echo $row1['cat_name']."<br>";?>
                                 <?php } 
														}?>
                                 <span id="cat_error"></span>
                                 </div>  
                            </div>
                            <div class="form-group">
                            	<label class="col-sm-3">Tags:</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control tags" id="tags_1"  name="tag_name" placeholder="">
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
                                        <input  type="submit" value="Save Template" name="savetemplate" class="btn btn-success"/> 
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
                "tname":{
                    required: true
                    /*remote : 
                    {
                        url: 'check_validation.php',
                        type: "POST",
                        data:
                        {
                            tname: function(){
                                 return $('#template-form :input[name="tname"]').val();
                            }
                        }
                    } */ 
                  
                }, 
                'category[]': {
                    required: true
               },
                tag_name: {
                    required: true,
                   // minlength: 8
                },
             },
            messages: {
                tname: {
                    required: "Please Enter Your Template Title",
                    remote: jQuery.validator.format("{0} is already taken."),
                  //  minlength: "Template title at least have 8 Charaters",
                },
                'category[]': {
                    required: "Please Select Category"
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