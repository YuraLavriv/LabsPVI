<?php

function remove_note($db_name, $table_name, $id_to_remove){

    $query = "DELETE FROM `" . $table_name . "` WHERE id = ". $id_to_remove;


    // $table_header = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
    //     WHERE table_name = '$table_name' AND table_schema = '$db_name'");

    // while($col = mysql_fetch_array($table_header)) 
    //     $query .=  "`" . $col[0] . "`, ";

    // $query = rtrim($query,", ");
    // $query .= ") VALUES (";


    // $table_header = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
    //     WHERE table_name = '$table_name' AND table_schema = '$db_name'");

    // $i = 0;
    // while($col = mysql_fetch_array($table_header)) 
    // {
    //     if($col[0] == "id")
    //         $query .= "NULL, ";
    //     elseif (is_numeric($row[$i]))
    //         $query .= $row[$i] . ", ";
    //     else 
    //         $query .= "'" . $row[$i] . "', ";
    //     $i++;
    // }

    // $query = rtrim($query,", ");
    // $query .= ")";



    $deleted = mysql_query($query);

    $data["query"] = $query;
    $data["result"] = $deleted;

    $data["error"] = false;

    return $data;
}
