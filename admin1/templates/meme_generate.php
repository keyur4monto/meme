<?php include('../header.php'); ?>
<script src="<?php echo $siteurl.'assets/javascripts/memegenretor/jquery.watermark.min.js'?>"></script>
			<!-- end: header -->

 <?php $query = mysqli_query($conn, "SELECT * FROM admin_setting_option where id=1");
$admin_setting_option = $query->fetch_assoc();
?>			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ('../sidebar.php'); ?>
				<!-- end: sidebar -->
                <section role="main" class="content-body">
					<header class="page-header">
						<h2>MEME GENERATE</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $siteurl; ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>CREATE MEME</span></li>
							</ol>
                            <a class="sidebar-right-toggle"></a>
						</div>
					</header>
                    <div class="example save1" id="example">
            			<!--<h2>Custom save button</h2>-->
            			<?php if($_GET['id'] && !empty($_GET['id'])){ 
            			$query1 = mysqli_query($conn, "SELECT * FROM template where id=".$_GET['id']);
                        $row1 = $query1->fetch_assoc();
                        //echo "<pre>"; print_r($row);
                        $img_src = $row1['template_image'];
                        $imgbinary = fread(fopen($img_src, "r"), filesize($img_src));
                        $img_str = base64_encode($imgbinary);
                         
                         ?>
            			<img src="<?php echo $homeurl.$img_src;?>" id="example-save">
            			<div id="toolbar"></div>
            			<div class="form-group">
							<label class="col-md-3 control-label" for="profileFirstName">Meme Name</label>
							<div class="col-md-8">
								<input type="text" name="meme_name" id="meme_name" class="form-control" required="">
							</div>
						</div>
            			<div class="form-group">
							<label class="col-md-3 control-label" for="profileFirstName">Tags</label>
							<div class="col-md-8">
								<input type="text" name="tag_name" id="tag_name" class="form-control" id="tags" required="">
							</div>
						</div>
                        <div class="form-group">
							<label class="col-md-3 control-label" for="profileFirstName">Watermark</label>
							<div class="col-md-8">
								<input type="checkbox" name="watermark" value="yes" id="water_mark">
							</div>
						</div>
            			<div class="container">
            				<div class="row">
            					<!--<div class="col-md-8" id="preview"></div>-->
            					
            					<div class="col-md-12">
                                    <button class="btn btn-success" id="create_meme">Create Meme</button>
            						<!--<button class="btn btn-success" id="save">Save</button>-->
            						<!--<button class="btn btn-danger" id="download">Download</button>-->
            					</div>
                                
                                <!--<a href="https://plus.google.com/share?url={http://meme.potenzadev.ga/admin/}" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
  src="https://www.gstatic.com/images/icons/gplus-64.png" alt="Share on Google+"/></a>
  
  <a href="https://twitter.com/home?status=This%20photo%20is%20awesome!%20Check%20it%20out:%20http://meme.potenzadev.ga/admin/templates/meme_generate.php">Share on Twitter</a>-->
  
            				</div>
            			</div>
               <?php } ?>
        		</div>
                <div id="new_meme_share" style="display: none;"><img src="" />
                <a class="download_img" href="" download><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></a>
                <div class="share-btn mb-30">
                                  <a href="#" class="fb_share"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                  <a href="#" class="tw_share"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                  <a href="#" class="gp_share"><i class="fa fa-google-plus" aria-hidden="true"></i></a>                
