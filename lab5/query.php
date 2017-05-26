<?php
include("dbconfig.php");

header('Content-Type: application/json');

$query=addslashes($_POST['query']); 

$sth = mysql_query($query);

$rows = array();
while($r = mysql_fetch_assoc($sth)) 
    $rows[] = $r;

echo json_encode($rows);
?>