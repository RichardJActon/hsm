<?php
require_once 'hsm/paginator.class.php';
$conn = new mysqli($serverName = "localhost","webuser","webuser","hsm2");

$limit = (isset($_GET['limit'])) ? $_GET['limit'] : 25;
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$links = (isset($_GET['links'])) ? $_GET['links'] : 5;
$query = "SELECT * FROM hsm2.SNP";

$paginator = new paginator($conn,$query);
$results = $paginator->getData($page,$limit);
?>

<!DOCTYPE html>
    <head>
        <title>PHP Pagination</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    </head>
    <body>
        <div class="container">
                <div class="col-md-10 col-md-offset-1">
                <h1>PHP Pagination</h1>
                <table class="table table-striped table-condensed table-bordered table-rounded">
                        <thead>
                                <tr>
                                <th>SNP</th>
                                <th width="20%">chr</th>
                                <th width="20%">start</th>
                                <th width="25%">stop</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($i=0; $i < count($results->data); $i++) : ?> 
						<tr>
							<td> <?php echo $results->$data[$i]['SNP']; ?> </td>
							<td> <?php echo $results->$data[$i]['chr']; ?> </td>
							<td> <?php echo $results->$data[$i]['start']; ?> </td>
							<td> <?php echo $results->$data[$i]['stop']; ?> </td>
						</tr>
						<?php endfor; ?>	
                        </tbody>
                </table>
                </div>
        </div>
        </body>
        <?php echo $paginator->createLinks($links,'pagination pagination-sm'); ?>
</html>

