<?php
include("dbconfig.php");

header('Content-Type: application/json');
$json_result = array();
$json_result['valid'] = false;

session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $username=addslashes($_POST['username']); 
    $password=addslashes($_POST['password']); 

    $query="SELECT id FROM user WHERE username='$username' and passcode='$password'";
    $result=mysql_query($query);
    $count = mysql_num_rows($result);
    if($count == 1)
    {
        $_SESSION['user_login']=$username;
        $json_result['valid'] = true;
    }
    else 
    {
        $json_result['valid'] = false;
    }
    echo json_encode($json_result);
}
?>