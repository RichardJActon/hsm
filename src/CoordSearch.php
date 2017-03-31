<?php
	/*Search suggestion results for coordinates based searches*/
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

	/*process coords query into chr, start and stop*/
	$array = preg_split("/[:|-]/", $_REQUEST['query']);

	/*get positions of LD blocks to suggest as coordinates based searches*/
	$sql = 'SELECT hsm2.LD_Block.chr, hsm2.LD_Block.start, hsm2.LD_Block.stop FROM hsm2.LD_Block WHERE (hsm2.LD_Block.chr LIKE "%' . $array[0] . '%" AND hsm2.LD_Block.start LIKE "%' . $array[1] . '%" AND hsm2.LD_Block.stop LIKE "%' . $array[2] . '%")';

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
				'label' => $row['chr'] . ":" . $row['start']. "-" . $row['stop'],
				'value' => $row['chr'] . ":" . $row['start']. "-" . $row['stop'],
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
