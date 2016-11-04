<?php
session_start();

include('common/db.php');
if(!isset($_SESSION['session_username'])){
    //header('location:login.php');
}
if($_POST['check']=='home_load' && $_POST['getresult']!=''){
    $no = $_POST['getresult'];
    $rec_limit = 36;
    $offset = $rec_limit * $no ;
    
    $query1 = mysqli_query($conn, "SELECT * FROM `template`");
    $rowcount1=mysqli_num_rows($query1);
    $left_rec = $rowcount1 - ($no * $rec_limit);
      
    $query = mysqli_query($conn, "SELECT * FROM `template` ORDER BY `id` DESC LIMIT $rec_limit,$offset");
    $rowcount=mysqli_num_rows($query);
    if($rowcount > 0){
        while($templates = $query->fetch_assoc()){
                  //  echo "<pre>"; print_r($templates);
          echo "<li><a onclick='func_template_user(".$templates['id'].")' data-toggle='tooltip' id=".$templates['id']." title='".$templates['template_name']."'><img class='img-responsive' src='".$siteurl."/".$templates['thumb_template_img']."'/></a></li>";
        }
        if( $left_rec < $rec_limit ) {
            ?>
            <style>
            #load{
                display: none;
            }
            </style>
            <?php
            }
        
   }
    else
    {
        $result = 0;
        
    }
}


if($_POST['my_memes'] && $_POST['my_memes']!=''){
    $uid = $_POST['my_memes'];
    $meme_list = mysqli_query($conn, "SELECT * FROM `template` where user_id='$uid' ORDER BY `id` DESC");
        while($my_memes = $meme_list->fetch_assoc()){
            //echo "<pre>"; print_r($my_memes);
              echo "<li><a onclick='func_template_user(".$my_memes['id'].")' data-toggle='tooltip' title='".$templates['template_name']."'><img class='img-responsive' src='".$siteurl."/".$my_memes['thumb_template_img']."'/></a></li>";
        }
}
if($_POST['popular_memes']=='popular_meme'){
    $popular_list = mysqli_query($conn, "SELECT * FROM `template` ORDER BY `template_count` DESC LIMIT 30");
        while($popular_memes = $popular_list->fetch_assoc()){
            //echo "<pre>"; print_r($my_memes);
              echo "<li><a onclick='func_template_user(".$popular_memes['id'].")' data-toggle='tooltip' id=".$popular_memes['id']." title='".$popular_memes['template_name']."'><img class='img-responsive' src='".$siteurl."/".$popular_memes['thumb_template_img']."'/></a></li>";
        }
}

if($_POST['recent_memes']=='recent_meme'){
    $recent_list = mysqli_query($conn, "SELECT t.* FROM template t INNER JOIN meme m ON t.id = m.template_id GROUP BY t.id ORDER BY MAX(m.id) DESC LIMIT 30");
        while($recent_memes = $recent_list->fetch_assoc()){
            //echo "<pre>"; print_r($my_memes);
              echo "<li><a onclick='func_template_user(".$recent_memes['id'].")' data-toggle='tooltip' id=".$recent_memes['id']." title='".$recent_memes['template_name']."'><img class='img-responsive' src='".$siteurl."/".$recent_memes['thumb_template_img']."'/></a></li>";
        }
}

if($_POST['south_meme']=='south_meme'){
    $recent_list = mysqli_query($conn, "SELECT * FROM `template` WHERE `cat_id` LIKE '%14%' OR `cat_id` LIKE '%15%' OR `cat_id` LIKE '%16%' OR `cat_id` LIKE '%17%' ORDER BY id DESC LIMIT 30 ");
        while($recent_memes = $recent_list->fetch_assoc()){
            //echo "<pre>"; print_r($my_memes);
              echo "<li><a onclick='func_template_user(".$recent_memes['id'].")' data-toggle='tooltip' id=".$recent_memes['id']." title='".$recent_memes['template_name']."'><img class='img-responsive' src='".$siteurl."/".$recent_memes['thumb_template_img']."'/></a></li>";
        }
}
if($_POST['international_meme']=='international_meme'){
    $recent_list = mysqli_query($conn, "SELECT * FROM `template` WHERE `cat_id` LIKE '%18%' ORDER BY id DESC LIMIT 30");
        while($recent_memes = $recent_list->fetch_assoc()){
            //echo "<pre>"; print_r($my_memes);
              echo "<li><a onclick='func_template_user(".$recent_memes['id'].")' data-toggle='tooltip' id=".$recent_memes['id']." title='".$recent_memes['template_name']."'><img class='img-responsive' src='".$siteurl."/".$recent_memes['thumb_template_img']."'/></a></li>";
        }
}

