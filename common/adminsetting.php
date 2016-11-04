<?php 

$query_common_setting = "SELECT * FROM admin_setting_option";
//$query_common_setting = "SELECT * FROM admin_setting_option WHERE `banner_image_type`='TOP_BANNER_IMG'";
$res_common_setting = mysqli_query($conn, $query_common_setting);

while($row_common_setting = mysqli_fetch_assoc($res_common_setting)) {
          $logo_change=$row_common_setting['logo'];
          if(!empty($logo_change)){
             $logo = str_replace("..","",$logo_change);
          }
           
          if(!empty($row_common_setting['tagline'])){
                $tagline=$row_common_setting['tagline'];	
          }
          
          if(!empty($row_common_setting['website_title'])){
                $website_title=$row_common_setting['website_title'];	
          }
          
          $favicon_change=$row_common_setting['fevicon'];
          if(!empty($favicon_change)){
              $favicon = str_replace("..","",$favicon_change);
          }
     
       /*   $banner_text=$row_common_setting['banner_text'];
          $banner_image=$row_common_setting['banner_image']; */
          
          if(!empty($row_common_setting['copyright'])){
               $copyright=$row_common_setting['copyright'];
           }
          
          if(!empty($row_common_setting['about_us_text'])){
              $about_us_text=$row_common_setting['about_us_text'];
           }
          
           if(!empty($row_common_setting['aboutme_page'])){
              $aboutme_page=$row_common_setting['aboutme_page'];
           }
          
           if(!empty($row_common_setting['terms_page'])){
              $terms_page=$row_common_setting['terms_page'];
           }
          
           if(!empty($row_common_setting['disclaimer_page'])){
              $disclaimer_page=$row_common_setting['disclaimer_page'];
           }
          
           if(!empty($row_common_setting['privacy_page'])){
              $privacy_page=$row_common_setting['privacy_page'];
           }
          
          if($row_common_setting['banner_image_type'] == 'TOP_BANNER_IMG'){
             // $banner_text=$row_common_setting['banner_text'];
              $banner_image1=$row_common_setting['banner_image'];
              $banner_image = str_replace("..","",$banner_image1);
          }
          else if($row_common_setting['banner_image_type'] == 'SIDEBAR_UPER'){
           // $banner_text=$row_common_setting['banner_text'];
             $banner_sidebaruper_image1=$row_common_setting['banner_image'];
             $banner_sidebaruper_image = str_replace("..","",$banner_sidebaruper_image1);
          }
          else if($row_common_setting['banner_image_type'] == 'SIDEBAR_LOWER'){
           // $banner_text=$row_common_setting['banner_text'];
             $banner_sidebarlower_image1=$row_common_setting['banner_image'];
             $banner_sidebarlower_image = str_replace("..","",$banner_sidebarlower_image1);
          }
          else if($row_common_setting['banner_image_type'] == 'BOTTOM_BANNER_IMG'){
          // $banner_bottom_text=$row_common_setting['banner_text'];
             $banner_bottom_image12=$row_common_setting['banner_image'];
             $banner_bottom_image2 = str_replace("..","",$banner_bottom_image12);
          }
          
          if($row_common_setting['facebook_url']){
                 $facebook_url=$row_common_setting['facebook_url'];
          }
          if($row_common_setting['twitter_url']){
                 $twitter_url=$row_common_setting['twitter_url'];
          }
          if($row_common_setting['google_url']){
                 $google_url=$row_common_setting['google_url'];
          }
          
} 
?>