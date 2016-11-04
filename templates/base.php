<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $metadata['title'].$metadata['separator'].$metadata['site_name'] ?></title>
	<meta name="viewport" content="width=device-width">
	<meta name="generator" content="Corkhammer">
	<link type="text/css" rel="stylesheet" href="example.css">
</head>
<body>
	<div>
		<h1><?php echo $metadata['title'] ?></h1>
		<div>
			<a href="index.html" <?php if($innerpath === 'index.html'){echo 'class="active"';} ?>>Index</a>
			<a href="foo.html" <?php if($innerpath === 'foo.html'){echo 'class="active"';} ?>>Foo</a>
		</div>
	</div>
	<article>
		<?php echo $contents ?>
	</article>
	<footer>
		Copyright and other stuff
	</footer>
</body>
</html>
