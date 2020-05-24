<?php 
echo "</<!DOCTYPE html>
<html>
<head>
	<title>Retreive</title>
	
</head>
</html>";


$table="BlogTable";
$dbLink=new mysqli("127.0.0.1",'root','','project_2k19');
	if(mysqli_connect_errno())
	{
		die("mysqli Connection Failed: ".mysqli_connet_error());
	}
	$sql="SELECT * from ".$table;
	$result=$dbLink->query($sql);
	if($result)
	{
		if($result->num_rows==0)
		{
			echo "<p>There are no files files in database</p>";
		}
		else
		{
			
			while ($row=$result->fetch_assoc()) {
				echo "<p><h3><b>Title:</b>{$row['name']}</h3></p>
				<p><h4><b>Description:</b>{$row['description']}</h4></p>
				<p><h2><b><a href='download.php?file_name={$row['file_name']}'><button>Download</button></a></b></h2></p><br>";
			}
			
		}
		$result->free();
		
	}
	else
	{
		echo "Error! SQL query Failed!";
		echo "<pre>{$dbLink->error}</pre>";

	}
	$dbLink->close();

 ?>
  
 </html>
