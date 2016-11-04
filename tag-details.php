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
    <title>Tag Details | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?> </title>
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
<?php //Header 
	include('common/header.php');
 ?>
<?php 
if (isset($_POST["tagname"])) {
        $_SESSION['tagname'] = $_POST["tagname"];	
        $tagname = $_SESSION['tagname'];
}
$tagname = $_SESSION['tagname'];
$tag_query="SELECT * FROM `template` WHERE  `tag_id` LIKE '%".$tagname."%' LIMIT 0,6";
$tag_result=mysqli_query($conn,$tag_query);   
?>
<div class="main-content">
<section>
 <div class="container">
    <div class="content white-bg pall-20 pb-40 sm-plr-10">
         <div class="row mb-50 sm-mb-30 xs-mb-20">
              <div class="col-md-4 col-sm-6 text-black">
                 <h1><?=$tagname;?></h1>
                  <p class="tagline">Select a template below to create your meme. <br>
                    You can also upload an image.</p>
              </div>
              <?php if(!empty($banner_image)){ ?>
              <div class="col-md-8 col-sm-6 xs-mt-20">
                  <a class="pull-right" href="<?php echo $siteurl; ?>"><img class="img-responsive" src="<?php echo  'admin'.$banner_image;?>" alt=""></a>
              </div>
              <?php } ?>
         </div>
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <div class="left-content mt-20">
                    <ul class="list-inline" id="result_para">
                    <input type="hidden" id="result_no" value="6"> 
                      <?php $i=1;
                	 while($language_result_row = mysqli_fetch_assoc($tag_result)) {
                           $meme_name =  $language_result_row['template_name'];
                            $meme_image =  $language_result_row['template_image'];
                            $meme_tag =  $language_result_row['tag_id'];
                            $user_id =  $language_result_row['user_id'];
                            $id =  $language_result_row['id'];?>	
                            <li><a onclick="func_template_user('<?=$id?>')" data-toggle="tooltip" title="<?php echo $meme_name; ?>"><img class="img-responsive" src="<?=$site_url.'/'.$meme_image?>"></a></li>
                    <?php  $i++;
                     } ?>
                </ul>
            </div>
            
            <?php if($i>=6){ ?>
                <div class="btm-cntn-load mt-30 text-center">
                    <div class="row">
                        <div class="col-sm-5">
                            <button class="btn btn-lg btn-success text-uppercase" id="load_more_template">Load more meme</button>
                        </div>
                     </div>
                 </div>
            <?php } ?>
        </div>
        <?php  include('common/sidebar.php'); ?>
    </div>
       <?php if(!empty($banner_bottom_image2)){ ?>
        <div class="btm-cntn mt-40 hidden-xs">
            <div class="row text-center mt-40">
                <div class="col-sm-12">
                    <a href="<?php echo $siteurl; ?>"><img class="img-responsive" src="<?php echo  'admin'.$banner_bottom_image2;?>" alt="" style="display:inline-block";></a>
                </div>
            </div>
        </div>
         <?php } ?>
    </div>
 </div>
</section>
</div>
<script type="text/javascript">
jQuery(document).ready(function ( $ ) {
       //Load More Template Jquery 
        $("#load_more_template").click(function(){
                $('.top-btn .search-meme').removeClass('search-meme');
                $(this).addClass('search-meme');
                $('#result_para li').remove();
                $('.btm-cntn-load').remove();
                
                $.ajax({
                 type: 'post',
                 url: 'load_more.php',
                 data: {
                  load_more_template:'<?php echo $tagname;?>'
                 },
                 success: function (response) {
                  var content = document.getElementById("result_para");
                  content.innerHTML = content.innerHTML+response;
                
                 }
               });
        });  
});
         
// Template Image Click         
function func_template_user(meme_userid) {
    var $link = $(this);
    $('<form/>', { action: 'create-meme.php', method: 'POST' })
        .append($("<input>").attr("type", "hidden").attr("name", "template_id").val(meme_userid)).appendTo('body').submit(); 
}
</script>
<?php include('common/footer.php'); ?>