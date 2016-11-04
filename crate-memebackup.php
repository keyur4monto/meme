<?php
session_start();

include('common/db.php');
include('common/adminsetting.php');
if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Create Meme | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?>  </title>
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
<div class="main-content details-page">
<section>
    <div class="container">
        <div class="content white-bg pall-20 pb-40 sm-plr-10 sm-pb-10 xs-pb-0">
            <div class="row mb-50 sm-mb-30 xs-mb-20">
                <div class="col-md-4 col-sm-6 text-black">
                    <h4 class="mb-10">Create A Meme</h4>
                    <h3 class="text-blue">College Star Sharukh</h3>
                </div>

                <div class="col-md-8 col-sm-6 xs-mt-20">
                   <a class="pull-right" href="#"><img class="img-responsive" src="images/ad.png" alt=""></a>
                </div>
           </div>
          <div class="row">
                <div class="col-md-9 col-sm-8">
                  <div class="top-btn mb-20">
                      <ul class="list-inline">
                         <li class="mr-10"><a href="#" class="btn btn-success big-btn">Choose a different meme <i class="fa fa-user" aria-hidden="true"></i></a></li>
                         <li"><a href="#" class="btn btn-primary big-btn">Upload Your Own Image <i class="fa fa-upload" aria-hidden="true"></i></a></li>
                      </ul>
                  </div>
                  <div class="img-box mr-30">
                     <img class="img-responsive" src="images/create-img.png" alt="">
                  </div>
                <div class="content-box text-black sm-mt-30">
                          <form>
                           <div class="form-group"><textarea class="form-control" rows="3" placeholder="top text here"></textarea></div>
                           <div class="form-group"><textarea class="form-control" rows="3" placeholder="bottom text here"></textarea></div>
                           <div class="form-group">
                                   <ul class="list-unstyled">
                                     <li class="dropdown">
                                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="images/flag-1.png" alt="">  English <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    
                                       <ul class="dropdown-menu">
                                           <li><a href="#"><img src="images/flag-1.png" alt="">  English</a></li>
                                           <li><a href="#"><img src="images/flag-2.png" alt="">  Hindi</a></li>
                                           <li><a href="#"><img src="images/flag-3.png" alt="">  Tamil</a></li>
                                           <li><a href="#"><img src="images/flag-4.png" alt="">  Telugu</a></li>
                                           <li><a href="#"><img src="images/flag-5.png" alt="">  Kannada</a></li>
                                           <li><a href="#"><img src="images/flag-6.png" alt="">  Malayalam</a></li>
                                      </ul>
                                     </li>
                                  </ul>
                                <div class="color-picker mlr-20">
                                    <fieldset>
                                     <div class="controlset"><input id="color1" type="text" name="color1" value="#000000" /></div>
                                    </fieldset>
                               </div>
                               <select class="form-control">
                                    <option style="font-family: Open Sans;">Open Sans</option>
                                    <option style="font-family:'Tangerine', verdana;">Tangerine</option>
                                    <option style="font-family: 'Comic Sans MS'">Comic Sans MS</option>
                                    <option style="font-family: Arial">Arial</option>
                                    <option style="font-family: 'Times New Roman'">Times New Roman</option>
                              </select>
                              <div class="clearfix"></div>
                        </div>
                        <div class="form-group text-editor">
                             <ul class="list-inline">
                                 <li><a class="btn btn-default active" href="#" role="button"><b>B</b></a></li>
                                 <li><a class="btn btn-default text-uppercase" href="#" role="button">abc</a></li>
                                 <li><a class="btn btn-default" href="#" role="button"><i>abc</i></a></li>
                                 <li><a class="btn btn-default text-underline" href="#" role="button"><u>abc</u></a></li>
                                 <li><a class="btn btn-default" href="#" role="button">abc</a></li>
                            </ul>
                            <div class="clearfix"></div>
                      </div>
                      <div class="form-group memetags">
                             <input type="text" class="form-control" id="exampleInputtext" placeholder="Add tags (multi-word allowed, enter to confirm)">
                      </div>
                      <div class="form-group">
                         <div class="checkbox">
                         <label class="mr-20"><input type="checkbox" checked> Public </label>
                         <label><input type="checkbox"> Private </label>
                          </div>
                      </div>
                     <div class="form-group text-uppercase">
                             <a href="#" class="btn btn-success btn-lg mr-10">create meme</a>
                             <a href="#" class="btn btn-primary text-capitalize">Reset <i class="fa fa-refresh" aria-hidden="true"></i></a>
                     </div>
                     <div class="form-group">
                      <a href="#" class="text-blue">Somthing odd? Report this image</a><br>
                      <a href="#" class="text-blue">Upload Images</a>
                     </div>
                  </form>
            </div>
        </div>
        <div class="sidebar text-center">
            <div class="col-md-3 col-sm-4 xs-mt-60">
                <a href="#"><img class="img-responsive" src="images/ad-1.png" alt=""></a>
                <a href="#"><img class="img-responsive mt-30" src="images/ad-1.png" alt=""></a>
           </div>
       </div>
    </div>
  </div>
 </div>
 </section>

