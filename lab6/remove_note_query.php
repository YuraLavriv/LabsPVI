<?php
include("dbconfig.php");
include("remove_note.php");

header('Content-Type: application/json');


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $table = addslashes($_POST['table_name']); 
    $id= addslashes($_POST['id']);
    
    echo json_encode(remove_note($mysql_database, $table, $id));
    return;
}
else {
    $data["error"] = true;
    echo json_encode($data);
    return;
}

?>
