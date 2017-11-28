<?php   include("./src/functions.php"); ?>
<!DOCTYPE html>

<?php get_header(); ?>

<script src="./src/js/search.js"></script>

<?php get_nav_search(); ?>

<?php 
	$typecheck = valid_download_type($_GET["type"]);
	if (!$typecheck['bool'])
	{
		die($typecheck['str']);
	}

	$type = $_GET["type"];
	$dwn = get_download_file($_GET["type"]);
	$sql = $dwn['sql'];
	$title = $dwn['title'];

?>

<body>

<div class="container-fluid">
	<div class="row-fluid">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="page-header">
				<h1><?php echo '<a href="download.php?type='.$type.'">'.$title.'</a>';?></h1>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php get_downloads($sql,$type); ?>
		</div>
		
	</div>
</div>

</body>

</html>
