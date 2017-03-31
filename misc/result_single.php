<?php   include($_SERVER['DOCUMENT_ROOT']."/hsm/src/functions.php"); ?>
<!DOCTYPE html>
<?php get_header(); ?>

<body>
<!-- nav -->
<?php get_nav_search(); ?>

<?php $searchTerm = ""; ?>

<?php 
	$serverName = "localhost";
	$userName = "webuser";
	$password = "webuser";
	$database = "hsm2";

	$conn = mysqli_connect($serverName, $userName, $password, $database);
	if(!$conn)
	{
		die("connection failed: " . mysqli_connect_error());
	}
?>

<?php 
	
	/*$sql = 'SELECT * FROM hsm.LD_Block WHERE id="'. $_GET["searchTerm"] .'";';*/

	$sql = 'SELECT hsm2.files.dataFilename, hsm2.files.pValFilename, hsm2.files.pValPDFfilename, hsm2.SNP.SNP,hsm2.SNP.chr AS "SNP.chr",hsm2.SNP.start AS "SNP.start",hsm2.SNP.stop AS "SNP.stop",hsm2.LD_Block.chr AS "ld.chr",hsm2.LD_Block.start AS "ld.start",hsm2.LD_Block.stop AS "ld.stop" FROM hsm2.SNP,hsm2.RefSNPpairs,hsm2.LD_Block,files WHERE hsm2.RefSNPpairs.SNP = "'. $_GET["searchTerm"] . '" AND hsm2.RefSNPpairs.Ref_SNP=hsm2.LD_Block.Ref_SNP AND hsm2.RefSNPpairs.SNP = hsm2.SNP.SNP AND hsm2.files.SNP=hsm2.SNP.SNP;';

	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
?>
<!-- main -->
<!-- main style="background-color:#499"-->
<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="page-header">
				<h1><a href=<?php echo "./result.php?searchTerm=". $row["SNP"];?>><?php echo $row["SNP"]; /* interim - need database bridge*/?></a></h1>
				<p><strong><?php echo "SNP at ". $row["SNP.chr"].":".$row["SNP.start"]."-".$row["SNP.stop"]; ?></strong></p>
				<p><strong><?php echo "in LD block " . $row["ld.chr"].":".$row["ld.start"]."-".$row["ld.stop"]; ?></strong></p>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-top: 2em">
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">
							<a data-toggle="collapse" href="#download">Downloads</a>
						</h2>	
					</div>
					<div id="download" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="container-fluid">
								<div class="row-fluid">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<p>Graph data as .txt.gz or image as .png</p>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<div class="btn-group">
											<!--<button type="button" class="btn btn-primary">Download <span class="glyphicon glyphicon-download"></span></button>-->
											<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
												Download <span class="glyphicon glyphicon-download"></span>&nbsp;<span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<li><a href=<?php echo '"./dataFiles/'.$row["dataFilename"].'"'?> download>Data</a></li>
												<li><a href=<?php echo '"./pValPosGraphs/'.$row["pValFilename"].'"'?> download>Graph (.png)</a></li>
												<li><a href=<?php echo '"./pValGraphs_pdf/'.$row["pValPDFfilename"].'"'?> download>Graph (.pdf)</a></li>
												<li><a href="./hsm_legend.png" download>Legend</a></li>
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
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">
							<a data-toggle="collapse" href="#key">key</a>
						</h2>	
					</div>
					<div id="key" class="panel-collapse collapse in">
						<div class="panel-body">
							<!--<img src=<?php echo '"./'.$row["boxplotFilename"].'"'?> style="width:100%" alt="Boxplot">-->
							<img src="./hsm_legend.png" style="width:60%" alt="key">
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
							<a data-toggle="collapse" href="#manhattan">p-value by Position</a>
						</h2>	
					</div>
					<div id="manhattan" class="panel-collapse collapse in">
						<div class="panel-body">
							<img src=<?php echo '"./pValPosGraphs/'.$row["pValFilename"].'"'?> style="width:100%" alt="manhattan">
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

</body>

<?php get_footer(); ?>

</html>