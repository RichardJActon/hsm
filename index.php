<?php   include($_SERVER['DOCUMENT_ROOT']."./src/functions.php"); ?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>hsm</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/hsm.css">
	<!--<link rel="stylesheet" href="./bootstrap.min.css">-->
	<!-- jQuery library -->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
	<script src="./src/js/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
	<script src="./src/js/bootstrap.min.js"></script>
	<!--<script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.min.js"></script>-->
	<script src="./src/js/typeahead.bundle.min.js"></script>
	<!--<script src="./js/typeahead.js"></script>-->
	<script src="./src/js/search.js"></script>
</head>

<body>

<?php 
get_nav(); 
$searchTerm = "";
$posSearch = ""; 
?>

<div class="container-fluid" style="margin-top: 7em">

	<div class="row-fluid"  style="text-align: center;">
		<h1>Search</h1>
	</div>

	<div class="row-fluid" style="text-align: center;padding-top:2em">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="btn-group">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					Search &nbsp;<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a id="SNP-btn">SNP</a></li>
					<li><a id="gene-btn">Gene</a></li>
					<li><a id="GWAS-btn">GWAS Disease/Phenotype</a></li>
					<li><a id="coord-btn">Genomic Coordinates</a></li>
				</ul>&nbsp;
			</div>
		</div>
	</div>

	<div class="row-fluid" style="text-align:center; padding-top:4em">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="row-fluid" id="searchDiv">
				<form id="searchForm" class="form-horizontal content" method="get" action="result.php?searchTerm">
					<div class="form-group">
						<div>
							<label id="searchLabel" class="sr-only" for="searchInput"></label>
							<input id="searchInput" type="text" class="form-control typeahead" name="searchTerm" placeholder="e.g. rs6025"></input>
							<div class="hidden-submit"><input type="submit" tabindex="-1"/></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
			<p>Search based on SNP (rs IDs), Gene names, GWAS disease/phenotype or genomic coordinates.</p>
		</div>
	</div>
	
</div>

</body>

<?php get_footer(); ?>

</html>
