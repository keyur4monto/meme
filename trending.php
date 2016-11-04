<?php

session_start();

//Database File
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
    <title>Meme| <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?>  </title>
    <link rel="shortcut icon" href="<?php if(!empty($favicon)){echo $siteurl.'/admin/'.$favicon;}else { echo 'favicon.png';}?>" type="image/png"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/potenza-style.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href='css/other-font.css' rel='stylesheet' type='text/css'>
    <script src="js/new/jquery.min.js"></script>
    <script src="js/new/jquery.validate.min.js"></script>
  
    
</head>
<body>
<?php
	//Header 
	include('common/header.php');

?>
<div class="main-content">
<section>
 <div class="container">
    <div class="content white-bg pall-20 pb-40 sm-plr-10">
     <div class="row mb-50 sm-mb-30 xs-mb-20">
      <div class="col-md-4 col-sm-6 text-black">
         <h1>Trending A Meme</h1>
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

      <div class="top-btn">

      <ul class="list-inline">

        <li class="mr-10"><a href="<?php echo $siteurl.'/trending.php' ?>" id="north_memes" class="btn btn-sm search-meme">North Indian</a></li>
        
        <li class="mr-10"><a id="south_memes" class="btn btn-sm">South Indian</a></li>

        <li class="mr-10"><a id="international_memes" class="btn btn-sm">International</a></li>
        
      </ul>

     </div>


   <div class="left-content mt-20">

     <ul class="list-inline" id="result_para">
     <input type="hidden" id="result_no" value="6"> 
        <?php 
        $i = 1;
        $query = mysqli_query($conn, "SELECT * FROM `template` WHERE `cat_id` LIKE '%13%' ORDER BY id DESC LIMIT 30");
        while($templates = $query->fetch_assoc()){ ?>
       <li><a onclick="func_template_user('<?=$templates['id']?>')" data-toggle="tooltip" title="<?php echo $templates['template_name'] ?>"><img class="img-responsive" src="<?php echo $siteurl.'/'.$templates['thumb_template_img'] ?>"></a></li>
        <?php
         $i++;
         } ?>
      
     </ul>



   </div>


<?php if($i>=36){ ?>
<div class="btm-cntn-load mt-30 text-center">

<div class="row">

<div class="col-sm-5">

<button class="btn btn-lg btn-success text-uppercase" id="north_load">Load more meme</button>

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
</section>
</div>
<?php include('common/footer.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
 
 $("#south_memes").click(function(){
    $('.top-btn .search-meme').removeClass('search-meme');
    $(this).addClass('search-meme');
    $('#result_para li').remove();
    $('.btm-cntn-load').remove();
    
    $.ajax({
     type: 'post',
     url: 'load_more.php',
     data: {
      south_meme:'south_meme'
     },
     success: function (response) {
      var content = document.getElementById("result_para");
      content.innerHTML = content.innerHTML+response;
      $('[data-toggle="tooltip"]').tooltip();
     }
 });
 });


 $("#international_memes").click(function(){
    $('.top-btn .search-meme').removeClass('search-meme');
    $(this).addClass('search-meme');
    $('#result_para li').remove();
    $('.btm-cntn-load').remove();
    
    $.ajax({
     type: 'post',
     url: 'load_more.php',
     data: {
      international_meme:'international_meme'
     },
     success: function (response) {
      var content = document.getElementById("result_para");
      content.innerHTML = content.innerHTML+response;
      $('[data-toggle="tooltip"]').tooltip();
     }
 });
 });
});

function func_template_user(template_userid) {
        var $link = $(this);
        $('<form/>', { action: 'create-meme.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "template_id").val(template_userid)).appendTo('body').submit(); 
}
</script>