if($_POST['telugu_memes']=='telugu_memes'){
    $recent_list = mysqli_query($conn, "SELECT * FROM `template` WHERE `cat_id` LIKE '%15%' ORDER BY id DESC LIMIT 30");
        while($recent_memes = $recent_list->fetch_assoc()){
            //echo "<pre>"; print_r($my_memes);
              echo "<li><a onclick='func_template_user(".$recent_memes['id'].")' data-toggle='tooltip' id=".$recent_memes['id']." title='".$recent_memes['template_name']."'><img class='img-responsive' src='".$siteurl."/".$recent_memes['thumb_template_img']."'/></a></li>";
        }
}
if($_POST['kannada_memes']=='kannada_memes'){
    $recent_list = mysqli_query($conn, "SELECT * FROM `template` WHERE `cat_id` LIKE '%16%' ORDER BY id DESC LIMIT 30");
        while($recent_memes = $recent_list->fetch_assoc()){
            //echo "<pre>"; print_r($my_memes);
              echo "<li><a onclick='func_template_user(".$recent_memes['id'].")' data-toggle='tooltip' id=".$recent_memes['id']." title='".$recent_memes['template_name']."'><img class='img-responsive' src='".$siteurl."/".$recent_memes['thumb_template_img']."'/></a></li>";
        }
}
if($_POST['malayalam_memes']=='malayalam_memes'){
    $recent_list = mysqli_query($conn, "SELECT * FROM `template` WHERE `cat_id` LIKE '%17%' ORDER BY id DESC LIMIT 30");
        while($recent_memes = $recent_list->fetch_assoc()){
            //echo "<pre>"; print_r($my_memes);
              echo "<li><a onclick='func_template_user(".$recent_memes['id'].")' data-toggle='tooltip' id=".$recent_memes['id']." title='".$recent_memes['template_name']."'><img class='img-responsive' src='".$siteurl."/".$recent_memes['thumb_template_img']."'/></a></li>";
        }
}

if(!empty($_POST['load_more_template'])){
    $tagname = $_POST['load_more_template'];
    $recent_template_list = mysqli_query($conn, "SELECT * FROM `template` WHERE  `tag_id` LIKE '%".$tagname."%'"); //LIMIT 0,6
        while($recent_template = $recent_template_list->fetch_assoc()){
              echo "<li><a onclick='func_template_user(".$recent_template['id'].")' data-toggle='tooltip' id=".$recent_template['id']." title='".$recent_template['template_name']."'><img class='img-responsive' src='".$siteurl."/".$recent_template['thumb_template_img']."'/></a></li>";
        }
}

if(!empty($_POST['searchmeme'])){
    $searchmeme = $_POST['searchmeme'];
    $search_meme_query = "SELECT * FROM `template` WHERE `template_name` LIKE '%".$searchmeme."%'";
    $search_meme_res = mysqli_query($conn, $search_meme_query);
    $rowcount=mysqli_num_rows($search_meme_res);
    if($rowcount >=1){
         while($search_meme_res_row = mysqli_fetch_assoc($search_meme_res)) {
    	       if($search_meme_res >=1){ 
                    echo "<li><a onclick='func_template_user(".$search_meme_res_row['id'].")' data-toggle='tooltip' id=".$search_meme_res_row['id']." title='".$search_meme_res_row['template_name']."'><img class='img-responsive' src='".$siteurl."/".$search_meme_res_row['thumb_template_img']."'/></a></li>";
               }
         }
     }
     else
     {
        echo  'No Template Found';
     }
}
?>