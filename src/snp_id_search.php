<?php
	/*Search suggestion results for SNP rs ID based based searches*/
	/*connect to database, check connection and print error if fails*/
	include($_SERVER['DOCUMENT_ROOT']."/hsm/src/functions.php");
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
	//$sql = 'SELECT hsm2.SNP.SNP,hsm2.geneIDpairs.gene FROM hsm2.geneIDpairs,hsm2.SNP WHERE (hsm2.geneIDpairs.gene LIKE "%' . $_REQUEST['query'] . '%" OR hsm2.SNP.SNP LIKE "%' . $_REQUEST['query'] . '%") AND hsm2.SNP.SNP=hsm2.geneIDpairs.SNP;';
	$sql = 'SELECT hsm2.SNP.SNP FROM hsm2.SNP WHERE hsm2.SNP.SNP LIKE "%' . $_REQUEST['query'] . '%"';
	
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
				'label' => $row['SNP'],
				'value' => $row['SNP'],//. '|'.$row['gene'],
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
