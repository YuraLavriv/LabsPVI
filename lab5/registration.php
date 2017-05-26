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

    $query="SELECT id FROM user WHERE username='$username'";
    $result=mysql_query($query);
    $count = mysql_num_rows($result);
    if($count == 1)
    {
        $json_result['exists'] = true;
    }
    else 
    {
        $json_result['exists'] = false;

        $_SESSION['user_login']=$username;

        $query="INSERT INTO `user` (`id`, `username`, `passcode`, `group`) VALUES (NULL, '$username','$password','user')";
        mysql_query($query);
    }
    echo json_encode($json_result);
}
?>