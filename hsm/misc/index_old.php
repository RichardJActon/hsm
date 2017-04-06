<?php   include($_SERVER['DOCUMENT_ROOT']."/hsm/functions.php"); ?>
<!DOCTYPE html>
<?php get_header(); ?>

<body>
<!-- "-inverse" -->
<?php get_nav(); ?>

<?php $searchTerm = ""; ?>

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
</script>

<div class="container-fluid" style="margin-top: 7em">
	<div class="row-fluid">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		<!-- 	<button type="submit" class="btn btn-default btn-block" value="Search">
			Search <span class="glyphicon glyphicon-search"></span>
			</button> -->
		</div>
		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
			<form class="form-horizontal" method="get" action="result.php?searchTerm">
				<div class="form-group">
					<label class="sr-only" for="searchTerm">Search Term:</label>
					<input type="text" class="submit_on_enter form-control" id="searchTerm" name="searchTerm" placeholder="e.g. rs10127775"></input>
				</div>
			</form>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">	
			<span class="badge">2709</span>
		</div>
	</div>
	<div class="row-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
			<a href="./result.php" role="button" class="btn btn-primary">Example</a>
		</div>
	</div>
</div>


</body>

<?php get_footer(); ?>
</html>