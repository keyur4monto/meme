<?php
session_start();
if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}
include('common/db.php');
include('common/adminsetting.php');

   //USER Upload Template Id
     if(isset($_POST['template_id'])){
          $_SESSION['template_userid'] = $_POST["template_id"];	
          $template_userid = $_SESSION['template_userid'];
     }
     $template_userid = $_SESSION['template_userid'];
     
     //get the userprofile 
     $email= $_SESSION['session_useremail'];
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
      $user_template_query = "SELECT * FROM `template` WHERE `id` = '$template_userid'";
      $user_template_res=mysqli_query($conn, $user_template_query);
      
      while($row_user_template_res = mysqli_fetch_assoc($user_template_res)) {
            $template_name    = $row_user_template_res['template_name'];
            $template_image   = $row_user_template_res['template_image'];
            $tag_id           = $row_user_template_res['tag_id'];
            $template_id      = $row_user_template_res['id'];
            $_SESSION['meme_id'] = $template_id;	
            $meme_id = $_SESSION['meme_id'];
     }
     
     //delete template
     if (isset($_POST["delete_template"])) {  
         $del_img_path = $_SERVER['DOCUMENT_ROOT'].'/'.$template_image;
              if(unlink($del_img_path))
              {
                  $user_del_template_query = "DELETE  FROM `template` WHERE `id` = '$template_userid'";
                  $user_del_template_res  = mysqli_query($conn, $user_del_template_query);
                  $num_del_template_row=mysqli_num_rows($user_del_template_res);
                  $_SESSION['template_delete_msg'] = 'Template Deleted Successfully.';
                  header('location:'.$siteurl.'/user-profile.php'); //.$siteurl.'user-profile.php'
             }
    } 
    
    //meme
     $user_meme_query = "SELECT * FROM `meme` WHERE `template_id` = '$meme_id'";
     $user_meme_res=mysqli_query($conn, $user_meme_query);
     $rowmeme=mysqli_num_rows($user_meme_res);       
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>User Template Detail Meme | <?php if(!empty($website_title)){echo $website_title;}else { echo 'Indianmeme.com';}?> </title>
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
            <div class="row mb-20">
                <div class="col-sm-12">
                 <h3><?php echo $template_name;?></h3>
                </div>
            </div>
           <div class="row">
               
                <div class="col-md-4 sm-mb-30">
                    <div class="user-img mb-20">
                      <img src="<?php if(!empty($template_image)){echo $template_image;}else{ echo 'images/user.png'; }?>"   height="100" width="100" alt="">
                    </div><br>
                   
                    <span>
                    
                    <?php if($rowmeme == 0){echo 'No memes have been created with this template yet.';}
                          else{ echo 'Memes created with this template: '.$rowmeme; }?>
                    </span>
                   
                    <div class="user-box">
                     <ul class="list-unstyled">
                         <form method="post">
                             <input  type="submit" value="DELETE TEMPLATE" name="delete_template"/><br />
                             <a id="mylink" onclick="func_edit_template('<?=$template_id?>')" >edit template</a>
                         </form>
                     </ul>
                 </div>
                 <div class="user-box">
                      <ul class="list-unstyled">Uploaded by you </ul>
                      <ul class="list-unstyled"><img src="<?php if(!empty($profile_image)){echo $profile_image;}else{ echo 'images/user.png'; }?>"  height="100" width="100" alt="">
                      </ul>
                 </div>
              </div>
             <div class="col-md-8">
                 <ul class="list-inline">
             <?php   
                    $template_update_msg = $_SESSION['template_update_msg'];
                    if(isset($template_update_msg)): 
                                echo '<div class="alert alert-success fade in" id="successmessage">'.$template_update_msg.'</div>';
                                unset($_SESSION['template_update_msg']);
                    endif;
                
                   if($rowmeme == 0){ 
                          echo  'No memes have been created with this template image yet. Be the first!';
                    }else{
                          while($user_meme_row = mysqli_fetch_assoc($user_meme_res)) {
                                    $meme_userid_value =  $user_meme_row['id'];
                                    $meme_image =  $user_meme_row['meme_image'];
                                    $total_meme =  $user_meme_row['count(meme_image)'];
                                    $img_path_meme=$siteurl.'/'.$meme_image;
                                    if(!empty($img_path_meme)){
                                    ?>
                                   <li><a  onclick="func_template_meme_edit('<?=$template_id?>')" ><img class="img-responsive" src="<?PHP echo $img_path_meme;?>" alt="" height="150" width="200"></a></li>
                    <?php           }
                            } 
                    } ?>  
                </ul>  
                
                        
             </div>
        </div>
    </div>
  </div>
</section>
</div>
<script type="text/javascript">
setTimeout(function() {
        $('#successmessage').fadeOut('fast');
        }, 5000);

function func_edit_template(templateid) {
        var $link = $(this);
        $('<form/>', { action: 'template-edit.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "template_id").val(templateid)).appendTo('body').submit(); 
}
function func_template_meme_edit(template_userid) {
        var $link = $(this);
        $('<form/>', { action: 'success.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "meme_id").val(template_userid)).appendTo('body').submit(); 
}
              
</script>
<?php include('common/footer.php'); ?>