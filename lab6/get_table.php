<?php
include("dbconfig.php");

header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $data["error"] = false;

    $table_name = addslashes($_POST['table_name']); 
}
else {
    $data["error"] = true;
    echo json_encode($data);
    return;
}


$html = "<table>";


$table_header = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE table_name = '$table_name' AND table_schema = '$mysql_database'");


$html .= "<tr>";
while($column_name = mysql_fetch_array($table_header)) {

    $html .= "<th>";

    $html .= $column_name[0];

    $html .= "</th>";

}
$html .= "</tr>";


$table_data = mysql_query("SELECT * FROM $table_name");


while($row = mysql_fetch_assoc($table_data)) {
$html .= "<tr>";

    foreach($row as $key => $val){
        $html .= "<td>";

        $html .= $val;

        $html .= "</td>";
    }

$html .= "</tr>";
}

$html .= "</table>";

$data["table_html"] = $html;

echo json_encode($data);
?>