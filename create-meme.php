<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    <script src="<?php echo $siteurl.'/js/memegenretor/jquery.textfill.js';?>"></script>
     
     <!-- Add js and css AutoComplte tag -->
    <link href="css/jquery.tagsinput.css" rel="stylesheet">
    <script src="js/jquery.tagsinput.js"></script> 
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

</head>
<body>
<?php
/*if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}*/

/*if(!empty($_POST['template_id'])){
    $_SESSION['template']=array('username' => $_SESSION['session_username']);
}
if(!isset($_SESSION['template'])){
    header('location:index.php');
}*/


$query = mysqli_query($conn, "SELECT * FROM admin_setting_option where id=1");
$admin_setting_option = $query->fetch_assoc();
?>
      
<?php 
if(isset($_SESSION['session_userid'])){
$query1 = mysqli_query($conn, "SELECT * FROM users where id=".$_SESSION['session_userid']);
$getuser = $query1->fetch_assoc();
}
else{
    $getuser['id']='';
}
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
		
		$temp_tags = explode(',',$tag_name);
		
		foreach($temp_tags as $temp_tag){
			$sel_tag = "SELECT * FROM `tag` WHERE `tag_name`='$temp_tag'";
			$ex_sel_tag = mysqli_query($conn,$sel_tag);
			
            if(!empty($tag_name)){
            		if(mysqli_num_rows($ex_sel_tag) > 0){
            		     $row_sel_tag = mysqli_fetch_array($ex_sel_tag);
                         $count = $row_sel_tag['count'];
                         $count++;
                         
                         $updt_tag = "UPDATE `tag` SET `count`='$count' WHERE `tag_name`='$temp_tag'";
                         $ex_updt_tag = mysqli_query($conn,$updt_tag);
            		}
            		else{
            			$ins_tag = "INSERT INTO `tag` (`tag_name`,`status`) VALUES ('$temp_tag','1')";
                        $ex_ins_tag = mysqli_query($conn,$ins_tag);
            		}
           }  
		}
        $upload_image = $_POST['upload_template'];
        $thumb_image =  str_replace("uploads/template_image/","uploads/template_image/thumb/",$upload_image);
        $unique_code = uniqid().uniqid();
       

        $query = 'INSERT INTO template (user_id,cat_id,tag_id,template_name,template_image,thumb_template_img,unique_code) VALUES ("'.$user_id.'","'.$cat_ids.'","'.$tag_name.'","'.$tname.'","'.$upload_image.'","'.$thumb_image.'","'.$unique_code.'")';
        if (mysqli_query($conn, $query)) {
            $last_record = mysqli_query($conn, "SELECT * FROM template ORDER BY id DESC LIMIT 1");
            $last_record = $last_record->fetch_assoc();
		
            $_SESSION['template_id']=$last_record['id'];
        }
        

}
elseif(!empty($_POST['template_id'])){
    $_SESSION['template_id']=$_POST['template_id'];
    $tid = $_SESSION['template_id'];
    $last_record = mysqli_query($conn, "SELECT * FROM template where id='$tid'");
            $last_record = $last_record->fetch_assoc();
            $tname = $last_record['template_name'];
    //echo "cakfdkfldf".$_POST['template_id'];
}
else{
    if(!empty($_SESSION['template_id'])){
    $tid = $_SESSION['template_id'];
    $last_record = mysqli_query($conn, "SELECT * FROM template where id='$tid'");
    $last_record = $last_record->fetch_assoc(); 
    $tname = $last_record['template_name'];
    }
    else{
        header('location:upload.php');
    }
}
   
/*else{
    header("Location:".$siteurl."/upload.php");
}*/
?>
<?php
	//Header 
	include('common/header.php');
