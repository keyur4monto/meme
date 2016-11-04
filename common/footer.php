<?php include('common/adminsetting.php');?>
<footer>
 <div class="footer light-gray-bg mt-60 ptb-50 xs-ptb-30 xs-mt-30">
     <div class="container">
         <div class="row">
            <div class="col-sm-4 xs-mb-30">
            <div class="footer-title text-black text-uppercase mb-30 xs-mb-20">about us</div>
            <p class="lg-pr-40 sm-pr-0">
                <?php if(!empty($about_us_text)){echo $about_us_text;}?>
             </p>
            </div>
    
            <div class="col-sm-3 xs-mb-30">
                <div class="footer-title text-black text-uppercase mb-30 xs-mb-20">information</div>
                    <div class="menu">
                        <ul class="list-unstyled">
                         <li><a href="about.php">About Me</a></li>
                         <li><a href="terms.php">Terms</a></li>
                         <li><a href="disclaimer.php">Disclaimer</a></li>
                         <li><a href="privacy.php">Privacy</a></li>
                        </ul>
                    </div>
                <?php if(!empty($facebook_url)||!empty($twitter_url)||!empty($google_url)){ ?> 
                <div class="social mt-20 xs-mt-10">
                     <ul class="list-inline">
                        <?php if(!empty($facebook_url)){ ?> 
                            <li class="mr-10"><a href="<?php echo $facebook_url;?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($twitter_url)){ ?>     
                            <li class="mr-10"><a href="<?php echo $twitter_url;?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($google_url)){ ?> 
                        <li class="mr-10"><a href="<?php echo $google_url;?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <?php } ?>
                     </ul>
                </div>
                <?php } ?>
            </div>
           <?php include('common/populartags.php'); ?>
        </div>
    </div>
</div>
<div class="copyright black-bg ptb-20 text-center xs-ptb-10">
      <div class="container">
        <div class="row">
         <div class="col-sm-12">
             <p class="text-white"> <?php if(!empty($copyright)){echo $copyright;}?></p>
         </div>
        </div>
     </div>
</div>
</footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <!--<script src="js/jquery.min.js"></script>-->
   <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.colorPicker.min.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript" src="js/mp.mansory.js"></script>
    
    <script>
	$("#searchmeme").keyup(function(event){
    if(event.keyCode == 13){
        $("#search").click();
		$('html, body').animate({scrollTop : 0},800);
		return false;
    }
});

$("#searchtemplate").keyup(function(event){
    if(event.keyCode == 13){
        $("#search_top").click();
    }
});    
	</script>
 </body>
</html>