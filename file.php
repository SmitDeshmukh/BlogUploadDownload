<?php

if(isset($_POST['submit'])&&!empty($_FILES['uploaded_file']))
{

if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        // Connect to the database
       include 'Connection.php';
            
        $title = $_POST['title'];
        $desc  = $_POST['desc'];
        //echo "$";
        $name = $dbLink->real_escape_string($_FILES['uploaded_file']['name']);
        $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
       
                 $table="BlogTable";
               
                    $create_table="create table if not exists ".$table."(name varchar(255) not null,description varchar(255) not null,file_name varchar(255) not null ,mime varchar(50) not null,size BigInt unsigned not null default 0,data mediumblob not null,created Datetime not null);";
    
                      $created=mysqli_query($dbLink,$create_table);
                  
                  if($created)
                  {   
                    $ifExists="SELECT * from ".$table." WHERE file_name='".$name."'";
                    $num_rec=mysqli_query($dbLink,$ifExists);
                    $numOfExistingRecord=mysqli_num_rows($num_rec);
                    if($numOfExistingRecord==0)
                    {
                      

                     $query = "INSERT INTO ".$table." (name,description,file_name,mime,size,data,created) VALUES ('{$title}','{$desc}','{$name}','{$mime}','{$size}','{$data}',NOW())";
                   
 
                // Execute the query
                    $result=mysqli_query($dbLink,$query);
                  //  echo "Done!";
    
                 // Check if it was successfull
                         if($result) {
                                                    ?>
              <script type="text/javascript">
                alert("Your file was successfully added!")
              </script>
              <?php
                                 //echo 'Success! Your file was successfully added!';
                         }
                        else {
                                echo 'Error! Failed to insert the file'
                                . "<pre>{$dbLink->error}</pre>";
                            }
                             }
                  else{
                        ?>
              <script type="text/javascript">
                alert("You have already Submiteed this assignmnet!")
              </script>
              <?php

                      //  echo "You have already Submiteed this assignmnet!";   
                  }
                }
                      else {
                                echo 'An error occured while the file was being uploaded. '
                                . 'Error code: '. intval($_FILES['uploaded_file']['error']);
                    }

 
                // Close the mysql connection
               $dbLink->close();
            }

            else {
              echo 'Error! A file was not sent!';
            }
}}

            echo '<p>Click <a href="#">here</a> to go back</p>';
?>
                 
                    
                 