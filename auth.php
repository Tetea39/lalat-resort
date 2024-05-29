<?php
$username = "admin";
$password = "admin_123";
$hostname = "localhost";
$db = "unleashe_hotel";


$dbhandle = new mysqli($hostname, $username, $password, $db);
// Check connection
if ($dbhandle->connect_error) {
	die("Connection failed: " . $dbhandle->connect_error);
}
