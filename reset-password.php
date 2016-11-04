<?php
session_start();

include('common/db.php');
include('common/adminsetting.php');

if(isset($_REQUEST['token'])){
	
	$token =  $_REQUEST['token'];
	$sel_token = "SELECT * FROM `forgot_password` WHERE `token`='$token' and usedto = 0";
	$ex_sel_token = mysqli_query($conn,$sel_token) or die(mysqli_error($conn));
	
	
	if(mysqli_num_rows($ex_sel_token) == 0){
		echo "<script>window.location.href = 'forgot-password.php';</script>";
	}
	
}
else{
	echo "<script>window.location.href = 'forgot-password.php';</script>";
}
	
	



if (isset($_POST["reset_password"])) {
	
	$password = md5($_POST['pass']);
  
    $sel_token = "SELECT * FROM `forgot_password` WHERE `token`='$token' and usedto = 0";
	$ex_sel_token = mysqli_query($conn,$sel_token) or die(mysqli_error($conn));
	
	
	if(mysqli_num_rows($ex_sel_token) > 0){
		$row_sel_token = mysqli_fetch_array($ex_sel_token);
		$t_email = $row_sel_token['email'];
		
		$updt_pass = "UPDATE `users` SET  `password`='$password' WHERE `email`='$t_email'";
		$ex_updt_pass = mysqli_query($conn,$updt_pass) or die(mysqli_error($conn));
		
		if($ex_updt_pass){
			$updt_token = "UPDATE `forgot_password` SET  `usedto`=1 WHERE `token`='$token'";
			$ex_updt_token = mysqli_query($conn,$updt_token) or die(mysqli_error($conn));
			$success_msg = "Yoour password changed successfully!";
			header('location:login.php');
		}
		else{
			$err_msg = "Something getting wrong!";
		}
		
		
	}
	else{
		$err_msg = "Something getting wrong!";
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
    <title>Reset Password | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?>  </title>
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
        <div class="content white-bg pall-20 pb-40 sm-plr-10 sm-pb-10 xs-pb-0">
            <div class="row">
                <div class="col-md-9 col-sm-8 text-capitalize xs-mb-40">
                    <h2 class="m-0">Reset Your Password</h2>
                    <hr>
                    <div class="clearfix"></div>
                    <?php
					if(isset($err_msg)){
						?>
                        <div class="alert alert-danger">
  							<strong>Warning!</strong> <?=$err_msg?>
						</div>
                        <?php
						unset($err_msg);
					}
					if(isset($success_msg)){
						?>
                        <div class="alert alert-success">
  							<strong>Success!</strong> <?=$success_msg?>
						</div>
                        <?php
						unset($success_msg);
					}
					?>
                   
                    <form class="account-form col-md-8 col-sm-11 col-xs-12" method="post" id="reset-password">
                      <div class="row">
                           <div class="form-group col-sm-12">
                            <label>Enter Your New Password</label>
                            <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter New Password">
                           </div>
                           <div class="form-group col-sm-12">
                            <input type="password" class="form-control" name="conf_pass" id="conf_pass" placeholder="Enter Confirm Password">
                           </div>
                           <div class="form-group col-sm-6 col-xs-6 col-xx-12 mb-0 text-uppercase xx-mb-10">
                            <!-- <a href="#" class="btn btn-success">reset password</a> -->
                             <input type="submit" value="SUBMIT"  class="btn btn-success" name="reset_password"/>
                           </div>
                          <div class="form-group col-sm-6 col-xs-6 col-xx-12 mb-0 text-right xs-text-left">
                              <a href="login.php" class="btn btn-success">back to login</a>
                          </div>
                      </div>
                  </form>
                  <div class="clearfix"></div>
            </div>
            <?php  include('common/sidebar.php'); ?>
         </div>
      </div>
   </div>
</section>
</div>

<script type="text/javascript">
  setTimeout(function() {
        $('#successmessage').fadeOut('fast');
        }, 5000);
        
      
        $("#reset-password").validate({
             
            rules: {
               
                pass: {
                    required: true,
                    minlength: 8
                },
                conf_pass : {
                    equalTo : "#pass",
                    required: true,
                    minlength : 8,
                   
                }
            },
            messages: {
            
               
                pass: {
                    required: "Please Enter Your Password",
                    minlength: "Password at least have 8 characters",
                },
               
                
               
            },
            submitHandler: function(form) {
                form.submit();
            }
});       
</script>
<?php include('common/footer.php'); ?>