<?php
require_once('../../db.php');

if(isset($_REQUEST['u_id'])){
    
	$u_id = $_REQUEST['u_id'];
	
	$sel_user = "SELECT * FROM `users` WHERE `id`='$u_id'";
	$ex_sel_user = mysqli_query($conn,$sel_user) or die (mysqli_error($conn));
	
	if(mysqli_num_rows($ex_sel_user) > 0){
		$row_sel_user = mysqli_fetch_array($ex_sel_user);
		$u_id 		= $row_sel_user['id'];
		$u_name 	= $row_sel_user['fname']." ".$row_sel_user['lname'];
		$username 	= $row_sel_user['username'];
		if($row_sel_user['image'] == ''){
			$u_img		= '<img style="height: 100px; width: 100px;" src="'.$homeurl.'images/default-profile.png">';
		}
		else{
			$u_img		= '<img style="height: 100px; width: 100px;" src="'.$row_sel_user['image'].'">';
		}
		
		$u_loginby	= $row_sel_user['login_by'];
		$u_email	= $row_sel_user['email'];
		$u_prourl	= $row_sel_user['profileURL'];
		$u_location	= $row_sel_user['location'];
		$u_status	= $row_sel_user['status'];
		$u_time		= $row_sel_user['user_time'];
	}
?>
    <div class="modal-dialog">
                            
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="fa fa-times"></i></button>
                                    <h4 class="modal-title">Update Details - USER ID : <?=$u_id?></h4>
                                </div>
                                
                            
                                <div class="modal-body">
                          			<h4>Username : <?=$username?></h4>
                                    <form class="form-horizontal" role="form" method="post">
                                     <input type="hidden" class="form-control" name="u_id" id="u_id" value="<?=$u_id?>">
                                      
                                         <div class="form-group">
                                            <label for="fname" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">First Name</label>
                                            
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" maxlength="10" name="fname" id="fname" placeholder="First Name" value="<?=$row_sel_user['fname']?>" >
                                                  <span for="fname" id="fname1" style="color:#a94442"></span>
                                                
                                            </div>
                                            
                                            <label for="lname" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Last Name</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?=$row_sel_user['lname']?>" >
                                                <span for="lname" id="lname1" style="color:#a94442"></span>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="email" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Email</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" name="email" id="email" placeholder="Last Name" value="<?=$u_email?>" disabled>
                                                <span for="email" id="email1" style="color:#a94442"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="loginby" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Login By</label>
                                            <label class="col-lg-2 col-sm-2 control-label">
                                                <?=$u_loginby?>
                                            </label>
                                            
                                            <label for="location" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Location</label>
                                            <label class="col-md-2 col-sm-2 control-label">
                                            <?php
												if($u_location == ''){
													echo "-";
												}
												else{
													echo $u_location;
												}
											?>
                                            </label>
                                     
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="profile" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Profile URL</label>
                                            <label class="col-lg-3 col-sm-2 control-label">
                                                <a href="<?=$u_prourl?>" target="_blank">Social Profile URL</a>
                                               
                                           </label>
                                        </div>
                                     
                                        <div class="form-group">
                                            <label for="status" class="col-lg-2 col-sm-2 control-label" style="font-weight: 600;color: black;">Status</label>
                                            <label class="col-lg-3 col-sm-2 checkbox-inline">
                                            <input type="checkbox" name="status" id="status" value="<?=$u_status?>" <?php 
											if($u_status == 1){
												echo "checked='checked'";
											}
											?>>
                                            
                                            </label>
                                      		
                                        </div>
                                        
                                        
                                       
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <input type="submit" name="update" value="Update" id="update_user" class="btn btn-default">
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
                                    <h4 class="modal-title">Delete User Details</h4>
                                </div>
                                <div class="modal-body">
                          		
                                     <h5>Are You Sure Do You Want To Delete This Record ?</h5> <br />
                                    <form class="form-horizontal"  role="form" method="post" name="">
                                         <input type="hidden" class="form-control" name="del_user" id="del_user" value="<?=$del_id?>">
                                           <div class="form-group">
                                                <div class="col-lg-12">
                                                    <input type="submit" name="delete" value="Delete" id="delete_user" class="btn btn-default">
                                                        <button aria-hidden="true" data-dismiss="modal" class="btn btn-default" type="button">Cancle</button>
                                                </div>
                                          </div>
                                    </form>
                              </div>
                            </div>
    </div>
<?php }

?>
    
