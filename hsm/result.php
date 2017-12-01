
<?php   include("./src/functions.php"); ?>
<!DOCTYPE html>

<?php get_header(); ?>

<body>

<script src="./src/js/search.js"></script>

<?php get_nav_search(); ?>

<?php
/*check for valid search term - optional | followed by gene name is a left over from a multitype search feature that is now removed. queries of the form "rs123|GENE" were accepted, "|GENE" was stripped and "rs123" submitted to the database.*/
	$pos;
	if (preg_match("/rs\d+(\|.+)?/",$_GET['searchTerm'])) 
	{
		$pos = preg_split("[\|]", $_GET['searchTerm']);
		if (preg_match("/rs\d+/",$pos[0])==FALSE) 
		{
			die("<div class='alert alert-danger'><strong>ERROR!</strong> SNP rs ID invalid.</div>");
		}
	}
	else
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> Search missing or invalid.</div>");
	}

	$dataset = "1DISC"; /*VALIDATE*/
	if (isset($_GET['dataset'])) 
	{
		$dataset = $_GET['dataset'];
	} 
	$dataDir = $dataset.'_graph_png';
?>

<?php $searchTerm = ""; ?>

<?php 
	/*Connect to database and check connection*/
	$conn = mysqli_connect($databaseServer, $databaseUserName, $databasePassword, $databaseName);
	if(!$conn)
	{
		die("<div class='alert alert-danger'><strong>ERROR!</strong> MYSQL connection failed: " . mysqli_connect_error()."</div>");
	}
	
	/*query to retrieve filenames, LD block info and position info for a SNP*/
	$sql = 'SELECT epigenome.files.1DISC_result_txt, epigenome.files.1DISC_graph_png, epigenome.files.1DISC_graph, epigenome.files.2FOLL_result_txt, epigenome.files.2FOLL_graph_png, epigenome.files.2FOLL_graph, epigenome.files.3REPL_result_txt, epigenome.files.3REPL_graph_png, epigenome.files.3REPL_graph, epigenome.files.vAll_result_txt, epigenome.files.vAll_graph_png, epigenome.files.vAll_graph, epigenome.SNP.SNP,epigenome.SNP.chr AS "SNP.chr",epigenome.SNP.start AS "SNP.start",epigenome.SNP.stop AS "SNP.stop",epigenome.LD_Block.chr AS "ld.chr",epigenome.LD_Block.start AS "ld.start",epigenome.LD_Block.stop AS "ld.stop" FROM epigenome.SNP,epigenome.RefSNPpairs,epigenome.LD_Block,files WHERE RefSNPpairs.SNP = "'. $pos[0] . '" AND RefSNPpairs.Ref_SNP=LD_Block.Ref_SNP AND RefSNPpairs.SNP = SNP.SNP AND files.SNP=SNP.SNP;';

	$result = $conn->query($sql);
	
	/*get result(s) for a SNP and generate html, including any associated genes and annotations*/
	$html = "";
	$LDcount = 0;
	while ($row = $result->fetch_assoc()) 
	{
	$LDcount++;
	$html .= '	
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="page-header">
					<h1><a href="./result.php?searchTerm=' .$row["SNP"]. '&dataset=' .$dataset. '">'.$row["SNP"]. '</a></h1>
					<p><strong>SNP at: ' . $row["SNP.chr"].':'.$row["SNP.start"].'-'.$row["SNP.stop"].'</strong></p>
					<p><strong>LD Block: </strong><a href="./posSearch.php?posSearch='.$row['ld.chr'] .':'. $row['ld.start'] .'-'.$row['ld.stop'].'&limit=10&page=1">'.$row['ld.chr'] .':'. $row['ld.start'] .'-'.$row['ld.stop'].'</a></p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding-top: 2em">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2 class="panel-title">
								<a data-toggle="collapse" href="#external">External Links</a>
							</h2>	
						</div>
						<div id="external" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="row-fluid">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
										<p><a href="https://www.ebi.ac.uk/gwas/search?query='.$row["SNP"].'" target="_blank">GWAS catalog</a></p>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
										<p><a href="https://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?searchType=adhoc_search&type=rs&rs='.$row["SNP"].'" target="_blank">dbSNP</a></p>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
										<p>
										<a href="http://genome.ucsc.edu/cgi-bin/hgTracks?db=hg19&position='.$row["ld.chr"].'%3A'.$row["ld.start"].'%2D'.$row["ld.stop"].'&hgt.customText=http://epigenome.soton.ac.uk/hsm/data/Supplementary_File1_mergeFinal_hsm.bed" target="_blank">UCSC Genome Browser</a>
										<!--<a href="http://genome.ucsc.edu/cgi-bin/hgTracks?db=hg19&lastVirtModeType=default&lastVirtModeExtraState=&virtModeType=default&virtMode=0&nonVirtPosition=&position='.$row["ld.chr"].'%3A'.$row["ld.start"].'%2D'.$row["ld.stop"].'&hgsid=585297645_jNjxavzCdnRaC0dDqxALXLho633r" target="_blank">UCSC Genome Browser</a>-->
										</p>
									</div>								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="padding-top: 2em">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
								<h2 class="panel-title">
									<a data-toggle="collapse" href="#download">Datasets</a>
								</h2>
						</div>
						<div id="download" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="container-fluid">
									<div class="row-fluid">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<p>Download data as .txt.gz or image (png or pdf)</p>
											<p>View Dataset (see <a href="./about.php">About</a> for details)</p>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
											<div class="btn-group">
												<!--<button type="button" class="btn btn-primary">Download <span class="glyphicon glyphicon-download"></span></button>-->
												<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
													Download <span class="glyphicon glyphicon-download"></span>&nbsp;<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" role="menu">
													<li><a href="./data/1DISC_result_txt/'.$row["SNP.chr"].'/'.$row["1DISC_result_txt"].'" download>1DISC Data</a></li>
													<li><a href="./data/1DISC_graph_png/'.$row["SNP.chr"].'/'.$row["1DISC_graph_png"].'" download>1DISC Graph (.png)</a></li>
													<li><a href="./data/1DISC_graph/'.$row["SNP.chr"].'/'.$row["1DISC_graph"].'" download> 1DISC Graph (.pdf)</a></li>
													<li><a href="./data/2FOLL_result_txt/'.$row["SNP.chr"].'/'.$row["2FOLL_result_txt"].'" download>2FOLL Data</a></li>
													<li><a href="./data/2FOLL_graph_png/'.$row["SNP.chr"].'/'.$row["2FOLL_graph_png"].'" download>2FOLL Graph (.png)</a></li>
													<li><a href="./data/2FOLL_graph/'.$row["SNP.chr"].'/'.$row["2FOLL_graph"].'" download>2FOLL Graph (.pdf)</a></li>
													<li><a href="./data/3REPL_result_txt/'.$row["SNP.chr"].'/'.$row["3REPL_result_txt"].'" download>3REPL Data</a></li>
													<li><a href="./data/3REPL_graph_png/'.$row["SNP.chr"].'/'.$row["3REPL_graph_png"].'" download>3REPL Graph (.png)</a></li>
													<li><a href="./data/3REPL_graph/'.$row["SNP.chr"].'/'.$row["3REPL_graph"].'" download>3REPL Graph (.pdf)</a></li>
													<li><a href="./data/vAll_result_txt/'.$row["SNP.chr"].'/'.$row["vAll_result_txt"].'" download>vAll Data</a></li>
													<li><a href="./data/vAll_graph_png/'.$row["SNP.chr"].'/'.$row["vAll_graph_png"].'" download>vAll Graph (.png)</a></li>
													<li><a href="./data/vAll_graph/'.$row["SNP.chr"].'/'.$row["vAll_graph"].'" download>vAll Graph (.pdf)</a></li>
													<li><a href="./img/hsm_legend.png" download>Legend</a></li>
													<li><a href="./img/hsm_legend_extended.png">Extended Legend</a></li>
												</ul>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
											<div class="btn-group">
												<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
													View <span class="caret"></span>
												</button>
												<ul class="dropdown-menu" role="menu">
													<li><a href="./result.php?searchTerm=' .$row["SNP"]. '&dataset=1DISC">1DISC Data</a></li>
													<li><a href="./result.php?searchTerm=' .$row["SNP"]. '&dataset=2FOLL">2FOLL Data</a></li>
													<li><a href="./result.php?searchTerm=' .$row["SNP"]. '&dataset=3REPL">3REPL Data</a></li>
													<li><a href="./result.php?searchTerm=' .$row["SNP"]. '&dataset=vAll">vAll Data</a></li>
												</ul>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="padding-bottom: 5em">	

				<div class="row-fluid">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title">
									<a data-toggle="collapse" href="#key">key</a>
								</h2>	
							</div>
							<div id="key" class="panel-collapse collapse in">
								<div class="panel-body">
									<a href="./img/hsm_legend_extended.png">
										<img src="./img/hsm_legend.png" style="width:60%" alt="key">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title">
									<a data-toggle="collapse" href="#GenesAndAnnotation">Genes and annotation</a>
								</h2>	
							</div>
							<div id="GenesAndAnnotation" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="row-fluid">
										<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
											<strong>Genes</strong><p>
												<ul>';
												$sqlGene = 'SELECT gene FROM epigenome.geneIDpairs WHERE geneIDpairs.SNP="'.$pos[0].'";';
												$resGene = $conn->query($sqlGene);
												while ($rowG = $resGene->fetch_assoc()) 
												{
													$html .= '<li><a href="./gene.php?gene=' . $rowG["gene"]. '&limit=10&page=1">'. $rowG["gene"].'</a></li>';
												};
											$html .='
											</ul></p>
										</div>
										<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
											<strong>GWAS disease/phenotype</strong><p>
											<ul>';
												$sqlAn = 'SELECT annotation FROM epigenome.annotationIDpairs WHERE annotationIDpairs.SNP="'.$pos[0].'";';
												$resAn = $conn->query($sqlAn);
												while ($rowA = $resAn->fetch_assoc()) 
												{
													$html .= '<li><a href="./annotation.php?annotation=' . $rowA["annotation"]. '&limit=10&page=1">'. $rowA["annotation"].'</a></li>';
												};
											$html .='
											</ul></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="padding-bottom: 5em">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2 class="panel-title">
								<a data-toggle="collapse" href="#manhattan">p-value by Position</a> <span class="badge">'.$dataset.'</span>
							</h2>	
						</div>
						<div id="manhattan" class="panel-collapse collapse in">
							<div class="panel-body">
								<a href="./data/'.$dataDir.'/'.$row["SNP.chr"].'/'. $row[$dataDir] .'">
									<img src="./data/'.$dataDir.'/'.$row["SNP.chr"].'/'. $row[$dataDir] .'" style="width:100%" alt="manhattan">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	';};

	/*Print a warning if a SNP returns more than 1 result*/
	if ($LDcount > 1) 
	{
		//$warning .= 
		echo '<div class="alert alert-warning">
			<strong>Warning!</strong> This SNP falls at the border of 2 LD blocks so both are displayed here.
		</div>';
	}
	echo $html;
?>

</body>

</html>
