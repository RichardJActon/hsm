<?php   include("./src/functions.php"); ?>
<!DOCTYPE html>
<?php get_header(); ?>

<body>

<script src="./src/js/search.js"></script>

<?php get_nav_search(); ?>

<div class="container-fluid">

	<div class="row-fluid">
		<div class="page-header">
			<h1>About</h1>
		</div>
	</div>

	<div class="row-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<p>
				This website makes available the results from Bell C.G. et al., (2017) “Obligatory And Facilitative Allelic Variation In The DNA Methylome Within Common Disease-Associated Loci.”
			<p>
				This analysis was performed in 3,128 MeDIP-seq DNA methylomes derived from peripheral blood. The results present the allelic dosage association of EBI-NIH Catalogue GWAS SNPs with DNA methylation. This was assessed in 500 bp semi-overlapping windows across the respective GWAS SNP Linkage Disequilibrium Blocks. It therefore identifies significant regional DNA methylation variation between risk and non-risk GWAS SNP haplotypes for these robustly associated human diseases and phenotypes. Genetic variation (CNVs, Indels, STRs, etc.) potentially contributing to these signals due to obligatory, facilitative, or dosage effects are subsequently overlaid with these results.
			</p>
				Please see the publication for more detailed discussion of these data and results.
			</p>
			<p>
				This data is from MeDIP-seq experiments from the <a href="http://www.twinsuk.ac.uk/" target="_blank">TwinsUK</a> <a href="http://www.epitwin.eu/" target="_blank">EpiTwin</a> study. 
				<!--The original data is available on request from the European Genome-phenome Archive under: <a href="https://www.ebi.ac.uk/ega/datasets/EGAD00010000983" target="_blank">EGAD00010000983</a>.-->
			</p>
			<p>
				Code for this website can be found at: <a href="https://github.com/RichardJActon/hsm" target="_blank">github.com/RichardJActon/hsm</a>.
			</p>
		</div>
	</div>

</div>

<div class="container-fluid" style="margin-top: 7em">
	<div class="row-fluid">
		<div class="well well-sm">
			<p>Citation:</p>
			<p>...</p>
		</div>
	</div>
</div>

<div class="container-fluid" style="text-align: center; margin-top: 7em; margin-bottom: 7em">
	<div class="row-fluid">
		<p>Website created by <a href="http://orcid.org/0000-0002-2574-9611" target="_blank">Richard J. Acton</a></p>
		<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<a href="http://www.southampton.ac.uk/"><img src="./img/soton.gif" height="150em"></a>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<a href="http://www.mrc.soton.ac.uk/web2/"><img src="./img/WG10-RGB-LEU.png" height="100em"></a>
		</div>-->
	</div>
</div>

</body>

</html>
