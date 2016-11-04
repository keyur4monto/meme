<?php
//session_start();
/*if(!isset($_SESSION['session_username'])){
    header('location:login.php');
}*/
include('common/db.php');
include('common/adminsetting.php'); ?>
<div class="sidebar text-center">
    <div class="col-md-3 col-sm-4 xs-mt-60">
     <?php if(!empty($banner_sidebaruper_image)){ ?>
      <a href="<?php echo $siteurl; ?>"><img class="img-responsive" src="<?php echo 'admin'.$banner_sidebaruper_image;?>" alt=""></a>
      <?php } ?>
      
        <?php if(!empty($banner_sidebarlower_image)){ ?>
        <a class="text-center" href="<?php echo $siteurl; ?>"><img class="img-responsive" src="<?php echo  'admin'.$banner_sidebarlower_image;?>" alt=""></a>
        <?php } ?>
   </div>
</div>
      