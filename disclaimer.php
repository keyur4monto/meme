<?php
session_start();
/*if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}*/
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
    <title> Disclaimer Meme | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?>  </title>
    <link rel="shortcut icon" href="<?php if(!empty($favicon)){echo $siteurl.'/admin/'.$favicon;}else { echo 'favicon.png';}?>" type="image/png"/>
   
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/potenza-style.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href='css/other-font.css' rel='stylesheet' type='text/css'>
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
   <div class="col-md-9 col-sm-8">
    <h2 class="m-0">Disclaimer</h2>
     <hr>
      <div class="clearfix"></div>
      <?php if(!empty($disclaimer_page)){
               echo $disclaimer_page;
        }?>
     </div>
 <?php include('common/sidebar.php');?>
  </div>
  </div>
   </div>
  </section>
</div>
<?php include('common/footer.php'); ?>