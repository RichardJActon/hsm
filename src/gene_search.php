<?php
	/*Search suggestion results for gene name based searches*/
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

	/*get gene name search suggestions*/
	$sql = 'SELECT geneIDpairs.gene FROM hsm2.geneIDpairs WHERE geneIDpairs.gene LIKE "%' . $_REQUEST['query'] . '%" GROUP BY gene';
	
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
				'label' => $row['gene'],
				'value' => $row['gene'],
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
