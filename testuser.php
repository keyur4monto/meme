 <?php
session_start();
if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}
include('common/db.php');
include('common/adminsetting.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>User Profile Meme | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?> </title>
    <link rel="shortcut icon" href="<?php if(!empty($favicon)){echo $siteurl.'/admin/'.$favicon;}else { echo 'favicon.png';}?>" type="image/png"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/potenza-style.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href='css/other-font.css' rel='stylesheet' type='text/css'>
    <script src="js/new/jquery.min.js"></script>
    <script src="js/new/jquery.validate.min.js"></script> 
     <script src="js/jquery.min.js"></script>   
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



  <div class="row mb-20">

    <div class="col-sm-12">

      <h3>VickyPatel's Created Memes</h3>

    </div>

  </div>



   <div class="row">

      <div class="col-md-4 sm-mb-30">

       <div class="user-img mb-20">

         <img src="images/user.png" alt="">

       </div><br>

       <span> No tagline yet.</span>



       <div class="user-box mb-20 mt-20">

         <ul class="list-unstyled">

           <li><i class="fa fa-clock-o mr-10 text-green" aria-hidden="true"></i> Member since 2016-09-21 </li>

           <li><i class="fa fa-trophy mr-10 text-green" aria-hidden="true"></i> You need at least 5 memes to get an initial score! </li>

         </ul>

       </div>



        <div class="user-box">

         <ul class="list-unstyled">

           <li><i class="fa fa-google-plus mr-10 text-green" aria-hidden="true"></i><a href="#">VickyPatel's Google+ Profile </a> </li>

           <li><i class="fa fa-map-marker mr-10 text-green" aria-hidden="true"></i> Enter your location. </li>

         </ul>

       </div>

        </div>



        <div class="col-md-8">



          <div class="tab">



            <!-- Nav tabs -->

            <ul class="nav nav-tabs" role="tablist">

              <li role="presentation" class="active"><a href="#created" aria-controls="created" role="tab" data-toggle="tab">Memes created (1)</a></li>

              <li role="presentation"><a href="#uploaded" aria-controls="uploaded" role="tab" data-toggle="tab">Templates uploaded (0)</a></li>

              <li role="presentation"><a href="#Follows" aria-controls="Follows" role="tab" data-toggle="tab">Follows (0)</a></li>

              <li role="presentation"><a href="#Followed" aria-controls="Followed" role="tab" data-toggle="tab">Followed by (0)</a></li>

              <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">My settings</a></li>

            </ul>



            <!-- Tab panes -->

            <div class="tab-content">

              <div role="tabpanel" class="tab-pane active" id="created">   

              <div class="memewrapper-inner">

              <a class="text-popup" href="#"><img src="images/text-img.jpg" alt=""></a><br>

              <div class="meme-hovercard">

                <div class="meme-hovercard-inner">

                <p>Cast your vote: 

                <span class="pull-right"><i class="fa fa-heart-o" aria-hidden="true"></i> 82 <i class="fa fa-heartbeat" aria-hidden="true"></i></span></p>

                

                <p>Created by <a class="" href="/user/VickyPatel">VickyPatel</a></p>

                <p><a title="More Futurama Fry memes" href="/memes/futurama_fry"> Futurama Fry memes</a>

              

              <a class="create-icon pull-right" href="/create/JX5Dfr"><i class="fa fa-magic" aria-hidden="true"></i>

</a>

            </p>

                </div>

                </div>

              </div>
               <div class="memewrapper-inner">

              <a class="text-popup" href="#"><img src="images/text-img.jpg" alt=""></a><br>

              <div class="meme-hovercard">

                <div class="meme-hovercard-inner">

                <p>Cast your vote: 

                <span class="pull-right"><i class="fa fa-heart-o" aria-hidden="true"></i> 82 <i class="fa fa-heartbeat" aria-hidden="true"></i></span></p>

                

                <p>Created by <a class="" href="/user/VickyPatel">VickyPatel</a></p>

                <p><a title="More Futurama Fry memes" href="/memes/futurama_fry"> Futurama Fry memes</a>

              

              <a class="create-icon pull-right" href="/create/JX5Dfr"><i class="fa fa-magic" aria-hidden="true"></i>

</a>

            </p>

                </div>

                </div>

              </div>


              </div>

              <div role="tabpanel" class="tab-pane" id="uploaded">

                <ul class="list-inline">

                  <li><a href="#"><img class="img-responsive" src="images/upload-img-1.jpg" alt=""></a></li>

                  <li><a href="#"><img class="img-responsive" src="images/upload-img-1.jpg" alt=""></a></li>

                  <li><a href="#"><img class="img-responsive" src="images/upload-img-1.jpg" alt=""></a></li>

                  <li><a href="#"><img class="img-responsive" src="images/upload-img-1.jpg" alt=""></a></li>

                  <li><a href="#"><img class="img-responsive" src="images/upload-img-1.jpg" alt=""></a></li>


                </ul>

              </div>

              <div role="tabpanel" class="tab-pane" id="Follows"></div>

              <div role="tabpanel" class="tab-pane" id="Followed"></div>



              <div role="tabpanel" class="tab-pane" id="settings">

                                <ul class="list-unstyled">

                    <li class="mb-20"><h4 class="mb-10">Account</h4><i class="fa fa-envelope mr-10 text-green" aria-hidden="true"></i>Logged in via Google</li>

                    <li class="mb-20"><h4 class="mb-10">Privacy</h4>

                     <div class="checkbox">

                        <label class="mr-20"><input checked="" type="checkbox"> Allow my public profile to be found in external search engines </label><br>

                        <label><input checked="" type="checkbox"> Enable rel="author"  <a href="#myModal" role="button" class="btn btn-sm btn-success text-white" data-toggle="modal">Settings</a> </label> 

                      </div>

                    </li>

                    <li class="mb-20"><h4 class="mb-10">My Stuff</h4>

                       <div class="checkbox">

                        <label class="mr-20"><input checked="" type="checkbox"> On upvote - save template to 'My Stuff' for later use. </label><br>

                      </div>

                    </li>

                    <li class="mb-10"><h4 class="mb-10">Display</h4><i class="fa fa-info-circle mr-10 text-green" aria-hidden="true"></i>

                    <select class="form-control" style="width: 100px; display: inline-block; height: 30px;">

                        <option value="10">10</option>

                        <option value="25">25</option>

                        <option value="50">50</option>

                        <option value="100">100</option>

                      </select>

                          memes at once </li>



                        <li><i class="fa fa-globe mr-10 text-green" aria-hidden="true"></i>



              <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="images/flag-1.png" alt="">  English <i class="fa fa-caret-down" aria-hidden="true"></i>

</a>

              <ul class="dropdown-menu">

                <li><a href="#"><img src="images/flag-1.png" alt="">  English</a></li>

                <li><a href="#"><img src="images/flag-2.png" alt="">  Hindi</a></li>

              </ul>

   </li>

   <li class="mt-30"><a class="btn btn-primary mt-10" href="create-account.html">Save Preferences</a></li>

                  </ul></div>

            </div>



          </div>



        </div>

  </div>

  </div>

   </div>



  </section>

</div>
<?php include('common/footer.php'); ?>