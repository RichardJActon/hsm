<?php 

/*# functions.php*/
$databaseServer = "srv01779.soton.ac.uk:3306";
$databaseName = "epigenome";
$databaseUserName = "epigenome_ro";
$databasePassword = "3dfa315f63c477d4f2f68bac84eaa7e7f135da26";
/*## `get_header()` function
### Args
- none

### Returns
- none directly
- prints a string of HTML when called - wrapped in a `<head></head>` tag.

### Description
- Sets the page title to 'hsm'
- Calls the generic dependencies of the pages:
  - dependency of bootstrap and for other interactivity
    - jQuery (v3.1.1) - local copy
  - for page styling:
    - bootstrap.css (v3.3.7) - from remote as glyphicons do not work with a local version.
    - bootstrap.js (3.3.7) - local copy
    - hsm.css stylesheet - local stylesheet with modifications/additions to standard bootstrap
  - for search suggestions:
    - typeahead.js - local copy
*/
function get_header()
{
	echo '
	<head>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>hsm</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/hsm.css">
		<!--<link rel="stylesheet" href="./css/bootstrap.min.css">-->
		<!-- jQuery library -->
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
		<script src="./src/js/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
		<script src="./src/js/bootstrap.min.js"></script>
		<!--<script src="./src/js/typeahead.js"></script>-->
		<script src="./src/js/typeahead.bundle.min.js"></script>
	</head>
	<style type="text/css">
		@media (max-width: 1136px) 
		{
			.navbar-header 
		    {
				float: none;
			}
			.navbar-left,.navbar-right 
		    {
				float: none !important;
			}
			.navbar-toggle 
		    {
				display: block;
			}
			.navbar-collapse 
		    {
				border-top: 1px solid transparent;
				box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
			}
			.navbar-fixed-top 
		    {
				top: 0;
				border-width: 0 0 1px;
			}
			.navbar-collapse.collapse 
		    {
				display: none!important;
			}
			.navbar-nav 
		    {
				float: none!important;
				margin-top: 7.5px;
			}
			.navbar-nav>li 
		    {
				float: none;
			}
			.navbar-nav>li>a 
		    {
				padding-top: 10px;
				padding-bottom: 10px;
			}
			.collapse.in
		    {
				display:block !important;
			}
		}
	</style>

	';
}

/*## `get_footer()` function
### Args
- none;

### Returns
- none directly
- prints a string of HTML when called - wrapped in a `<footer></footer>` tag.

### Description
generates the page footer.
*/
function get_footer()
{
	echo '
	<footer class="page-footer">
		<div class="navbar navbar-default navbar-fixed-bottom">
			<p class="text-center">University of Southampton <a href="#">DOI:</a>
			&nbsp
			Website created by <a href="http://orcid.org/0000-0002-2574-9611" target="_blank">Richard J. Acton</a></p>
		</div>
	</footer>
	';
}

/*## `get_nav_search()` function
### Args
- none;

### Returns
- none directly
- prints a string of HTML when called.

### Description
generates a navbar with a search bar.

### Dependencies
needs the search.js script to be called on any page using it.
`<script src="./src/js/search.js"></script>`
(see the search.js documentation for its dependencies.)
*/
function get_nav_search()
{
echo '
<div class="container-fluid">
	<div class="row-fluid">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		 				<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
					<a class="navbar-brand" href="./hsm.php">Haplotype-Specific DNA Methylation</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
				<div class="navbar-form navbar-left" id="searchDiv">
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

';
}

/*## `get_nav()` function
### Args
- none;

### Returns
- none directly
- prints a string of HTML when called.

### Description
generates a navbar WITHOUT a search bar.

*/
function get_nav()
{
echo '
<div class="container-fluid">
	<div class="row-fluid">
		<nav class="navbar navbar-default navbar-fixed-top"> 
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		 				<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
					<a class="navbar-brand" href="./hsm.php">Haplotype-Specific DNA Methylation</a>
				</div>
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
';
}