?>
<div class="main-content details-page">
<section>
    <div class="container">
        <div class="content white-bg pall-20 pb-40 sm-plr-10 sm-pb-10 xs-pb-0" id="meme_toogle">
            <div class="row mb-50 sm-mb-30 xs-mb-20">
                <div class="col-md-4 col-sm-6 text-black">
                    <h4 class="mb-10">Create A Meme</h4>
                    <h3 class="text-blue"><?php echo $tname; ?></h3>
                </div>
                 <?php if(!empty($banner_image)){ ?>
                <div class="col-md-8 col-sm-6 xs-mt-20">
                   <a class="pull-right" href="<?php echo $siteurl; ?>"><img class="img-responsive" src="<?php echo  'admin'.$banner_image;?>" alt=""></a>
                </div>
                <?php } ?>
           </div>
          <div class="row">
          
          <div class="col-md-9 col-sm-8 example save1" id="example">
                  <div class="top-btn mb-20">
                      <ul class="list-inline">
                         <li class="mr-10"><a href="<?php echo $siteurl;?>" class="btn btn-success big-btn">Choose a different meme <i class="fa fa-user" aria-hidden="true"></i></a></li>
                         <li><a href="upload.php" class="btn btn-primary big-btn">Upload Your Own Image <i class="fa fa-upload" aria-hidden="true"></i></a></li>
                      </ul>
                  </div>
                
                 <div class="example save" id="example">
                    <form id="myform" method="post">
    			           <img src="<?php echo $last_record['template_image']; ?>" id="example-save">
    			           <!--<div class="form-meme">
                           <div class="form-group memetags">
                                 <input type="text" name="meme_name" placeholder="Meme Name" id="meme_name" required="" class="form-control">
                            </div>
                			<div class="form-group">
    			                 <input type="text" name="meme_tag" placeholder="Add tags (multi-word allowed, enter to confirm)"  class="form-control" id="meme_tag" required="">
    						</div>
                            </div>
                            
                            <div class="form-group">
    							<label class="col-md-3 control-label" for="profileFirstName">Watermark</label>
    							<div class="col-md-8">
    								<input type="checkbox" name="watermark" value="yes" id="water_mark">
    							</div>
    						</div>
                            <div class="form-group">
                              <div class="checkbox">
                                <label class="mr-20"><input name="" type="checkbox" checked=""> Public </label>
                                <label><input type="checkbox"> Private </label>
                              </div>
                            </div>
                            <div class="form-group text-uppercase">
                              <button class="btn btn-success btn-lg mr-10" id="create_meme">Create Meme</button>
                              <a class="btn btn-primary text-capitalize reset_meme">Reset <i class="fa fa-refresh" aria-hidden="true"></i></a>
                            </div>
                            <div class="form-group">
                            
                              <a data-toggle="modal" data-target="#myModal1" class="text-blue" href="#">Somthing odd? Report this image</a><br>
                              <a class="text-blue" href="#">Upload Images</a>
                            </div>-->
                    </form>
                            
                            
                            <div id="toolbar"></div>
    		  </div>
              
        </div>
       <?php  include('common/createsidebar1.php'); ?>
    </div>
  </div>
 </div>
 </section>
 <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Report for this Template?</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="template_id" value="<?php echo $last_record['id']; ?>" />
          <input type="radio" name="report_reason" value="1" />Abc<br />
          <input type="radio" name="report_reason" value="2" />xyz<br />
          <input type="radio" name="report_reason" value="3" />qwerty<br />
          <input type="radio" name="report_reason" value="4" />asdf<br />
        </div>
        <div class="modal-footer">
            <input type="submit" name="report_submit" value="Submit" />
        </div>
      </form>
      </div>
    </div>
  </div>
  <?php if(isset($_POST['report_submit'])) {
    $template_id = $_POST['template_id'];
    $report_resoan = $_POST['report_reason'];
    $report_img = "INSERT INTO `report_image` (`template_id`,`report_reason`) VALUES (".$template_id.",'$report_resoan')";
    $ex_ins_tag = mysqli_query($conn,$report_img);
  } ?>
  <?php
  $recent_list = mysqli_query($conn, "SELECT m.* FROM meme m INNER JOIN template t ON m.template_id = t.id WHERE m.template_id = '".$last_record['id']."' ORDER BY id DESC LIMIT 30");
  $rowcount=mysqli_num_rows($recent_list);
  if($rowcount>=1){
  ?>
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
     <ul class="list-inline" id="result_para">
        <input type="hidden" value="6" id="result_no">
        <?php 
        $i =1;
        
        while($recent_memes = $recent_list->fetch_assoc()){
            //echo "<pre>"; print_r($my_memes);
              echo "<li><a onclick='func_meme_user(".$recent_memes['id'].")' data-toggle='tooltip' id=".$recent_memes['id']." title='".$recent_memes['meme_name']."'><img class='img-responsive' src='".$siteurl."/".$recent_memes['meme_image']."'/></a></li>";
              $i++;
        }
         ?>

     </ul>
     <div class="clearfix"></div>
      <?php if($i>=30) { ?>
      <div class="more-btn text-uppercase text-center mt-30"><a class="btn btn-primary big-btn" href="#" role="button">see more</a></div>
    <?php } ?>
   </div>
   
   </div>
<?php  include('common/createsidebar2.php'); ?>
   </div>
   </div>
 </div>
  </section>
  <?php } ?>
  
  <section class="mt-30">
    <div class="container">
    <div class="content white-bg pall-20 ptb-30 sm-plr-10 xs-ptb-0 ">
    <div class="row">
      <div class="col-sm-12">
       <h2>Popular Templates</h2>
      </div>
      </div>

     <div class="row">
      <div "="" class="col-md-9 col-sm-8">
     <div class="left-content">
     <ul class="list-inline" id="result_para">
        <input type="hidden" value="6" id="result_no">
        <?php 
        $i =1;
        $popular_list = mysqli_query($conn, "SELECT * FROM `template` ORDER BY `template_count` DESC LIMIT 30");
        while($popular_memes = $popular_list->fetch_assoc()){
            //echo "<pre>"; print_r($my_memes);
              echo "<li><a onclick='func_template_user(".$popular_memes['id'].")' data-toggle='tooltip' id=".$popular_memes['id']." title='".$popular_memes['template_name']."'><img class='img-responsive' src='".$siteurl."/".$popular_memes['thumb_template_img']."'/></a></li>";
              $i++;
        }
         ?>

     </ul>
     
     <div class="clearfix"></div>
        
      <!--<div class="more-btn text-uppercase text-center mt-30"><a role="button" href="#" class="btn btn-primary big-btn">see more</a></div>-->

   </div>
   </div>

