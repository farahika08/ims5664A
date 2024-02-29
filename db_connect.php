<?php
$servername = "localhost";
$username = "id21940718_admin";
$password = "Admin123@";
$database = "id21940718_db_ims566";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
	header('location:server_down.php');
} 
else{
	// echo "Connection Established";
}

?>