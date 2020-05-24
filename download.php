<?php

$table="BlogTable";

// Make sure an ID was passed
if(isset($_GET['file_name'])) {
// Get the ID
    $id = $_GET['file_name'];
 
        // Connect to the database
       include 'Connection.php';
 
        // Fetch the file information
      /
        $sql="SELECT * from ".$table." WHERE file_name='".$id."'";
       $query = "
            SELECT `mime`, `file_name`, `size`, `data`
            FROM ".$table."
            WHERE `file_name` = {$id}";
        $result = $dbLink->query($sql);

       
        if($result) {
            // Make sure the result is valid
            if($result->num_rows == 1) {
            // Get the row
                $row = mysqli_fetch_array($result);
 
                // Print headers
				$cur_mime=$row['mime'];
				$cur_size=$row['size'];
				$cur_name=$row['file_name'];
				
                header("Content-Type: ".$cur_mime);
              
                header("Content-Length:$cur_size");
                header("Content-Disposition:attachment;filename=$cur_name");
 
                // Print data
				
                echo $row['data'];
               
            }
            else {
                echo 'Error! No image exists with that ID.';
            }
 
            // Free the mysqli resources
            @mysqli_free_result($result);
        }
        else {
            echo "Error! Query failed: <pre>{$dbLink->error}</pre>";
        }
        @mysqli_close($dbLink);
    //}
}
else {
    echo 'Error! No ID was passed.';
}
?>

