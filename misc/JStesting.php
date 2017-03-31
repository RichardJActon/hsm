<?php   include($_SERVER['DOCUMENT_ROOT']."/hsm/functions.php"); ?>
<!DOCTYPE html>
<?php get_header(); ?>
<?php// get_nav(); ?>
<body>
<script src="./search.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		var currentSearchType = "";
		var searchTypes = 
		{
			"SNP":
			{
				"id":"#SNP",
				"actionURL":"result.php?searchTerm",
				"btnID":"#SNP-btn",
				"name":"result",
				"placeholder":"e.g. rs6025",
				"label":"SNP search",
				"searchURL":"snp_id_search.php?query"
			},
			"gene":
			{
				"id":"#gene",
				"actionURL":"gene.php?gene",
				"btnID":"#gene-btn",
				"name":"gene",
				"placeholder":"e.g. TERT",
				"label":"Gene search",
				"searchURL":"gene_search.php?query"
			},
			"GWAS":
			{
				"id":"#GWAS",
				"actionURL":"annotation.php?annotation",
				"btnID":"#GWAS-btn",
				"name":"annotation",
				"placeholder":"e.g. obesity",
				"label":"GWAS disease/phenotype search",
				"searchURL":"GWASsearch.php?query"
			},
			"coord":
			{
				"id":"#coord",
				"actionURL":"posSearch.php?posSearch",
				"btnID":"#coord-btn",
				"name":"posSearch",
				"placeholder":"e.g. chr1:1000:2000",
				"label":"Genomic coordinates search",
				"searchURL":"CoordSearch.php?query"
			}
		};
		
		function Search($actionURL){
			var Suggestions = new Bloodhound(
			{
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				remote: 
				{
					url: $actionURL + '=%QUERY',
					wildcard: '%QUERY'
				}
			});
			$('#searchForm .typeahead').typeahead(null,
			{
				name:'Suggestions',
				display: 'value',
				source: Suggestions
			});
		}

/*		//for (var i = 0; i < Object.keys(searchTypes).length; i++) 
		$.each(searchTypes, function(key, value)
		{
			//console.log(searchTypes[key].btnID);
			$(searchTypes[key].btnID).click(function()
			{
				//if (searchTypes.SNP.btnID ===)
				$("#searchForm").attr("action",searchTypes[key].actionURL);
				$("#searchLabel").attr("html",searchTypes[key].label);
				$("#searchInput").attr("name",searchTypes[key].name);
				$("#searchInput").attr("placeholder",searchTypes[key].placeholder);
				Search(searchTypes[key].searchURL);
			});
			
			//if (currentSearchType === searchTypes[key])
			//{

			//}
		});*/

/*		$("#SNP-btn").click(function()
		{
			$("#searchForm").attr("action","result.php?searchTerm");
			$("#searchLabel").attr("html","SNP search");
			$("#searchInput").attr("name","result");
			$("#searchInput").attr("placeholder","e.g. rs6025");
			Search("snp_id_search.php?query");
		});
*/

		var searchDiv = '<form id="searchForm" class="form-horizontal content" method="get" action="%action%"><div class="form-group"><div><label id="searchLabel" class="sr-only" for="searchInput">%label%</label><input id="searchInput" type="text" class="submit_on_enter form-control typeahead" name="%name%" placeholder="%placeholder%"></input><div class="hidden-submit"><input type="submit" tabindex="-1"/></div></div></div></form>'
		//<input type="submit hidden" value="Submit">

	/*		
		function searchSet($key)
		{
			//if (searchTypes.SNP.btnID ===)
			$("#searchForm").attr("action",searchTypes[$key].actionURL);
			$("#searchLabel").attr("html",searchTypes[$key].label);
			$("#searchInput").attr("name",searchTypes[$key].name);
			$("#searchInput").attr("placeholder",searchTypes[$key].placeholder);
			$("#searchInput").val("")	;
			Search(searchTypes[$key].searchURL);
		};
		$(searchTypes.SNP.btnID).click(function(){searchSet("SNP");});
		$(searchTypes.gene.btnID).click(function(){searchSet("gene");});
		$(searchTypes.GWAS.btnID).click(function(){searchSet("GWAS");});
		$(searchTypes.coord.btnID).click(function(){searchSet("coord");});
	*/
		function searchSet($key)
		{
			//if (searchTypes.SNP.btnID ===)
			var tmp = searchDiv.replace("%action%",searchTypes[$key].actionURL);
			tmp = tmp.replace("%label%",searchTypes[$key].label);
			tmp = tmp.replace("%name%",searchTypes[$key].name);
			tmp = tmp.replace("%placeholder%",searchTypes[$key].placeholder);
			$("#searchDiv").empty();
			$("#searchDiv").append(tmp);
			Search(searchTypes[$key].searchURL);
		};
		
		searchSet("SNP");
		
		$(searchTypes.SNP.btnID).click(function(){searchSet("SNP");});
		$(searchTypes.gene.btnID).click(function(){searchSet("gene");});
		$(searchTypes.GWAS.btnID).click(function(){searchSet("GWAS");});
		$(searchTypes.coord.btnID).click(function(){searchSet("coord");});

	});
</script>

<div class="container-fluid">
	<div class="row-fluid">
		<nav class="navbar navbar-default navbar-fixed-top"> <!-- "-inverse" -->
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		 				<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
					<a class="navbar-brand" href="./index.php">Haplotype-Specific DNA Methylation</a>
				</div>

				<div class="navbar-form navbar-left">
					<div class="btn-group">
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							Search &nbsp;<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a id="SNP-btn">SNP</a></li>
							<li><a id="gene-btn">Gene</a></li>
							<li><a id="GWAS-btn">GWAS Disease/Phenotype</a></li>
							<li><a id="coord-btn">Genomic Coordinates</a></li>
						</ul>
					</div>
				</div>

				<div class="navbar-form navbar-left" id="searchDiv">
					<form id="searchForm" class="form-horizontal content" method="get" action="result.php?searchTerm">
						<div class="form-group">
							<div>
								<label id="searchLabel" class="sr-only" for="searchInput"></label>
								<input id="searchInput" type="text" class="submit_on_enter form-control typeahead" name="searchTerm" placeholder="e.g. rs6025"></input>
								<div class="hidden-submit"><input type="submit" tabindex="-1"/></div>
								<!--<input type="submit" value="Submit">-->
							</div>
						</div>
					</form>
				</div>

<!-- 				<div class="navbar-form navbar-left">
					<input type="submit" value="Submit">
				</div> -->
				
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="./randResult.php">Random</a></li>
						<li><a href="./selectHits.php?limit=10&page=1">Selected Hits</a></li>
						<li><a href="./about.php">About</a></li>
						<li><a href="./downloads.php">Downloads</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</div>


<script type="text/javascript">
		/*$('#searchInput').keydown(function (event) {
			var keypressed = event.keyCode || event.which;
			if (keypressed == 13) {
				//document.forms.submit();
				form.submit();
				//$("#searchForm")[0].submit();
			}
		});*/
	/*	$('.submit_on_enter').keyup(function(event) 
		{
			// enter has keyCode = 13, change it if you want to use another button
			if (event.keyCode == 13) 
			{
				form.submit(); //this.for...
				//$("#searchForm").form.submit();
				return false;
			}
		});*/
</script>

<?php get_footer(); ?>
</body>
</html>