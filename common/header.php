<?php
require_once("common/db.php");
if (isset($_POST["login"])) {
    $username =  $_POST['username'];
    $password = md5($_POST['password']);
    
    if(!empty($username)&&!empty($password)){ 
        $query = "SELECT * FROM users where (`username` = '$username' or `email` ='$username') and `password` = '$password'";
        $resultuser = mysqli_query($conn, $query);
        if ($resultuser) {
             $rowaffect = mysqli_affected_rows($conn);
             if($rowaffect >= 1){
                  $getuser = $resultuser->fetch_assoc();
                  $sucessmsg_user = 'Welcome '. $username.', you are now logged in.';
                  $_SESSION['session_username']	= $username;
                  $_SESSION['session_userid'] =$getuser['id'];		
              	  header("location:".$siteurl);
             }
             else
             {    
                  $failmsg_user = 'Login invalid, Try again.';
            }
        }
    } 
}
include('common/adminsetting.php');
?>

   <header class="site-header">
     <div class="container">
        <div class="row">
         <div class="col-sm-3 main-logo"><div class="logo"><a href="<?php echo $siteurl;?>"><img class="img-responsive" src="<?php if(!empty($logo)){echo $siteurl.'/admin/'.$logo;}else { echo 'images/logo.png';}?>" alt=""></a></div></div>
             <div class="col-sm-4">
              <div class="search-box mt-40 sm-mt-30"> 
                    <input  class="form-control" type="text" name="searchtemplate" placeholder="Search for hilarious desi memes..." id="searchtemplate" />
                    <button class="submit-btn" type="button" id="search_top" onclick="search_template()"><i class="fa fa-search" aria-hidden="true"></i></button> 
              </div>
             </div>
    <div class="col-sm-5">
      <div class="header-right text-right">
         <div class="right-top">
              <ul class="list-inline">
               <li><a href="about.php">About Me</a></li>
               <li><a href="terms.php">Terms</a></li>
               <li><a href="disclaimer.php">Disclaimer</a></li>
               <li><a href="privacy.php">Privacy</a></li>
              </ul>
          </div>
          <div class="right-btm">
             <ul class="list-inline text-uppercase">
                <li><a href="create-meme.php"><i class="fa fa-pencil" aria-hidden="true"></i> create</a></li>
                <li><a 
                    <?php
					if(isset($_SESSION['session_username'])){
						echo 'href="upload.php"';
					}
					else{
						echo 'href="#" data-toggle="modal" data-target="#myModal"';
					} 
					?>><i class="fa fa-upload" aria-hidden="true"></i> upload your own</a>
                    <!-- Modal -->
                     <div class="modal fade text-left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                         <div class="modal-dialog" role="document">
                             <div class="modal-content">
                               <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <h4 class="modal-title text-center" id="myModalLabel">You need to login to use this feature.</h4>
                               </div>
                              
                               <div class="modal-body">
                                <form class="login account-form text-capitalize" id="login-form" method="post">
                                    <?php  if(!empty($sucessmsg_user)||!empty($failmsg_user)){?>
                                  
                                     <?php if(isset($sucessmsg_user)){ echo '<div class="alert alert-success fade in" id="successmessage">'.$sucessmsg_user.'</div>'; }
                                           if(isset($failmsg_user)){   echo '<div class="alert alert-danger fade in" id="successmessage">'.$failmsg_user.'</div>';    } ?>
                                    
                                    <?php } ?>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                             <label>Username or Email</label>
                                             <input type="text" name="username" class="form-control" placeholder="Username or Email">
                                        </div>
                                        <div class="form-group col-sm-12">
                                             <label>Password</label>
                                             <input type="password" class="form-control"  name="password" placeholder="Enter your Password">
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
                                        <div class="form-group col-sm-6 col-xs-12 text-right xs-text-left f-password">
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
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                 </li>
                 <li class="login-page dropdown">
                 
                 <?php
				 if(isset($_SESSION['session_username'])){
					 ?>
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                      
                          <?php  if(isset($sucessmsg_user)||isset($failmsg_user)){?>
                                  
                                     <?php if(isset($sucessmsg_user)){ ?> <div class="alert alert-success fade in" id="successmessage"><?php echo $sucessmsg_user;?></div><?php  } ?>
                                     <?php if(isset($failmsg_user)){ ?> <div class="alert alert-danger fade in" id="successmessage"><?php echo $failmsg_user;?></div><?php  } ?>
                                    
                        <?php } ?>
                     
      
                        <div class="row login dropdown-menu account-form text-capitalize">
                       		
                            	<a href="user-profile.php">My Public Profile</a>
                                <a href="">Setting</a>
                                <a href="logout.php">Logout</a>
                        </div>
                     <?php
				 }
				 else{
					 ?>
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                        
                        <form class="login dropdown-menu account-form text-capitalize"  id="login-form" method="post">
                        
                          <?php  if(isset($sucessmsg_user)||isset($failmsg_user)){?>
                                  
                                     <?php if(isset($sucessmsg_user)){ ?> <div class="alert alert-success fade in" id="successmessage"><?php echo $sucessmsg_user;?></div><?php  } ?>
                                     <?php if(isset($failmsg_user)){ ?> <div class="alert alert-danger fade in" id="successmessage"><?php echo $failmsg_user;?></div><?php  } ?>
                                    
                           <?php } ?>
                     
                        <div class="row">
                            <div class="form-group col-sm-12">
                                 <label>Username or Email</label>
                                 <input type="text" class="form-control" name="username" placeholder="Username or Email">
                            </div>
                            <div class="form-group col-sm-12">
                                 <label>Password</label>
                                 <input type="password" class="form-control"  name="password" placeholder="Enter your Password">
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
                            <div class="form-group col-sm-6 col-xs-12 text-right xs-text-left f-password">
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
                     <?php
				 }
				 ?>       
                 </li>
             </ul>
            </div>
          </div>
      </div>
    </div>

     <div class="row mt-30 sm-mt-20">
         <div class="col-sm-12">
            <nav class="navbar navbar-default">
                 <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                   </button>
                 </div>
                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav text-uppercase text-center">
                   <?php /* $memelan_query = "SELECT * FROM meme";
                          $memelan_result = mysqli_query($conn, $memelan_query);
                         
                           while($meme_result_row = mysqli_fetch_assoc($memelan_result)) {
                                  $meme_lang =  $meme_result_row['meme_lang'];
                           }*/     
                   ?>
                          
                    <li class="active menu-1"><a href="<?php echo $siteurl ?>"><span data-hover="All India">All India</span></a></li>
                    <li class="menu-2"><a href="<?php echo $siteurl.'/trending.php' ?>"><span data-hover="Trending Now!">Trending Now!</span></a></li>
                    <li class="menu-3"><a href="<?php echo $siteurl.'/northindian.php' ?>"><span data-hover="North Indian">North Indian</span></a></li>
                    <li class="menu-4"><a href="<?php echo $siteurl.'/southindian.php' ?>"><span data-hover="South Indian">South Indian</span></a></li>
                    <li class="menu-5"><a href="<?php echo $siteurl.'/international.php'?>"><span data-hover="International">International</span></a></li>
                    <li class="menu-6"><a href="#"><span data-hover="Top 100 Users">Top 100 Users</span></a></li>
                  </ul>
                </div>
              </nav>
       </div>
    </div>
</div>
</header>


<script type="text/javascript">
  setTimeout(function() {
        $('#successmessage').fadeOut('fast');
        }, 5000);
        
         jQuery.validator.addMethod("noSpace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
        }, "Username Space Not Allowed");
   
    $("#login-form").validate({
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

function search_template()
{
     var searchmeme1 = document.getElementById("searchtemplate").value;
     if(searchmeme1 !=''){
        $('<form/>', { action: 'search.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "searchtemplate").val(searchmeme1)).appendTo('body').submit(); 
        }
} 


     
        
</script>
