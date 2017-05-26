<?php
include("dbconfig.php");
include("add_to_table.php");

header('Content-Type: application/json');


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $table = addslashes($_POST['table_name']); 
    $data= json_decode(stripslashes($_POST['note']));
    
    echo json_encode(add_note($mysql_database, $table, $data));
    return;
}
else {
    $data["error"] = true;
    echo json_encode($data);
    return;
}

?>