<?php  include('common/createsidebar2.php'); ?>
     
   </div>
   </div>
 </div>
  </section>
  
  
 
  
  
</div>
<script src="//connect.facebook.net/en_US/all.js"></script>
<script>
$(window).load(function() {
	$('#meme_tag').tagsInput({width:'auto'});
});
  /*window.fbAsyncInit = function() {     
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
            });*/
  // Example with saving
  $(document).on("click",".reset_meme",function(e){
    $('.resetmeme').click();
    $('#meme_name').val('');
    $('#meme_tag_tagsinput span').remove();
  });
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
      
        //var counter = 1;
        $(document).ready(function(e){
            /*if(counter%2!=0){
            watermarkimg = $("#example-save").memeGenerator("save");
            //console.log(watermarkimg);
            }
            else{
                watermarkimg1 = $("#example-save").memeGenerator("save");
            }*/
            
             //start validation for create meme meme_name,meme_tag
        
            $('#myform').validate({ 
            rules: {
                meme_name: {
                    required: true
                },
                meme_tag: {
                    required: true
                }
            },
             messages: {
                    meme_name: {
                        required: "Please Enter Meme Name",
                    },
                   
                    meme_tag: {
                        required: "Please Enter Meme Tag",
                    },
             },
            submitHandler: function (form) { 
                return false;
            }
           });
            //end validation for create meme meme_name,meme_tag

            if(set_watermark=='image'){
               // if(document.getElementById('water_mark').checked) {
                    
    		        //if(counter <= 2){  
                    $('.example.save img').watermark({
                        path: watermark_image
                    });
                    /*}
                    else{
                        $('.example.save img').attr("src", watermarkimg1);
                    }
                /*} else {
            
                    //console.log(watermarkimg);
                    $('.example.save img').attr("src", watermarkimg);
                }*/
            }
            else{
                //if(document.getElementById('water_mark').checked) {
                        //console.log(watermarkimg);
                        
        		       // if(counter <= 2){  
                        $('.example.save img').watermark({
                            text: watermark_text,
                            textWidth: 150,
                            gravity: 'e'
                        });
                        /*}
                        else{
                            $('.example.save img').attr("src", watermarkimg1);
                        }
                } else {
                
                        //console.log(watermarkimg);
                        $('.example.save img').attr("src", watermarkimg);
                }*/
            }
           // counter++;
           
        });
        $(window).load(function() {
           $("#create_meme").click(function(e){
            //alert('call');
            console.log('call');
           	  
              if ($('#myform').valid())  //start validation for create meme meme_name,meme_tag
              {
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
						  beforeSend: function() {
							    $("#create_meme").hide();
              					$("#loading-image").show();
           				  },			
                          data: {meme_name:meme_name,meme_tag:meme_tag,template_id:template_id,user_id:user_id,image: dataURL,meme_lang:meme_lang}
                        }).done(function( respond ) {
                            
                         $('<form/>', { action: 'success.php', method: 'POST' })
                        .append($("<input>").attr("type", "hidden").attr("name", "meme_id").val(respond[2])).appendTo('body').submit();
                        
                          // you will get back the temp file name
                          // or "Unable to save this image."
                          console.log(respond[0]);
                          /*pr_img = '<?php echo $siteurl.'/'?>'+respond[0];
                          pr_url="//pinterest.com/pin/create/button/?url=<?php echo $siteurl ?>&media="+pr_img+"&description="+respond[1];
                          $('#meme_toogle').remove();
                          $("#new_meme_share").css('display','block');
                          $("#new_meme_share img").attr("src", respond[0]);
                          $(".download_img").attr("href", respond[0]);
                          $(".pr_share").attr("href", pr_url);
                          $("#share_meme_name").text(respond[1]);*/
                        });
                        
            } //end validation for create meme meme_name,meme_tag
		});
 	}); 


        
      function func_meme_user(meme_userid) {
        var $link = $(this);
        $('<form/>', { action: 'success.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "meme_id").val(meme_userid)).appendTo('body').submit(); 
        }
        function func_template_user(template_userid) {
        var $link = $(this);
        $('<form/>', { action: 'create-meme.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "template_id").val(template_userid)).appendTo('body').submit(); 
        }
  </script>

<?php include('common/footer.php'); ?>
<script src="<?php echo $siteurl.'/js/memegenretor/jquery.watermark.min.js'?>"></script>