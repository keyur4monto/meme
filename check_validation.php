<?php  
include('common/db.php');

if(isset($_POST['email'])){
if(!empty($_POST['email'])){
       
        $email_val = $_POST['email'];
        $query = "SELECT email FROM users where `email` = '$email_val'";
        $ex_query = mysqli_query($conn,$query)or die(mysqli_error());
       
        if(mysqli_num_rows($ex_query) > 0){
            echo "false";  
        }
        else
        {
            echo "true"; 
        }
        
}
}

if(isset($_POST['username'])){
if(!empty($_POST['username'])){
       
        $username_val = $_POST['username'];
        $query1 = "SELECT username FROM users where `username`= '$username_val'";
        $ex_query1 = mysqli_query($conn,$query1)or die(mysqli_error());
        
        if(mysqli_num_rows($ex_query1) > 0){
            echo "false";  
        }
        else
        {
            echo "true"; 
        }
        
}
}

if(isset($_POST['tname'])){
if(!empty($_POST['tname'])){
       
        $template_name = $_POST['tname'];
        $query2 = "SELECT template_name FROM template  where `template_name` LIKE '%$template_name'";
        $ex_query2 = mysqli_query($conn,$query2)or die(mysqli_error());
        
        if(mysqli_num_rows($ex_query2) > 0){
            echo "false";  
        }
        else
        {
            echo "true"; 
        }
        
}
}

if(isset($_POST['meme_name'])){
if(!empty($_POST['meme_name'])){
       
        $meme_name = $_POST['meme_name'];
        $query_meme = "SELECT meme_name FROM meme  where `meme_name` LIKE '%$meme_name'";
        $ex_query_meme = mysqli_query($conn,$query_meme)or die(mysqli_error());
        
        if(mysqli_num_rows($ex_query_meme) > 0){
            echo "false";  
        }
        else
        {
            echo "true"; 
        }
        
}
}

       
?>