<?php
include('common/db.php');
 if(isset($_REQUEST['user'])){
    $email = $_REQUEST['user'];
    
    $location = $_REQUEST["locationname"];
   
    $q_location="SELECT * FROM `users` WHERE `username`='".$email."'";
      
       
	    $r_location=mysqli_query($conn,$q_location);
	    $n_location=mysqli_num_rows($r_location);
         
        if($n_location >= 1) {
          while($row1 = mysqli_fetch_assoc($r_location)) {
            $user_location=$row1['location'];
          }  
        }
        else{
           $updt_location = "UPDATE `users` SET `location` = '".$location."' WHERE `username` = '$email'";
           $ex_updt_location = mysqli_query($conn,$updt_location) or die(mysqli_error($conn));
           $user_location=$row1['location'];
           $success_msg = 'Location Updated Successfully'; 
        }
 }
?>