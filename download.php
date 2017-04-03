<?php   include("./src/functions.php"); ?>
<!DOCTYPE html>

<?php get_header(); ?>

<script src="./src/js/search.js"></script>

<?php get_nav_search(); ?>

<?php 
	if ($_GET["type"] != ("dataFiles"||"pValPosGraphs"||"pValGraphs_pdf") )
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> invalid download class - dataFiles, pValPosGraphs or pValGraphs_pdf ar valid download classes.</div>");
	}
	$type = $_GET["type"];
	$sql = "";
	$title = "";
	if ($type == "dataFiles") 
	{
		$sql = 'SELECT dataFilename AS "file" FROM files';
		$title = "Download Datafiles - txt.gz";
	}
	elseif ($type == "pValPosGraphs") 
	{
		$sql = 'SELECT pValFilename AS "file" FROM files';
		$title = "Download PNGs";
	}
	else //($type == "pValGraphs_pdf") 
	{
		$sql = 'SELECT pValPDFfilename AS "file" FROM files';
		$title = "Download PDFs";
	}
?>

<body>

<div class="container-fluid">
	<div class="row-fluid">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="page-header">
				<h1><?php echo '<a href="download.php?'.$type.'">'.$title.'</a>';?></h1>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php get_downloads($sql,$type); ?>
		</div>
		
	</div>
</div>

</body>

<?php get_footer(); ?>

</html>
