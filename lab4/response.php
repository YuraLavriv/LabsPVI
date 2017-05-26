<?php
    $database = array(
        "admin" => "__Adm1n__",
        "Admin" => "Pass1111",
        "user" => "paSSw0rd",
        "login" => "II1234II",
        "user123" => "123Qwerty",
        "user111" => "1q@W3e4R"
        );

    function checkPass()
    {
        
        $pass = $_POST['value'];
        $uppercase = preg_match('@[A-Z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);

        if(!$uppercase || !$number || strlen($pass) < 4)
          return false;
        else
            return true;
    }
    function checkLogin()
    {
        global $database;
        $login = $_POST['value'];

        if(array_key_exists($login, $database) || strlen($login) < 4)
            return false;
        else
            return true;
    }


    header('Content-Type: application/json');

    $Result = array();
    $Result['error'] = "";
    $Result['result'] = false;

    if( !isset($_POST['valuetype'])) 
        $Result['error'] = 'Value type not setted!';

    if( !isset($_POST['value']) ) 
        $Result['error'] = 'Value not setted!';

    if($_POST['valuetype'] == 'login')
    {
        $Result['result'] = checkLogin();
    }
    elseif($_POST['valuetype'] == 'password')
    {
        $Result['result'] = checkPass();
    }
    else
    {
         $Result['error'] = 'Not found function '.$_POST['valuetype'].'!';
    }
    echo json_encode($Result);

?>