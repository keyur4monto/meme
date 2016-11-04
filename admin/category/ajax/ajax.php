<?php
require_once('../../db.php');

if(isset($_REQUEST['cat_id'])){
    
	$cat_id = $_REQUEST['cat_id'];
	
	$sel_cat = "SELECT * FROM `category` WHERE `id`='$cat_id'";
	$ex_sel_cat = mysqli_query($conn,$sel_cat) or die (mysqli_error($conn));
	
	if(mysqli_num_rows($ex_sel_cat) > 0){
		$row_sel_cat = mysqli_fetch_array($ex_sel_cat);
		$cat_id 	= $row_sel_cat['id'];
		$cat_name 	= $row_sel_cat['cat_name'];
		$cat_icon 	= $row_sel_cat['icon'];
		$cat_status = $row_sel_cat['status'];
		
	}


?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="fa fa-times"></i></button>
      <h4 class="modal-title">Update Details - CATEGORY ID :
        <?=$cat_id?>
      </h4>
    </div>
    <div class="modal-body">
      <form class="form-horizontal" role="form" method="post" >
        <input type="hidden" class="form-control" name="cat_id" id="cat_id" value="<?=$cat_id?>">
        <div class="form-group">
          <label for="cat_name" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Category Name</label>
          <div class="col-lg-10">
            <input type="text" class="form-control"  name="cat_name" id="cat_name" placeholder="Category Name" value="<?=$cat_name?>">
            <span for="cat_name" id="cat_name1" style="color:#a94442"></span> </div>
          
         </div>
       
        <div class="form-group">
          
          <label for="icon" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Category Icon</label>
          <div class="col-lg-10">
          	<input type="text" class="form-control"  name="cat_icon" id="cat_icon" placeholder="Category Icon" value="<?=$cat_icon?>">
          
            <span for="cat_icon" id="cat_icon1" style="color:#a94442"></span> 
         </div>
        </div>
        
         <div class="form-group">
            <label for="status" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Status</label>
            <label class="col-lg-3 col-sm-2 checkbox-inline">
            <input type="checkbox" name="status" id="status" value="<?=$cat_status?>" <?php 
            if($cat_status == 1){
                echo "checked='checked'";
            }
            ?>>
            
            </label>
            
        </div>
        
        <div class="form-group">
          <div class="col-lg-12">
            <input type="submit" name="update" value="Update" id="update_cat" class="btn btn-default">
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
      <h4 class="modal-title">Delete Category Details</h4>
    </div>
    <div class="modal-body">
      <h5>Are You Sure Do You Want To Delete This Record ?</h5>
      <br />
      <form class="form-horizontal"  role="form" method="post" >
        <input type="hidden" class="form-control" name="del_cat" id="del_cat" value="<?=$del_id?>">
        <div class="form-group">
          <div class="col-lg-12">
            <input type="submit" name="delete" value="Delete" id="delete_cat" class="btn btn-default">
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
      <h4 class="modal-title">Add New category
      </h4>
    </div>
    <div class="modal-body">
      <form class="form-horizontal" role="form" method="post" >
        <div class="form-group">
          <label for="cat_name" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Category Name</label>
          <div class="col-lg-10">
            <input type="text" class="form-control"  name="cat_name" id="cat_name" placeholder="Category Name">
            <span for="cat_name" id="cat_name1" style="color:#a94442"></span> </div>
          
         </div>
       
        <div class="form-group">
          
          <label for="icon" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Category Icon</label>
          <div class="col-lg-10">
          	<input type="text" class="form-control"  name="cat_icon" id="cat_icon" placeholder="Category Icon">
          
            <span for="cat_icon" id="cat_icon1" style="color:#a94442"></span> 
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
            <input type="submit" name="add_new_cat" value="Add" id="add_new_cat" class="btn btn-default">
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
