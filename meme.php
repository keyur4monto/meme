<?php
session_start();
/*if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}*/
include('common/db.php');
include('common/adminsetting.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>All Meme | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?> </title>
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
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
    
    <!-- Add js and css AutoComplte tag -->
    <link href="css/jquery.tagsinput.css" rel="stylesheet">
    <script src="js/jquery.tagsinput.js"></script>
    
  </head>
<body>
<?php

	//Header 
	include('common/header.php');

?>

<?php  /* if (isset($_POST["meme_lang"])) {
            $meme_lang1= $_POST["meme_lang"];
            $_SESSION['meme_lang'] = $meme_lang1;	
            $meme_lang = $_SESSION['meme_lang'];
            $language_query="SELECT * FROM `meme` WHERE `meme_lang`='".$meme_lang."' ORDER BY `id` DESC";
        }else{
	       $language_query="SELECT * FROM `meme` ORDER BY `id` DESC";
        } */
        
        $language_query="SELECT * FROM `meme` WHERE `meme_lang`='english' ORDER BY `id` DESC";    
	    $language_result=mysqli_query($conn,$language_query);
       
   
?>
<div class="main-content">
<section>
 <div class="container">
    <div class="content white-bg pall-20 pb-40 sm-plr-10">
     <div class="row mb-50 sm-mb-30 xs-mb-20">
          <div class="col-md-4 col-sm-6 text-black">
             <h1>Meme List</h1>
              <p class="tagline">All Indian Meme</p>
          </div>
          <?php if(!empty($banner_image)){ ?>
          <div class="col-md-8 col-sm-6 xs-mt-20">
              <a class="pull-right" href="<?php echo $siteurl; ?>"><img class="img-responsive" src="<?php echo  'admin'.$banner_image;?>" alt=""></a>
          </div>
          <?php } ?>
     </div>
     <div class="row">
     <div class="" id="my-gallery-container">
     <?php
	 $i=1;
	 while($language_result_row = mysqli_fetch_assoc($language_result)) {
            $meme_lang =  $language_result_row['meme_lang'];
            $meme_name =  $language_result_row['meme_name'];
            $meme_image =  $language_result_row['meme_image'];
            $meme_tag =  $language_result_row['meme_tag'];
            $template_id =  $language_result_row['template_id'];
            $user_id =  $language_result_row['user_id'];
            $id =  $language_result_row['id'];
           
	 ?>

			<div class="item" data-order="<?=$i?>">
				<a onclick="func_meme_user('<?=$id?>')"><img src="<?=$site_url.'/'.$meme_image?>"></a>
			</div>
        
     <?php 
	 $i++; 
	 }
	 ?>
     </div>
     <?php
	 //include('common/sidebar.php'); ?>
 </div>
  <!-- <?php if(!empty($banner_bottom_image2)){ ?>
    <div class="btm-cntn mt-40 hidden-xs">
        <div class="row text-center mt-40">
            <div class="col-sm-12">
                <a href="<?php echo $siteurl; ?>"><img class="img-responsive" src="<?php echo  'admin'.$banner_bottom_image2;?>" alt="" style="display:inline-block";></a>
            </div>
        </div>
    </div>-->
     <?php } ?>
</div>
</section>
</div>
<?php include('common/footer.php'); ?>
<script type="text/javascript">
		jQuery(document).ready(function ( $ ) {
			$("#my-gallery-container").mpmansory(
				{
					childrenClass: 'item', // default is a div
					columnClasses: '', //add classes to items
					breakpoints:{
						lg: 3, 
						md: 4, 
						sm: 6,
						xs: 12
					},
					distributeBy: { order: false, height: false, attr: 'data-order', attrOrder: 'asc' }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
					onload: function (items) {
						//make somthing with items
					} 
				}
			);
		});
        
        
        function func_meme_user(meme_userid) {
        var $link = $(this);
        $('<form/>', { action: 'success.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "meme_id").val(meme_userid)).appendTo('body').submit(); 
        } 

	</script>