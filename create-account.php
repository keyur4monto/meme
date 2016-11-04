<?php

session_start();

if(isset($_SESSION['session_username'])){
    header('location:create-meme.php');
}

//Database File
include('common/db.php');
include('common/adminsetting.php');
if (isset($_POST["submit"])) {
    $username =  $_POST['username'];
    $email =  $_POST['email'];
    $password = md5($_POST['password']);
    $time=date("Y/m/d H:i:s");
   
    $query_usercheck = "SELECT email FROM users where `email` ='$email'";
    
    $ex_query = mysqli_query($conn, $query_usercheck);
  
    if(mysqli_num_rows($ex_query) <= 0){
       
        $query_ins = "INSERT INTO users (username,email,password,user_time,status,login_by) VALUES ('$username','$email','$password','$time','1','Website')";
        $ex_query_ins = mysqli_query($conn, $query_ins) or die(mysqli_error($conn));  
                if ($ex_query_ins) {
                     
                          $sucessmsg1 = 'User Register Successfully...';
                           
                }
          
            else{
                 $sucessmsg1 = 'This Email Address Already Exits Please Try Again...';
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
    <title>Create Account | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?> </title>
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
                   
                    <h2 class="m-0">Create An Account</h2>
                    <hr> 
                    <div class="clearfix"></div>
                   
                        
                         <?php if(isset($sucessmsg1)){ 
                                        echo  '<div class="alert alert-success fade in" id="successmessage"><strong>Well done! </strong>'.$sucessmsg1.'</div>';
                            } ?>
                       
                     
                    <form class="account-form col-lg-7 col-md-9 col-sm-12 col-xs-12" action="create-account.php" method="post" id="register-form">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>username*</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter your Username">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Email*</label>
                                <input type="email"  name="email" class="form-control" placeholder="Enter your Email">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Password*</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Confirm Password*</label>
                                <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Enter your Confirm Password">
                            </div>
                           <div class="form-group col-sm-12">
                                <p>By signing up, you represent that you have read, understood, and accepted our <a class="text-blue" href="terms.html" target="_blank">Terms of Service ?</a></p>
                           </div>
                           <div class="form-group text-uppercase col-sm-12 text-center mt-20 mb-0">
                               	<input type="submit" name="submit" class="btn  btn-success btn-lg" value="SIGN UP"/>
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
        
        jQuery.validator.addMethod("noSpace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
        }, "Username Space Not Allowed");

        $("#register-form").validate({
             
            rules: {
                username:{
                    noSpace: true,
                    required: true,
                    minlength: 8,
                    remote : 
                    {
                        url: 'check_validation.php',
                        type: "POST",
                        data:
                        {
                            username: function(){
                                 return $('#register-form :input[name="username"]').val();
                            }
                        }
                      }  
                }, 
                email: {
                    required: true,
                    email: true,
                    remote : 
                    {
                        url: 'check_validation.php',
                        type: "POST",
                        data:
                        {
                            email: function(){
                                 return $('#register-form :input[name="email"]').val();
                            }
                        }
                      }     
               },
                password: {
                    required: true,
                    minlength: 8
                },
                cpassword : {
                    equalTo : "#password",
                    required: true,
                    minlength : 8,
                   
                }
            },
            messages: {
                username: {
                    required: "Please Enter Your Username",
                    minlength: "Username at least have 8 Charaters",
                    remote: jQuery.validator.format("{0} is already taken."),
                },
               
                password: {
                    required: "Please Enter Your Password",
                    minlength: "Password at least have 8 characters",
                },
               
                email:{
                     required: "Please Enter Your Email Address",
                    email: "Please Enter Valid Email Address",
                     remote: jQuery.validator.format("{0} is already taken."),
                },
               
               
            },
            submitHandler: function(form) {
                form.submit();
            }
});    
</script>
<?php include('common/footer.php'); ?>