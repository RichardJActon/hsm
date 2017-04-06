</!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php $count = 0; ?>
<p>Testing a counter <?php echo $count; ?></p>
<?php
while($x <= 10){$count++;$x++;};
echo $count;
?>

</body>
</html>