<?php 
ob_start();
include('../header.php'); 
$admin_id = $row['id'];
$cat_id = $_POST['category'];
$tname = $_POST['tname'];
$tag_name = $_POST['tag_name'];
$upload_image = $_POST['upload_template'];
$query = "INSERT INTO template (admin_id,cat_id,tag_id,template_name,template_image) VALUES ('$admin_id','$cat_id','$tag_name','$tname','$upload_image')";

                          if (mysqli_query($conn, $query)) {
							  $last_record = mysqli_query($conn, "SELECT id FROM template ORDER BY id DESC LIMIT 1");
$last_record = $last_record->fetch_assoc();
                          header("Location:".$siteurl."templates/meme_generate.php?id=".$last_record['id']);
                          }

?>