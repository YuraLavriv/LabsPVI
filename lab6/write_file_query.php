<?php
include("dbconfig.php");
include("write_file.php");

header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = addslashes($_POST['table_name']); 
    echo json_encode(table_to_str($mysql_database, $name, "table_" . $name . ".txt"));
    return;
}
else {
    $data["error"] = true;
    echo json_encode($data);
    return;
}
?>