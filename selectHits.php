<?php   include($_SERVER['DOCUMENT_ROOT']."/hsm/src/functions.php"); ?>
<!DOCTYPE html>

<?php get_header(); ?>

<script src="./src/js/search.js"></script>

<?php get_nav_search(); ?>

<body>

<?php
	/*get number of results per page*/
	if (preg_match("/[1-9]+/", $_GET['limit'])==FALSE) 
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> Items per page limit missing or invalid.</div>");
	}
	//echo $_GET['page'];
	/*get page number*/
	if (preg_match("/\d+/", $_GET['page'])==FALSE) 
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> page number missing or invalid.</div>");
	}
?>

<?php
	/*get total number of results*/
	$serverName = $databaseServer;
	$userName = $databaseUserName;
	$password = $databasePassword;
	$database = $databaseName;
	
	$conn = mysqli_connect($serverName, $userName, $password, $database);
	if(!$conn)
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> MYSQL connection failed: " . mysqli_connect_error()."</div>");
	}

	$Csql = 'SELECT COUNT(SNP) AS "count" FROM hsm2.SNP WHERE SNP IN("rs7531118","rs1516725","rs180242","rs2388896","rs6469804","rs4147929","rs10499194","rs3129934","rs2248359","rs17356907","rs2823093","rs3802842","rs45430","rs4775302")';
	//echo "<p>$Csql</p>";
	$result = $conn->query($Csql);
	$hitCount = $result->fetch_assoc();
	$hitCount = implode($hitCount);

	/*set max number of results per page, page number and current starting results number*/
	$limit = $_GET['limit'];
	//echo "<p>$limit</p>";
	$page = $_GET['page'];
	//echo "<p>$page</p>";
	$start = ($page-1)*$limit;

	/*pagination links generation*/
	$base = "?selectHits=".$_GET['selectHits'];
	$Lhtml = createLinks(7,"pagination",$limit,$hitCount,$page,$base);

	/*specify title html*/
	$Thtml = ' 
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="page-header">
			<h1><a href="./selectHits.php?limit=10&page=1">Selected hits</a></h1>
			<p><span class = "label label-primary"> hits &nbsp'.
			$hitCount.
			'</span></p>
		</div>
	</div>';

	/* Page specific MYSQL query definition */
	$sql = 'SELECT SNP.SNP,SNP.chr AS "SNP.chr",SNP.start AS "SNP.start",SNP.stop AS "SNP.stop",LD_Block.chr AS "ld.chr",LD_Block.start AS "ld.start",LD_Block.stop AS "ld.stop"  FROM SNP,RefSNPpairs,LD_Block WHERE RefSNPpairs.SNP IN("rs7531118","rs1516725","rs180242","rs2388896","rs6469804","rs4147929","rs10499194","rs3129934","rs2248359","rs17356907","rs2823093","rs3802842","rs45430","rs4775302") AND RefSNPpairs.Ref_SNP=LD_Block.Ref_SNP  AND RefSNPpairs.SNP = SNP.SNP ORDER BY length(SNP.chr),SNP.chr,SNP.start LIMIT '.$start.','.$limit;

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

<?php get_footer(); ?>

</html>
