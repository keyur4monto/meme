<?php
require_once('../../db.php');

if(isset($_REQUEST['view_id'])){
    
	$view_id = $_REQUEST['view_id'];
	
	$sel_temp = "SELECT users.username, template.*
					FROM template JOIN users
					ON template.user_id=users.id WHERE template.`id`='$view_id' ORDER BY `id` DESC ";
	$ex_sel_temp = mysqli_query($conn,$sel_temp) or die (mysqli_error($conn));
	
	if(mysqli_num_rows($ex_sel_temp) > 0){
		$row_sel_temp = mysqli_fetch_array($ex_sel_temp);
		$template_id 	= $row_sel_temp['id'];
		$template_name 	= $row_sel_temp['template_name'];
		$template_user 	= $row_sel_temp['username'];
		$template_cat 	= $row_sel_temp['cat_id'];
		$img = "../../".$row_sel_temp['template_image'];
		
		//Select Category
		$temps = explode(',',$template_cat);
		$category = array();
		foreach($temps as $temp){
			$sel_cat = "SELECT * FROM `category` WHERE `id`='$temp'";
			$ex_sel_cat = mysqli_query($conn,$sel_cat) or die(mysqli_error($conn));
			$row_sel_cat = mysqli_fetch_array($ex_sel_cat);
			$cat_name = $row_sel_cat['cat_name'];
			array_push($category,$cat_name);
			 
		}
	
		$template_tag 	= explode(',',$row_sel_temp['tag_id']);
		$template_count = $row_sel_temp['template_count'];
		$time			= $row_sel_temp['time'];
		
	}


?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="fa fa-times"></i></button>
      <h4 class="modal-title">Template Name :
        <?=$template_name?>
      </h4>
    </div>
    <div class="modal-body">
                    
                                    <form class="form-horizontal" role="form" method="post" >
                            
                                      
                                         <div class="form-group">
                                            <label for="username" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Username</label>
                                            <label class="col-lg-2 col-sm-2 ">
                                                <?=$template_user?>
                                            </label>
                                            
                                           
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                        
                                        <label for="category" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Category</label>
                                            <label class="col-md-10 col-sm-10">
                                            <?php
											$n = 1;
											foreach($category as $cat){
												echo '<b>'.$n.'.</b> '.$cat.'&nbsp;';
												$n++;
											}
											?>
                                           	
                                            </label>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="tag" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Tag</label>
                                            <label class="col-lg-10 col-sm-10 ">
                                               <?php
											$m = 1;
											foreach($template_tag as $tag){
												echo '<b>'.$m.'.</b> '.$tag.'&nbsp;';
												$m++;
											}
											?>
                                            </label>
                                       
                                        </div>
                                     
                                        
                                        <div class="form-group">
                                            <label for="Count" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Template Used</label>
                                            <label class="col-lg-4 col-sm-4 ">
                                                <?=$template_count?>
                                            </label>
                                            
                                           
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                         <label for="image" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Image</label>
                                            <label class="col-md-4 col-sm-4 ">
                                           	<img src="<?=$img?>" width="100" height="100">
                                            </label>
                                        </div>
                                      
                                      
                                       
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                               <button aria-hidden="true" data-dismiss="modal" class="btn btn-default" type="button">Cancle</button>
                                            </div>
                                        </div>
                                    </form>
                             
                                </div>
  </div>
</div>
<?php 
}

if(isset($_REQUEST['del_id'])){
    $del_id = $_REQUEST['del_id'];?>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="fa fa-times"></i></button>
      <h4 class="modal-title">Delete Meme Details</h4>
    </div>
    <div class="modal-body">
      <h5>Are You Sure Do You Want To Delete This Record ?</h5>
      <br />
      <form class="form-horizontal"  role="form" method="post" >
        <input type="hidden" class="form-control" name="del_meme" id="del_meme" value="<?=$del_id?>">
        <div class="form-group">
          <div class="col-lg-12">
            <input type="submit" name="delete" value="Delete" id="delete_meme" class="btn btn-default">
            <button aria-hidden="true" data-dismiss="modal" class="btn btn-default" type="button">Cancle</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php }


if(isset($_REQUEST['del_mul'])){
    $del_mul = $_REQUEST['del_mul'];?>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="fa fa-times"></i></button>
      <h4 class="modal-title">Delete Memes</h4>
    </div>
    <div class="modal-body">
      <h5>Are You Sure Do You Want To Delete These Records ?</h5>
      <br />
      <form class="form-horizontal"  role="form" method="post" >
        <input type="hidden" class="form-control" name="del_meme_mul" id="del_meme_mul" value="<?=$del_mul?>">
        <div class="form-group">
          <div class="col-lg-12">
            <input type="submit" name="delete_mul" value="Delete" class="btn btn-default">
            <button aria-hidden="true" data-dismiss="modal" class="btn btn-default" type="button">Cancle</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php }

	?>
    
