<?php 
	include("./src/functions.php");
	/*Connect to database and check connection*/
	$serverName = $databaseServer;
	$userName = $databaseUserName;
	$password = $databasePassword;
	$database = $databaseName;

	$conn = mysqli_connect($serverName, $userName, $password, $database);
	if(!$conn)
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> MYSQL connection failed: " . mysqli_connect_error()."</div>");
	}
	
	/*select random SNP from the database*/
	$sql1 = 'SELECT SNP from epigenome.SNP ORDER BY RAND() LIMIT 1;';
	$result1 = $conn->query($sql1);
	$row1 = $result1->fetch_assoc();

	header("Location: ./result.php?searchTerm=".$row1['SNP']); /*1DISC?*/
	mysqli_close($conn);
	exit;
?>
