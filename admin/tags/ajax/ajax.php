<?php
require_once('../../db.php');

if(isset($_REQUEST['tag_id'])){
    
	$tag_id = $_REQUEST['tag_id'];
	
	$sel_tag = "SELECT * FROM `tag` WHERE `id`='$tag_id'";
	$ex_sel_tag = mysqli_query($conn,$sel_tag) or die (mysqli_error($conn));
	
	if(mysqli_num_rows($ex_sel_tag) > 0){
		$row_sel_tag = mysqli_fetch_array($ex_sel_tag);
		$tag_id 	= $row_sel_tag['id'];
		$tag_name 	= $row_sel_tag['tag_name'];
		$tag_status = $row_sel_tag['status'];
		
	}


?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="fa fa-times"></i></button>
      <h4 class="modal-title">Update Details - TAG ID :
        <?=$tag_id?>
      </h4>
    </div>
    <div class="modal-body">
      <form class="form-horizontal" role="form" method="post" >
        <input type="hidden" class="form-control" name="tag_id" id="tag_id" value="<?=$tag_id?>">
        <div class="form-group">
          <label for="tag_name" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Tag Name</label>
          <div class="col-lg-10">
            <input type="text" class="form-control"  name="tag_name" id="tag_name" placeholder="Tag Name" value="<?=$tag_name?>">
            <span for="tag_name" id="tag_name1" style="color:#a94442"></span> </div>
          
         </div>
       
    
         <div class="form-group">
            <label for="status" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Status</label>
            <label class="col-lg-3 col-sm-2 checkbox-inline">
            <input type="checkbox" name="status" id="status" value="<?=$tag_status?>" <?php 
            if($tag_status == 1){
                echo "checked='checked'";
            }
            ?>>
            
            </label>
            
        </div>
        
        <div class="form-group">
          <div class="col-lg-12">
            <input type="submit" name="update" value="Update" id="update_tag" class="btn btn-default">
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
      <h4 class="modal-title">Delete Tag Details</h4>
    </div>
    <div class="modal-body">
      <h5>Are You Sure Do You Want To Delete This Record ?</h5>
      <br />
      <form class="form-horizontal"  role="form" method="post" >
        <input type="hidden" class="form-control" name="del_tag" id="del_tag" value="<?=$del_id?>">
        <div class="form-group">
          <div class="col-lg-12">
            <input type="submit" name="delete" value="Delete" id="delete_tag" class="btn btn-default">
            <button aria-hidden="true" data-dismiss="modal" class="btn btn-default" type="button">Cancle</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php }

if(isset($_REQUEST['add'])){
	?>
    	<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="fa fa-times"></i></button>
      <h4 class="modal-title">Add Tag category
      </h4>
    </div>
    <div class="modal-body">
      <form class="form-horizontal" role="form" method="post" >
        <div class="form-group">
          <label for="tag_name" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Tag Name</label>
 
         
         <div class="col-md-7">
													
													<select id="tags-input-multiple" name="tag_name[]" multiple data-role="tagsinput" data-tag-class="label label-primary">
														
													</select>
                                                    <p>
														Please add value using <b>comma(,)</b> seperator.
													</p>
											
													
												</div>
        </div>
     
        
         <div class="form-group">
            <label for="status" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Status</label>
            <label class="col-lg-3 col-sm-2 checkbox-inline">
            <input type="checkbox" name="status" id="status" value="1">
            
            </label>
            
        </div>
        
        <div class="form-group">
          <div class="col-lg-12">
            <input type="submit" name="add_new_tag" value="Add" id="add_new_tag" class="btn btn-default">
            <button aria-hidden="true" data-dismiss="modal" class="btn btn-default" type="button">Cancle</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    <?php
}

?>

<script>
	$('#status').on('click', function () {
    $(this).val(this.checked ? 1 : 0);
  
});
</script>
<script src="../assets/vendor/jquery/jquery.js"></script>
<script src="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
