<?php
session_start();
if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}
include('common/db.php');
include('common/adminsetting.php');

$user=$_SESSION['session_useremail'];
if (isset($_POST["change_password"])) {
        $email= $_SESSION['session_useremail'];
        $oldpassword=md5($_POST["oldpassword"]);
        $newpassword=md5($_POST["newpassword"]);
    
        $q="SELECT `email` FROM `users` WHERE `username`='".$email."' and `password`='".$oldpassword."'";
        $active='active';
	    $r=mysqli_query($conn,$q);
        
	    $n=mysqli_num_rows($r);
    	if($n==0)
    	{  
    		$err_msg = "Old Password not matched";
           
    	}
        else
        {
       	    $updt_pwd = "UPDATE `users` SET `password` = '".$newpassword."' WHERE `username` = '$email' and `password`='".$oldpassword."'";
			$ex_updt_pwd = mysqli_query($conn,$updt_pwd) or die(mysqli_error($conn));
  	        $success_msg = 'Your Password Changed Successfully';
           
        }
        
}    
?>
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
</head>

<body>
<?php

	//Header 
	include('common/header.php');

?>
<div class="main-content">
<section>
   <?php $email= $_SESSION['session_useremail'];
         $query = "SELECT * FROM users WHERE `username`='$email' or `email` ='$email'";
         $res = mysqli_query($conn, $query);
      
         while($row = mysqli_fetch_assoc($res)) {
		          $profile_image=$row['image'];
                  $fname=$row['fname'];	
                  $login_by=$row['login_by'];
                  $user_profile=$row['profileURL'];
                  $uid=$row['id'];	
         }
         //User Template  Upload Image
          $user_template_query = "SELECT * FROM `template` WHERE `user_id` = '$uid'";
          $user_template_res=mysqli_query($conn, $user_template_query);
          $count_template=mysqli_num_rows($user_template_res); 
          
          //User Meme  Upload Image
          $user_meme_query = "SELECT * FROM `meme` WHERE `user_id` = '$uid'";
          $user_meme_res=mysqli_query($conn, $user_meme_query);
          $count_meme=mysqli_num_rows($user_meme_res); 
   ?>
    <div class="container">
        <div class="content white-bg pall-20 pb-40 sm-plr-10 sm-pb-10 xs-pb-0">
            <div class="row mb-20">
                <div class="col-sm-12">
                 <div class="col-sm-4"><h3>User Profile</h3></div>
                 <div class="col-sm-8">
                 <?php $template_delete_msg = $_SESSION['template_delete_msg'];
                    if(isset($template_delete_msg)): 
                                echo '<div class="alert alert-success fade in" id="successmessage">'.$template_delete_msg.'</div>';
                                unset($_SESSION['template_delete_msg']);
                    endif; ?>
                 </div>
                </div>
            </div>
           <div class="row">
                <div class="col-md-4 sm-mb-30">
                    <div class="user-img mb-20">
                      <img src="<?php if(!empty($profile_image)){echo $profile_image;}else{ echo 'images/user.png'; }?>"  alt="">
                    </div><br>
                    <span> No tagline yet.</span>
                    <div class="user-box mb-20 mt-20">
                       <ul class="list-unstyled">
                          <li><i class="fa fa-clock-o mr-10 text-green" aria-hidden="true"></i> Member since 2016-09-21 </li>
                       </ul>
                    </div>
                    <div class="user-box">
                     <ul class="list-unstyled">
                     <?php if($login_by == 'Facebook'){?>
                     <li><i class="fa fa-facebook mr-10 text-green" aria-hidden="true"></i><a href="<?php echo $user_profile;?>"><?php echo $fname;?> Facebook Profile </a> </li>
                     <?php }if($login_by == 'Google'){ ?>
                      <li><i class="fa fa-google-plus mr-10 text-green" aria-hidden="true"></i><a href="<?php echo $user_profile;?>"><?php echo $fname;?> Google+ Profile </a> </li>
                      <?php }if($login_by == 'Twitter'){ ?>
                      <li><i class="fa fa-twitter mr-10 text-green" aria-hidden="true"></i><a href="<?php echo $user_profile;?>"><?php echo $fname;?> Twitter Profile </a> </li>
                      <?php } ?> 
                     <li><i class="fa fa-map-marker mr-10 text-green" aria-hidden="true"></i> Enter your location. 
                       <form class="" method="post" id="change-location" >
                         <input type="text" class="form-control" name="location" id="location" value="" placeholder="Enter Your Location">
                         <button  type="button" name="approve" class="btn btn-success"  onclick="locationfun('<?php echo 'testuser'; ?>')"><i class="fa fa-check-circle "></i></button>
                       </form>
                     </li>
                     </ul>
                 </div>
              </div>
             <div class="col-md-8">
                   <div class="tab">
                    <!-- Nav tabs -->
                     <ul class="nav nav-tabs" role="tablist">
                     <li role="presentation" class="<?php if(isset($active)){}else{ echo 'active'; } ?>">
                         <a href="#created" aria-controls="created" role="tab" data-toggle="tab">
                         <?php if(!empty($count_meme)) { echo  ' Memes created ('.$count_meme.')'; } else { echo  'Memes created '.'(0)';} ?>
                         </a>
                     </li>
                     <li role="presentation"><a href="#uploaded" aria-controls="uploaded" role="tab" data-toggle="tab">
                        <?php if(!empty($count_template)) { echo  ' Templates uploaded ('.$count_template.')'; } else { echo  'Templates uploaded '.'(0)';} ?></a>
                     </li>
                     <?php if($login_by == 'Website'){?>
                     <li role="presentation" class="<?php if(isset($active)){ echo $active; } ?>"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">My settings</a></li>
                     <?php } ?>
                    </ul>
                    <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane <?php if(isset($active)){}else{ echo 'active'; unset($active);}  ?>" id="created">   
                      <div class="memewrapper-inner">
                         <ul class="list-inline" style="padding-top:20px">
                          <?php  if($count_meme == 0) {
                                 echo 'No Meme Upload';
                           }
                           else{
                                while($user_meme_row = mysqli_fetch_assoc($user_meme_res)) {
                                    $meme_userid_value =  $user_meme_row['id'];
                                    $meme_image =  $user_meme_row['meme_image'];
                                    $total_meme =  $user_meme_row['count(meme_image)'];
                                    $img_path_meme=$siteurl.'/'.$meme_image;
                                    if(!empty($img_path_meme)){
                                    ?>
                                   <li style="padding-left: 20px;"><a id="mylink" onclick="func_meme_user('<?=$meme_userid_value?>')"><img class="img-responsive" src="<?PHP echo $img_path_meme;?>" alt="" height="150" width="225"></a></li>
                    <?php           }
                                } 
                           }?>
                         </ul>
                    </div>
                  </div>

              <div role="tabpanel" class="tab-pane" id="uploaded">
                 <ul class="list-inline" style="padding-top:20px">
                    <?php  if($count_template == 0) {
                                 echo 'No Template Upload';
                           }
                           else{
                                while($user_template_row = mysqli_fetch_assoc($user_template_res)) {
                                  //$user_template_row = $user_template_res->fetch_assoc();
                                   $template_userid_value =  $user_template_row['id'];
                                    $template_image =  $user_template_row['template_image'];
                                    $total_template =  $user_template_row['count(template_image)'];
                                    $img_path=$siteurl.'/'.$template_image;
                                    if(!empty($img_path)){
                                    ?>
                                   <li style="padding-left: 20px;"><a id="mylink" onclick="func_template_user('<?=$template_userid_value?>')"><img class="img-responsive" src="<?PHP echo $img_path;?>" alt="" height="150" width="225"></a></li>
                    <?php           }
                                } 
                           }?>
                   </ul>
              </div>            
              <div role="tabpanel" class="tab-pane" id="Follows"></div>

              <div role="tabpanel" class="tab-pane" id="Followed"></div>

            
              <div role="tabpanel" class="tab-pane <?php if(isset($active)){ echo 'active'; unset($active);} ?>" id="settings">
                  <ul class="list-unstyled">
                   <li class="mb-20"><h4 class="mb-10">Change Password</h4>
                        <?php if($login_by == 'Facebook'){?><i class="fa fa-envelope mr-10 text-green" aria-hidden="true"></i>Logged in via <?php echo $login_by; ?></li> <?php } ?>
                        <?php if($login_by == 'Google'){?><i class="fa fa-envelope mr-10 text-green" aria-hidden="true"></i>Logged in via <?php echo $login_by; ?></li> <?php } ?>
                        <?php if($login_by == 'Twitter'){?><i class="fa fa-envelope mr-10 text-green" aria-hidden="true"></i>Logged in via <?php echo $login_by; ?></li> <?php } ?>
                    </li>
                   </ul>
                   
                   <div class="clearfix"></div>
                    <?php
					if(isset($err_msg)){
						?>
                        <div class="alert alert-danger" id="successmessage">
  							<strong>Warning!</strong> <?=$err_msg?>
						</div>
                        <?php
						unset($err_msg);
					}
					if(isset($success_msg)){
						?>
                        <div class="alert alert-success" id="successmessage">
  							<strong>Success!</strong> <?=$success_msg?>
						</div>
                        <?php
						unset($success_msg);
					}
					?>
                   
                  <?php //echo $login_by; if($login_by == 'Website'){?>  
                   <form class="account-form col-md-8 col-sm-11 col-xs-12" method="post" id="change-password">
                      <div class="row">
                      
                            <div class="form-group col-sm-12">
                                <label>Enter Your Old password </label>
                                <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Enter Your Old Password">
                            </div>
                            
                             <div class="form-group col-sm-12">
                                <label>Enter Your New password </label>
                                <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Enter Your New Password">
                            </div>
                            
                            <div class="form-group col-sm-12">
                                <label>Enter Your Confirm password </label>
                                <input type="password" class="form-control" name="cpassword2" id="cpassword2" placeholder="Enter Your Confirm Password">
                            </div>
                           
                           <div class="form-group col-sm-6 col-xs-6 col-xx-12 mb-0 text-uppercase xx-mb-10">
                            <!-- <a href="#" class="btn btn-success">reset password</a> -->
                             <input type="submit" value="CHANGE PASSWORD"  class="btn btn-success" name="change_password"/>
                           </div>
                          
                      </div>
                  </form>
                   <?php //} ?>
                  <div class="clearfix"></div>
                   
              </div>
           
          </div>
        </div>
      </div>
