<?php
	/*Search suggestion results for GWAS associations based searches*/
	/*connect to database, check connection and print error if fails*/
	include("./functions.php");
	$serverName = $databaseServer;
	$userName = $databaseUserName;
	$password = $databasePassword;
	$database = $databaseName;

	$conn = mysqli_connect($serverName, $userName, $password, $database);
	if(!$conn)
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> MYSQL connection failed: " . mysqli_connect_error()."</div>");
	}

	/*get GWAS association search suggestions*/
	$sql = 'SELECT annotationIDpairs.annotation FROM hsm2.annotationIDpairs WHERE annotationIDpairs.annotation LIKE "%'.$_REQUEST['query'].'%" GROUP BY annotation';
	
	$result = $conn->query($sql);
	
	$array = array();
	$num_rows = $result->num_rows; /*get to home for result count indicator*/
	/*check if there are any results*/
	if ($result->num_rows > 0)
	{
		/*generate JSON from results*/
		while($row = $result->fetch_assoc())
		{
			$array[] = array (
				'label' => $row['annotation'],
				'value' => $row['annotation'],
			);
		}
		echo json_encode ($array);
	}
	else
	{
		echo "0 results";
	}
	mysqli_close($conn);
?>
