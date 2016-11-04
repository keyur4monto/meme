<?php

session_start();

//Database File
include('common/db.php');
include('common/adminsetting.php');

if(isset($_POST['searchtemplate'])){
          $_SESSION['searchtemplate'] = $_POST["searchtemplate"];	
          $searchmeme = $_SESSION['searchtemplate'];
}
$searchmeme = $_SESSION['searchtemplate'];

$search_meme_query = "SELECT * FROM `template` WHERE `template_name` LIKE '%".$searchmeme."%'";
$search_meme_res = mysqli_query($conn, $search_meme_query);
$rowcount=mysqli_num_rows($search_meme_res);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Search Meme| <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?>  </title>
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
                 <h1>Search A Meme</h1>
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
                <?php  if($rowcount >=1){ 
                while($search_meme_res_row = mysqli_fetch_assoc($search_meme_res)) { 
                        echo "<li><a onclick='func_template_user(".$search_meme_res_row['id'].")' data-toggle='tooltip' id=".$search_meme_res_row['id']." title='".$search_meme_res_row['template_name']."'><img class='img-responsive' src='".$siteurl."/".$search_meme_res_row['thumb_template_img']."'/></a></li>";
                 }
                }
                else
                {
                     echo  'No Template Found';
                }?>
             </ul>
          </div>
        </div>
       <?php  include('common/sidebar.php'); ?>
     </div>
        <?php if(!empty($banner_bottom_image2)){ ?>
        <div class="btm-cntn mt-40 hidden-xs">
           <div class="btm-cntn-load mt-30 text-center">
                <div class="row">
                    <div class="col-sm-5">
                        <button class="btn btn-lg btn-success text-uppercase" id="load">Load more meme</button>
                    </div>
                    <div class="col-sm-7 text-right">
                       <!-- <div class="search pull-right">
                        <input type="hidden" id="result_no1" value="6"> 
                        <input placeholder="Search for hilarious desi memes..." class="form-control" name="searchmeme" id="searchmeme" onclick="search()">
                        <button class="submit-btn" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>-->
                    </div>
                </div>
            </div>
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
     
 $("#load").click(function(){
    /*var uid = '<?php echo $_SESSION['session_userid']?>';
    if(uid){*/
  loadmore();
  //}
 });
 
 $("#my_memes").click(function(){
    $('.top-btn .search-meme').removeClass('search-meme');
    $(this).addClass('search-meme');
    $('#result_para li').remove();
    $('.btm-cntn-load').remove();
    
    $.ajax({
     type: 'post',
     url: 'load_more.php',
     data: {
      my_memes:'<?php echo $_SESSION['session_userid']?>'
     },
     success: function (response) {
      var content = document.getElementById("result_para");
      content.innerHTML = content.innerHTML+response;
      $('[data-toggle="tooltip"]').tooltip();
     }
 });
 });
 
  $("#popular_memes").click(function(){
    $('.top-btn .search-meme').removeClass('search-meme');
    $(this).addClass('search-meme');
    $('#result_para li').remove();
    $('.btm-cntn-load').remove();
    
    $.ajax({
     type: 'post',
     url: 'load_more.php',
     data: {
      popular_memes:'popular_meme'
     },
     success: function (response) {
      var content = document.getElementById("result_para");
      content.innerHTML = content.innerHTML+response;
      $('[data-toggle="tooltip"]').tooltip();
     }
 });
 });
 
 $("#recent_memes").click(function(){
    $('.top-btn .search-meme').removeClass('search-meme');
    $(this).addClass('search-meme');
    $('#result_para li').remove();
    $('.btm-cntn-load').remove();
    
    $.ajax({
     type: 'post',
     url: 'load_more.php',
     data: {
      recent_memes:'recent_meme'
     },
     success: function (response) {
      var content = document.getElementById("result_para");
      content.innerHTML = content.innerHTML+response;
      $('[data-toggle="tooltip"]').tooltip();
     }
 });
 });
 
  /*$("#load_more_meme").click(function(){
    var val1 = document.getElementById("result_no").value;
 /*$.ajax({
 type: 'post',
 url: 'load_more.php',
 data: {
  memeloadresult:val1,
  memeload_uid:'<?php echo $_SESSION['session_userid']?>',
  check:'meme_load'
 },
 success: function (response) {
  var content = document.getElementById("result_para");
  content.innerHTML = content.innerHTML+response;

  // We increase the value by 2 because we limit the results by 2
  document.getElementById("result_no").value = Number(val)+6;
 }
 });
 console.log('callllll');
 });*/
 
 
});
function loadmore()
{
     var val = document.getElementById("result_no").value;
     $.ajax({
     type: 'post',
     url: 'load_more.php',
     data: {
      getresult:val,
      check:'home_load'
     },
     success: function (response) {
      var content = document.getElementById("result_para");
      content.innerHTML = content.innerHTML+response;
      $('[data-toggle="tooltip"]').tooltip();
      // We increase the value by 2 because we limit the results by 2
      document.getElementById("result_no").value = Number(val)+6;
     }
     });
}

function search()
{
     var searchmeme1 = document.getElementById("searchmeme").value;
     $.ajax({
         type: 'post',
         url: 'load_more.php',
         data: {
            searchmeme:searchmeme1
         },
         success: function (response) {
             if(response != null){ 
                      $('#result_para li').remove();
                      $('#result_para').append(response);
                      //alert(response);
                      $('[data-toggle="tooltip"]').tooltip();
              }
              else
              {
                  //alert('hiii');
              }
         }
     });
}

function func_template_user(template_userid) {
        var $link = $(this);
        $('<form/>', { action: 'create-meme.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "template_id").val(template_userid)).appendTo('body').submit(); 
        }
</script>


  