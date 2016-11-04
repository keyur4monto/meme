<?php

	require_once("common/db.php");
	
	//error checking
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	/*
	  Common Constant Defined 
	*/

$siteurl1 = 'http://'.$_SERVER['SERVER_NAME'];
//define("BASE_HTTP_URL"   , "http://202.164.42.226/staging/android_api/zippy/");
define("BASE_HTTP_URL"   , $siteurl1);

define("BASE_SERVER_URL" , dirname(dirname(__FILE__)));
//print_r(BASE_SERVER_URL);

define("APP_NAME" ,'Indainmeme');

define("MAIL_FROM_EMAIL" ,'admin@indianmeme.com');						

date_default_timezone_set("Asia/Kolkata");



/**
  Database Exist Check
*/

function dbExist($value , $field_name , $table_name , $type = '=' , $failureMessg = 'Error in the query while looking for field in database') {
	
		$sql = "SELECT * FROM $table_name WHERE $field_name $type '$value' LIMIT 1 ";

		$ex_sql =  mysqli_query($conn, $sql);

		return (mysql_num_rows($sql)>0);

}


?>