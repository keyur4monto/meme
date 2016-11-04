<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
session_start();

include('common/db.php');
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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
    
		
	
    
    	
</head>
<body>
<?php

 if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}
if($_POST['template_id']){
    $_SESSION['template']=array('username' => $_SESSION['session_username']);
}
if(!isset($_SESSION['template'])){
    header('location:index.php');
}
$_SESSION['session_userid'];


 
 $query = mysqli_query($conn, "SELECT * FROM admin_setting_option where id=1");
$admin_setting_option = $query->fetch_assoc();
?>

<?php $query1 = mysqli_query($conn, "SELECT * FROM users where id=".$_SESSION['session_userid']);
$getuser = $query1->fetch_assoc();
if(!empty($_POST['upload_template'])){
        $cat_ids='';
        $user_id = $getuser['id'];
        $cat_id = $_POST['category'];
        if(!empty($cat_id)) {
        foreach($cat_id as $check_cat_id) {
            $cat_ids .= $check_cat_id.','; 
            }
        }
        $cat_ids = substr($cat_ids, 0, -1);
        $tname = $_POST['tname'];
        $tag_name = $_POST['tag_name'];
        $upload_image = $_POST['upload_template'];
        $unique_code = uniqid().uniqid();
        

        $query = "INSERT INTO template (user_id,cat_id,tag_id,template_name,template_image,unique_code) VALUES ('$user_id','$cat_ids','$tag_name','$tname','$upload_image','$unique_code')";
       
        
        if (mysqli_query($conn, $query)) {
            $last_record = mysqli_query($conn, "SELECT * FROM template ORDER BY id DESC LIMIT 1");
            $last_record = $last_record->fetch_assoc();
        }

}
elseif($_POST['template_id']){
    $tid = $_POST['template_id'];
    $last_record = mysqli_query($conn, "SELECT * FROM template where id='$tid'");
            $last_record = $last_record->fetch_assoc();
    //echo "cakfdkfldf".$_POST['template_id'];
}
else{
    header("Location:".$siteurl."/upload.php");
}
?>
<?php

	//Header 
	include('common/header.php');

