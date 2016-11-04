<?php

session_start();

include('common/db.php');
include('common/adminsetting.php');
if (isset($_POST["reset_password"])) {
    $email=$_POST["email"];
  
    $q="SELECT `email` FROM `users` WHERE `email`='".$email."'";
	$r=mysqli_query($conn,$q);
	$n=mysqli_num_rows($r);
	if($n==0)
	{  
		$err_msg = "Email id is not registered";
	}
	else{

		$length = 25;
		$validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
		$validCharNumber = strlen($validCharacters);
		$result = "";
	
		for ($i = 0; $i < $length; $i++) {
			$index = mt_rand(0, $validCharNumber - 1);
			$result .= $validCharacters[$index];
		}
		 
		$token = $result;
		
		
		$sel_forgot = "SELECT `email` FROM `forgot_password` WHERE `email`='$email' ";
		$ex_sel_forgot = mysqli_query($conn,$sel_forgot) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($ex_sel_forgot) > 0){
			
			$updt_token = "UPDATE `forgot_password` SET `token` = '$token',`usedto`='0' WHERE `email` = '$email'";
			$ex_updt_token = mysqli_query($conn,$updt_token) or die(mysqli_error($conn));
			
		}
		else{
			$inserttoken_q="INSERT INTO `forgot_password` (email,token) values ('".$email."','".$token."')";
			mysqli_query($conn,$inserttoken_q) or die(mysqli_error($conn));
		}
		
		
		$to = $email;
		$subject = "Forgot Password on Meme";
		$uri = 'http://'.$_SERVER['SERVER_NAME'];
		$message = '
			<html>
			<head>
			<title>Forgot Password For Meme</title>
			</head>
			<body>
			<p>Click on the given link to reset your password <a href="'.$uri.'/reset-password.php?token='.$token.'">Reset Password</a></p>
			</body>
			</html>
		';
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= 'From: Admin<chandani2vadaria@gmail.com>' . "\r\n";
	  //  $headers .= 'Cc: Admin@example.com' . "\r\n";
	
		if(mail($to,$subject,$message,$headers)){
			$success_msg = "We have sent the password reset link to your  email id <b>".$to."</b>"; 
		}
	
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
    <title>Forgot Password | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?> </title>
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
                    <h2 class="m-0">Forgot Your Password?</h2>
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
                   
                    <form class="account-form col-md-8 col-sm-11 col-xs-12" method="post" id="forgot-password">
                      <div class="row">
                           <div class="form-group col-sm-12">
                            <label>Enter your Email address below to reset your password </label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
                           </div>
                           <div class="form-group col-sm-6 col-xs-6 col-xx-12 mb-0 text-uppercase xx-mb-10">
                            <!-- <a href="#" class="btn btn-success">reset password</a> -->
                             <input type="submit" value="RESET PASSWORD"  class="btn btn-success" name="reset_password"/>
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
        
      
        $("#forgot-password").validate({
             
            rules: {
                
                email: {
                    required: true,
                    email: true,
                  
               },
            
            },
            messages: {
                email:{
                     required: "Please Enter Your Email Address",
                    email: "Please Enter Valid Email Address",
                 
                },
               
               
            },
            submitHandler: function(form) {
                form.submit();
            }
});       
</script>
<?php include('common/footer.php'); ?>