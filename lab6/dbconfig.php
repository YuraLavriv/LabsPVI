<?php

$mysql_database = "db_lab_6";
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";


$db_link = mysql_connect($mysql_hostname, $mysql_user, $mysql_password);
    
if(!$db_link)
    die("Can`t connect to database! :(");

mysql_select_db($mysql_database, $db_link) 
    or die("Can`t select database! :(");
?>
