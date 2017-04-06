<?php   include("./src/functions.php"); ?>
<!DOCTYPE html>

<?php get_header(); ?>

<script src="./src/js/search.js"></script>

<?php get_nav_search(); ?>

<body>

<div class="container-fluid">
	<div class="row-fluid">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="page-header">
				<h1>Downloads</h1>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<ul>
				<li><a href="download.php?type=dataFiles">All Data files - by SNP</a></li>
				<!--<li><a href="./data/dataFilesChr/">All Data files - by Chromosome</a></li>-->
				<li><a href="download.php?type=pValPosGraphs">p-Value Graphs (.png) - by SNP</a></li>
				<li><a href="download.php?type=pValGraphs_pdf">p-Value Graphs (.pdf) - by SNP</a></li>
			</ul>
		</div>
		
	</div>
</div>

</body>

</html>