/*## `get_list()` function
### Args
- $sqli: MYSQL query as string.
- $start: start position - integer (query result number from which to start page)

### Returns
- $array: an array containing:
  - a string of html `html`: the HTML generated to list the results of the search from `$start`
  - an integer `hitCount`: `$start` plus the number of new entries added

### Description
generates the html for search multiple results, starting from a set result number and also returning the number of results returned added to the starting number.

NB uses a MYSQL connection (makes 2 requests per initial result from an initial request)

*/
function get_list($sqli,$start)
{
	$databaseServer = "srv01779.soton.ac.uk:3306";
	$databaseName = "epigenome";
	$databaseUserName = "epigenome_ro";
	$databasePassword = "3dfa315f63c477d4f2f68bac84eaa7e7f135da26";
	
	$serverName = $databaseServer;
	$userName = $databaseUserName;
	$password = $databasePassword;
	$database = $databaseName;

	$conn = mysqli_connect($serverName, $userName, $password, $database);
	if(!$conn)
	{
		//$html = "<div class='alert alert-danger'><strong>ERROR!</strong> MYSQL connection failed: " . mysqli_connect_error()."</div>";
		die("<div class='alert alert-danger'><strong>ERROR!</strong> get_list MYSQL connection failed: " . mysqli_connect_error()."</div>");
	}

	$sql = $sqli;
	$result = $conn->query($sql);
	$hitCount = $start;
	$html = "";
	while($row = $result->fetch_assoc())
	{
		$sqlGene = 'SELECT gene FROM epigenome.geneIDpairs WHERE geneIDpairs.SNP="'.$row["SNP"].'";';
		$resGene = $conn->query($sqlGene);
		$geneCount = 0;
		$Ghtml = "";
		while ($rowG = $resGene->fetch_assoc()) 
		{
			$Ghtml.= '<li><a href="./gene.php?gene=' . $rowG["gene"]. '&limit=10&page=1">'. $rowG["gene"].'</a></li>';
			$geneCount++;
		};

		$sqlAn = 'SELECT annotation FROM epigenome.annotationIDpairs WHERE annotationIDpairs.SNP="'.$row["SNP"].'";';
		$resAn = $conn->query($sqlAn);
		$annCount = 0;
		$Ahtml = "";
		while ($rowA = $resAn->fetch_assoc()) 
		{
			$Ahtml .= '<li><a href="./annotation.php?annotation=' . $rowA["annotation"]. '&limit=10&page=1">'. $rowA["annotation"].'</a></li>';
			$annCount++;
		};
		$hitCount++;
		$html .= '
		<div class="row-fluid">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">
							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">

									<span class="badge">'.$hitCount.'</span><span>&nbsp</span>
									<strong><a data-toggle="collapse" href="#' . $row['SNP'] . '">' . $row['SNP'] . '</a></strong>
									<span> &nbsp;' . $row['SNP.chr'] .':'. $row['SNP.start'] .'-'.$row['SNP.stop'] . ' </span>
								
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
									<span class="label label-primary">genes&nbsp'.$geneCount.'</span>
									<span class="label label-default">GWAS disease/phenotype&nbsp'.$annCount.'</span>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 col-xs-offset-6 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
									<a href="./result.php?searchTerm=' .$row["SNP"].'" class="btn btn-info btn-block" role="button">'. $row["SNP"] .'</a>
								</div>
							</div>
						</h2>
					</div>
					<div id="'. $row['SNP'].'" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<p><strong>LD Block:</strong>&nbsp; 
									<a href="posSearch.php?posSearch='.$row['ld.chr'] .':'. $row['ld.start'] .'-'.$row['ld.stop'].'&limit=10&page=1">'.$row['ld.chr'] .':'. $row['ld.start'] .'-'.$row['ld.stop'].'</a></p>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<p><strong>Genes:</strong>
										<ul>';

										$html .= $Ghtml;

										$html.='
										</ul>
										</p>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<p><strong>GWAS Disease/Phenotype:</strong>
										<ul>';

										$html .= $Ahtml;

										$html .= '
										</ul>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		';
	}
	mysqli_close($conn);
	$array = array(html => $html,hitCount => $hitCount);
	return $array;
}

/*## `get_title()` function
### Args
- $title: page title
- $hitCount: total number of hits
- $type: type of result for page name e.g. gene, annotation
- $get: GET key for results list page.

### Returns
- $Thtml: title html

### Description


*/
function get_title($title,$hitCount,$type,$get)
{
$title = $title;
$hitCount = $hitCount;
$type = $type;
$Thtml = '
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="page-header">
			<h1><a href="./'.$type.'.php?'.$type.'='. $title.$get.'">'.$title.'</a></h1>
			<p><span class = "label label-primary"> hits &nbsp'.
			$hitCount.
			'</span></p>
		</div>
	</div>';
	return $Thtml;
}

