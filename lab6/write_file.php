<?php

function table_to_str($db_name, $table_name, $filename){
    $file_conent = "";


    $table_header = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE table_name = '$table_name' AND table_schema = '$db_name'");


    while($column_name = mysql_fetch_array($table_header))
        $file_conent .= $column_name[0] . "\t";

    $file_conent = rtrim($file_conent, "\t");
    $file_conent .= "\r\n";


    $table_data = mysql_query("SELECT * FROM $table_name");


    while($row = mysql_fetch_assoc($table_data)) {

        foreach($row as $key => $val)
            $file_conent .= $val . "\t";
        $file_conent = rtrim($file_conent, "\t");


        $file_conent .= "\r\n";
    }

    $file_conent = rtrim($file_conent, "\r\n");

    $data["table_file_name"] = $filename;
    $data["table_file_content"] = $file_conent;


    return $data;
}

?>