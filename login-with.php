<?php

        session_start();
        include('common/db.php');
        include('config.php');
        include('hybridauth/Hybrid/Auth.php');
        if(isset($_GET['provider']))
        {
            $provider = $_GET['provider'];
        	try{
        	
        	$hybridauth = new Hybrid_Auth($config);
        	
        	$authProvider = $hybridauth->authenticate($provider);
             
	        $user_profile = $authProvider->getUserProfile();
            /* echo "<pre>";
               print_r($user_profile);
             echo "</pre>";
             echo "<a href='logout.php'>logout</a>";
            die(); */
			if($user_profile && isset($user_profile->identifier))
	        {
                $email= $user_profile->email;
                
                $query = "SELECT * FROM users where `email` ='$email'";
                $result_q =mysqli_query($conn, $query);
                
                if (!empty($result_q)) {
                    
                    $rowaffect = mysqli_affected_rows($conn);
                    
                    $fnm=$user_profile->firstName;
                    $lnm=$user_profile->lastName;
                    $profileURL=$user_profile->profileURL;
                    $img=$user_profile->photoURL;
                    
                    $getuser = $result_q->fetch_assoc();
                    
                    $time=date("Y/m/d H:i:s");
                    
                    $_SESSION['session_useremail'] = $email;
                    $_SESSION['session_username']  = $fnm;
                    $_SESSION['session_userid']    = $getuser['id'];
                   
                    if($rowaffect == 0){
                        $query_ins = "INSERT INTO users (fname,lname,username,email,image,user_time,status,login_by,profileURL) VALUES ('$fnm','$lnm','$email','$email','$img','$time','1','$provider','$profileURL')";
                         mysqli_query($conn, $query_ins) or die(mysqli_error($conn)); 
                         header("location:".$siteurl);
                    }
                    else{
                        $query_update = "UPDATE `potenza3_memegen`.`users` SET `fname` = '$fnm',`lname` ='$lnm',`username` ='$email',`email`='$email',`image` ='$img',`user_time`='$time',`status`='1',`login_by`='$provider',`profileURL`='$profileURL' WHERE `users`.`email` = '$email';";  
                         mysqli_query($conn, $query_update);  
                         header("location:".$siteurl);
                    }
                }    
	      
	        }	        

			}
			catch( Exception $e )
			{ 
			
				 switch( $e->getCode() )
				 {
                        case 0 : echo "Unspecified error."; break;
                        case 1 : echo "Hybridauth configuration error."; break;
                        case 2 : echo "Provider not properly configured."; break;
                        case 3 : echo "Unknown or disabled provider."; break;
                        case 4 : echo "Missing provider application credentials."; break;
                        case 5 : echo "Authentication failed. "
                                         . "The user has canceled the authentication or the provider refused the connection.";
                                 break;
                        case 6 : echo "User profile request failed. Most likely the user is not connected "
                                         . "to the provider and he should to authenticate again.";
                                 $twitter->logout();
                                 break;
                        case 7 : echo "User not connected to the provider.";
                                 $twitter->logout();
                                 break;
                        case 8 : echo "Provider does not support this feature."; break;
                }

                // well, basically your should not display this to the end user, just give him a hint and move on..
                echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

                echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";

			}
        
        }
?>