 <?php
$servername = "localhost";
$username = "potenza3_memegen";
$password = "xUwS@}3#ZW0-";
$dbname = "potenza3_memegen";
$siteurl = 'http://'.$_SERVER['SERVER_NAME'].'/admin/';
$homeurl = 'http://'.$_SERVER['SERVER_NAME'].'/';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?> 
