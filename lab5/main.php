<?php
include("dbconfig.php");

header('Content-Type: application/json');
$json_result = array();
$json_result['valid'] = false;

session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!isset($_SESSION['user_login']))
    {
        $data["logged"] = false;
    }
    else
        $data["username"] = $_SESSION['user_login'];
    
    echo json_encode($data);
}
?>