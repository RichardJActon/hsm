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
			<h2>Results For Individual Loci</h2>
			<ul>
				<!--<li><a href="./data/dataFilesChr/">All Data files - by Chromosome</a></li>-->
				<li><a href="download.php?type=1DISC_reslt_txt">1DISC Data files - by SNP</a></li>
				<li><a href="download.php?type=1DISC_graphs_png">1DISC p-Value Graphs (.png) - by SNP</a></li>
				<li><a href="download.php?type=1DISC_graphs_pdf">1DISC p-Value Graphs (.pdf) - by SNP</a></li>
				<li><a href="download.php?type=2FOLL_reslt_txt">2FOLL Data files - by SNP</a></li>
				<li><a href="download.php?type=2FOLL_graphs_png">2FOLL p-Value Graphs (.png) - by SNP</a></li>
				<li><a href="download.php?type=2FOLL_graphs_pdf">2FOLL p-Value Graphs (.pdf) - by SNP</a></li>
				<li><a href="download.php?type=3REPL_reslt_txt">3REPL Data files - by SNP</a></li>
				<li><a href="download.php?type=3REPL_graphs_png">3REPL p-Value Graphs (.png) - by SNP</a></li>
				<li><a href="download.php?type=3REPL_graphs_pdf">3REPL p-Value Graphs (.pdf) - by SNP</a></li>
				<li><a href="download.php?type=vALL_reslt_txt">vALL Data files - by SNP</a></li>
				<li><a href="download.php?type=vALL_graphs_png">vALL p-Value Graphs (.png) - by SNP</a></li>
				<li><a href="download.php?type=vALL_graphs_pdf">vALL p-Value Graphs (.pdf) - by SNP</a></li>
			</ul>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2>Whole Dataset Files</h2>
			<ul>
				<li><a href="./data/Supplementary_File1_mergeFinal_hsm.bed">Replicating HSM peaks</a></li>
				<li><a href="./data/hg19_500bp_NonSNPVariants.bed.gz">Variant Annotations</a></li>
			</ul>
		</div>		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2>Figures</h2>
			<ul>
				<li><a href="./img/hsm_legend.png">Variant Types Legend</a></li>
				<li><a href="./img/hsm_legend_extended.png">Variant Types Legend - Extended</a></li>
				<li><a href="./img/Bell2017Fig1_StudyDesign.png">Study Design summary figure (.png)</a></li>
				<li><a href="./img/Bell2017Fig1_StudyDesign.pdf">Study Design summary figure (.pdf)</a></li>
			</ul>
		</div>
	</div>
</div>

</body>

</html>
