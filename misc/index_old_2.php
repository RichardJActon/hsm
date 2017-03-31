<?php   include($_SERVER['DOCUMENT_ROOT']."/hsm/functions.php"); ?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>hsm</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="./bootstrap.min.css">-->
	<!-- jQuery library -->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
	<script src="./js/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
	<script src="./js/bootstrap.min.js"></script>
	<!-- -->
	<!--<script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.min.js"></script>-->
	<script src="./js/typeahead.bundle.min.js"></script>
	<!-- 
	<script src="./js/typeahead.js"></script>
	-->
	<script>
    /*    $(document).ready(function() 
        {
            $('input.searchTerm').typeahead({
                name: 'value',
                display: 'label',
                remote:'snp_id_search.php?query=%QUERY'
            });
        })*/
    </script>
    <!-- -->
    <script type="text/javascript">
    	$(document).ready(function()
    	{
			var SNPs = new Bloodhound(
			{
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				remote: 
				{
					url: 'snp_id_search.php?query=%QUERY',
					wildcard: '%QUERY'
				}
			});
			$('#SNPinput .typeahead').typeahead(null,
			{
				name:'SNPs',
				display: 'value',
				source: SNPs
			});
//
			var Genes = new Bloodhound(
			{
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				remote: 
				{
					url: 'gene_search.php?query=%QUERY',
					wildcard: '%QUERY'
				}
			});
			$('#geneInput .typeahead').typeahead(null,
			{
				name:'Genes',
				display: 'value',
				source: Genes
			});
//
			var Annotation = new Bloodhound(
			{
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				remote: 
				{
					url: 'GWASsearch.php?query=%QUERY',
					wildcard: '%QUERY'
				}
			});
			$('#GWASinput .typeahead').typeahead(null,
			{
				name:'Annotation',
				display: 'value',
				source: Annotation
			});
//
			var Coords = new Bloodhound(
			{
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				remote: 
				{
					url: 'CoordSearch.php?query=%QUERY',
					wildcard: '%QUERY'
				}
			});
			$('#coordsInput .typeahead').typeahead(null,
			{
				name:'Coords',
				display: 'value',
				source: Coords
			});
		});
    </script>
    <!-- -->
	<style> 
		body
		{
			padding-top: 4em;
		}
		.content {
            text-align: center;
            width: 100%;
        }

        .tt-hint,
        .typeahead {
        	text-align: left;
            border: 2px solid #CCCCCC;
            border-radius: 8px 8px 8px 8px;
            font-size: 24px;
            height: 45px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 400px;
        }

        .tt-menu {
        	text-align: left;
            width: 400px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        } 
        .tt-cursor {
            background-color: lightblue;
        }
	</style> 
</head>

<body>
<!-- "-inverse" -->
<?php get_nav(); ?>

<?php $searchTerm = "";
$posSearch = ""; 
?>

<script type="text/javascript">
	$(document).ready(function() 
	{
  		$('.submit_on_enter').keyup(function(event) 
  		{
    		// enter has keyCode = 13, change it if you want to use another button
    		if (event.keyCode == 13) 
    		{
      			this.form.submit();
      			return false;
    		}
  		});
	});


/*
document.getElementsByClass(".submit_on_enter").addEventListener("keydown", function(e) {
    if (!e) { var e = window.event; }
    e.preventDefault(); // sometimes useful

    // Enter is pressed
    if (e.keyCode == 13) { submitFunction(); }
}, false);
*/

</script>

<div class="container-fluid" style="margin-top: 7em">
	<div class="row-fluid"  style="text-align: center;">
	<h1>Search</h1>
	</div>
	<div class="row-fluid" style="text-align: center;">
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				Search &nbsp;<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><a data-toggle="collapse" data-parent="#accordion" href="#SNP">SNP</a></li>
				<li><a data-toggle="collapse" data-parent="#accordion" href="#Gene">Gene</a></li>
				<li><a data-toggle="collapse" data-parent="#accordion" href="#GWASassociation">GWAS Disease/Phenotype</a></li>
				<li><a data-toggle="collapse" data-parent="#accordion" href="#posSearchCollapse">Genomic Coordinates</a></li>
			</ul>
		</div>
	</div>
	<div class="row-fluid" id="accordion">
		<div class="panel" style="border:0; box-shadow: 0 0 0">
			<div class="row-fluid collapse in" id="SNP">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<form class="form-horizontal content" method="get" action="result.php?searchTerm">
						<div class="form-group">
							<div id="SNPinput">
								<label class="sr-only" for="SNPinput">SNP search:</label>
								<input type="text" class="submit_on_enter form-control typeahead" name="searchTerm" placeholder="e.g. rs10127775"></input> <!-- class searchTerm , id searchTerm-->
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row-fluid collapse" id="Gene"">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<form class="form-horizontal content" method="get" action="gene.php?gene">
						<div class="form-group">
							<div id="geneInput">
								<label class="sr-only" for="geneInput">Gene Search:</label>
								<input type="text" class="submit_on_enter form-control typeahead" name="gene" placeholder="e.g. TERT"></input>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row-fluid collapse" id="GWASassociation">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<form class="form-horizontal content" method="get" action="annotation.php?annotation">
						<div class="form-group">
							<div id="GWASinput">
								<label class="sr-only" for="GWASinput">GWAS association search:</label>
								<input type="text" class="submit_on_enter form-control typeahead" name="annotation" placeholder="e.g. obesity"></input>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row-fluid collapse" id="posSearchCollapse">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<form class="form-horizontal content" method="get" action="posSearch.php?posSearch">
						<div class="form-group">
							<div id="coordsInput">
								<label class="sr-only" for="coordsInput">GWAS Disease/Phenotype search:</label>
								<input type="text" class="submit_on_enter form-control typeahead" name="posSearch" placeholder="e.g. chr1:1000:2000"></input>
								<input type="hidden" class="submit_on_enter form-control" name="limit" value=10 ></input>
								<input type="hidden" class="submit_on_enter form-control" name="page" value=1 ></input>
							</div>
						</div>
					</form>
				</div>
				<!--
				<form class="form-horizontal" method="get" action="posSearch.php?posSearch">
				<label class="sr-only" for="searchTerm">Chromosomal Coordinates Search</label>
				<p><input type="text" class="submit_on_enter form-control" id = "posSearch" name="posSearch" placeholder="e.g. chr1:1000:2000"></input>
				<input type="hidden" class="submit_on_enter form-control" name="limit" value=10 ></input>
				<input type="hidden" class="submit_on_enter form-control" name="page" value=1 ></input>
				</p>
				</form>
				-->
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
			<p>Search based on SNP (rs IDs), Gene names, GWAS disease/phenotype or genomic coordinates.</p>
			<!--<a href="./randResult.php" role="button" class="btn btn-primary">Example</a>-->
			<!--<div id="remote">
  				<input class="typeahead" type="text" placeholder="Oscar winners for Best Picture">
			</div>-->
		</div>
	</div>
	
</div>


</body>

<?php get_footer(); ?>
</html>