<section class="mt-30">


    <div class="container">


    <div class="content white-bg pall-20 ptb-30 sm-plr-10 xs-pb-0">


    <div class="row">


      <div class="col-sm-12">


       <h2>Other’s meme from this template</h2>


      </div>


      </div>





     <div class="row">


      <div class="col-md-9 col-sm-8"">


     <div class="left-content">


     <ul class="list-inline">


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>





     </ul>


     


     <div class="clearfix"></div>


        


      <div class="more-btn text-uppercase text-center mt-30"><a class="btn btn-primary big-btn" href="#" role="button">see more</a></div>





   </div>


   </div>








     <div class="sidebar text-center">


  <div class="col-md-3 col-sm-4 xs-mt-60">


  <a href="#"><img class="img-responsive" src="images/ad-1.png" alt=""></a>


  


   <div class="recent-tag text-left mtb-30">


     <h5 class="green-bg text-uppercase">recent tags</h5>


     <div class="recent-tag-cntn">


     <ul class="list-inline">


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name 4</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name 4</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name 4</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name </a></li>


        <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name 4</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name 4</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>





     </ul>


   </div>


   </div>


    </div>


    </div>


   </div>


   </div>


 </div>


  </section>








    <section class="mt-30">


    <div class="container">


    <div class="content white-bg pall-20 ptb-30 sm-plr-10 xs-ptb-0 ">


    <div class="row">


      <div class="col-sm-12">


       <h2>Popular Memes</h2>


      </div>


      </div>





     <div class="row">


      <div class="col-md-9 col-sm-8"">


     <div class="left-content">


     <ul class="list-inline">


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-1.jpg"></a></li>


       <li><a href="#" data-toggle="tooltip" title="Lorem Ipsum"><img class="img-responsive" src="images/thumb-img-2.jpg"></a></li>





     </ul>


     


     <div class="clearfix"></div>


        


      <div class="more-btn text-uppercase text-center mt-30"><a class="btn btn-primary big-btn" href="#" role="button">see more</a></div>





   </div>


   </div>








     <div class="sidebar text-center">


  <div class="col-md-3 col-sm-4 xs-mt-60">


  <a href="#"><img class="img-responsive" src="images/ad-1.png" alt=""></a>


  


   <div class="recent-tag text-left mtb-30">


     <h5 class="green-bg text-uppercase">recent tags</h5>


     <div class="recent-tag-cntn">


     <ul class="list-inline">


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name 4</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name 4</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name 4</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name </a></li>


        <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name 4</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name 4</a></li>


       <li><a href="#">Tag name</a></li>


       <li><a href="#">Tag name</a></li>
     </ul>


   </div>


   </div>


    </div>


    </div>


   </div>


   </div>


 </div>


  </section>
</div>
  

<?php include('common/footer.php'); ?>