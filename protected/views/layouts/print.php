<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
	<?=$content?>
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>