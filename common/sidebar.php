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
      <div class="recent-tag text-left mtb-30">
      <h5 class="green-bg text-uppercase">recent tags</h5>
       <div class="recent-tag-cntn">
         <ul class="list-inline">
           <?php $tag_query = "SELECT * FROM `tag` WHERE `tagof`='0' ORDER BY id DESC LIMIT 0,18";
               $tag_res = mysqli_query($conn, $tag_query); 
               while($tag_row = mysqli_fetch_assoc($tag_res)) {
                $tag_nm = $tag_row['tag_name'];?>
                <li>
                     <a onclick="func_tag_detail('<?=$tag_nm?>')"><?php echo $tag_nm;?></a>
                </li>
           <?php } ?>    
         </ul>
      </div>
     </div>
     <?php if(!empty($banner_sidebarlower_image)){ ?>
            <a class="text-center" href="<?php echo $siteurl; ?>"><img class="img-responsive" src="<?php echo  'admin'.$banner_sidebarlower_image;?>" alt=""></a>
      <?php } ?>
   </div>
</div>
<script type="text/javascript">
function func_tag_detail(tag_nm) {
        var $link = $(this);
        $('<form/>', { action: 'tag-details.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "tagname").val(tag_nm)).appendTo('body').submit(); 
}
</script>