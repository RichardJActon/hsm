<?php   include($_SERVER['DOCUMENT_ROOT']."/hsm/src/functions.php"); ?>
<!DOCTYPE html>

<?php get_header(); ?>

<script src="./src/js/search.js"></script>

<?php get_nav_search(); ?>

<body>

<?php
	/*check for presence of annotation string*/
	if (strlen($_GET['annotation'])<1) 
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> Missing Association.</div>");
	}
	$params = $_GET[['annotation']];

	/*get number of results per page if present, set to default if not*/
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
?>

<?php 
	/*get total number of results*/
	$serverName = "localhost";
	$userName = "webuser";
	$password = "webuser";
	$database = "hsm2";

	$conn = mysqli_connect($serverName, $userName, $password, $database);
	if(!$conn)
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> MYSQL connection failed: " . mysqli_connect_error()."</div>");
	}
	$Csql = 'SELECT COUNT(SNP) AS "count" FROM hsm2.annotationIDpairs WHERE annotation = "'.$_GET["annotation"].'"';
	//echo "<p>$Csql</p>";
	$result = $conn->query($Csql);
	$hitCount = $result->fetch_assoc();
	$hitCount = implode($hitCount);
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

	$annotation = ""; 

 	/*pagination links generation*/
	$base = "?annotation=".$_GET['annotation'];
	$Lhtml = createLinks(7,"pagination",$limit,$hitCount,$page,$base);

	/*get title html*/
	$Thtml = get_title($_GET['annotation'],$hitCount,"annotation","&limit=10&page=1");

	/*get results list*/
	$sql = 'SELECT SNP.SNP,SNP.chr AS "SNP.chr",SNP.start AS "SNP.start",SNP.stop AS "SNP.stop",LD_Block.chr AS "ld.chr",LD_Block.start AS "ld.start",LD_Block.stop AS "ld.stop"  FROM SNP,RefSNPpairs,LD_Block,annotationIDpairs WHERE annotationIDpairs.annotation ="' .$_GET["annotation"].'" AND RefSNPpairs.Ref_SNP=LD_Block.Ref_SNP AND RefSNPpairs.SNP = SNP.SNP AND annotationIDpairs.SNP=SNP.SNP ORDER BY length(SNP.chr),SNP.chr,SNP.start LIMIT '.$start.','.$limit;

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
