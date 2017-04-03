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
				This website makes available the results of an analysis of the relationship between allelic dosage of genetic risk loci that have previously been significantly and reliably associated with human phenotypic variation (via NIH GWAS Catalogue) and DNA methylation of the genomic region harbouring it.
			</p>
			<p>
				The plots show the significance of the relationship between the methylation state of loci and the underlying genetic variants. Thus a high peak represents a more deterministic relationship between genotype and epigenotype, middling values a potentially more facilitative and low values as more purely epigenetic. There are however nuances to this interpretation please see [Bell et al. 2017] for more detailed discussion of these results.
			</p>
			<p>
				This data is from MeDIP-seq experiments from the <a href="http://www.twinsuk.ac.uk/">TwinsUK</a> <a href="http://www.epitwin.eu/">EpiTwin</a> study. The original data is available on request from the European Genome-phenome Archive under: <a href="https://www.ebi.ac.uk/ega/datasets/EGAD00010000983">EGAD00010000983</a>.
			</p>
			<p>
				Code for this website can be found at: <a href="https://github.com/RichardJActon/hsm">github.com/RichardJActon/hsm</a>.
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
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<a href="http://www.southampton.ac.uk/"><img src="./img/soton.gif" height="150em"></a>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<a href="http://www.mrc.soton.ac.uk/web2/"><img src="./img/WG10-RGB-LEU.png" height="100em"></a>
		</div>
	</div>
</div>

</body>

<?php get_footer(); ?>

</html>
