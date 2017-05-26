<?php
include("dbconfig.php");
include("add_to_table.php");
include("write_file.php");

header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $string = addslashes(($_POST['content']));

    $name = addslashes(($_POST['table_name']));
    echo json_encode(read_to_table($string, $mysql_database, $name));
    return true;
}
else {
    $data["error"] = true;
    echo json_encode($data);
    return false;
}

function read_to_table($content, $db_name, $table_name){
    //$file = fopen($file_to_load, "r");
    $data = array();
    $rows = explode("\n", $content);
    
    $header = explode("\t", $rows[0]);
     //check data
    $table_header = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE table_name = '$table_name' AND table_schema = '$db_name'");

        // $i = 0;
        // while($col = mysql_fetch_array($table_header)) 
        // {
        //     if(strcmp($col[0], $header[$i]) != 0)
        //         {
        //             $data["error"] = true;
        //             $data["header_missmatch"] = true;

        //             return $data;
        //         }
        //     $i++;
        // }


    $backup_content = table_to_str($db_name, $table_name, "table_" . $table_name . "_backup.txt");
    $file = fopen($backup_content["table_file_name"], "w");
    fwrite($file, $backup_content["table_file_content"]);

    //clear table
    $trunc = mysql_query("TRUNCATE `$table_name`");


    $i = 1;
    $count = count($rows);
    while($i < $count){
        if(add_note($db_name, $table_name, explode("\t", $rows[$i]))["result"] != true){
            //backup database
            read_to_table("backups/" . $backup_content["table_file_name"], $db_name, $table_name);
            $data["error"] = true;
            $data["insertation_error"] = true;
            return $data;
        }
        $i++;
    }
    return $data;
}

?>