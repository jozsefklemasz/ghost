<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
  	<link href="/mvc/view/theme/main/style/images/favicon.png" rel="icon" />
	
	<?php foreach ($scripts as $script): ?>
	<script type="text/javascript" src="<?php echo $script ?>"></script>
	<?php endforeach ?>

	<?php foreach ($styles as $style): ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $style ?>">
	<?php endforeach ?>
</head>
<body>