/*## `createLinks()` function
### Args
- $links: max number of links
- $list_class: pagination
- $limit: limit on results per page - for link
- $total: total number of results
- $page: current page number
- $base: base URL for links

### Returns
- $html: the html for the pagination links

### Dependencies
- bootstrap.css (v3.3.7) - from remote as glyphicons do not work with a local version.
- bootstrap.js (3.3.7) - local copy

### Description
Creates pagination links.
based on: https://code.tutsplus.com/tutorials/how-to-paginate-data-with-php--net-2928

*/
function createLinks($links,$list_class,$limit,$total,$page,$base)
{
	if ($limit == 'all') 
	{
		return '';
	}
	$last = ceil($total/$limit);
	$start = (($page - $links) > 0) ? $page - $links : 1;
	$end = (($page + $links) < $last) ? $page + $links : $last;
	$html = '<ul class="' . $list_class . '">';
	$class = ($page == 1) ? "disabled" : "";
	$html .= '<li class="' . $class . '"><a href="'.$base.'&limit=' . $limit . '&page=' . ($page -1) . '">&laquo;</a></li>';
	if ($start > 1) 
	{
		$html .= '<li><a href="'.$base.'&limit=' . $limit . '&page=1"></a></li>';
		$html .= '<li class="disabled"><span>...</span></li>';
	}
	for ($i=$start; $i <= $end; $i++) 
	{ 
		$class = ($page == $i) ? "active" : "";
		$html .= '<li class="' . $class . '"><a href="'.$base.'&limit=' . $limit . '&page=' . $i . '">' . $i . '</a></li>';
	}
	if ($end < $last) 
	{
		$html .= '<li class="disabled"><span>...</span></li>';
		$html .='<li><a href="'.$base.'&limit=' . $limit . '&page=' . $last  . '">' . $last . '</a></li>';
	}
	$class = ($page == $last) ? "disabled" : "";
	$html .= '<li class="' . $class . '"><a href="'.$base.'&limit=' . $limit . '&page=' . ($page + 1) . '">&raquo;</a></li>';
	$html .= '</ul>';
	return $html;
}

/*## `get_downloads()` function
### Args
- $sql: SQL query specific to download type
- $type: folder name - for use in URL

### Returns
- none directly
- prints a string of HTML when called.

### Description
generates unordered html list of link to files for download based on a sql query.

*/
function get_downloads($sql,$type)
{
	$databaseServer = "srv01779.soton.ac.uk:3306";
	$databaseName = "epigenome";
	$databaseUserName = "epigenome_ro";
	$databasePassword = "3dfa315f63c477d4f2f68bac84eaa7e7f135da26";

	$conn = mysqli_connect($databaseServer, $databaseUserName, $databasePassword, $databaseName);
	if(!$conn)
	{
		//$html = "<div class='alert alert-danger'><strong>ERROR!</strong> MYSQL connection failed: " . mysqli_connect_error()."</div>";
		die("<div class='alert alert-danger'><strong>ERROR!</strong> get_downloads() MYSQL connection failed: " . mysqli_connect_error()."</div>");
	}

	$Rhtml = "<ul>\n";
	$res = $conn->query($sql);
	while ($row = $res->fetch_assoc()) 
	{
		$Rhtml .= '	<li><a href="./data/'. $type .'/' . $row["file"].'"</a>'. $row["file"].'</li>'."\n";
	};
	$Rhtml .= "</ul>\n";
	echo $Rhtml;
}

/*## `valid_download_type()` function
### Args
- $type: folder name - for use in URL

### Returns
- $out array
	- 'bool' - Boolean - True = valid type, False = invalid type
	- 'str' - error string to print if false, empty string if true

### Description
Validates the download types given to the download.php page

*/
function valid_download_type($type)
{
	if ($type == ("1DISC_dataFile"||"1DISC_graph_png"||"1DISC_graph_pdf"||"2FOLL_dataFile"||"2FOLL_graph_png"||"2FOLL_graph_pdf"||"3REPL_dataFile"||"3REPL_graph_png"||"3REPL_graph_pdf"||"vALL_dataFile"||"vALL_graph_png"||"vALL_graph_pdf"))
	{
		$out['bool'] = True;
		$out['str'] = "";
		return $out;
	}
	else
	{
		$out['bool'] = False;
		$out['str'] = "<div class='alert alert-danger'><strong>ERROR!</strong> invalid download class - 1DISC_dataFile, 1DISC_graph_png, 1DISC_graph_pdf, 2FOLL_dataFile, 2FOLL_graph_png, 2FOLL_graph_pdf, 3REPL_dataFile, 3REPL_graph_png, 3REPL_graph_pdf, vALL_dataFile, vALL_graph_png, vALL_graph_pdf are valid download classes.</div>");
		return $out;
	}
}

/*## `get_download_file` function
### Args
- $type: folder name / data type - for use in SQL query

### Returns
- $out array
	- 'sql' - sql query to get all the relevant files
	- 'title' - title to give the page

### Description
gets the SQL query needed to retrieve the download page contents and the page title from the data type

*/
function get_download_file($type)
{
	$out['sql'] = "SELECT $type AS 'file' FROM files";
	$out['title'] = "Download $type";
	return $out;
}

?>
