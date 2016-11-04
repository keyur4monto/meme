<?php
session_start();
//Database File
include('common/db.php');
include('common/adminsetting.php');

if (isset($_POST["login"])) {
    $username =  $_POST['username'];
    $password = md5($_POST['password']);
    
    if(!empty($username)&&!empty($password)){ 
        $query = mysqli_query($conn,"SELECT * FROM users where (`username` = '$username' or `email` ='$username') and `password` = '$password'");
        $getuser = $query->fetch_assoc();
        if (!empty($getuser['id'])) {
             $rowaffect = mysqli_affected_rows($conn);
             if($rowaffect >= 1){
                  $sucessmsg = 'Welcome '. $username.', you are now logged in.';
                  session_start();
            	  $_SESSION['session_username']	= $username;
                  $_SESSION['session_useremail'] =$getuser['email'];
                  $_SESSION['session_userid'] =$getuser['id'];	
              	  header("location:".$siteurl);
             }
             else
             {    
                  $failmsg2 = 'Login invalid, Try again.';
            }
        }
        
        mysqli_close($conn); 
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
    <title>Login | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?> </title>
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
                <div class="col-md-9 col-sm-8 text-capitalize">
                    <h2 class="m-0">login now</h2>
                    <hr>
                    <div class="clearfix"></div>
                    <form class="login account-form col-lg-7 col-md-8 col-sm-11 col-xs-12" id="login-form-demo" method="post">
                         <?php  if(!empty($sucessmsg)||!empty($failmsg2)){?>
                         
                         <?php if(isset($sucessmsg)){ 
						 	      echo '<div class="alert alert-success fade in" id="successmessage2">'.$sucessmsg.'</div>';
								}
                               if(isset($failmsg2)){
                                  echo '<div class="alert alert-danger fade in" id="successmessage2">'.$failmsg2.'</div>';
                               }?>
                             
                        <?php } ?>
                        <div class="row">
                           <div class="form-group col-sm-12">
                               <label>Username or Email</label>
                               <input type="text" name="username" class="form-control" placeholder="Username or Email">
                           </div>
                           <div class="form-group col-sm-12">
                               <label>Password</label>
                               <input type="password" name="password" class="form-control" placeholder="Enter your Password">
                           </div>
                           <div class="form-group text-uppercase col-sm-12 text-center">
                              <input type="submit" value="LOGIN"  name="login" class="btn btn-success btn-lg" />
                            </div>
                           <div class="form-group col-sm-6 col-xs-12">
                              <div class="checkbox m-0">
                               <label class="text-black">
                                 <input type="checkbox"> Remember me?</label>
                              </div>
                           </div>
                           <div class="form-group col-sm-6 col-xs-12 text-right xs-text-left">
                                <a class="text-blue" href="forgot-password.php">Forgot your password?</a>
                          </div>
                          <div class="clearfix"></div>
                          <div class="form-group col-sm-12 text-center text-blue social-media mt-10">
                                 <div class="social-title mb-20"><span>login with your social account</span></div>
                                  <a class="fb-bg text-white ptb-10 plr-20 mr-10" href="login-with.php?provider=Facebook"><b><i class="fa fa-facebook" aria-hidden="true"></i> facebook </b></a>
                                 <a class="twt-bg text-white ptb-10 plr-20 mr-10" href="login-with.php?provider=Twitter"><b><i class="fa fa-twitter" aria-hidden="true"></i> twitter</b></a>
                                 <a class="google-bg text-white ptb-10 plr-20" href="login-with.php?provider=Google"><b><i class="fa fa-google-plus" aria-hidden="true"></i> google</b></a>
                             </div>
                             <div class="clearfix"></div>
                                <div class="form-group col-sm-12 text-center text-green text-uppercase mt-30">
                                    <p>don't have an account ?</p>
                                    <a class="btn btn-primary big-btn mt-10" href="create-account.php">Create An Account</a>
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
        $('#successmessage2').fadeOut('fast');
        }, 5000);

     jQuery.validator.addMethod("noSpace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
        }, "Username Space Not Allowed");
   
    $("#login-form-demo").validate({
           rules: {
                username:{
                    noSpace: true,
                    required: true,
                }, 
                password: {
                    required: true, 
               },
            },
            messages: {
                username: {
                    required: "Please Enter Your Username",
                },
                password: {
                    required: "Please Enter Your Password",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
   });            
        
</script>       
<?php include('common/footer.php'); ?>