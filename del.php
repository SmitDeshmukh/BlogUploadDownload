<?php

$table="BlogTable";

$id = $_GET['file_name'];
 
    
       include 'Connection.php';
 
        
        $sql="DELETE from ".$table." WHERE file_name='".$id."'";
       
        $result = $dbLink->query($sql);

       
?>

