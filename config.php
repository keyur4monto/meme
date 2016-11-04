<?php $config =array(
		"base_url" =>'http://'.$_SERVER['SERVER_NAME'].'/hybridauth/index.php',// 'http://potenzadev.ga/meme/hybridauth/index.php';//"http://hayageek.com/examples/oauth/hybridauth/hybridauth/index.php", 
	
        "providers" => array ( 

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" =>"785677406264-irb7j165fgfhkitc07bprct8lh2395b0.apps.googleusercontent.com", "secret" => "pOmfQQzvzBfDim_AXZRW8Tik" ),
               /*   "scope"           => "https://www.googleapis.com/auth/userinfo.profile ". // optional
                               "https://www.googleapis.com/auth/userinfo.email"   , // optional
                  "access_type"     => "offline",   // optional
                  "approval_prompt" => "force",     // optional
                 // "hd"              => "domain.com" // optional */
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "791581577635519", "secret" => "90d7fa1f7f7e291885e1163bcf8bc27f"), 
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" =>"q1fRfgtNElBDQvXXRGQ1fkBRF", "secret" => "wjnrRcTDmDyAHOu6Kngr4zQyM718G0Y6vlKRMedvKVhFh8pqGI") 
			),
		),
		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,
		"debug_file" => "",
	     );
         
          
 ?>  
 