?>
<div class="main-content details-page">
<section>
    <div class="container">
        <div style="display: none;" class="content white-bg pall-20 pb-40 sm-plr-10 sm-pb-10 xs-pb-0" id="new_meme_share">
            <div class="row">
                <div class="col-sm-12">
                  <h2 id="share_meme_name"></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="mr-30">
                    <img style="float: left; margin-right:15px;" src="" />
                    </div>
                </div>
                <div class="col-md-5">   
                    <div class="light-gray-bg text-black sm-mt-30 pall-30">
                            <div class="share-btn mb-30">
                              <a href="#" class="fb_share"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                              <a href="#" class="tw_share"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="https://twitter.com/share?text=<?php echo $tname ?>" class="twitter-share-button" data-url="http://meme.potenzadev.ga/create-meme.php" data-via="websterlkc">Tweet</a>
                              <a href="#" class="gp_share"><i class="fa fa-google-plus" aria-hidden="true"></i></a>                
                             <a title="Pin this to Pinterest" class="pr_share" href="" data-pin-do="buttonPin" data-pin-config="none" target="_blank">
                             <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                             </a>
                            </div>
                            <div class="success-link">
                              <a class="download_img pull-left" href="" download>
                                <i aria-hidden="true" class="fa fa-arrow-circle-down"></i>
                              </a>
                            </div>
                            <div class="form-group text-uppercase mt-30" style="float: left;">
                                  <a class="btn gray-bg text-green" href="#">back</a>
                                  <a class="btn btn-success" href="#">Go to image page</a>
                                  <a class="btn btn-primary" href="#">Make another</a>
                            </div>
                            <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content white-bg pall-20 pb-40 sm-plr-10 sm-pb-10 xs-pb-0" id="meme_toogle">
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
          
          <div class="col-md-9 col-sm-8 example save1" id="example">
                  <div class="top-btn mb-20">
                      <ul class="list-inline">
                         <li class="mr-10"><a href="#" class="btn btn-success big-btn">Choose a different meme <i class="fa fa-user" aria-hidden="true"></i></a></li>
                         <li"><a href="#" class="btn btn-primary big-btn">Upload Your Own Image <i class="fa fa-upload" aria-hidden="true"></i></a></li>
                      </ul>
                  </div>
            <div class="example save" id="example">	
			<img src="<?php echo $last_record['template_image']; ?>" id="example-save">
			
                        <div class="form-group memetags">
                             <input type="text" name="meme_name" placeholder="Meme Name" id="meme_name" required="" class="form-control">
                        </div>
            			<div class="form-group">
			                 <input type="text" name="meme_tag" placeholder="Add tags (multi-word allowed, enter to confirm)" id="meme_tag" class="form-control" id="tags" required="">
						</div>
                        <div class="form-group">
							<label class="col-md-3 control-label" for="profileFirstName">Watermark</label>
							<div class="col-md-8">
								<input type="checkbox" name="watermark" value="yes" id="water_mark">
							</div>
						</div>
            			
                                                
                        <div class="form-group col-md-12">
                        <button class="btn btn-success" id="create_meme">Create Meme</button>
                        </div>
                                                
                        <div id="toolbar"></div>
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
</div>
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
    fb_share_img = '<?php echo $siteurl.'/'; ?>'+fb_share_img;
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
  // Example with saving
    var set_watermark = '<?php echo $admin_setting_option['set_watermark'] ?>';
    var watermark_text = '<?php echo $admin_setting_option['water_mark_text'] ?>';
    var watermark_image = '<?php echo $admin_setting_option['water_mark_image'] ?>';
    watermark_image = watermark_image.replace('../', '<?php echo $siteurl.'/admin/' ?>');
    
		$("#example-save").memeGenerator({
			useBootstrap: true,
			layout: "horizontal",
		});
		// Example with saving
		
		$("#save").click(function(e){
			e.preventDefault();
			
			var imageDataUrl = $("#example-save").memeGenerator("save");
			
			$("#preview").html(
				$("<img>").attr("src", imageDataUrl)
			);
		});
		
		$("#download").click(function(e){
			e.preventDefault();
			
			$("#example-save").memeGenerator("download");
		});
        
        
        var counter = 1;
        $("#water_mark").click(function(e){
            
            if(counter%2!=0){
            //alert(counter);
            watermarkimg = $("#example-save").memeGenerator("save");
            //console.log(watermarkimg);
            }
            else{
                watermarkimg1 = $("#example-save").memeGenerator("save");
            }
            
           /* if(document.getElementById('water_mark').checked) {
            $('.example.save #example-save').watermark({
                text: 'testing',
                textWidth: 200
            });
            }*/
            if(set_watermark=='image'){
                if(document.getElementById('water_mark').checked) {
                    
    		        if(counter <= 2){  
                    $('.example.save img').watermark({
                        path: watermark_image
                    });
                    }
                    else{
                        $('.example.save img').attr("src", watermarkimg1);
                    }
                } else {
            
                    //console.log(watermarkimg);
                    $('.example.save img').attr("src", watermarkimg);
                }
            }
            else{
                if(document.getElementById('water_mark').checked) {
                        //console.log(watermarkimg);
                        
        		        if(counter <= 2){  
                        $('.example.save img').watermark({
                            text: watermark_text,
                            textWidth: 200
                        });
                        }
                        else{
                            $('.example.save img').attr("src", watermarkimg1);
                        }
                } else {
                
                        //console.log(watermarkimg);
                        $('.example.save img').attr("src", watermarkimg);
                }
            }
            counter++;
        });


        $("#create_meme").click(function(e){
            
			var dataURL = $("#example-save").memeGenerator("save");
            var meme_name = $("#meme_name").val();
            var meme_tag = $("#meme_tag").val();
            var template_id = '<?php echo $last_record['id']; ?>';
            var user_id = '<?php echo $getuser['id'];  ?>';
            var meme_lang = $('#meme_lang option:selected').val();
            //console.log(meme_lang);
            // post the dataUrl to php
            $.ajax({
              type: "POST",
              url: "ajax_meme.php",
              dataType:"json",
              data: {meme_name:meme_name,meme_tag:meme_tag,template_id:template_id,user_id:user_id,image: dataURL,meme_lang:meme_lang}
            }).done(function( respond ) {
              // you will get back the temp file name
              // or "Unable to save this image."
              console.log(respond[0]);
              pr_img = '<?php echo $siteurl.'/'?>'+respond[0];
              pr_url="//pinterest.com/pin/create/button/?url=<?php echo $siteurl ?>&media="+pr_img+"&description="+respond[1];
              $('#meme_toogle').remove();
              $("#new_meme_share").css('display','block');
              $("#new_meme_share img").attr("src", respond[0]);
              $(".download_img").attr("href", respond[0]);
              $(".pr_share").attr("href", pr_url);
              $("#share_meme_name").text(respond[1]);
            });

		});
  
  </script>

<?php include('common/footer.php'); ?>
<script src="<?php echo $siteurl.'/js/memegenretor/jquery.watermark.min.js'?>"></script>