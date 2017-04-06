<?php   include("./src/functions.php"); ?>
<!DOCTYPE html>

<?php get_header(); ?>

<script src="./src/js/search.js"></script>

<?php get_nav_search(); ?>

<body>

<?php 
	/*check for presence of posSearch string*/
	//echo $_GET['posSearch'];
	if (preg_match("/chr\d+:\d+-\d+/i", $_GET['posSearch'])) 
	{
		/*Array of chr,start,stop from get array*/
		$pos = preg_split("[:|-]", $_GET['posSearch']);
	}
	else
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> Genomic coordinates missing or invalid. (/chr\d+:\d+-\d+/i)</div>");
	}
	//echo $_GET['limit'];

	/*get number of results per page if present, set to default if not*/
	$params = $_GET[['posSearch']];
	if (preg_match("/[1-9]+/", $_GET['limit']))//==FALSE 
	{
		//die("<div class='alert alert-danger'><strong>ERROR!</strong> Items per page limit missing or invalid.</div>");
		$params['limit'] = $_GET['limit'];
	}
	else
	{
		$params['limit'] = 10;
		//echo $params['limit'];
	}
	//echo $_GET['page'];

	/*get page number if present, set to default if not*/
	if (preg_match("/\d+/", $_GET['page'])) //==FALSE
	{
		$params['page'] = $_GET['page'];
		//die("<div class='alert alert-danger'><strong>ERROR!</strong> page number missing or invalid.</div>");
	}
	else
	{
		$params['page'] = 1;
		//echo $params['page'];
	}
	//$pos = preg_split("[:|-]", $_GET['posSearch']);
?>

<?php
	//$rpp = $_GET['rpp'];
	//echo "<h1> $rpp </h1>";

	//$params
	//$_GET = array_merge($_GET,array("limit" => "10", "page" => "1"));
	//$new_query_string = http_build_query($params);

	/*get total number of results*/
	$serverName = $databaseServer;
	$userName = $databaseUserName;
	$password = $databasePassword;
	$database = $databaseName;

	$conn = mysqli_connect($serverName, $userName, $password, $database);
	if(!$conn)
	{
		
		die("<div class='alert alert-danger'><strong>ERROR!</strong> posSearch MYSQL connection failed: " . mysqli_connect_error()."</div>");
	}
	$Csql = 'SELECT COUNT(SNP) AS "count" FROM epigenome.SNP WHERE chr = "'.$pos[0].'" AND start >= '.$pos[1].' AND stop <= '.$pos[2];
	//echo "<p>$Csql</p>";
	$result = $conn->query($Csql);
	$hitCount = $result->fetch_assoc();
	$hitCount = implode($hitCount);
	//echo "<p>$hitCount</p>";
	if ($hitCount < 1) 
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> No hits</div>");
	}

	/*set max number of results per page, page number and current starting results number*/
	$limit = $params['limit'];
	//echo "<p>$limit</p>";
	$page = $params['page'];
	//echo "<p>$page</p>";
	$start = ($page-1)*$limit;
	//$last = ceil($hitCount/$limit)

	/*pagination links generation*/
	$base = "?posSearch=".$_GET['posSearch'];
	$Lhtml = createLinks(7,"pagination",$limit,$hitCount,$page,$base);

	/*get title html*/
	$Thtml = get_title($_GET['posSearch'],$hitCount,"posSearch","&limit=10&page=1");

	/* Page specific MYSQL query definition */
	$sql = 'SELECT SNP.SNP,SNP.chr AS "SNP.chr",SNP.start AS "SNP.start",SNP.stop AS "SNP.stop",LD_Block.chr AS "ld.chr",LD_Block.start AS "ld.start",LD_Block.stop AS "ld.stop"  FROM SNP,RefSNPpairs,LD_Block WHERE SNP.chr = "'.$pos[0].'" AND SNP.start >= "'.$pos[1].'" AND SNP.stop <= "'.$pos[2].'" AND RefSNPpairs.Ref_SNP=LD_Block.Ref_SNP  AND RefSNPpairs.SNP = SNP.SNP ORDER BY length(SNP.chr),SNP.chr,SNP.start LIMIT '.$start.','.$limit;	
	//echo "<p>$sql</p>";	

	/* get results list*/	
	$array = get_list($sql,$start);

	/*print title with pagination links*/
	echo '
	<div class="container-fluid" style="padding-top: 1em; padding-bottom: 1em">
		<div class="row-fluid">';
			echo $Thtml;
			echo'
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">'.
			$Lhtml.
			'</div>
		</div>
	</div>';

	/*print results list*/
	echo $array['html'];

	/*print second instance of pagination links*/
	echo 
	'<div class="container-fluid" style="text-align: center; padding-bottom: 5em">
		<div class="row-fluid">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'.
			$Lhtml . 
			'</div>
		</div>
	</div>';

	mysqli_close($conn);
?>

</body>

</html>
