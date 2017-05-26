<?php
include("dbconfig.php");

header('Content-Type: application/json');

session_start();
if(!isset($_SESSION['user_login']))
{
	$data["logged"] = false;
	echo json_encode($data);
	return;
}

$user = $_SESSION['user_login'];

$query="SELECT username, group FROM user WHERE username='$user'";


$result = mysql_query($query);
$data = mysql_fetch_assoc($result);

echo json_encode($data);
?>