</div>
</div>
 </div>
  </section>
</div>
<script type="text/javascript">

function locationfun(user) {
     var locationname=document.getElementById("location").value;
 
     $.ajax({
        url:"update-userlocation.php", //the page containing php script
        type: "POST", //request type
         data: 'user='+user+'&locationname='+locationname,
        success:function(data){
           // $("#location").html(data);
       }
     });
}
function func_template_user(template_userid) {
        var $link = $(this);
        $('<form/>', { action: 'template-details.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "template_id").val(template_userid)).appendTo('body').submit(); 
}

function func_meme_user(template_userid) {
        var $link = $(this);
        $('<form/>', { action: 'success.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "meme_id").val(template_userid)).appendTo('body').submit(); 
}
    
  setTimeout(function() {
        $('#successmessage').fadeOut('fast');
        }, 5000);
        
      
        $("#change-password").validate({
             
            rules: {
                
               
               oldpassword:{
                   required: true,
                    minlength: 8,
               },
               newpassword:{
                   required: true,
                    minlength: 8,
               },
               cpassword2 : {
                    equalTo : "#newpassword",
                    required: true,
                    minlength : 8,
               }, 
            
            },
            messages: {
              
                 oldpassword: {
                    required: "Please Enter Your Old Password",
                    minlength: "Password at least have 8 characters",
                },
                 newpassword: {
                    required: "Please Enter Your New Password",
                    minlength: "Password at least have 8 characters",
                },
               
            },
            submitHandler: function(form) {
                form.submit();
            }
});       
</script>
<?php include('common/footer.php'); ?>