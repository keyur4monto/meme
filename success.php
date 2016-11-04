<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
session_start();
include('common/db.php');
?>
<?php
/*if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}*/
if($_POST['meme_id']){
    $_SESSION['meme']=array('username' => $_SESSION['session_username']);
}
else{
    header('location:index.php');
}
/*if(!isset($_SESSION['meme'])){
    header('location:index.php');
}*/

if($_POST['meme_id']){
    $memeid = $_POST['meme_id'];
    $last_record = mysqli_query($conn, "SELECT * FROM meme where id='$memeid'");
    $last_record = $last_record->fetch_assoc();
    //echo "<pre>"; print_r($last_record);
}
	//Header 
	include('common/header.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@@flickr" />
<meta name="twitter:title" content="fgfg" />
<meta name="twitter:description" content="<?php  echo $last_record['meme_name'] ?>" />
<meta name="twitter:image" content="<?php echo $siteurl.'/'.$last_record['meme_image'] ?>" />
<meta name="twitter:url" content="<?php  echo $siteurl.'/success.php'?>" />

<link rel="canonical" href="<?php  echo $siteurl.'/success.php'?>" />
    <meta property="og:title" content="This is Referral Ace" />
    <meta property="og:description" content="This is decription for Referral Ace" />
    <meta property="og:url" content="<?php  echo $siteurl.'/success.php'?>" />
    <meta property="og:image" content="<?php echo $siteurl.'/'.$last_record['meme_image'] ?>" />
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js">
    </script>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Create Meme | Indianmeme.com </title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/potenza-style.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
  
    <link href='css/other-font.css' rel='stylesheet' type='text/css'>
    
   	<link rel="stylesheet" href="<?php echo $siteurl.'/css/memegenretor/jquery.memegenerator.min.css';?>" />		
    <link rel="stylesheet" href="<?php echo $siteurl.'/css/memegenretor/spectrum.css';?>" />
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="js/new/jquery.min.js"></script>
    <script src="js/new/jquery.validate.min.js"></script> 
   
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		
    <script src="<?php echo $siteurl.'/js/memegenretor/jquery.memegenerator.min.js';?>"></script>
    <script src="<?php echo $siteurl.'/js/memegenretor/spectrum.js';?>"></script>
     <script>
    $(document).ready(function(){
            var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState==4 && xmlhttp.status==200)
        //alert("webpage " + xmlhttp.responseText + " was successfully created!");
        var twiurl = '<?php echo $siteurl.'/makepage/' ?>'+xmlhttp.responseText;
        $('.twitter-share-button').attr('data-url',twiurl);
        $('.twitter-share-button').attr('href',"https://twitter.com/intent/tweet?url="+twiurl);
    }
    var content = '<html><head><meta charset="utf-8"><meta name="viewport" content="">'+
    '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />'+
    '<meta name="twitter:card" content="summary" />'+
    '<meta name="twitter:site" content="@@flickr" />'+
    '<meta name="twitter:title" content="fgfg" /><meta name="twitter:description" content="Testing Desc" />'+
    '<meta name="twitter:image" content="<?php echo $siteurl."/".$last_record['meme_image'] ?>" />'+
    '<meta name="twitter:url" content="<?php  echo $siteurl ?>" /></head></html>';
    xmlhttp.open("GET","<?php echo $siteurl.'/makepage/makePage.php?content=' ?>"+ content,true);
    xmlhttp.send();
    });	
    </script>
</head>
<body class="body_style" itemscope itemtype="http://schema.org/Product">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=1625043167764533";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="main-content">
<section>
  <div class="container">
  <div id="new_meme_share" class="content white-bg pall-20 pb-40 sm-plr-10 sm-pb-10 xs-pb-0">
  <div class="row">
    <div class="col-sm-12">
      <h2><?php echo $last_record['meme_name'] ?></h2>
    </div>
  </div>
   <div class="row">
      <div class="col-md-5">
           <div class="mr-30">
          <img class="img-responsive" src="<?php echo $siteurl.'/'.$last_record['meme_image'];?>" alt="">
        </div>
        </div>
        <div class="col-md-5">
         <div class="light-gray-bg text-black sm-mt-30 pall-30">
        <div class="share-btn mb-30">
         <a class="fb_share" href="#"><i aria-hidden="true" class="fa fa-facebook"></i></a>
          <!--<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>-->
          <a href="" class="twitter-share-button" data-url=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="//pinterest.com/pin/create/button/?url=<?php echo $siteurl ?>&media=<?php echo $siteurl.'/'.$last_record['meme_image']?>&description=<?php echo $last_record['meme_name']?>" title="Pin this to Pinterest" class="pr_share"  data-pin-do="buttonPin" data-pin-config="none" target="_blank">
          <i class="fa fa-pinterest-p" aria-hidden="true"></i>
          </a>
          <a href="https://plus.google.com/share?url=http://meme.potenzadev.ga/success.php" target="_blank" class="gplus-counter" id="gplus_share"><i class="fa fa-google" aria-hidden="true"></i></a>
          
          
        
        </div>
            <div class="success-link">
              <a download="" href="<?php echo $siteurl.'/'.$last_record['meme_image'] ?>" class="download_img pull-left">
                <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
              </a>
  
            </div>
              <div class="form-group text-uppercase mt-30" style="float: left;">
              <a href="#" class="btn gray-bg text-green">back</a>
              <a href="#" class="btn btn-success">Go to image page</a>
              <a href="#" class="btn btn-primary">Make another</a>
            </div>
          <div class="clearfix"></div>
        </div>
        </div>
        <div class="fb-comments" data-href="http://meme.potenzadev.ga/success.php" data-numposts="5"></div>
  </div>
  </div>
   </div>
  </section>
</div>
<?php include('common/footer.php'); ?>
<script src="//connect.facebook.net/en_US/all.js"></script>
  <script>
  window.fbAsyncInit = function() {     
        FB.init({
            appId      : '1220571414663890',
            status     : true,
            xfbml      : true
        });
        // Code in here will run once FB has been initialised
        function FB_post_feed(method,name,link,picture,caption,description){
            FB.ui({
                method: method,
                name: name,
                link: link,
                picture: picture,
                caption: caption,
                description: description
            });
        }
     };
     $(document).on("click",".fb_share",function(e){
    fb_share_img = $('#new_meme_share img').attr('src'); 
    //fb_share_img = '<?php echo $siteurl.'/'; ?>'+fb_share_img;
    console.log(fb_share_img);
                FB.ui({
                    method: 'feed',
                    name: 'MEME GENERATOR',
                    link: 'http://meme.potenzadev.ga',
                    picture: fb_share_img,
                    caption: 'Meme generator',
                    description: 'Hello This one is testing purpose please check it and confirm it'
                });
            });
            
    </script>