<a title="Pin this to Pinterest" class="pr_share" href="" data-pin-do="buttonPin" data-pin-config="none" target="_blank">
<i class="fa fa-pinterest-p" aria-hidden="true"></i>
</a>
</div>
</div>

                
</section>
</div>
<script src="//connect.facebook.net/en_US/all.js"></script>
    <script>
    var set_watermark = '<?php echo $admin_setting_option['set_watermark'] ?>';
    var watermark_text = '<?php echo $admin_setting_option['water_mark_text'] ?>';
    var watermark_image = '<?php echo $admin_setting_option['water_mark_image'] ?>';
    watermark_image = watermark_image.replace('../', '<?php echo $siteurl ?>');
    console.log(watermark_text);
   window.fbAsyncInit = function() {     
        FB.init({
            appId      : '1625043167764533',
            status     : true,
            xfbml      : true
        });
        // Code in here will run once FB has been initialised
        function FB_post_feed(method,name,link,picture,caption,description){
            FB.ui({
                method: method,
                name: name,
                link: link,
                picture: picture,
                caption: caption,
                description: description
            });
        }
     };
  $(document).on("click",".fb_share",function(e){
    fb_share_img = $('#new_meme_share img').attr('src'); 
    fb_share_img = '<?php echo $siteurl ?>'+fb_share_img;
    //fb_share_img = fb_share_img.replace('../', '<?php echo $siteurl ?>');
                FB.ui({
                    method: 'feed',
                    name: 'MEME GENERATOR',
                    link: 'http://meme.potenzadev.ga',
                    picture: fb_share_img,
                    caption: 'Meme generator',
                    description: 'Hello This one is testing purpose please check it and confirm it'
                });
            });
        
        var counter = 1;
        $("#water_mark").click(function(e){
            $('.example').removeClass();
            $('#example').addClass('example save'+counter);
            if(counter%2!=0){
            //alert(counter);
            watermarkimg = $("#example-save").memeGenerator("save");
            //console.log(watermarkimg);
            }
            else{
                watermarkimg1 = $("#example-save").memeGenerator("save");
            }
            if(set_watermark=='image'){
                if(document.getElementById('water_mark').checked) {
                    
    		        if(counter <= 2){  
                    $('.example.save'+counter+' img').watermark({
                        //text: 'MEME.POTENZA',
                        //textWidth: 200
                        //path: '<?php // echo $siteurl ?>assets/images/logo.png'
                        path: watermark_image
                    });
                    }
                    else{
                        $('.example.save'+counter+' img').attr("src", watermarkimg1);
                    }
                } else {
            
                    //console.log(watermarkimg);
                    $('.example.save'+counter+' img').attr("src", watermarkimg);
                }
            }
            else{
                if(document.getElementById('water_mark').checked) {
                
		        if(counter <= 2){  
                $('.example.save'+counter+' img').watermark({
                    text: watermark_text,
                    textWidth: 200
                });
                }
                else{
                    $('.example.save'+counter+' img').attr("src", watermarkimg1);
                }
            } else {
        
                //console.log(watermarkimg);
                $('.example.save'+counter+' img').attr("src", watermarkimg);
            }
            }
            counter++;
        });
		
		// Example with saving
		$("#example-save").memeGenerator({
			useBootstrap: true,
			layout: "horizontal",
		});
		
		$("#save").click(function(e){
			e.preventDefault();
			
			var imageDataUrl = $("#example-save").memeGenerator("save");
			
			$("#preview").html(
				$("<img>").attr("src", imageDataUrl)
			);
		});
		
		/*$("#download").click(function(e){
			e.preventDefault();
            console.log('call');
			$("#new_meme_share img").memeGenerator("download");
		});*/
        $("#create_meme").click(function(e){
			var dataURL = $("#example-save").memeGenerator("save");
            var meme_name = $("#meme_name").val();
            var meme_tag = $("#meme_tag").val();
            var template_id = '<?php echo $_GET['id'];  ?>';
            var admin_id = '<?php echo $row['id'];  ?>';
            // post the dataUrl to php
            $.ajax({
              type: "POST",
              url: "ajax_meme.php",
              data: {meme_name:meme_name,meme_tag:meme_tag,template_id:template_id,admin_id:admin_id,image: dataURL}
            }).done(function( respond ) {
              // you will get back the temp file name
              // or "Unable to save this image."
              pr_img = respond.replace('../', '<?php echo $siteurl ?>');
              pr_url="//pinterest.com/pin/create/button/?url=<?php echo $siteurl ?>&media="+pr_img+"&description=Potenza+MEME+Image"
              $('#example').remove();
              $("#new_meme_share").css('display','block');
              $("#new_meme_share img").attr("src", respond);
              $(".download_img").attr("href", respond);
              $(".pr_share").attr("href", pr_url);  
            });

		});
		</script>
  
<?php include('../footer.php');?>	
		